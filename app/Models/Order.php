<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Order extends Model
{
    use HasFactory;

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function getPath(): string
    {
        return URL::signedRoute('orders.show', [ 'order' => $this->id ]);
    }
}