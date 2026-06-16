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

    /**
     * Kurangi stok secara aman — tidak akan pernah turun di bawah 0
     */
    public function decrementStock(int $qty): void
    {
        \Illuminate\Support\Facades\DB::table('products')
            ->where('id', $this->id)
            ->update([
                'stock' => \Illuminate\Support\Facades\DB::raw("GREATEST(0, stock - {$qty})")
            ]);
    }
}