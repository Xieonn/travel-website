<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua transaksi milik user yang sedang login beserta data produknya
        $transactions = Transaction::with('product')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        // Kelompokkan transaksi berdasarkan order_id di sisi Blade nanti
        return view('transaction.transaction_history', compact('transactions'));
    }
}