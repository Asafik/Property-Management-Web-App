<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KprDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpr_application_id',
        'type',
        'document_name',
        'path',
        'status',
        'catatan',
        'validated_by',
        'validated_at',
    ];

    public function kprApplication()
    {
        return $this->belongsTo(KprApplication::class);
    }

    public function validator()
    {
        return $this->belongsTo(Employee::class, 'validated_by');
    }

    public function getFormattedStatusAttribute()
    {
        return match ($this->status) {
            'disetujui' => 'Disetujui',
            'revisi'    => 'Perlu Revisi',
            'ditolak'   => 'Ditolak',
            default     => 'Menunggu Validasi',
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'disetujui' => 'badge-gradient-success bg-success text-white',
            'revisi'    => 'badge-gradient-warning bg-warning text-dark',
            'ditolak'   => 'badge-gradient-danger bg-danger text-white',
            default     => 'badge-gradient-secondary bg-secondary text-white',
        };
    }
}