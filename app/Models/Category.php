<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

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

    public function scopeLatestParent($query, $parent_id = null)
    {
        $query = is_null($parent_id) ? $query->whereNull('parent_id') : $query->where('parent_id', $parent_id);
        return $query->latest('sort');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
