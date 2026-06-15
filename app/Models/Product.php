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

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function averageRating(): float
    {
        $avg = $this->reviews()->avg('rating');
        return $avg ? round($avg, 1) : 0;
    }

    public function reviewCount(): int
    {
        return $this->reviews()->count();
    }
}