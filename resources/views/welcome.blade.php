<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>FACC GAME STORE - Akun Game Terverifikasi</title>
    <meta name="description" content="Beli akun game Mobile Legends, PUBG Mobile, dan eFootball yang sudah terverifikasi, aman 100%, dengan garansi 1 bulan.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        facc: {
                            DEFAULT: '#00008B',
                            dark: '#000055',
                            light: '#1A1AA6',
                            50: '#f0f0ff',
                            100: '#e0e0ff',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Category card hover */
        .cat-card:hover .cat-overlay { opacity: 1; }
        .cat-overlay { opacity: 0; transition: opacity 0.3s; }

        /* Smooth transitions */
        * { transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased font-sans">

    {{-- ===== NAVBAR ===== --}}
    <nav class="bg-white border-b border-gray-200 p-4 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2">
                <img src="{{ asset('images/facc-logo.png') }}" alt="Logo FACC Game Store" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                <div class="leading-tight">
                    <div class="font-black text-gray-900 text-sm tracking-widest uppercase">FACC</div>
                    <div class="font-semibold text-gray-500 text-xs tracking-widest uppercase">Game Store</div>
                </div>
            </a>
            
            {{-- SEARCH BAR (Desktop) --}}
            <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                <form action="{{ route('products.all') }}" method="GET" class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-full bg-gray-50 text-sm placeholder-gray-400 focus:outline-none focus:border-facc focus:ring-1 focus:ring-facc focus:bg-white transition" placeholder="Cari akun game...">
                </form>
            </div>

            {{-- NAV ICONS --}}
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
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-9 pr-3 py-2 border border-gray-300 rounded-full bg-gray-50 text-sm placeholder-gray-400 focus:outline-none focus:border-facc focus:ring-1 focus:ring-facc focus:bg-white" placeholder="Cari akun game...">
            </form>
        </div>
    </nav>

    {{-- ===== HERO SECTION ===== --}}
    <div class="max-w-7xl mx-auto px-4 mt-6">
        <div class="bg-facc rounded-3xl p-8 md:p-12 lg:p-16 relative overflow-hidden flex flex-col md:flex-row items-center shadow-xl">
            <div class="absolute top-0 right-0 opacity-10 pointer-events-none">
                <svg width="400" height="400" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 6H3C1.89543 6 1 6.89543 1 8V16C1 17.1046 1.89543 18 3 18H21C22.1046 18 23 17.1046 23 16V8C23 6.89543 22.1046 6 21 6Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 12H10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 10V14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 13C15.5523 13 16 12.5523 16 12C16 11.4477 15.5523 11 15 11C14.4477 11 14 11.4477 14 12C14 12.5523 14.4477 13 15 13Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="w-full md:w-3/5 relative z-10">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">
                    Akun Game Impian,<br>Tanpa Takut Tertipu
                </h1>
                <p class="text-blue-100 text-lg mb-8 max-w-md">
                    Akun terverifikasi, aman 100%, dan siap menemani perjalananmu!
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.all') }}" class="bg-white hover:bg-gray-100 text-facc px-6 py-3 rounded-full font-bold flex items-center gap-2 transition shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Telusuri Katalog
                    </a>
                    @if(!auth()->check() || !auth()->user()->isAdmin())
                        <a href="{{ route('sell.create') }}" class="bg-transparent border border-white hover:bg-white hover:text-facc text-white px-6 py-3 rounded-full font-bold flex items-center gap-2 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Jual Akunmu
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-12 space-y-16">
        
        {{-- ===== KATEGORI GAME UTAMA ===== --}}
        <section>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-xl md:text-2xl font-bold text-facc border-b-2 border-facc pb-1">Kategori Game Utama</h2>
            </div>
            <div class="flex flex-wrap gap-6 md:gap-10 pb-4 justify-center md:justify-start">
                
                {{-- Mobile Legends --}}
                <a href="{{ route('games.mlbb') }}" class="flex flex-col items-center gap-3 min-w-[100px] group cat-card">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl border-2 border-gray-200 group-hover:border-facc transition-all shadow-sm overflow-hidden relative">
                        <img src="{{ asset('images/mlbb.jpeg') }}" alt="Mobile Legends" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="cat-overlay absolute inset-0 bg-facc/60 flex items-center justify-center">
                            <span class="text-white font-black text-xs text-center px-1">Lihat Akun</span>
                        </div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-facc transition">Mobile Legends</span>
                </a>

                {{-- PUBG Mobile --}}
                <a href="{{ route('games.pubg') }}" class="flex flex-col items-center gap-3 min-w-[100px] group cat-card">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl border-2 border-gray-200 group-hover:border-facc transition-all shadow-sm overflow-hidden relative">
                        <img src="{{ asset('images/pubg.jpeg') }}" alt="PUBG Mobile" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="cat-overlay absolute inset-0 bg-facc/60 flex items-center justify-center">
                            <span class="text-white font-black text-xs text-center px-1">Lihat Akun</span>
                        </div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-facc transition">PUBG Mobile</span>
                </a>

                {{-- eFootball --}}
                <a href="{{ route('games.efootball') }}" class="flex flex-col items-center gap-3 min-w-[100px] group cat-card">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl border-2 border-gray-200 group-hover:border-facc transition-all shadow-sm overflow-hidden relative">
                        <img src="{{ asset('images/efootball.jpeg') }}" alt="eFootball" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="cat-overlay absolute inset-0 bg-facc/60 flex items-center justify-center">
                            <span class="text-white font-black text-xs text-center px-1">Lihat Akun</span>
                        </div>
                    </div>
                    <span class="text-sm font-bold text-gray-700 group-hover:text-facc transition">eFootball</span>
                </a>

            </div>
        </section>

        {{-- ===== PRODUK TERBARU ===== --}}
        <section id="katalog">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-facc">Terbaru</h2>
                <a href="{{ route('products.all') }}" class="text-sm text-facc hover:underline font-bold">Lihat semua &gt;</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products->take(3) as $product)
                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-facc transition duration-300 relative group">
                        <div class="h-44 bg-gray-50 flex items-center justify-center relative overflow-hidden p-3 pb-0 border-b border-gray-100">
                             <div class="w-full h-full bg-gray-200 rounded-t-xl relative overflow-hidden flex items-center justify-center">
                                <div class="absolute inset-0 w-full h-full" style="background: linear-gradient(to top left, transparent calc(50% - 1px), #d1d5db, transparent calc(50% + 1px)), linear-gradient(to top right, transparent calc(50% - 1px), #d1d5db, transparent calc(50% + 1px));"></div>
                                
                                @if(count($product->getAllImages()) > 0)
                                    <img src="{{ asset('storage/' . $product->getAllImages()[0]) }}" class="w-full h-full object-cover relative z-10">
                                @endif
                             </div>
                        </div>

                        <div class="p-5">
                            <span class="inline-block px-2 py-1 bg-blue-50 border border-blue-100 text-facc text-xs rounded mb-3 font-bold uppercase tracking-wider">{{ $product->category->name ?? 'Game' }}</span>
                            
                            <a href="{{ route('products.show', $product->id) }}" class="block mb-3">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-facc leading-tight mb-1 truncate transition">{{ $product->name }}</h3>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <span class="px-2 py-0.5 bg-gray-50 border border-gray-200 text-gray-500 text-[11px] rounded-md truncate max-w-[150px]">
                                        {{ Str::limit($product->description, 20) }}
                                    </span>
                                </div>
                            </a>

                            <div class="flex justify-between items-center mt-4">
                                <span class="text-2xl font-black text-facc">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
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
                                        <a href="{{ route('products.show', $product->id) }}" class="px-4 py-2 bg-white border-2 border-facc text-facc hover:bg-facc hover:text-white rounded-xl text-sm font-bold flex items-center justify-center transition shadow-sm">
                                            Detail
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center text-gray-500 border-2 border-dashed border-gray-300 rounded-xl">
                        Belum ada akun game yang terdaftar.
                    </div>
                @endforelse
            </div>

            @if($products->count() > 3)
            <div class="mt-8 text-center">
                <a href="{{ route('products.all') }}" class="inline-flex items-center gap-2 bg-facc text-white px-8 py-3 rounded-full font-bold hover:bg-facc-dark transition shadow-lg">
                    Lihat Semua Akun
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
            @endif
        </section>

        {{-- ===== MENGAPA KAMI ===== --}}
        <section class="bg-gray-50 rounded-3xl p-8 md:p-10 border border-gray-200">
            <div class="flex items-center justify-center mb-10">
                <h2 class="text-2xl md:text-3xl font-black text-facc text-center">Mengapa Kami?</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center shadow-sm hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-facc">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Verifikasi Ketat</h3>
                    <p class="text-xs text-gray-500">Akun dicek manual oleh tim profesional</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center shadow-sm hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-facc">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Anti-Hackback</h3>
                    <p class="text-xs text-gray-500">Akun aman dengan sistem proteksi kami</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center shadow-sm hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-facc">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Garansi 1 Bulan</h3>
                    <p class="text-xs text-gray-500">Jika masalah? Kami jamin solusi terbaik</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center shadow-sm hover:-translate-y-1 transition duration-300">
                    <div class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 text-facc">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Panduan Lengkap</h3>
                    <p class="text-xs text-gray-500">Panduan step-by-step pasca pembelian</p>
                </div>
            </div>
        </section>

        {{-- ===== TESTIMONI PEMBELI (SLIDER) ===== --}}
        <section>
            <h2 class="text-xl md:text-2xl font-bold text-facc mb-6">Testimoni Pembeli</h2>

            <div class="relative max-w-4xl mx-auto px-10 md:px-14">
                {{-- Slide Wrapper --}}
                <div id="testimonialSlider" class="overflow-hidden">

                    {{-- Testimoni 1 --}}
                    <div class="testimonial-slide flex min-h-[320px] md:min-h-[220px] bg-white border border-gray-200 rounded-3xl p-6 md:p-10 flex-col md:flex-row items-center gap-8 shadow-lg shadow-blue-900/5">
                        <div class="w-20 h-20 bg-blue-50 border-2 border-facc rounded-full flex-shrink-0 flex items-center justify-center text-facc text-2xl font-black">Y</div>
                        <div class="flex-1 text-center md:text-left">
                            <div class="flex justify-center md:justify-start text-yellow-400 mb-3">
                                @for($i=0; $i<5; $i++)
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            <p class="text-gray-700 text-base md:text-lg font-medium mb-3 italic">
                                "Aman banget! Akun MLBB-ku sudah 3 bulan nggak kena hackback. Prosesnya juga cepet banget dan mudah. Adminnya juga ramah."
                            </p>
                            <p class="text-facc font-bold text-sm">– Yanto, Jakarta</p>
                        </div>
                    </div>

                    {{-- Testimoni 2 --}}
                    <div class="testimonial-slide hidden min-h-[320px] md:min-h-[220px] bg-white border border-gray-200 rounded-3xl p-6 md:p-10 flex-col md:flex-row items-center gap-8 shadow-lg shadow-blue-900/5">
                        <div class="w-20 h-20 bg-blue-50 border-2 border-facc rounded-full flex-shrink-0 flex items-center justify-center text-facc text-2xl font-black">R</div>
                        <div class="flex-1 text-center md:text-left">
                            <div class="flex justify-center md:justify-start text-yellow-400 mb-3">
                                @for($i=0; $i<5; $i++)
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            <p class="text-gray-700 text-base md:text-lg font-medium mb-3 italic">
                                "Beli akun PUBG di sini, serah terima cuma 5 menit! Harga murah, kualitas premium. Recommended banget buat yang mau upgrade rank!"
                            </p>
                            <p class="text-facc font-bold text-sm">– Rizki, Surabaya</p>
                        </div>
                    </div>

                    {{-- Testimoni 3 --}}
                    <div class="testimonial-slide hidden min-h-[320px] md:min-h-[220px] bg-white border border-gray-200 rounded-3xl p-6 md:p-10 flex-col md:flex-row items-center gap-8 shadow-lg shadow-blue-900/5">
                        <div class="w-20 h-20 bg-blue-50 border-2 border-facc rounded-full flex-shrink-0 flex items-center justify-center text-facc text-2xl font-black">D</div>
                        <div class="flex-1 text-center md:text-left">
                            <div class="flex justify-center md:justify-start text-yellow-400 mb-3">
                                @for($i=0; $i<5; $i++)
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            <p class="text-gray-700 text-base md:text-lg font-medium mb-3 italic">
                                "Udah beli 2 akun eFootball di sini. Dua-duanya mulus, nggak ada masalah sama sekali. Garansi 1 bulannya beneran dipenuhi, top!"
                            </p>
                            <p class="text-facc font-bold text-sm">– Dika, Bandung</p>
                        </div>
                    </div>

                </div>

                {{-- Tombol Panah Kiri --}}
                <button onclick="changeTestimonial(-1)"
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-10 h-10 bg-white border-2 border-facc text-facc rounded-full flex items-center justify-center shadow-md hover:bg-facc hover:text-white transition z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                {{-- Tombol Panah Kanan --}}
                <button onclick="changeTestimonial(1)"
                    class="absolute right-0 top-1/2 -translate-y-1/2 w-10 h-10 bg-white border-2 border-facc text-facc rounded-full flex items-center justify-center shadow-md hover:bg-facc hover:text-white transition z-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </button>

                {{-- Dot Indicators --}}
                <div class="flex justify-center gap-2 mt-5">
                    <button onclick="goToTestimonial(0)" class="dot w-2.5 h-2.5 rounded-full transition" id="dot-0"></button>
                    <button onclick="goToTestimonial(1)" class="dot w-2.5 h-2.5 rounded-full transition" id="dot-1"></button>
                    <button onclick="goToTestimonial(2)" class="dot w-2.5 h-2.5 rounded-full transition" id="dot-2"></button>
                </div>
            </div>
        </section>

    </main>

    @include('partials.footer')

    {{-- ===== TESTIMONIAL SLIDER SCRIPT ===== --}}
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.testimonial-slide');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach(s => {
                s.classList.remove('flex');
                s.classList.add('hidden');
            });
            dots.forEach(d => { d.style.backgroundColor = '#d1d5db'; });
            
            currentSlide = (index + totalSlides) % totalSlides;
            slides[currentSlide].classList.remove('hidden');
            slides[currentSlide].classList.add('flex');
            dots[currentSlide].style.backgroundColor = '#00008B';
        }

        function changeTestimonial(direction) {
            showSlide(currentSlide + direction);
        }

        function goToTestimonial(index) {
            showSlide(index);
        }

        // Auto-slide every 5 seconds
        setInterval(() => changeTestimonial(1), 5000);
    </script>

</body>
</html>