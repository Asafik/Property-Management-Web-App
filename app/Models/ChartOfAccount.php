<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChartOfAccount extends Model
{
    use HasFactory;

    protected $table = 'chart_of_accounts';

    protected $fillable = [
        'code',
        'name',
        'category',
        'sub_category',
        'normal_balance',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function journalItems(): HasMany
    {
        return $this->hasMany(JournalEntryItem::class, 'account_id');
    }

    /**
     * Scope active accounts
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
