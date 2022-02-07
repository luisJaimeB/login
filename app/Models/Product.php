<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class)->latestOfMany();
    }

    public function scopeWhereCategory(Builder $query, int $category=null): Builder
    {
        return $query->when($category, function ($query) use ($category) {
            $query->where('category_id', $category);
        });
    }

    public function scopeSearch(Builder $query, string $search=null): Builder
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        });
    }
}
