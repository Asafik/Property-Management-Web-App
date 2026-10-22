<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpnameMingguan extends Model
{
    use HasFactory;

    protected $table = 'opname_mingguan';

    protected $fillable = [
        'development_progress_id',
        'land_bank_unit_id',
        'development_progress_item_id',
        'no_opname',
        'minggu_ke',
        'tanggal_mulai_minggu',
        'tanggal_akhir_minggu',
        'progress_minggu_ini',
        'progress_kumulatif',
        'uraian_pekerjaan',
        'jumlah_pekerja',
        'material_digunakan',
        'kendala',
        'solusi',
        'rencana_minggu_depan',
        'status',
        'dibuat_oleh',
        'disetujui_oleh',
        'tanggal_disetujui',
        'catatan_reviewer',
        'foto_dokumentasi',
        'catatan',
    ];

    protected $casts = [
        'tanggal_mulai_minggu'  => 'date:Y-m-d',
        'tanggal_akhir_minggu'  => 'date:Y-m-d',
        'progress_minggu_ini'   => 'decimal:2',
        'progress_kumulatif'    => 'decimal:2',
        'uraian_pekerjaan'      => 'array',
        'tanggal_disetujui'     => 'datetime',
    ];

    public function progress()
    {
        return $this->belongsTo(DevelopmentProgress::class, 'development_progress_id');
    }

    public function item()
    {
        return $this->belongsTo(DevelopmentProgressItem::class, 'development_progress_item_id');
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'land_bank_unit_id');
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function penyetuju()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    public function terminPembayaran()
    {
        return $this->hasMany(PembayaranTermin::class, 'opname_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft'     => 'Draft',
            'diajukan'  => 'Diajukan',
            'disetujui' => 'Disetujui',
            'ditolak'   => 'Ditolak',
            default     => ucfirst($this->status ?? '-'),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'draft'     => 'secondary',
            'diajukan'  => 'warning',
            'disetujui' => 'success',
            'ditolak'   => 'danger',
            default     => 'secondary',
        };
    }
}
