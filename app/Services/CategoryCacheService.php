<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryCacheService 
{
    public static function get(): Collection
    {
        return Cache::rememberForever('categories', function () {
            return Category::all();
        });
    }
}