<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Semua Akun Game - FACC GAME STORE</title>
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
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2">
                    <img src="{{ asset('images/facc-logo.png') }}" alt="Logo FACC Game Store" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                    <div class="leading-tight hidden md:block">
                        <div class="font-black text-gray-900 text-sm tracking-widest uppercase">FACC</div>
                        <div class="font-semibold text-gray-500 text-xs tracking-widest uppercase">Game Store</div>
                    </div>
                </a>

            </div>
            <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                <form action="{{ route('products.all') }}" method="GET" class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ $search }}" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-full bg-gray-50 text-sm placeholder-gray-400 focus:outline-none focus:border-facc focus:ring-1 focus:ring-facc focus:bg-white transition" placeholder="Cari akun game...">
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
        {{-- SEARCH BAR (Mobile) --}}
        <div class="md:hidden mt-3">
            <form action="{{ route('products.all') }}" method="GET" class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ $search }}" class="block w-full pl-9 pr-3 py-2 border border-gray-300 rounded-full bg-gray-50 text-sm placeholder-gray-400 focus:outline-none focus:border-facc focus:ring-1 focus:ring-facc focus:bg-white" placeholder="Cari akun game...">
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <h1 class="text-3xl font-black text-gray-900 mb-8 uppercase tracking-tight">Semua Akun Game</h1>

        <!-- Filter Section -->
        <div class="mb-8 space-y-4">
            <form action="{{ route('products.all') }}" method="GET" class="space-y-4 bg-white p-4 rounded-2xl border border-gray-200 shadow-sm">
                <div class="flex gap-3 flex-wrap items-center">
                    <div class="relative flex-1 min-w-[200px]">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" placeholder="Cari akun..." value="{{ $search }}" 
                            class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-full text-gray-900 placeholder-gray-500 focus:outline-none focus:border-facc focus:ring-1 focus:ring-facc">
                    </div>
                    
                    <select name="category" class="px-4 py-2 bg-gray-50 border border-gray-300 rounded-full text-gray-900 focus:outline-none focus:border-facc focus:ring-1 focus:ring-facc min-w-[180px]">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ $categorySlug === $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="px-6 py-2 bg-facc hover:bg-facc-dark text-white font-bold rounded-full transition shadow-md">
                        Filter
                    </button>
                    
                    @if($search || $categorySlug)
                        <a href="{{ route('products.all') }}" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-full transition border border-gray-200">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @forelse($products as $product)
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-md hover:shadow-xl hover:border-facc transition duration-300 group flex flex-col justify-between">
                    <div>
                        <div class="relative bg-gray-100 h-48 md:h-56 overflow-hidden">
                            @if(count($product->getAllImages()) > 0)
                                <img src="{{ asset('storage/' . $product->getAllImages()[0]) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="{{ $product->name }}">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <span class="text-[10px] font-black text-facc uppercase tracking-widest block mb-2 bg-blue-50 w-max px-2 py-1 rounded">{{ $product->category->name ?? 'Game' }}</span>
                            <a href="{{ route('products.show', $product->id) }}" class="hover:text-facc transition">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">{{ $product->name }}</h3>
                            </a>
                            <p class="text-gray-500 text-sm h-10 overflow-hidden mb-4">{{ Str::limit($product->description, 60) }}</p>
                        </div>
                    </div>
                    <div class="p-5 pt-0">
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
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-gray-200">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-xl font-bold text-gray-600">Tidak ada produk yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="flex justify-center mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </main>

    @include('partials.footer')
</body>
</html>
