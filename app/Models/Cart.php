<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getCurrencyAttribute()
    {
        return Product::DEFAULT_CURRENCY;
    }

    public function getTotalAmountAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
}
