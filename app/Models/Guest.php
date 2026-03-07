<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    //
    protected $table = 'guests';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'source',
        'land_bank_id',
        'unit_id',
        'notes',
        'status',
        'assigned_to',
        'last_follow_up',
        'next_follow_up'
    ];

    public function project()
{
    return $this->belongsTo(LandBank::class, 'land_bank_id');
}
public function unit()
{
    return $this->belongsTo(LandBankUnit::class);
}
public function employee()
{
    return $this->belongsTo(Employee::class, 'assigned_to');
}
}
