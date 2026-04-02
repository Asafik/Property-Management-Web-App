<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingTask extends Model
{
    //
    protected $fillable = [
        'employee_id',
        'nama_tugas',
        'deskripsi',
        'deadline',
        'status',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function guest()
    {
        return $this->hasMany(Guest::class, 'marketing_task_id');
    }
}
