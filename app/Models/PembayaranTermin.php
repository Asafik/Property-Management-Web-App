<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembayaranTermin extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_termin';

    protected $fillable = [
        'development_progress_id',
        'land_bank_unit_id',
        'termin_ke',
        'nama_termin',
        'uraian_pekerjaan',
        'syarat_progress_persen',
        'persentase_bayar',
        'nominal',
        'status',
        'tanggal_jatuh_tempo',
        'tanggal_ajuan',
        'tanggal_bayar',
        'opname_id',
        'no_bukti_bayar',
        'file_bukti',
        'catatan',
        'dibayar_oleh',
        'disetujui_oleh',
    ];

    protected $casts = [
        'tanggal_jatuh_tempo'   => 'date:Y-m-d',
        'tanggal_ajuan'         => 'date:Y-m-d',
        'tanggal_bayar'         => 'date:Y-m-d',
        'syarat_progress_persen' => 'decimal:2',
        'persentase_bayar'      => 'decimal:2',
        'nominal'               => 'decimal:2',
        'termin_ke'             => 'integer',
    ];

    public function progress()
    {
        return $this->belongsTo(DevelopmentProgress::class, 'development_progress_id');
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'land_bank_unit_id');
    }

    public function opname()
    {
        return $this->belongsTo(OpnameMingguan::class, 'opname_id');
    }

    public function pembayar()
    {
        return $this->belongsTo(User::class, 'dibayar_oleh');
    }

    public function penyetuju()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    // Accessors
    public function getFormattedNominalAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->nominal, 0, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu'  => 'Menunggu',
            'diajukan'  => 'Diajukan',
            'disetujui' => 'Disetujui',
            'dibayar'   => 'Dibayar',
            'ditolak'   => 'Ditolak',
            default     => ucfirst($this->status ?? '-'),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'menunggu'  => 'secondary',
            'diajukan'  => 'warning',
            'disetujui' => 'info',
            'dibayar'   => 'success',
            'ditolak'   => 'danger',
            default     => 'secondary',
        };
    }
}
