<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDokumenPerizinan extends Model
{
    use HasFactory;

    protected $table = 'master_dokumen_perizinans';

    protected $fillable = [
        'kode_dokumen',
        'nama_dokumen',
        'kategori',
        'instansi_terkait',
        'estimasi_hari',
        'estimasi_biaya',
        'syarat_dokumen',
        'deskripsi',
        'urutan',
        'is_active',
        'is_required',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_required' => 'boolean',
        'estimasi_hari' => 'integer',
        'estimasi_biaya' => 'integer',
        'urutan' => 'integer',
    ];

    /**
     * Scope untuk mengambil perizinan yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan', 'asc')->orderBy('nama_dokumen', 'asc');
    }

    /**
     * Scope filter berdasarkan kategori
     */
    public function scopeKategori($query, $kategori)
    {
        if (!empty($kategori) && $kategori !== 'all') {
            return $query->where('kategori', $kategori);
        }
        return $query;
    }

    /**
     * Daftar Kategori Standar
     */
    public static function getCategories(): array
    {
        return [
            'Pertanahan & BPN'         => 'Kantor Pertanahan / ATR BPN',
            'Tata Ruang & PUPR'        => 'Dinas PUPR / Tata Ruang',
            'Kementerian & OSS RBA'    => 'Kementerian Investasi / DPMPTSP',
            'Lingkungan Hidup (DLH)'   => 'Dinas Lingkungan Hidup',
            'Perpajakan & Bapenda'     => 'Bapenda / BPKAD / KPP Pratama',
            'Desa & Kecamatan'         => 'Kelurahan / Desa & Kantor Kecamatan',
            'Perizinan Gedung (PBG)'   => 'Dinas Cipta Karya / SIMBG',
            'PSU & Disperkim'          => 'Dinas Perumahan & Kawasan Permukiman',
            'Utilitas & Rekomendasi'   => 'PLN, PDAM, Telkom & Damkar',
            'Lainnya'                  => 'Lembaga / Instansi Terkait Lainnya'
        ];
    }
}
