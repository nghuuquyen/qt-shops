<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const DEFAULT_CURRENCY = 'VNĐ';
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
