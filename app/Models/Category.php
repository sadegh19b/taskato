<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Category extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $guarded = ['id'];
    protected $casts = ['is_group' => 'boolean'];
    protected $hidden = [
        'sort',
        'parent_id',
        'created_at',
        'updated_at'
    ];

    protected static function booted()
    {
        static::saved(function ($model) {
            Cache::forget('categories');
        });
        static::deleted(function ($model) {
            Cache::forget('categories');
        });
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->ordered();
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
