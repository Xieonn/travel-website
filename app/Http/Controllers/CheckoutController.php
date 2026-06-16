<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // 1. Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        
        // Buat satu Order ID tunggal untuk mengikat semua produk dalam satu pembayaran
        $orderId = 'TRX-' . time();
        $totalPrice = $request->input('total_price');

        // 2. Ambil data keranjang belanja (JSON String) dari frontend dan ubah menjadi array PHP
        $cartItems = json_decode($request->input('cart_items'), true);

        if (!$cartItems || count($cartItems) === 0) {
            return back()->with('error', 'Keranjang belanja Anda kosong.');
        }

        try {
            // 3. Simpan setiap item di keranjang ke dalam tabel transaksi
            foreach ($cartItems as $item) {
                // Tambahkan pengecekan jika 'id' tidak ada di array
                if (!isset($item['id'])) {
                    return back()->with('error', 'Data produk tidak valid. Silakan kosongkan keranjang dan coba lagi.');
                }

                Transaction::create([
                    'user_id'     => $request->user()->id,
                    'order_id'    => $orderId,
                    'product_id'  => $item['id'],     
                    'quantity'    => $item['qty'],    
                    'total_price' => $item['price'] * $item['qty'], 
                    'status'      => 'pending',       
                ]);
            }

            // 4. Siapkan parameter untuk Midtrans
            $params = [
                'transaction_details' => [
                    'order_id'     => $orderId, 
                    'gross_amount' => $totalPrice, 
                ],
                'customer_details' => [
                    'first_name' => $request->user()->name,
                    'email'      => $request->user()->email,
                ],
            ];

            // 5. Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);
            
            return view('checkout.pay', compact('snapToken'));
            
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}