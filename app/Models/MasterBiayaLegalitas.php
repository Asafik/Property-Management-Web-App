<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBiayaLegalitas extends Model
{
    use HasFactory;

    protected $table = 'master_biaya_legalitas';

    protected $fillable = [
        'kode_biaya',
        'nama_biaya',
        'kategori',
        'tipe_perhitungan',
        'nominal_standar',
        'persentase_standar',
        'pihak_penanggung',
        'deskripsi',
        'urutan',
        'is_standard',
        'is_required',
        'is_active',
    ];

    protected $casts = [
        'is_standard'        => 'boolean',
        'is_required'        => 'boolean',
        'is_active'          => 'boolean',
        'nominal_standar'    => 'integer',
        'persentase_standar' => 'float',
        'urutan'             => 'integer',
    ];

    /**
     * Scope item aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan', 'asc')->orderBy('nama_biaya', 'asc');
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
            'Legalitas & Notaris'       => 'Notaris, IJB, PPJB & Legalitas Transaksi',
            'Pajak & Retribusi'         => 'Pajak (PPh, BPHTB) & Retribusi Pemda',
            'Perantara & Broker'        => 'Fee Agen, Makelar & Perantara Lahan',
            'Perizinan & Kas Desa'      => 'Kompensasi Desa, Saksi Batas & Izin Lingkungan',
            'Administrasi & Operasional' => 'Biaya Plotting, Pengukuran & Operasional Lainnya',
        ];
    }

    /**
     * Daftar Pihak Penanggung
     */
    public static function getPihakPenanggung(): array
    {
        return [
            'perusahaan' => 'Beban Perusahaan (Developer)',
            'pembeli'    => 'Beban Pembeli',
            'penjual'    => 'Beban Penjual / Pemilik Asal',
            'bagi_dua'   => 'Bagi Dua (50 : 50)',
            'opsional'   => 'Kesepakatan / Fleksibel',
        ];
    }
}
