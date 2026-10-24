<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingUtjInstallment extends Model
{
    use HasFactory;

    protected $table = 'booking_utj_installments';

    protected $fillable = [
        'booking_id',
        'installment_number',
        'amount',
        'due_date',
        'status',
        'payment_date',
        'payment_method',
        'proof_file',
        'notes',
    ];

    protected $casts = [
        'installment_number' => 'integer',
        'amount'             => 'integer',
        'due_date'           => 'date',
        'payment_date'       => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
