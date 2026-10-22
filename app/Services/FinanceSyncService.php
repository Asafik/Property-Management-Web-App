<?php

namespace App\Services;

use App\Models\ChartOfAccount;
use App\Models\JournalEntry;
use App\Models\JournalEntryItem;
use App\Models\PraLandbankPayment;
use App\Models\LandBankInfrastructureExpense;
use App\Models\PembayaranTermin;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\CashTempoInstallment;
use App\Models\KprDisbursement;
use App\Models\Invoice;
use App\Models\LandBank;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FinanceSyncService
{
    /**
     * Sinkronisasi seluruh transaksi proyek yang sudah ada ke Buku Jurnal
     */
    public function syncAll(): array
    {
        $stats = [
            'pra_landbank'     => 0,
            'infrastructure'   => 0,
            'spk_termin'       => 0,
            'booking_payment'  => 0,
            'cash_tempo'       => 0,
            'kpr_disbursement' => 0,
            'invoices'         => 0,
        ];

        DB::beginTransaction();
        try {
            $stats['pra_landbank']     = $this->syncPraLandbankPayments();
            $stats['infrastructure']   = $this->syncInfrastructureExpenses();
            $stats['spk_termin']       = $this->syncSpkTerminPayments();
            $stats['booking_payment']  = $this->syncBookingPayments();
            $stats['cash_tempo']       = $this->syncCashTempoInstallments();
            $stats['kpr_disbursement'] = $this->syncKprDisbursements();
            $stats['invoices']         = $this->syncInvoices();

            DB::commit();
            return ['status' => true, 'stats' => $stats, 'message' => 'Sinkronisasi transaksi keuangan berhasil.'];
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error syncAll finance: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * 1. Sinkronisasi Pembayaran Pembebasan Lahan (Pra-Landbank)
     */
    protected function syncPraLandbankPayments(): int
    {
        $accDebit  = ChartOfAccount::where('code', '1-1201')->first(); // Persediaan Tanah Mentah
        $accCredit = ChartOfAccount::where('code', '1-1010')->first(); // Bank Operasional

        if (!$accDebit || !$accCredit) return 0;

        $payments = PraLandbankPayment::with('praLandbank')
            ->where(function($q) {
                $q->where('status', 'paid')
                  ->orWhere('status', 'lunas')
                  ->orWhereNotNull('due_date');
            })
            ->where('amount', '>', 0)
            ->get();

        $count = 0;
        foreach ($payments as $p) {
            $existing = JournalEntry::where('source_module', 'pra_landbank')
                ->where('reference_id', $p->id)
                ->first();

            $date = $p->due_date ? Carbon::parse($p->due_date) : $p->created_at;
            $landBankId = $p->praLandbank?->land_bank_id ?? null;
            $landName = $p->praLandbank?->land_name ?? ($p->praLandbank?->nama_lahan ?? 'Lahan');
            $ownerName = $p->praLandbank?->land_owner ?? ($p->praLandbank?->owner_name ?? ($p->praLandbank?->nama_pemilik ?? 'Pemilik Lahan'));
            $desc = "Pembayaran Tanah Pra-Landbank: " . $landName . " - " . ($p->term_name ?? 'Termin');

            if ($existing) {
                $existing->update([
                    'total_amount' => $p->amount,
                    'entry_date'   => $date,
                    'land_bank_id' => $landBankId,
                    'description'  => $desc,
                    'party_name'   => $ownerName,
                    'proof_file'   => $p->file_path ?? $existing->proof_file,
                ]);
                $this->updateJournalItems($existing, $accDebit->id, $accCredit->id, $p->amount);
            } else {
                $entryNumber = $this->generateEntryNumber('BKK', $date);
                $entry = JournalEntry::create([
                    'entry_number'       => $entryNumber,
                    'entry_date'         => $date,
                    'transaction_type'   => 'outflow',
                    'cash_flow_category' => 'investing',
                    'source_module'      => 'pra_landbank',
                    'reference_type'     => PraLandbankPayment::class,
                    'reference_id'       => $p->id,
                    'land_bank_id'       => $landBankId,
                    'description'        => $desc,
                    'party_name'         => $ownerName,
                    'payment_method'     => $p->payment_type ?? 'Transfer Bank',
                    'total_amount'       => $p->amount,
                    'proof_file'         => $p->file_path,
                    'is_auto_generated'  => true,
                ]);
                $this->createJournalItems($entry, $accDebit->id, $accCredit->id, $p->amount);
                $count++;
            }
        }
        return $count;
    }

    /**
     * 2. Sinkronisasi Pengeluaran Infrastruktur Lahan
     */
    protected function syncInfrastructureExpenses(): int
    {
        $accDebit  = ChartOfAccount::where('code', '5-5003')->first(); // HPP Infrastruktur
        $accCredit = ChartOfAccount::where('code', '1-1010')->first(); // Bank Operasional

        if (!$accDebit || !$accCredit) return 0;

        $expenses = LandBankInfrastructureExpense::with('landBank')
            ->where('total_amount', '>', 0)
            ->get();

        $count = 0;
        foreach ($expenses as $exp) {
            $existing = JournalEntry::where('source_module', 'infrastructure')
                ->where('reference_id', $exp->id)
                ->first();

            $date = $exp->expense_date ? Carbon::parse($exp->expense_date) : $exp->created_at;
            $desc = "Biaya Infrastruktur (" . ($exp->category ?? 'Pekerjaan') . "): " . ($exp->item_name ?? 'Material/Alat') . " - Proyek: " . ($exp->landBank?->nama_land_bank ?? 'Umum');

            if ($existing) {
                $existing->update([
                    'total_amount' => $exp->total_amount,
                    'entry_date'   => $date,
                    'land_bank_id' => $exp->land_bank_id,
                    'description'  => $desc,
                    'proof_file'   => $exp->receipt_proof ?? $existing->proof_file,
                ]);
                $this->updateJournalItems($existing, $accDebit->id, $accCredit->id, $exp->total_amount);
            } else {
                $entryNumber = $this->generateEntryNumber('BKK', $date);
                $entry = JournalEntry::create([
                    'entry_number'       => $entryNumber,
                    'entry_date'         => $date,
                    'transaction_type'   => 'outflow',
                    'cash_flow_category' => 'investing',
                    'source_module'      => 'infrastructure',
                    'reference_type'     => LandBankInfrastructureExpense::class,
                    'reference_id'       => $exp->id,
                    'land_bank_id'       => $exp->land_bank_id,
                    'description'        => $desc,
                    'party_name'         => $exp->vendor_name ?? 'Vendor Infrastruktur',
                    'payment_method'     => $exp->payment_method ?? 'Transfer Bank',
                    'total_amount'       => $exp->total_amount,
                    'proof_file'         => $exp->receipt_proof,
                    'is_auto_generated'  => true,
                ]);
                $this->createJournalItems($entry, $accDebit->id, $accCredit->id, $exp->total_amount);
                $count++;
            }
        }
        return $count;
    }

    /**
     * 3. Sinkronisasi Pembayaran Termin SPK Mandor / Pembangunan Unit
     */
    protected function syncSpkTerminPayments(): int
    {
        $accDebit  = ChartOfAccount::where('code', '5-5002')->first(); // HPP Konstruksi Unit
        $accCredit = ChartOfAccount::where('code', '1-1010')->first(); // Bank Operasional

        if (!$accDebit || !$accCredit) return 0;

        $termins = PembayaranTermin::with(['unit.landBank'])
            ->where(function($q) {
                $q->where('status', 'lunas')
                  ->orWhere('status', 'dibayar')
                  ->orWhere('status', 'disetujui')
                  ->orWhereNotNull('tanggal_bayar');
            })
            ->where('nominal', '>', 0)
            ->get();

        $count = 0;
        foreach ($termins as $t) {
            $existing = JournalEntry::where('source_module', 'spk_termin')
                ->where('reference_id', $t->id)
                ->first();

            $date = $t->tanggal_bayar ? Carbon::parse($t->tanggal_bayar) : ($t->tanggal_ajuan ? Carbon::parse($t->tanggal_ajuan) : $t->created_at);
            $landBankId = $t->unit?->land_bank_id ?? null;
            $unitName = $this->getUnitName($t->unit);
            $partyName = $t->unit?->kontraktor ?? 'Mandor / Kontraktor Proyek';
            $desc = "Pembayaran Termin Konstruksi (" . ($t->nama_termin ?? ('Termin ' . $t->termin_ke)) . ") - Unit: " . $unitName;

            if ($existing) {
                $existing->update([
                    'total_amount' => $t->nominal,
                    'entry_date'   => $date,
                    'land_bank_id' => $landBankId,
                    'description'  => $desc,
                    'party_name'   => $partyName,
                    'proof_file'   => $t->file_bukti ?? $existing->proof_file,
                ]);
                $this->updateJournalItems($existing, $accDebit->id, $accCredit->id, $t->nominal);
            } else {
                $entryNumber = $this->generateEntryNumber('BKK', $date);
                $entry = JournalEntry::create([
                    'entry_number'       => $entryNumber,
                    'entry_date'         => $date,
                    'transaction_type'   => 'outflow',
                    'cash_flow_category' => 'investing',
                    'source_module'      => 'spk_termin',
                    'reference_type'     => PembayaranTermin::class,
                    'reference_id'       => $t->id,
                    'land_bank_id'       => $landBankId,
                    'description'        => $desc,
                    'party_name'         => $partyName,
                    'payment_method'     => 'Transfer Bank',
                    'total_amount'       => $t->nominal,
                    'proof_file'         => $t->file_bukti,
                    'is_auto_generated'  => true,
                ]);
                $this->createJournalItems($entry, $accDebit->id, $accCredit->id, $t->nominal);
                $count++;
            }
        }
        return $count;
    }

    /**
     * 4. Sinkronisasi Penerimaan Booking Fee / UTJ
     */
    protected function syncBookingPayments(): int
    {
        $accDebit  = ChartOfAccount::where('code', '1-1001')->first(); // Kas Operasional
        $accCredit = ChartOfAccount::where('code', '4-4010')->first(); // Pendapatan Tanda Jadi / UTJ

        if (!$accDebit || !$accCredit) return 0;

        // Ambil dari payments table
        $payments = Payment::with(['booking.unit.landBank', 'booking.customer'])
            ->where('amount', '>', 0)
            ->get();

        $count = 0;
        foreach ($payments as $pay) {
            $existing = JournalEntry::where('source_module', 'booking_payment')
                ->where('reference_id', $pay->id)
                ->first();

            $date = $pay->payment_date ? Carbon::parse($pay->payment_date) : $pay->created_at;
            $booking = $pay->booking;
            $landBankId = $booking?->unit?->land_bank_id ?? null;
            $customerName = $this->getCustomerName($booking?->customer);
            $unitName = $this->getUnitName($booking?->unit);
            $payTypeLabel = $pay->type ? strtoupper(str_replace('_', ' ', $pay->type)) : 'PEMBAYARAN UNIT';
            $desc = "Penerimaan " . $payTypeLabel . " (" . $unitName . ") - Konsumen: " . $customerName;
            $proof = $pay->reference_number ?? null;

            if ($existing) {
                $existing->update([
                    'total_amount' => $pay->amount,
                    'entry_date'   => $date,
                    'land_bank_id' => $landBankId,
                    'description'  => $desc,
                    'party_name'   => $customerName,
                    'proof_file'   => $proof ?? $existing->proof_file,
                ]);
                $this->updateJournalItems($existing, $accDebit->id, $accCredit->id, $pay->amount);
            } else {
                $entryNumber = $this->generateEntryNumber('BKM', $date);
                $entry = JournalEntry::create([
                    'entry_number'       => $entryNumber,
                    'entry_date'         => $date,
                    'transaction_type'   => 'inflow',
                    'cash_flow_category' => 'operating',
                    'source_module'      => 'booking_payment',
                    'reference_type'     => Payment::class,
                    'reference_id'       => $pay->id,
                    'land_bank_id'       => $landBankId,
                    'description'        => $desc,
                    'party_name'         => $customerName,
                    'payment_method'     => $pay->method ?? 'Transfer Bank',
                    'total_amount'       => $pay->amount,
                    'proof_file'         => $proof,
                    'is_auto_generated'  => true,
                ]);
                $this->createJournalItems($entry, $accDebit->id, $accCredit->id, $pay->amount);
                $count++;
            }
        }

        // Ambil booking UTJ langsung jika tidak ada di payments
        $bookings = Booking::with(['unit.landBank', 'customer', 'payments'])
            ->where(function($q) {
                $q->where('utj', '>', 0)
                  ->orWhere('booking_fee', '>', 0);
            })
            ->get();

        foreach ($bookings as $b) {
            $amount = $b->utj > 0 ? $b->utj : $b->booking_fee;
            // Jika sudah ada payment yang mencakup ini, lewati
            if ($b->payments->sum('amount') >= $amount) {
                continue;
            }

            $existing = JournalEntry::where('source_module', 'booking_utj')
                ->where('reference_id', $b->id)
                ->first();

            $date = $b->booking_date ? Carbon::parse($b->booking_date) : $b->created_at;
            $landBankId = $b->unit?->land_bank_id ?? null;
            $customerName = $this->getCustomerName($b->customer);
            $unitName = $this->getUnitName($b->unit);
            $desc = "Penerimaan UTJ / Booking Fee (" . $unitName . ") - Konsumen: " . $customerName;

            if ($existing) {
                $existing->update([
                    'total_amount' => $amount,
                    'entry_date'   => $date,
                    'land_bank_id' => $landBankId,
                    'description'  => $desc,
                    'party_name'   => $customerName,
                ]);
                $this->updateJournalItems($existing, $accDebit->id, $accCredit->id, $amount);
            } else {
                $entryNumber = $this->generateEntryNumber('BKM', $date);
                $entry = JournalEntry::create([
                    'entry_number'       => $entryNumber,
                    'entry_date'         => $date,
                    'transaction_type'   => 'inflow',
                    'cash_flow_category' => 'operating',
                    'source_module'      => 'booking_utj',
                    'reference_type'     => Booking::class,
                    'reference_id'       => $b->id,
                    'land_bank_id'       => $landBankId,
                    'description'        => $desc,
                    'party_name'         => $customerName,
                    'payment_method'     => 'Transfer Bank',
                    'total_amount'       => $amount,
                    'is_auto_generated'  => true,
                ]);
                $this->createJournalItems($entry, $accDebit->id, $accCredit->id, $amount);
                $count++;
            }
        }

        return $count;
    }

    /**
     * 5. Sinkronisasi Pembayaran Angsuran Cash Bertempo
     */
    protected function syncCashTempoInstallments(): int
    {
        $accDebit  = ChartOfAccount::where('code', '1-1010')->first(); // Bank Operasional
        $accCredit = ChartOfAccount::where('code', '4-4003')->first(); // Pendapatan Cash Bertempo

        if (!$accDebit || !$accCredit) return 0;

        $installments = CashTempoInstallment::with(['cashTempo.booking.unit.landBank', 'cashTempo.booking.customer'])
            ->where(function($q) {
                $q->where('status', 'paid')
                  ->orWhere('status', 'lunas')
                  ->orWhereNotNull('tanggal_bayar');
            })
            ->where('nominal_angsuran', '>', 0)
            ->get();

        $count = 0;
        foreach ($installments as $ins) {
            $existing = JournalEntry::where('source_module', 'cash_tempo')
                ->where('reference_id', $ins->id)
                ->first();

            $date = $ins->tanggal_bayar ? Carbon::parse($ins->tanggal_bayar) : ($ins->jatuh_tempo ? Carbon::parse($ins->jatuh_tempo) : $ins->created_at);
            $booking = $ins->cashTempo?->booking;
            $landBankId = $booking?->unit?->land_bank_id ?? null;
            $customerName = $this->getCustomerName($booking?->customer);
            $unitName = $this->getUnitName($booking?->unit);
            $desc = "Angsuran Cash Bertempo Bulan Ke-" . $ins->bulan_ke . " (" . $unitName . ") - Konsumen: " . $customerName;

            if ($existing) {
                $existing->update([
                    'total_amount' => $ins->nominal_angsuran,
                    'entry_date'   => $date,
                    'land_bank_id' => $landBankId,
                    'description'  => $desc,
                    'party_name'   => $customerName,
                    'proof_file'   => $ins->bukti_bayar ?? $existing->proof_file,
                ]);
                $this->updateJournalItems($existing, $accDebit->id, $accCredit->id, $ins->nominal_angsuran);
            } else {
                $entryNumber = $this->generateEntryNumber('BKM', $date);
                $entry = JournalEntry::create([
                    'entry_number'       => $entryNumber,
                    'entry_date'         => $date,
                    'transaction_type'   => 'inflow',
                    'cash_flow_category' => 'operating',
                    'source_module'      => 'cash_tempo',
                    'reference_type'     => CashTempoInstallment::class,
                    'reference_id'       => $ins->id,
                    'land_bank_id'       => $landBankId,
                    'description'        => $desc,
                    'party_name'         => $customerName,
                    'payment_method'     => 'Transfer Bank',
                    'total_amount'       => $ins->nominal_angsuran,
                    'proof_file'         => $ins->bukti_bayar,
                    'is_auto_generated'  => true,
                ]);
                $this->createJournalItems($entry, $accDebit->id, $accCredit->id, $ins->nominal_angsuran);
                $count++;
            }
        }
        return $count;
    }

    /**
     * 6. Sinkronisasi Pencairan Dana KPR Bank
     */
    protected function syncKprDisbursements(): int
    {
        $accDebit  = ChartOfAccount::where('code', '1-1020')->first(); // Bank Escrow / KPR
        $accCredit = ChartOfAccount::where('code', '4-4001')->first(); // Pendapatan Penjualan Unit KPR

        if (!$accDebit || !$accCredit) return 0;

        $disbursements = KprDisbursement::with(['unit.landBank', 'kprApplication.booking.customer'])
            ->where('nominal_cair', '>', 0)
            ->get();

        $count = 0;
        foreach ($disbursements as $kpr) {
            $existing = JournalEntry::where('source_module', 'kpr_disbursement')
                ->where('reference_id', $kpr->id)
                ->first();

            $date = $kpr->tanggal_cair ? Carbon::parse($kpr->tanggal_cair) : $kpr->created_at;
            $landBankId = $kpr->unit?->land_bank_id ?? null;
            $customerName = $this->getCustomerName($kpr->kprApplication?->booking?->customer);
            $unitName = $this->getUnitName($kpr->unit ?? $kpr->kprApplication?->booking?->unit);
            $desc = "Pencairan Dana KPR Bank (" . ($kpr->bank_penyalur ?? 'Bank') . ") " . ($kpr->nama_termin ?? ('Termin ' . $kpr->termin_ke)) . " (" . $unitName . ") - Konsumen: " . $customerName;
            $partyName = $customerName !== 'Konsumen' ? $customerName : ($kpr->bank_penyalur ?? 'Bank Rekanan KPR');

            if ($existing) {
                $existing->update([
                    'total_amount' => $kpr->nominal_cair,
                    'entry_date'   => $date,
                    'land_bank_id' => $landBankId,
                    'description'  => $desc,
                    'party_name'   => $partyName,
                    'proof_file'   => $kpr->bukti_transfer ?? $existing->proof_file,
                ]);
                $this->updateJournalItems($existing, $accDebit->id, $accCredit->id, $kpr->nominal_cair);
            } else {
                $entryNumber = $this->generateEntryNumber('BKM', $date);
                $entry = JournalEntry::create([
                    'entry_number'       => $entryNumber,
                    'entry_date'         => $date,
                    'transaction_type'   => 'inflow',
                    'cash_flow_category' => 'financing',
                    'source_module'      => 'kpr_disbursement',
                    'reference_type'     => KprDisbursement::class,
                    'reference_id'       => $kpr->id,
                    'land_bank_id'       => $landBankId,
                    'description'        => $desc,
                    'party_name'         => $partyName,
                    'payment_method'     => 'Transfer Bank',
                    'total_amount'       => $kpr->nominal_cair,
                    'proof_file'         => $kpr->bukti_transfer,
                    'is_auto_generated'  => true,
                ]);
                $this->createJournalItems($entry, $accDebit->id, $accCredit->id, $kpr->nominal_cair);
                $count++;
            }
        }
        return $count;
    }

    /**
     * 7. Sinkronisasi Invoice Konsumen yang sudah terbayar
     */
    protected function syncInvoices(): int
    {
        $accDebit  = ChartOfAccount::where('code', '1-1010')->first(); // Bank Operasional
        $accCredit = ChartOfAccount::where('code', '4-4002')->first(); // Pendapatan Penjualan Unit Cash

        if (!$accDebit || !$accCredit) return 0;

        $invoices = Invoice::with(['booking.unit.landBank', 'praLandbank'])
            ->where(function($q) {
                $q->where('payment_status', 'paid')
                  ->orWhere('payment_status', 'lunas')
                  ->orWhere('paid_amount', '>', 0);
            })
            ->get();

        $count = 0;
        foreach ($invoices as $inv) {
            // Hindari duplikasi jika invoice terhubung ke booking/pra-landbank yang sudah disinkronkan
            if ($inv->booking_id || $inv->pra_landbank_id) {
                continue;
            }

            $amount = $inv->paid_amount > 0 ? $inv->paid_amount : $inv->total_amount;
            if ($amount <= 0) continue;

            $existing = JournalEntry::where('source_module', 'invoice')
                ->where('reference_id', $inv->id)
                ->first();

            $date = $inv->invoice_date ? Carbon::parse($inv->invoice_date) : $inv->created_at;
            $desc = "Penerimaan Tagihan Invoice " . $inv->invoice_number . ": " . ($inv->title ?? 'Pembayaran Konsumen');

            if ($existing) {
                $existing->update([
                    'total_amount' => $amount,
                    'entry_date'   => $date,
                    'description'  => $desc,
                    'proof_file'   => $inv->file_path ?? $existing->proof_file,
                ]);
                $this->updateJournalItems($existing, $accDebit->id, $accCredit->id, $amount);
            } else {
                $entryNumber = $this->generateEntryNumber('BKM', $date);
                $entry = JournalEntry::create([
                    'entry_number'       => $entryNumber,
                    'entry_date'         => $date,
                    'transaction_type'   => 'inflow',
                    'cash_flow_category' => 'operating',
                    'source_module'      => 'invoice',
                    'reference_type'     => Invoice::class,
                    'reference_id'       => $inv->id,
                    'description'        => $desc,
                    'party_name'         => $inv->recipient_name ?? 'Konsumen',
                    'payment_method'     => $inv->payment_method ?? 'Transfer Bank',
                    'total_amount'       => $amount,
                    'proof_file'         => $inv->file_path,
                    'is_auto_generated'  => true,
                ]);
                $this->createJournalItems($entry, $accDebit->id, $accCredit->id, $amount);
                $count++;
            }
        }
        return $count;
    }

    /**
     * Helper mengambil nama lengkap konsumen
     */
    public function getCustomerName($customer): string
    {
        if (!$customer) return 'Konsumen';
        return $customer->full_name 
            ?? $customer->nama_lengkap 
            ?? $customer->nama 
            ?? $customer->name 
            ?? 'Konsumen';
    }

    /**
     * Helper mengambil kode/nomor unit kavling
     */
    public function getUnitName($unit): string
    {
        if (!$unit) return 'Unit';
        if (!empty($unit->unit_code)) return 'Kavling ' . $unit->unit_code;
        if (!empty($unit->unit_number)) {
            $prefix = !empty($unit->block) ? $unit->block . '.' : '';
            return 'Kavling ' . $prefix . $unit->unit_number;
        }
        if (!empty($unit->unit_name)) return $unit->unit_name;
        if (!empty($unit->nama_unit)) return $unit->nama_unit;
        return 'Unit';
    }

    /**
     * Helper untuk membuat 2 baris item jurnal (Debit & Kredit)
     */
    public function createJournalItems(JournalEntry $entry, int $debitAccId, int $creditAccId, float $amount, ?string $memo = null): void
    {
        JournalEntryItem::create([
            'journal_entry_id' => $entry->id,
            'account_id'       => $debitAccId,
            'type'             => 'debit',
            'amount'           => $amount,
            'memo'             => $memo ?? $entry->description,
        ]);

        JournalEntryItem::create([
            'journal_entry_id' => $entry->id,
            'account_id'       => $creditAccId,
            'type'             => 'credit',
            'amount'           => $amount,
            'memo'             => $memo ?? $entry->description,
        ]);
    }

    /**
     * Helper untuk update 2 baris item jurnal (Debit & Kredit)
     */
    public function updateJournalItems(JournalEntry $entry, int $debitAccId, int $creditAccId, float $amount, ?string $memo = null): void
    {
        $entry->items()->delete();
        $this->createJournalItems($entry, $debitAccId, $creditAccId, $amount, $memo);
    }

    /**
     * Generate Nomor Transaksi / Jurnal
     */
    public function generateEntryNumber(string $prefix, Carbon|string $date): string
    {
        $d = is_string($date) ? Carbon::parse($date) : $date;
        $period = $d->format('Ym');
        $searchPrefix = "{$prefix}-{$period}-";

        $last = JournalEntry::where('entry_number', 'like', "{$searchPrefix}%")
            ->orderBy('id', 'desc')
            ->value('entry_number');

        if ($last) {
            $num = intval(substr($last, strrpos($last, '-') + 1)) + 1;
        } else {
            $num = 1;
        }

        return $searchPrefix . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Rekap Laporan Arus Kas (Cash Flow)
     */
    public function getCashFlowReport(?string $startDate = null, ?string $endDate = null, ?int $landBankId = null): array
    {
        $query = JournalEntry::with(['items.account', 'landBank'])
            ->whereIn('cash_flow_category', ['operating', 'investing', 'financing']);

        if ($startDate) {
            $query->where('entry_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('entry_date', '<=', $endDate);
        }
        if ($landBankId) {
            $query->where('land_bank_id', $landBankId);
        }

        $entries = $query->orderBy('entry_date', 'asc')->get();

        // Hitung Saldo Awal (Sebelum startDate)
        $saldoAwal = 0;
        if ($startDate) {
            $priorQuery = JournalEntry::whereIn('cash_flow_category', ['operating', 'investing', 'financing'])
                ->where('entry_date', '<', $startDate);
            if ($landBankId) {
                $priorQuery->where('land_bank_id', $landBankId);
            }
            $priorEntries = $priorQuery->get();
            $priorInflow = $priorEntries->where('transaction_type', 'inflow')->sum('total_amount');
            $priorOutflow = $priorEntries->where('transaction_type', 'outflow')->sum('total_amount');
            $saldoAwal = $priorInflow - $priorOutflow;
        }

        // Klasifikasi per Aktivitas
        $operatingInflows = $entries->where('cash_flow_category', 'operating')->where('transaction_type', 'inflow');
        $operatingOutflows = $entries->where('cash_flow_category', 'operating')->where('transaction_type', 'outflow');
        $netOperating = $operatingInflows->sum('total_amount') - $operatingOutflows->sum('total_amount');

        $investingInflows = $entries->where('cash_flow_category', 'investing')->where('transaction_type', 'inflow');
        $investingOutflows = $entries->where('cash_flow_category', 'investing')->where('transaction_type', 'outflow');
        $netInvesting = $investingInflows->sum('total_amount') - $investingOutflows->sum('total_amount');

        $financingInflows = $entries->where('cash_flow_category', 'financing')->where('transaction_type', 'inflow');
        $financingOutflows = $entries->where('cash_flow_category', 'financing')->where('transaction_type', 'outflow');
        $netFinancing = $financingInflows->sum('total_amount') - $financingOutflows->sum('total_amount');

        $totalInflow = $operatingInflows->sum('total_amount') + $investingInflows->sum('total_amount') + $financingInflows->sum('total_amount');
        $totalOutflow = $operatingOutflows->sum('total_amount') + $investingOutflows->sum('total_amount') + $financingOutflows->sum('total_amount');
        $netCashFlow = $totalInflow - $totalOutflow;
        $saldoAkhir = $saldoAwal + $netCashFlow;

        return [
            'saldo_awal'         => $saldoAwal,
            'saldo_akhir'        => $saldoAkhir,
            'total_inflow'       => $totalInflow,
            'total_outflow'      => $totalOutflow,
            'net_cash_flow'      => $netCashFlow,
            'operating_inflows'  => $operatingInflows,
            'operating_outflows' => $operatingOutflows,
            'net_operating'      => $netOperating,
            'investing_inflows'  => $investingInflows,
            'investing_outflows' => $investingOutflows,
            'net_investing'      => $netInvesting,
            'financing_inflows'  => $financingInflows,
            'financing_outflows' => $financingOutflows,
            'net_financing'      => $netFinancing,
            'all_entries'        => $entries,
        ];
    }

    /**
     * Rekap Laporan Laba Rugi (Profit & Loss / Income Statement)
     */
    public function getIncomeStatement(?string $startDate = null, ?string $endDate = null, ?int $landBankId = null): array
    {
        // Ambil item jurnal untuk akun Pendapatan (revenue), HPP (cogs), dan Beban (expense)
        $query = JournalEntryItem::with(['account', 'journalEntry.landBank'])
            ->whereHas('account', function($q) {
                $q->whereIn('category', ['revenue', 'cogs', 'expense']);
            });

        if ($startDate || $endDate || $landBankId) {
            $query->whereHas('journalEntry', function($q) use ($startDate, $endDate, $landBankId) {
                if ($startDate) $q->where('entry_date', '>=', $startDate);
                if ($endDate) $q->where('entry_date', '<=', $endDate);
                if ($landBankId) $q->where('land_bank_id', $landBankId);
            });
        }

        $items = $query->get();

        // 1. PENDAPATAN (Akun Normal Kredit)
        // Saldo Pendapatan = Kredit - Debit
        $revenueAccounts = ChartOfAccount::where('category', 'revenue')->orderBy('code')->get();
        $revenueData = [];
        $totalRevenue = 0;

        foreach ($revenueAccounts as $acc) {
            $accItems = $items->where('account_id', $acc->id);
            $credit = $accItems->where('type', 'credit')->sum('amount');
            $debit  = $accItems->where('type', 'debit')->sum('amount');
            $balance = $credit - $debit;

            if ($balance > 0 || $accItems->isNotEmpty()) {
                $revenueData[] = [
                    'account' => $acc,
                    'balance' => $balance,
                ];
                $totalRevenue += $balance;
            }
        }

        // 2. HARGA POKOK PENJUALAN (HPP) (Akun Normal Debit)
        // Saldo HPP = Debit - Kredit
        $cogsAccounts = ChartOfAccount::where('category', 'cogs')->orderBy('code')->get();
        $cogsData = [];
        $totalCogs = 0;

        foreach ($cogsAccounts as $acc) {
            $accItems = $items->where('account_id', $acc->id);
            $debit  = $accItems->where('type', 'debit')->sum('amount');
            $credit = $accItems->where('type', 'credit')->sum('amount');
            $balance = $debit - $credit;

            if ($balance > 0 || $accItems->isNotEmpty()) {
                $cogsData[] = [
                    'account' => $acc,
                    'balance' => $balance,
                ];
                $totalCogs += $balance;
            }
        }

        // Laba Kotor = Total Pendapatan - Total HPP
        $grossProfit = $totalRevenue - $totalCogs;
        $grossProfitMargin = $totalRevenue > 0 ? ($grossProfit / $totalRevenue) * 100 : 0;

        // 3. BEBAN OPERASIONAL (Akun Normal Debit)
        // Saldo Beban = Debit - Kredit
        $expenseAccounts = ChartOfAccount::where('category', 'expense')->orderBy('code')->get();
        $expenseData = [];
        $totalExpense = 0;

        foreach ($expenseAccounts as $acc) {
            $accItems = $items->where('account_id', $acc->id);
            $debit  = $accItems->where('type', 'debit')->sum('amount');
            $credit = $accItems->where('type', 'credit')->sum('amount');
            $balance = $debit - $credit;

            if ($balance > 0 || $accItems->isNotEmpty()) {
                $expenseData[] = [
                    'account' => $acc,
                    'balance' => $balance,
                ];
                $totalExpense += $balance;
            }
        }

        // Laba Bersih = Laba Kotor - Total Beban
        $netIncome = $grossProfit - $totalExpense;
        $netIncomeMargin = $totalRevenue > 0 ? ($netIncome / $totalRevenue) * 100 : 0;

        return [
            'revenue_data'        => $revenueData,
            'total_revenue'       => $totalRevenue,
            'cogs_data'           => $cogsData,
            'total_cogs'          => $totalCogs,
            'gross_profit'        => $grossProfit,
            'gross_profit_margin' => $grossProfitMargin,
            'expense_data'        => $expenseData,
            'total_expense'       => $totalExpense,
            'net_income'          => $netIncome,
            'net_income_margin'   => $netIncomeMargin,
        ];
    }

    /**
     * Rekap Neraca Keuangan (Balance Sheet) per Tanggal Tertentu
     */
    public function getBalanceSheet(?string $asOfDate = null, ?int $landBankId = null): array
    {
        $asOf = $asOfDate ? Carbon::parse($asOfDate) : Carbon::today();

        // Ambil semua item jurnal sampai tanggal $asOf
        $query = JournalEntryItem::with(['account', 'journalEntry'])
            ->whereHas('journalEntry', function($q) use ($asOf, $landBankId) {
                $q->where('entry_date', '<=', $asOf->format('Y-m-d'));
                if ($landBankId) {
                    $q->where('land_bank_id', $landBankId);
                }
            });

        $items = $query->get();

        // 1. ASET (Aktiva) - Normal Debit (Debit - Kredit)
        $assetAccounts = ChartOfAccount::where('category', 'asset')->orderBy('code')->get();
        $assetsCurrent = [];
        $assetsProject = [];
        $totalAssets = 0;

        foreach ($assetAccounts as $acc) {
            $accItems = $items->where('account_id', $acc->id);
            $debit  = $accItems->where('type', 'debit')->sum('amount');
            $credit = $accItems->where('type', 'credit')->sum('amount');
            $balance = $debit - $credit;

            $itemData = [
                'account' => $acc,
                'balance' => $balance,
            ];

            if ($acc->sub_category === 'Persediaan Properti') {
                $assetsProject[] = $itemData;
            } else {
                $assetsCurrent[] = $itemData;
            }
            $totalAssets += $balance;
        }

        // 2. KEWAJIBAN (Liabilitas) - Normal Kredit (Kredit - Debit)
        $liabilityAccounts = ChartOfAccount::where('category', 'liability')->orderBy('code')->get();
        $liabilities = [];
        $totalLiabilities = 0;

        foreach ($liabilityAccounts as $acc) {
            $accItems = $items->where('account_id', $acc->id);
            $credit = $accItems->where('type', 'credit')->sum('amount');
            $debit  = $accItems->where('type', 'debit')->sum('amount');
            $balance = $credit - $debit;

            $liabilities[] = [
                'account' => $acc,
                'balance' => $balance,
            ];
            $totalLiabilities += $balance;
        }

        // 3. EKUITAS (Equity) - Normal Kredit (Kredit - Debit)
        $equityAccounts = ChartOfAccount::where('category', 'equity')->orderBy('code')->get();
        $equity = [];
        $totalEquityBase = 0;

        foreach ($equityAccounts as $acc) {
            if ($acc->code === '3-3003') {
                // Akun Laba Tahun Berjalan akan dihitung dari Income Statement
                continue;
            }
            $accItems = $items->where('account_id', $acc->id);
            $credit = $accItems->where('type', 'credit')->sum('amount');
            $debit  = $accItems->where('type', 'debit')->sum('amount');
            $balance = $credit - $debit;

            $equity[] = [
                'account' => $acc,
                'balance' => $balance,
            ];
            $totalEquityBase += $balance;
        }

        // Hitung Laba/Rugi Tahun Berjalan (Net Income kumulatif s/d tanggal asOf)
        $incomeStatement = $this->getIncomeStatement(null, $asOf->format('Y-m-d'), $landBankId);
        $currentYearProfit = $incomeStatement['net_income'];

        $equity[] = [
            'account' => (object)[
                'code' => '3-3003',
                'name' => 'Laba / Rugi Berjalan (Net Income)',
                'sub_category' => 'Laba Periode Berjalan',
            ],
            'balance' => $currentYearProfit,
        ];

        $totalEquity = $totalEquityBase + $currentYearProfit;
        $totalLiabilitiesAndEquity = $totalLiabilities + $totalEquity;
        $isBalanced = abs($totalAssets - $totalLiabilitiesAndEquity) < 1.0;
        $difference = $totalAssets - $totalLiabilitiesAndEquity;

        return [
            'as_of_date'                   => $asOf->format('Y-m-d'),
            'assets_current'               => $assetsCurrent,
            'assets_project'               => $assetsProject,
            'total_assets'                 => $totalAssets,
            'liabilities'                  => $liabilities,
            'total_liabilities'            => $totalLiabilities,
            'equity'                       => $equity,
            'total_equity'                 => $totalEquity,
            'total_liabilities_and_equity' => $totalLiabilitiesAndEquity,
            'is_balanced'                  => $isBalanced,
            'difference'                   => $difference,
        ];
    }
}
