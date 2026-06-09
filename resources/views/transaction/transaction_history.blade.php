<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi Saya</title>
    <style>
        body { font-family: sans-serif; background-color: #f3f4f6; margin: 0; padding: 20px; color: #1f2937; }
        .container { max-width: 800px; margin: 0 auto; }
        h1 { font-size: 24px; font-weight: bold; margin-bottom: 20px; }
        .back-link { display: inline-block; margin-bottom: 15px; color: #0284c7; text-decoration: none; font-size: 14px; }
        .back-link:hover { text-decoration: underline; }
        .order-card { background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px; border: 1px solid #e5e7eb; overflow: hidden; }
        .order-header { background-color: #f9fafb; padding: 15px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .order-id { font-weight: bold; color: #111827; }
        .order-date { size: 12px; color: #6b7280; }
        .status-badge { padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-paid { background-color: #d1fae5; color: #065f46; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .order-body { padding: 15px; }
        .product-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .product-row:last-child { border-bottom: none; }
        .product-info { display: flex; flex-direction: column; }
        .product-name { font-weight: 600; color: #374151; }
        .product-qty { font-size: 13px; color: #6b7280; margin-top: 2px; }
        .product-price { font-weight: bold; color: #111827; }
        .order-footer { background-color: #f9fafb; padding: 15px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e5e7eb; }
        .total-label { font-size: 14px; color: #4b5563; }
        .total-amount { font-size: 18px; font-weight: bold; color: #0284c7; }
        .empty-state { text-align: center; background: white; padding: 40px; border-radius: 8px; border: 1px solid #e5e7eb; color: #6b7280; }
    </style>
</head>
<body>

<div class="container">
    <a href="/" class="back-link">← Kembali ke Toko</a>
    <h1>Riwayat Transaksi</h1>

    @if($transactions->isEmpty())
        <div class="empty-state">
            <p style="font-size: 18px; margin-bottom: 8px;">Belum ada transaksi</p>
            <p style="font-size: 14px;">Semua riwayat penyewaan atau pembelian Anda akan muncul di sini.</p>
        </div>
    @else
        {{-- Kita kelompokkan transaksi berdasarkan order_id menggunakan fitur Collection Laravel --}}
        @foreach($transactions->groupBy('order_id') as $orderId => $items)
            @php 
                // Mengambil item pertama sebagai perwakilan data tanggal dan status grup
                $firstItem = $items->first(); 
                // Menghitung total harga keseluruhan dari grup order_id ini
                $totalOrderPrice = $items->sum('total_price');
            @endphp

            <div class="order-card">
                <div class="order-header">
                    <div>
                        <span class="order-id">{{ $orderId }}</span>
                        <div class="order-date">{{ $firstItem->created_at->format('d M Y, H:i') }} WIB</div>
                    </div>
                    
                    @if($firstItem->status === 'pending')
                        <span class="status-badge status-pending">Menunggu Pembayaran</span>
                    @elseif($firstItem->status === 'paid')
                        <span class="status-badge status-paid">Selesai / Lunas</span>
                    @else
                        <span class="status-badge status-cancelled">Dibatalkan</span>
                    @endif
                </div>

                <div class="order-body">
                    @foreach($items as $item)
                        <div class="product-row">
                            <div class="product-info">
                                {{-- Menampilkan nama produk lewat relasi model --}}
                                <span class="product-name">{{ $item->product->name ?? 'Produk Telah Dihapus' }}</span>
                                <span class="product-qty">{{ $item->quantity }} barang x Rp {{ number_format($item->total_price / $item->quantity, 0, ',', '.') }}</span>
                            </div>
                            <div class="product-price">
                                Rp {{ number_format($item->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="order-footer">
                    <span class="total-label">Total Pembayaran:</span>
                    <span class="total-amount">Rp {{ number_format($totalOrderPrice, 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach
    @endif
</div>

</body>
</html>