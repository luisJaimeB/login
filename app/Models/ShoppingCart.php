<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $filiable = [
        'status',
        'user_id',
        'order_date',
    ];

    public function shopping_cart_details(): HasMany
    {
        return $this->hasMany(ShoppingCartDetail::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function finOrCreateBySessionId($shoppingCartId)
    {
        if ($shoppingCartId) {
            return ShoppingCart::find($shoppingCartId);
        } else {
            return ShoppingCart::create();
        }
    }
}
