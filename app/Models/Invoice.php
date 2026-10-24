<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'category',
        'pra_landbank_id',
        'booking_id',
        'title',
        'recipient_name',
        'recipient_contact',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'payment_method',
        'payment_status',
        'invoice_date',
        'due_date',
        'notes',
        'file_path',
        'created_by',
    ];

    protected $casts = [
        'total_amount'     => 'decimal:2',
        'paid_amount'      => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'invoice_date'     => 'date',
        'due_date'         => 'date',
    ];

    public function praLandbank(): BelongsTo
    {
        return $this->belongsTo(PraLandbank::class, 'pra_landbank_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Helper to automatically sync/generate Invoice from a PraLandbank model
     */
    public static function syncFromPraLandbank(PraLandbank $land): self
    {
        $year = $land->created_at ? $land->created_at->format('Y') : date('Y');
        $invoiceNumber = 'INV-PLB/' . $year . '/' . str_pad($land->id, 5, '0', STR_PAD_LEFT);

        $dealPrice = (float)($land->deal_price ?? $land->estimated_price ?? $land->offer_price ?? 0);
        $costIjb = (float)($land->cost_ijb ?? 0);
        $costTax = (float)($land->cost_tax ?? 0);
        $costBroker = (float)($land->cost_broker ?? 0);
        $costOther = (float)($land->cost_other ?? 0);
        $grandTotal = $dealPrice + $costIjb + $costTax + $costBroker + $costOther;

        $payments = $land->payments ?? collect([]);
        $paidAmount = 0;
        foreach ($payments as $pmt) {
            if (in_array(strtolower($pmt->status ?? ''), ['lunas', 'paid', 'verified'])) {
                $paidAmount += (float)$pmt->amount;
            }
        }

        // If cash method and payment marked as lunas or no separate payment row, check cash status
        if ($land->payment_method === 'cash') {
            $cashPmt = $payments->first();
            if ($cashPmt && in_array(strtolower($cashPmt->status ?? ''), ['lunas', 'paid'])) {
                $paidAmount = $cashPmt->amount > 0 ? (float)$cashPmt->amount : $grandTotal;
            }
        }

        $remainingAmount = max(0, $grandTotal - $paidAmount);

        $paymentStatus = 'pending';
        if ($paidAmount >= $grandTotal && $grandTotal > 0) {
            $paymentStatus = 'lunas';
        } elseif ($paidAmount > 0) {
            $paymentStatus = 'partial';
        }

        $recipient = $land->owner_name ?: ($land->certificate_owner ?: ($land->land_owner ?: 'Pemilik Lahan'));

        $invoice = self::updateOrCreate(
            ['pra_landbank_id' => $land->id],
            [
                'invoice_number'   => $invoiceNumber,
                'category'         => 'pra_landbank',
                'title'            => 'Pengadaan Lahan - ' . ($land->land_name ?? 'Lahan Pra Land Bank'),
                'recipient_name'   => $recipient,
                'recipient_contact'=> $land->owner_contact,
                'total_amount'     => $grandTotal,
                'paid_amount'      => $paidAmount,
                'remaining_amount' => $remainingAmount,
                'payment_method'   => $land->payment_method ?? 'cash',
                'payment_status'   => $paymentStatus,
                'invoice_date'     => $land->created_at ? $land->created_at->toDateString() : now()->toDateString(),
                'due_date'         => $payments->max('due_date') ?? now()->addDays(30)->toDateString(),
                'notes'            => $land->notes,
                'created_by'       => auth()->id() ?? null,
            ]
        );

        return $invoice;
    }

    /**
     * Helper to automatically sync/generate Invoice from a Booking UTJ
     */
    public static function createOrUpdateFromBookingUtj(Booking $booking, $utjTotal = null, $paidNow = null, $proofPath = null): ?self
    {
        $total = (float)($utjTotal !== null ? $utjTotal : ($booking->utj ?: ($booking->booking_fee ?? 0)));
        if ($total <= 0) {
            return null;
        }

        $booking->loadMissing(['customer', 'unit.landBank', 'sales', 'utjInstallments', 'payments']);
        $customer = $booking->customer;
        $unit = $booking->unit;
        $projectName = $unit->landBank->name ?? 'Proyek';
        $unitLabel = $unit ? ($unit->unit_code ?: ($unit->block . '-' . $unit->unit_number)) : 'Unit';

        $year = $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('Y') : date('Y');
        $invoiceNumber = 'INV-UTJ/' . $year . '/' . str_pad($booking->id, 5, '0', STR_PAD_LEFT);

        $recipientName = $customer->full_name ?? ($customer->name ?? 'Customer');
        $recipientContact = $customer->phone ?? ($customer->no_hp ?? ($customer->whatsapp ?? null));

        $paid = 0;
        if ($paidNow !== null) {
            $paid = (float)$paidNow;
        } else {
            $paid = (float)$booking->booking_fee;
            if ($booking->relationLoaded('utjInstallments')) {
                $paid += (float)$booking->utjInstallments->where('status', 'paid')->sum('amount');
            }
        }

        $remaining = max(0, $total - $paid);

        $status = 'pending';
        if ($paid >= $total && $total > 0) {
            $status = 'lunas';
        } elseif ($paid > 0) {
            $status = 'partial';
        }

        $filePath = $proofPath ?: optional($booking->payments->where('type', 'booking_fee')->first())->reference_number;

        $notes = 'Invoice Uang Tanda Jadi (UTJ) unit ' . $unitLabel . ' (' . $projectName . ')';
        if ($booking->utj_payment_type === 'cicilan') {
            $countInstallment = $booking->relationLoaded('utjInstallments') ? $booking->utjInstallments->count() : 0;
            if ($countInstallment > 0) {
                $notes .= ' dengan skema dicicil ' . $countInstallment . 'x.';
            } else {
                $notes .= ' dengan skema dicicil.';
            }
        }

        $invoice = self::updateOrCreate(
            [
                'booking_id' => $booking->id,
                'category'   => 'utj',
            ],
            [
                'invoice_number'   => $invoiceNumber,
                'title'            => 'Uang Tanda Jadi (UTJ) - ' . $unitLabel . ' (' . $projectName . ')',
                'recipient_name'   => $recipientName,
                'recipient_contact'=> $recipientContact,
                'total_amount'     => $total,
                'paid_amount'      => $paid,
                'remaining_amount' => $remaining,
                'payment_method'   => 'transfer',
                'payment_status'   => $status,
                'invoice_date'     => $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->toDateString() : now()->toDateString(),
                'due_date'         => now()->addDays(14)->toDateString(),
                'notes'            => $notes,
                'file_path'        => $filePath,
                'created_by'       => auth()->id() ?? ($booking->sales_id ?? null),
            ]
        );

        return $invoice;
    }

    /**
     * Helper to automatically sync/generate Invoice from a Booking IJB
     */
    public static function createOrUpdateFromBookingIjb(Booking $booking, $ijbAmount = null, $proofPath = null): ?self
    {
        $ijb = (float)($ijbAmount !== null ? $ijbAmount : ($booking->ijb ?? 0));
        if ($ijb <= 0) {
            return null;
        }

        $booking->loadMissing(['customer', 'unit.landBank', 'sales']);
        $customer = $booking->customer;
        $unit = $booking->unit;
        $projectName = $unit->landBank->name ?? 'Proyek';
        $unitLabel = $unit ? ($unit->unit_code ?: ($unit->block . '-' . $unit->unit_number)) : 'Unit';

        $year = $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('Y') : date('Y');
        $invoiceNumber = 'INV-IJB/' . $year . '/' . str_pad($booking->id, 5, '0', STR_PAD_LEFT);

        $recipientName = $customer->full_name ?? ($customer->name ?? 'Customer');
        $recipientContact = $customer->phone ?? ($customer->no_hp ?? ($customer->whatsapp ?? null));

        $filePath = $proofPath ?: ($booking->bukti_transfer_ijb ?: null);

        $invoice = self::updateOrCreate(
            [
                'booking_id' => $booking->id,
                'category'   => 'ijb',
            ],
            [
                'invoice_number'   => $invoiceNumber,
                'title'            => 'Ikatan Jual Beli (IJB) - ' . $unitLabel . ' (' . $projectName . ')',
                'recipient_name'   => $recipientName,
                'recipient_contact'=> $recipientContact,
                'total_amount'     => $ijb,
                'paid_amount'      => $filePath ? $ijb : 0,
                'remaining_amount' => $filePath ? 0 : $ijb,
                'payment_method'   => 'transfer',
                'payment_status'   => $filePath ? 'lunas' : 'pending',
                'invoice_date'     => $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->toDateString() : now()->toDateString(),
                'due_date'         => now()->addDays(7)->toDateString(),
                'notes'            => 'Invoice otomatis pembayaran Ikatan Jual Beli (IJB) untuk unit ' . $unitLabel . ' (' . $projectName . ') oleh customer ' . $recipientName . '.',
                'file_path'        => $filePath,
                'created_by'       => auth()->id() ?? ($booking->sales_id ?? null),
            ]
        );

        return $invoice;
    }

    /**
     * Helper to automatically sync/generate Invoice from an Akad AJB (Akta Jual Beli Notaris)
     */
    public static function createOrUpdateFromAkadAjb(Booking $booking, ?Akad $akad = null, $ajbAmount = null, $docPath = null): ?self
    {
        $akad = $akad ?: ($booking->akad ?: Akad::where('booking_id', $booking->id)->first());
        $ajb = (float)($ajbAmount !== null ? $ajbAmount : (($akad && ($akad->nominal_ajb ?? 0) > 0) ? $akad->nominal_ajb : ($booking->ajb ?? (optional($booking->unit)->ajb_price ?? 0))));

        $booking->loadMissing(['customer', 'unit.landBank', 'sales']);
        $customer = $booking->customer;
        $unit = $booking->unit;
        $projectName = $unit->landBank->name ?? 'Proyek';
        $unitLabel = $unit ? ($unit->unit_code ?: ($unit->block . '-' . $unit->unit_number)) : 'Unit';

        $year = ($akad && $akad->tanggal_akad) ? \Carbon\Carbon::parse($akad->tanggal_akad)->format('Y') : date('Y');
        $invoiceNumber = 'INV-AJB/' . $year . '/' . str_pad($booking->id, 5, '0', STR_PAD_LEFT);

        $recipientName = $customer->full_name ?? ($customer->name ?? 'Customer');
        $recipientContact = $customer->phone ?? ($customer->no_hp ?? ($customer->whatsapp ?? null));

        $filePath = $docPath ?: ($akad->dokumen_ajb ?? ($booking->bukti_transfer_ajb ?? ($akad->dokumen ?? null)));
        $notarisName = ($akad && !empty($akad->nama_notaris)) ? $akad->nama_notaris : '-';
        $noAjbText = ($akad && !empty($akad->no_ajb)) ? $akad->no_ajb : ($booking->no_ajb ?? '-');

        $invoice = self::updateOrCreate(
            [
                'booking_id' => $booking->id,
                'category'   => 'ajb',
            ],
            [
                'invoice_number'   => $invoiceNumber,
                'title'            => 'Akta Jual Beli (AJB) - ' . $unitLabel . ' (' . $projectName . ')',
                'recipient_name'   => $recipientName,
                'recipient_contact'=> $recipientContact,
                'total_amount'     => $ajb,
                'paid_amount'      => $filePath ? $ajb : 0,
                'remaining_amount' => $filePath ? 0 : $ajb,
                'payment_method'   => 'transfer',
                'payment_status'   => $filePath ? 'lunas' : 'pending',
                'invoice_date'     => ($akad && $akad->tanggal_akad) ? \Carbon\Carbon::parse($akad->tanggal_akad)->toDateString() : now()->toDateString(),
                'due_date'         => now()->addDays(7)->toDateString(),
                'notes'            => 'Invoice otomatis Akta Jual Beli (AJB) No. ' . $noAjbText . ' di hadapan Notaris ' . $notarisName . ' untuk unit ' . $unitLabel . ' (' . $projectName . ') oleh customer ' . $recipientName . '.',
                'file_path'        => $filePath,
                'created_by'       => auth()->id() ?? ($booking->sales_id ?? null),
            ]
        );

        return $invoice;
    }
}
