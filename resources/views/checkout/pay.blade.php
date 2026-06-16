<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran</title>
    <style>
        body { 
            font-family: sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            background-color: #f3f4f6; 
            margin: 0; 
        }
        .payment-card { 
            background: white; 
            padding: 2rem; 
            border-radius: 8px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
            text-align: center; 
            max-width: 400px; 
            width: 100%; 
        }
        .btn-pay { 
            width: 100%; 
            padding: 12px; 
            font-size: 16px; 
            background-color: #0284c7; 
            color: white; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            margin-top: 15px; 
        }
        .btn-pay:hover { background-color: #0369a1; }
    </style>
</head>
<body>

    <div class="payment-card">
        <p style="font-size:14px; color:#9ca3af; margin-bottom:4px;">Menyelesaikan pembayaran untuk</p>
        <h1 style="font-size:20px; font-weight:bold; color:#111827; margin-bottom:15px;">Pesanan Alat Outdoor Anda</h1>
        
        <button id="pay-button" class="btn-pay">
            Bayar Sekarang
        </button>
        <p style="margin-top:12px; font-size:12px; color:#9ca3af;">
            Anda akan diarahkan ke jendela pembayaran aman Midtrans
        </p>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    // Hapus keranjang dari localStorage setelah pembayaran berhasil
                    localStorage.removeItem('outdoor_cart');
                    alert("Pembayaran berhasil! Terima kasih atas pembelian Anda.");
                    window.location.href = '/';
                },
                onPending: function (result) {
                    alert("Menunggu pembayaran! Selesaikan pembayaran Anda.");
                    window.location.href = '/';
                },
                onError: function (result) {
                    alert("Pembayaran gagal! Silakan coba lagi.");
                    window.location.href = '/toko';
                },
                onClose: function () {
                    // User menutup popup tanpa menyelesaikan pembayaran
                    window.location.href = '/toko';
                }
            });
        });
    </script>
</body>
</html>