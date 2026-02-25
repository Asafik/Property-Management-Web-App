<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDocument extends Model
{
    //
    protected $fillable = [
    'customer_id',
    'document_name',
    'document_number',
    'file',
    'upload_date',
    'status'
];
    public function customer()
{
    return $this->belongsTo(Customer::class);
}
}
