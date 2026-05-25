<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

            {{-- Logo --}}
            <a href="/" class="text-2xl font-bold text-blue-700">
                🌍 Travel Website
            </a>

            {{-- Menu --}}
            <div class="flex gap-6 items-center">
                <a href="/" class="text-gray-600 hover:text-blue-700 font-medium">Home</a>
                <a href="/destinasi" class="text-gray-600 hover:text-blue-700 font-medium">Destinasi</a>
                <a href="/toko" class="text-gray-600 hover:text-blue-700 font-medium">Toko</a>
                <a href="/berita" class="text-gray-600 hover:text-blue-700 font-medium">Berita</a>

                @auth
                    <a href="/keranjang" class="text-gray-600 hover:text-blue-700 font-medium">🛒 Keranjang</a>

                    @if(auth()->user()->isAdmin())
                        <a href="/admin/dashboard" class="text-red-600 hover:text-red-800 font-medium">Admin</a>
                    @endif

                    @if(auth()->user()->isSeller())
                        <a href="/seller/dashboard" class="text-green-600 hover:text-green-800 font-medium">Seller</a>
                    @endif

                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="text-gray-600 hover:text-blue-700 font-medium">Login</a>
                    <a href="/register" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- KONTEN HALAMAN --}}
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-blue-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-3">🌍 Travel Website</h3>
                <p class="text-blue-200 text-sm">Temukan destinasi impian Anda bersama kami.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Navigasi</h4>
                <ul class="space-y-2 text-blue-200 text-sm">
                    <li><a href="/destinasi" class="hover:text-white">Destinasi</a></li>
                    <li><a href="/toko" class="hover:text-white">Toko</a></li>
                    <li><a href="/berita" class="hover:text-white">Berita</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Informasi</h4>
                <ul class="space-y-2 text-blue-200 text-sm">
                    <li><a href="/tentang" class="hover:text-white">Tentang Kami</a></li>
                    <li><a href="/layanan" class="hover:text-white">Layanan Pelanggan</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center text-blue-300 text-sm py-4 border-t border-blue-700">
            © {{ date('Y') }} Travel Website. All rights reserved.
        </div>
    </footer>

</body>
</html>