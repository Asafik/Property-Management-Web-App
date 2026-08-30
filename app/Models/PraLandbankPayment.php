<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PraLandbankPayment extends Model
{
    protected $fillable = [
        'pra_landbank_id',
        'term_name',
        'amount',
        'due_date',
        'file_path',
        'status',
        'payment_type',
        'bank_name',
        'account_number',
        'account_name'
    ];

    public function praLandbank()
    {
        return $this->belongsTo(PraLandbank::class, 'pra_landbank_id');
    }
}
