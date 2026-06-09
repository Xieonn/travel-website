<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
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
            $notif = new Notification();

            $transactionStatus = $notif->transaction_status;
            $orderId = $notif->order_id;

            // 3. Cari transaksi berdasarkan order_id yang dikirim Midtrans
            $transactions = Transaction::where('order_id', $orderId);

            if ($transactions->count() > 0) {
                // Logika perubahan status berdasarkan respon Midtrans
                if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                    // Jika pembayaran sukses, ubah status menjadi 'paid'
                    $transactions->update(['status' => 'paid']);
                } elseif ($transactionStatus == 'pending') {
                    $transactions->update(['status' => 'pending']);
                } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                    // Jika gagal atau kedaluwarsa, ubah status menjadi 'cancelled'
                    $transactions->update(['status' => 'cancelled']);
                }
            }

            return response()->json(['message' => 'Notification handled successfully'], 200);

        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}