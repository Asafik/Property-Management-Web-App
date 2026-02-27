<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Promo extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'validity_period',
        'start_date',
        'end_date',
        'type',
        'category',
        'value',
        'duration_days',
        'status'
    ];
    public function getStatusAttribute($value)
{
    if (
        $this->validity_period === 'periode' &&
        $this->end_date &&
        Carbon::today()->gt(Carbon::parse($this->end_date))
    ) {
        return 'tidak_aktif';
    }

    return $value;
}
}
