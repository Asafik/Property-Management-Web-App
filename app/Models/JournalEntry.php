<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JournalEntry extends Model
{
    use HasFactory;

    protected $table = 'journal_entries';

    protected $fillable = [
        'entry_number',
        'entry_date',
        'transaction_type',
        'cash_flow_category',
        'source_module',
        'reference_type',
        'reference_id',
        'land_bank_id',
        'description',
        'party_name',
        'payment_method',
        'total_amount',
        'proof_file',
        'is_auto_generated',
        'created_by',
    ];

    protected $casts = [
        'entry_date'        => 'date',
        'total_amount'      => 'decimal:2',
        'is_auto_generated' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(JournalEntryItem::class, 'journal_entry_id');
    }

    public function landBank(): BelongsTo
    {
        return $this->belongsTo(LandBank::class, 'land_bank_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function debitItems(): HasMany
    {
        return $this->hasMany(JournalEntryItem::class, 'journal_entry_id')->where('type', 'debit');
    }

    public function creditItems(): HasMany
    {
        return $this->hasMany(JournalEntryItem::class, 'journal_entry_id')->where('type', 'credit');
    }

    public function getProofUrlAttribute(): ?string
    {
        if (!$this->proof_file) {
            return null;
        }

        $path = ltrim($this->proof_file, '/\\');

        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        if (file_exists(public_path('uploads/' . $path))) {
            return asset('uploads/' . $path);
        }

        return asset('storage/' . $path);
    }
}
