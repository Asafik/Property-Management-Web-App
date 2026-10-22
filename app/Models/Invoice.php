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
}
