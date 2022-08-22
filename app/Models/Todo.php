<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['sort'];
    protected $casts = [
        'done_at' => 'datetime',
        'is_important' => 'boolean',
    ];
    protected $appends = [
        'created_at_persian',
        'updated_at_persian',
        'done_at_persian',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function getCreatedAtPersianAttribute()
    {
        return $this->created_at ? persian_date($this->created_at) : null;
    }

    protected function getUpdatedAtPersianAttribute()
    {
        return ($this->updated_at && $this->updated_at != $this->created_at && $this->updated_at != $this->done_at)
            ? persian_date($this->updated_at) : null;
    }

    protected function getDoneAtPersianAttribute()
    {
        return $this->done_at ? persian_date($this->done_at) : null;
    }
}
