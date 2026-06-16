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
                'notification_url' => 'https://ardently-scheme-abridge.ngrok-free.dev/midtrans/callback',
            ];

            // 5. Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);
            
            // Simpan snap token ke dalam database
            Transaction::where('order_id', $orderId)->update(['snap_token' => $snapToken]);

            return view('checkout.pay', compact('snapToken'));
            
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function resume($order_id)
    {
        // 1. Ambil transaksi yang sesuai
        $transactions = Transaction::where('order_id', $order_id)
                                   ->where('user_id', auth()->id())
                                   ->where('status', 'pending')
                                   ->get();

        if ($transactions->isEmpty()) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan atau sudah diproses.');
        }

        // 2. Ambil token yang sudah kita simpan di database sebelumnya
        $snapToken = $transactions->first()->snap_token;

        if (!$snapToken) {
            return redirect()->back()->with('error', 'Token pembayaran hilang. Silakan buat pesanan baru.');
        }

        // 3. Langsung tampilkan view tanpa perlu menghubungi Midtrans API lagi!
        return view('checkout.pay', compact('snapToken'));
    }
}