<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Keranjang Belanja - FACC Game Store</title>
    <meta name="description" content="Keranjang belanja akun game di FACC Game Store.">
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
                <a href="{{ route('cart.index') }}" class="relative p-2 text-facc bg-blue-50 border border-facc rounded-full transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    @if(count($cart) > 0)
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 flex justify-center items-center bg-facc text-white text-[10px] font-bold h-5 w-5 rounded-full border-2 border-white">{{ count($cart) }}</span>
                    @endif
                </a>
                @include('partials.navbar-profile')
            </div>
        </div>
    </nav>

    <div class="bg-white border-b border-gray-100 px-4 py-3">
        <div class="max-w-5xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-facc transition">Beranda</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-facc font-semibold">Keranjang Belanja</span>
            </div>
        </div>
    </div>

    <main class="max-w-5xl mx-auto px-4 py-10">
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl md:text-3xl font-black text-gray-900 flex items-center gap-3">
                <svg class="w-8 h-8 text-facc" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Keranjang Belanja
            </h1>
            <a href="{{ route('products.all') }}" class="text-sm text-facc hover:underline font-semibold flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Lanjut Belanja
            </a>
        </div>



        @if(count($cart) > 0)
            <form action="{{ route('cart.checkout') }}" method="POST" id="cart-form">
                @csrf
                <div class="space-y-4">
                    @foreach($cart as $id => $details)
                        <div class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col md:flex-row justify-between items-center gap-4 shadow-sm hover:border-facc hover:shadow-md transition">
                            <div class="flex items-center gap-4 w-full md:w-auto">
                                <input type="checkbox" name="selected_items[]" value="{{ $id }}" class="item-checkbox w-5 h-5 text-facc bg-gray-100 border-gray-300 rounded focus:ring-facc focus:ring-2" data-price="{{ $details['price'] }}" checked>
                                
                                <div class="w-16 h-16 bg-gray-100 rounded-xl flex-shrink-0 flex items-center justify-center overflow-hidden border border-gray-200">
                                    @if($details['image'])
                                        <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-xs text-facc block font-bold uppercase tracking-wider mb-1">{{ $details['category'] }}</span>
                                    <h2 class="text-base font-bold text-gray-900 truncate max-w-xs md:max-w-md">{{ $details['name'] }}</h2>
                                </div>
                            </div>

                            <div class="flex justify-between md:justify-end items-center w-full md:w-auto gap-6 border-t md:border-t-0 pt-3 md:pt-0 border-gray-100">
                                <span class="text-xl font-black text-facc">Rp {{ number_format($details['price'], 0, ',', '.') }}</span>
                                
                                <button type="button" onclick="document.getElementById('remove-form-{{ $id }}').submit();" class="text-red-500 hover:text-red-600 text-xs font-semibold bg-red-50 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Summary & Checkout --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-6 mt-6 shadow-sm">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <p class="text-sm text-gray-500 font-medium mb-1"><span id="selected-count">{{ count($cart) }}</span> item dipilih</p>
                            <p class="text-xs text-gray-400 mb-3">Total Pembayaran:</p>
                            <p class="text-3xl font-black text-facc" id="total-price">Rp 0</p>
                        </div>
                        <div class="flex flex-col gap-3 w-full md:w-auto">
                            <button type="submit" id="checkout-btn" class="w-full md:w-auto text-center bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Lanjut ke Pembayaran
                            </button>
                            <a href="{{ route('products.all') }}" class="w-full md:w-auto text-center bg-white border-2 border-facc text-facc hover:bg-facc hover:text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md flex items-center justify-center gap-2">
                                Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Hidden Forms for Remove --}}
            @foreach($cart as $id => $details)
                <form id="remove-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach

            {{-- Script for Checkbox Calculation --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const checkboxes = document.querySelectorAll('.item-checkbox');
                    const totalPriceEl = document.getElementById('total-price');
                    const selectedCountEl = document.getElementById('selected-count');
                    const checkoutBtn = document.getElementById('checkout-btn');

                    function calculateTotal() {
                        let total = 0;
                        let count = 0;
                        checkboxes.forEach(cb => {
                            if(cb.checked) {
                                total += parseInt(cb.dataset.price);
                                count++;
                            }
                        });
                        
                        totalPriceEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
                        selectedCountEl.textContent = count;
                        
                        if(count === 0) {
                            checkoutBtn.disabled = true;
                            checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
                            checkoutBtn.classList.remove('hover:bg-facc-dark');
                        } else {
                            checkoutBtn.disabled = false;
                            checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                            checkoutBtn.classList.add('hover:bg-facc-dark');
                        }
                    }

                    checkboxes.forEach(cb => {
                        cb.addEventListener('change', calculateTotal);
                    });

                    // Initial calculation
                    calculateTotal();
                });
            </script>

        @else
            <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center shadow-sm">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-700 mb-2">Keranjang Masih Kosong</h3>
                <p class="text-gray-500 text-sm mb-6">Yuk, temukan akun game impianmu!</p>
                <a href="{{ route('products.all') }}" class="inline-block bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md text-sm mt-4">
                    Cari Akun Sekarang
                </a>
            </div>
        @endif

    </main>

    @include('partials.footer')

</body>
</html>