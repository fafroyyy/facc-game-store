<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Akun PUBG Mobile - FACC Game Store</title>
    <meta name="description" content="Beli akun PUBG Mobile yang sudah terverifikasi, rank Conqueror, skin langka, aman 100%. Garansi 1 bulan di FACC Game Store.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        facc: { DEFAULT: '#00008B', dark: '#000055', light: '#1A1AA6' }
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-200 p-4 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
            <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2">
                <img src="{{ asset('images/facc-logo.png') }}" alt="Logo FACC Game Store" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                <div class="leading-tight">
                    <div class="font-black text-gray-900 text-sm tracking-widest uppercase">FACC</div>
                    <div class="font-semibold text-gray-500 text-xs tracking-widest uppercase">Game Store</div>
                </div>
            </a>
            <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                <form action="{{ route('products.all') }}" method="GET" class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-full bg-gray-50 text-sm placeholder-gray-400 focus:outline-none focus:border-facc focus:ring-1 focus:ring-facc focus:bg-white transition" placeholder="Cari akun game...">
                </form>
            </div>
            <div class="flex items-center space-x-3 md:space-x-4 flex-shrink-0">
                @unless(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-facc bg-gray-50 border border-gray-200 rounded-full transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        @if(count((array) session('cart')) > 0)
                            <span class="absolute top-0 right-0 -mt-1 -mr-1 flex justify-center items-center bg-facc text-white text-[10px] font-bold h-5 w-5 rounded-full border-2 border-white">{{ count((array) session('cart')) }}</span>
                        @endif
                    </a>
                @endunless
                @include('partials.navbar-profile')
            </div>
        </div>
    </nav>

    {{-- HERO PUBG --}}
    <div class="relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/pubg.jpeg') }}" alt="PUBG Mobile" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-facc/80"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 py-16 md:py-20">
            <div class="mb-6">
                <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
            </div>
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="w-24 h-24 rounded-2xl overflow-hidden border-4 border-white/30 flex-shrink-0 shadow-xl">
                    <img src="{{ asset('images/pubg.jpeg') }}" alt="PUBG" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-2">PUBG Mobile</h1>
                    <p class="text-blue-200 text-base md:text-lg max-w-2xl">Akun PUBG rank Conqueror, skin senjata langka, UC melimpah — terverifikasi & bergaransi 1 bulan.</p>
                    <div class="flex gap-4 mt-4">
                        <span class="px-3 py-1 bg-white/20 rounded-full text-white text-xs font-semibold border border-white/30">✅ Terverifikasi</span>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-white text-xs font-semibold border border-white/30">🛡️ Anti-Hackback</span>
                        <span class="px-3 py-1 bg-white/20 rounded-full text-white text-xs font-semibold border border-white/30">📦 Garansi 1 Bulan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PRODUK --}}
    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-facc">{{ $products->count() }} Akun Tersedia</h2>
            <a href="{{ route('products.all') }}" class="text-sm text-facc hover:underline font-semibold">Lihat Semua Game →</a>
        </div>

        @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-facc transition duration-300 group">
                    <div class="h-44 bg-gray-50 relative overflow-hidden border-b border-gray-100">
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center relative">
                            <div class="absolute inset-0" style="background: linear-gradient(to top left, transparent calc(50% - 1px), #d1d5db, transparent calc(50% + 1px)), linear-gradient(to top right, transparent calc(50% - 1px), #d1d5db, transparent calc(50% + 1px));"></div>
                            @if(count($product->getAllImages()) > 0)
                                <img src="{{ asset('storage/' . $product->getAllImages()[0]) }}" class="w-full h-full object-cover relative z-10">
                            @else
                                <span class="text-gray-400 text-4xl relative z-10">🎮</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-5">
                        <span class="inline-block px-2 py-1 bg-blue-50 border border-blue-100 text-facc text-xs rounded mb-3 font-bold uppercase tracking-wider">PUBG Mobile</span>
                        <a href="{{ route('products.show', $product->id) }}" class="block mb-3">
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-facc leading-tight mb-1 truncate transition">{{ $product->name }}</h3>
                            <p class="text-gray-500 text-xs truncate">{{ Str::limit($product->description, 40) }}</p>
                        </a>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100 mt-2">
                            <span class="text-xl font-black text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <div class="flex gap-2">
                                @php
                                    $inCart = isset(session('cart', [])[$product->id]);
                                @endphp
                                @if($inCart)
                                    <span class="px-3 py-2 bg-gray-100 border border-gray-200 text-gray-500 rounded-xl text-xs font-bold flex items-center shadow-inner cursor-not-allowed">
                                        <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        Di Keranjang
                                    </span>
                                @else
                                    <a href="{{ route('products.show', $product->id) }}" class="inline-block bg-facc hover:bg-facc-dark text-white font-black py-2 px-6 rounded-xl transition text-sm text-center">Detail Akun</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="py-20 text-center">
            <div class="w-32 h-32 rounded-2xl overflow-hidden border-4 border-gray-200 mx-auto mb-6">
                <img src="{{ asset('images/pubg.jpeg') }}" class="w-full h-full object-cover opacity-50">
            </div>
            <h3 class="text-lg font-bold text-gray-700 mb-2">Belum ada akun PUBG Mobile</h3>
            <p class="text-gray-500 text-sm mb-6">Stok sedang kosong. Coba cek kembali nanti.</p>
            <a href="{{ route('products.all') }}" class="inline-block bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition text-sm">
                Lihat Game Lain
            </a>
        </div>
        @endif
    </main>

    @include('partials.footer')

</body>
</html>
