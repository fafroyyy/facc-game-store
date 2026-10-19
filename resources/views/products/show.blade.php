<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>{{ $product->name }} - FACC Game Store</title>
    <meta name="description" content="Beli {{ $product->name }} di FACC Game Store. Akun game terverifikasi, aman, bergaransi 1 bulan.">
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

    <div class="bg-white border-b border-gray-100 px-4 py-3">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-facc transition">Beranda</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <a href="{{ route('products.all') }}" class="text-gray-500 hover:text-facc transition">Semua Akun</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-facc font-semibold truncate max-w-xs">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <main class="max-w-5xl mx-auto px-4 py-10">
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Gambar Produk --}}
            <div class="space-y-4">
                <div class="bg-white border border-gray-200 rounded-2xl p-4 flex items-center justify-center min-h-[350px] shadow-sm relative overflow-hidden group">
                    @php $allImages = $product->getAllImages(); @endphp
                    @if(count($allImages) > 0)
                        <img id="main-image" src="{{ asset('storage/' . $allImages[0]) }}" class="w-full h-full rounded-xl object-contain shadow transition duration-300" alt="{{ $product->name }}">
                    @else
                        <div class="text-center text-gray-400">
                            <svg class="w-20 h-20 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm">Belum ada screenshot akun.</p>
                        </div>
                    @endif
                </div>

                {{-- Thumbnail Gallery --}}
                @if(count($allImages) > 1)
                <div class="grid grid-cols-5 gap-2">
                    @foreach($allImages as $index => $img)
                        <button onclick="document.getElementById('main-image').src='{{ asset('storage/' . $img) }}'" class="border-2 {{ $index === 0 ? 'border-facc' : 'border-transparent' }} hover:border-facc rounded-lg overflow-hidden transition focus:outline-none h-16 w-full">
                            <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Detail Produk --}}
            <div class="space-y-6">
                <div>
                    <span class="text-xs font-bold text-facc bg-blue-50 border border-blue-100 px-3 py-1 rounded-full uppercase tracking-widest">{{ $product->category->name ?? 'Game' }}</span>
                    <h1 class="text-3xl font-black text-gray-900 mt-3 leading-tight">{{ $product->name }}</h1>
                </div>

                {{-- Keunggulan --}}
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-green-50 border border-green-200 text-green-700 text-xs rounded-full font-semibold">✅ Terverifikasi</span>
                    <span class="px-3 py-1 bg-blue-50 border border-blue-200 text-facc text-xs rounded-full font-semibold">🛡️ Anti-Hackback</span>
                    <span class="px-3 py-1 bg-purple-50 border border-purple-200 text-purple-700 text-xs rounded-full font-semibold">📦 Garansi 1 Bulan</span>
                </div>

                {{-- Harga --}}
                <div class="bg-blue-50 border border-blue-100 p-5 rounded-2xl">
                    <p class="text-xs text-gray-500 mb-1 font-medium">Harga Final</p>
                    <p class="text-4xl font-black text-facc">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <h2 class="text-base font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-facc" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Spesifikasi Lengkap
                    </h2>
                    <div class="bg-white border border-gray-200 rounded-xl p-4">
                        <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $product->description }}</p>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="pt-2 space-y-3">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <div class="rounded-2xl border border-orange-200 bg-orange-50 p-5 text-center text-sm text-orange-700 font-medium">
                            🚫 Kamu login sebagai admin — tidak dapat membeli atau menambahkan ke keranjang.
                        </div>
                    @elseif($product->status === 'available')
                        @php
                            $inCart = isset(session('cart', [])[$product->id]);
                        @endphp
                        
                        @if($inCart)
                            <button disabled class="w-full bg-gray-100 border border-gray-200 text-gray-500 font-bold py-3.5 px-6 rounded-2xl shadow-inner text-base flex items-center justify-center gap-2 cursor-not-allowed">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                Sudah Ada di Keranjang
                            </button>
                        @else
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-white border-2 border-facc text-facc hover:bg-facc hover:text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md">
                                    Masukkan ke Keranjang
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('checkout.buy', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md">
                                Beli Sekarang
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full bg-gray-100 text-gray-400 font-bold py-3 px-6 rounded-xl cursor-not-allowed text-sm text-center border border-gray-200 uppercase tracking-widest">
                            Akun Telah Terjual
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>