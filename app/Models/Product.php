<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category',
        'seller_id',
        'rating',
        'sold_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'sold_count' => 'integer',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}