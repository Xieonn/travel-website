<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Mengizinkan Laravel untuk mengisi kolom-kolom ini secara massal (Mass Assignment)
    protected $fillable = [
        'user_id', 
        'order_id', 
        'product_id', 
        'quantity', 
        'total_price', 
        'status',
        'snap_token'
    ];

    // Relasi: Setiap transaksi dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Setiap transaksi berisi satu Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}