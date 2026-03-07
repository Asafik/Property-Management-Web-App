<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KprApplication extends Model
{
    protected $fillable = [
    'unit_id',
    'customer_id',
    'booking_id',
    'banks_id',
    'sales_id',
    'harga_unit',
    'dp',
    'tenor',
    'jumlah_pinjaman',
    'bunga',
    'estimasi_angsuran',
    'status',
    'submitted_at',
    'approved_at',
    'rejected_at',
    'akad_at',
    'catatan',
    'catatan_survey',        // catatan dari survey
    'berita_acara',
    'no_sp3k',
    'appraisal_value',       // nilai appraisal dari survey
    'luas_tanah',            // luas tanah m²
    'luas_bangunan',         // luas bangunan m²
    'kondisi_bangunan',      // kondisi bangunan
    'listrik',               // checklist listrik
    'air',                   // checklist PDAM / air bersih
    'akses',                 // checklist akses jalan
    'sertifikat',            // checklist sertifikat
    'shm',                   // checklist SHM/SHGB
    'imb',                   // checklist IMB
    'foto_depan',            // path foto tampak depan
    'foto_interior',         // path foto interior
    'foto_lingkungan',       // path foto lingkungan
    'rekomendasi',           // rekomendasi survey
    'persentase_kelayakan',  // persentase kelayakan survey
    'surveyor_id'            // ID surveyor (relasi employee)
];

    // relasi
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function unit()
    {
        return $this->belongsTo(LandBankUnit::class);
    }

    public function bank()
    {
        return $this->belongsTo(Banks::class, 'banks_id');
    }

    public function sales()
    {
        return $this->belongsTo(Employee::class, 'sales_id');
    }
    public function documents()
{
    return $this->hasMany(KprDocument::class);
}
    public function booking()
{
    return $this->belongsTo(Booking::class);
}
}
