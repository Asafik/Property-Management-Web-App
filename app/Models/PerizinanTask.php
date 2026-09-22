<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerizinanTask extends Model
{
    use HasFactory;

    protected $table = 'perizinan_tasks';

    protected $fillable = [
        'proyek_id',
        'proyek_nama',
        'master_dokumen_id',
        'nama_tugas',
        'instansi',
        'employee_id',
        'assigned_by',
        'updated_by',
        'deadline',
        'status',
        'progress',
        'nomor_dokumen',
        'tanggal_terbit',
        'catatan',
        'kendala',
        'file_dokumen',
        'last_activity_at',
    ];

    protected $casts = [
        'deadline'         => 'date',
        'tanggal_terbit'   => 'date',
        'progress'         => 'integer',
        'last_activity_at' => 'datetime',
    ];

    /**
     * Staf Legal yang ditugaskan (Pelaksana)
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Alias staf yang ditugaskan
     */
    public function assignedStaff()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Pemberi tugas (Kepala Legal / Owner / Admin)
     */
    public function assigner()
    {
        return $this->belongsTo(Employee::class, 'assigned_by');
    }

    /**
     * User/Staf terakhir yang mengupdate data / status
     */
    public function updater()
    {
        return $this->belongsTo(Employee::class, 'updated_by');
    }

    /**
     * Proyek / Tanah Pra Land Bank terkait
     */
    public function proyek()
    {
        return $this->belongsTo(PraLandbank::class, 'proyek_id');
    }

    /**
     * Master Dokumen Perizinan template (jika ada)
     */
    public function masterDokumen()
    {
        return $this->belongsTo(MasterDokumenPerizinan::class, 'master_dokumen_id');
    }

    /**
     * Riwayat aktivitas / audit trail log
     */
    public function logs()
    {
        return $this->hasMany(PerizinanTaskLog::class, 'perizinan_task_id')->latest();
    }
}
