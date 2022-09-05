<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Todo extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = [
        'title',
        'description',
        'is_important',
        'done_at',
        'category_id',
    ];

    protected $casts = [
        'done_at' => 'datetime',
        'is_important' => 'boolean',
    ];

    protected $appends = [
        'created_at_persian',
        'updated_at_persian',
        'done_at_persian',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function createdAtPersian(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at ? persian_date($this->created_at) : null
        );
    }

    protected function updatedAtPersian(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->updated_at && $this->updated_at != $this->created_at && $this->updated_at != $this->done_at)
                ? persian_date($this->updated_at) : null
        );
    }

    protected function doneAtPersian(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->done_at ? persian_date($this->done_at) : null
        );
    }
}
