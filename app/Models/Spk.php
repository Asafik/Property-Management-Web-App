<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\SpkTermin;

class Spk extends Model
{
    use HasFactory;

    protected $table = 'spks';

    protected $fillable = [
        'no_spk',
        'land_bank_id',
        'land_bank_unit_id',
        'jenis_spk',
        'nama_pekerjaan',
        'deskripsi_pekerjaan',
        'pihak_pertama_nama',
        'pihak_pertama_jabatan',
        'pihak_pertama_perusahaan',
        'pihak_pertama_alamat',
        'pihak_pertama_telepon',
        'kontraktor_nama',
        'kontraktor_pic',
        'kontraktor_ktp',
        'kontraktor_telepon',
        'kontraktor_alamat',
        'kontraktor_bank',
        'kontraktor_rekening',
        'kontraktor_atas_nama',
        'tanggal_spk',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_hari',
        'nilai_kontrak',
        'sistem_pembayaran',
        'status',
        'progress',
        'file_lampiran',
        'pasal_syarat_ketentuan',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_spk' => 'date:Y-m-d',
        'tanggal_mulai' => 'date:Y-m-d',
        'tanggal_selesai' => 'date:Y-m-d',
        'nilai_kontrak' => 'decimal:2',
        'durasi_hari' => 'integer',
        'progress' => 'integer',
    ];

    public function landBank()
    {
        return $this->belongsTo(LandBank::class, 'land_bank_id');
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class, 'land_bank_unit_id');
    }

    public function termins()
    {
        return $this->hasMany(SpkTermin::class, 'spk_id')->orderBy('termin_ke', 'asc');
    }

    /**
     * Format Rupiah helper
     */
    public function getFormattedNilaiKontrakAttribute()
    {
        return 'Rp ' . number_format($this->nilai_kontrak, 0, ',', '.');
    }

    /**
     * Terbilang Rupiah Helper
     */
    public function getTerbilangAttribute()
    {
        return self::penyebut($this->nilai_kontrak) . ' Rupiah';
    }

    public static function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = self::penyebut($nilai - 10) . " Belas";
        } else if ($nilai < 100) {
            $temp = self::penyebut(floor($nilai / 10)) . " Puluh " . self::penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus " . self::penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = self::penyebut(floor($nilai / 100)) . " Ratus " . self::penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu " . self::penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = self::penyebut(floor($nilai / 1000)) . " Ribu " . self::penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = self::penyebut(floor($nilai / 1000000)) . " Juta " . self::penyebut(fmod($nilai, 1000000));
        } else if ($nilai < 1000000000000) {
            $temp = self::penyebut(floor($nilai / 1000000000)) . " Milyar " . self::penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = self::penyebut(floor($nilai / 1000000000000)) . " Triliun " . self::penyebut(fmod($nilai, 1000000000000));
        }
        return preg_replace('/\s+/', ' ', trim($temp));
    }
}
