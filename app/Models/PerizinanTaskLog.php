<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerizinanTaskLog extends Model
{
    use HasFactory;

    protected $table = 'perizinan_task_logs';

    protected $fillable = [
        'perizinan_task_id',
        'user_id',
        'action',
        'old_status',
        'new_status',
        'old_progress',
        'new_progress',
        'keterangan',
        'file_dokumen',
    ];

    protected $casts = [
        'old_progress' => 'integer',
        'new_progress' => 'integer',
    ];

    /**
     * Relasi ke tugas perizinan
     */
    public function task()
    {
        return $this->belongsTo(PerizinanTask::class, 'perizinan_task_id');
    }

    /**
     * Relasi ke user / pegawai yang melakukan update
     */
    public function user()
    {
        return $this->belongsTo(Employee::class, 'user_id');
    }
}
