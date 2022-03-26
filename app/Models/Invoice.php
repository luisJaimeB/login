<?php

namespace App\Models;

use App\Constants\InvoiceStatus;
use App\Constants\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price', 'subtotal');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return !empty($this->attributes['request_id'])
            && $this->attributes['invoice_status'] === InvoiceStatus::PENDING;
    }

    public function couldPay(): bool
    {
        return empty($this->attributes['request_id'])
            || in_array($this->attributes['invoice_status'], [InvoiceStatus::PENDING, InvoiceStatus::CANCELED]);
    }
}