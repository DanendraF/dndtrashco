<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'price',
        'description',
        'seller_name',
        'phone_number',
        'address',
        'images',
        'status',
        'slug',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
