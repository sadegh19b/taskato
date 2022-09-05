<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Category extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = [
        'title',
        'is_group',
        'parent_id',
    ];

    protected $casts = [
        'is_group' => 'boolean'
    ];

    protected static function booted(): void
    {
        static::saved(function ($model) {
            Cache::forget('categories');
        });
        static::deleted(function ($model) {
            Cache::forget('categories');
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->ordered();
    }

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }
}
