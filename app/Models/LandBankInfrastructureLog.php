<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandBankInfrastructureLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'land_bank_infrastructure_id',
        'log_date',
        'volume_achieved',
        'cumulative_volume',
        'progress_percent',
        'mandor_name',
        'photo_documentation',
        'notes',
        'recorded_by',
    ];

    protected $casts = [
        'log_date'          => 'date',
        'volume_achieved'   => 'float',
        'cumulative_volume' => 'float',
        'progress_percent'  => 'float',
    ];

    public function infrastructure()
    {
        return $this->belongsTo(LandBankInfrastructure::class, 'land_bank_infrastructure_id');
    }

    public function recorder()
    {
        return $this->belongsTo(Employee::class, 'recorded_by');
    }
}
