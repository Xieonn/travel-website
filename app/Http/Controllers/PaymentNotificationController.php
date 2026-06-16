<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentNotificationController extends Controller
{
    public function handle(Request $request)
    {
        // 1. Set konfigurasi Server Key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;

        try {
            // 2. Tangkap data notifikasi dari Midtrans
            $notif = new \Midtrans\Notification();

            $transactionStatus = $notif->transaction_status;
            $orderId           = $notif->order_id;

            // 3. Cari semua transaksi berdasarkan order_id
            $transactions = Transaction::where('order_id', $orderId)->get();

            if ($transactions->count() === 0) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                // Hanya proses jika belum paid (hindari double-deduct)
                $firstTrx = $transactions->first();
                if ($firstTrx->status !== 'paid') {
                    DB::transaction(function () use ($transactions) {
                        foreach ($transactions as $trx) {
                            // Kurangi stok dengan aman (tidak bisa negatif)
                            $product = Product::find($trx->product_id);
                            if ($product) {
                                $product->decrementStock($trx->quantity);
                            }

                            // Tandai transaksi sebagai paid
                            $trx->status = 'paid';
                            $trx->save();
                        }
                    });
                }

            } elseif ($transactionStatus === 'pending') {
                Transaction::where('order_id', $orderId)->update(['status' => 'pending']);

            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                Transaction::where('order_id', $orderId)->update(['status' => 'cancelled']);
            }

            return response()->json(['message' => 'Notification handled successfully'], 200);

        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}