<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Checkout - FACC GAME STORE</title>
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
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">

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

    <main class="flex-grow max-w-6xl mx-auto w-full px-4 py-10 md:py-16">
        <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-10">
            <div>
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tight">Checkout</h1>
                <p class="text-gray-500 mt-2 font-medium">Langkah 2 dari 3 — verifikasi pembayaran & konfirmasi pesanan.</p>
            </div>
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>



        <div class="grid grid-cols-1 xl:grid-cols-[1.4fr_1fr] gap-8">
            <section class="bg-white border border-gray-200 rounded-3xl p-6 md:p-8 shadow-xl shadow-gray-200/50">
                <h2 class="text-xl font-black text-gray-900 uppercase tracking-wider mb-2">Informasi Pesanan</h2>
                <p class="text-sm text-gray-500 mb-6 font-medium">Metode pembayaran menggunakan Midtrans Sandbox. Email akan digunakan untuk mengirim detail akun yang dibeli.</p>

                <div class="space-y-4">
                    @foreach($cart as $product)
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 shadow-sm hover:border-facc transition">
                            <div class="flex items-center gap-4">
                                <div class="h-16 w-16 bg-gray-200 rounded-xl overflow-hidden flex-shrink-0">
                                    @if($product['image'])
                                        <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $product['name'] }}</h3>
                                    <p class="text-facc text-xs font-bold uppercase tracking-widest mt-0.5">{{ $product['category'] }}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-1">Harga</p>
                                    <p class="text-lg font-black text-green-600">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 rounded-2xl border border-gray-200 bg-gray-50 p-6 shadow-sm">
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-3 font-medium">
                        <span>Subtotal</span>
                        <span class="font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-4 font-medium">
                        <span>Biaya Admin (4%)</span>
                        <span class="font-bold text-gray-900">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                        <span class="text-base font-bold text-gray-900 uppercase tracking-wider">Total Pembayaran</span>
                        <span class="text-xl font-black text-facc">Rp {{ number_format($finalTotal, 0, ',', '.') }}</span>
                    </div>
                </div>
            </section>

            <section class="bg-white border border-gray-200 rounded-3xl p-6 md:p-8 shadow-xl shadow-gray-200/50 self-start">
                <h2 class="text-xl font-black text-gray-900 uppercase tracking-wider mb-6">Detail Pembayaran</h2>
                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-3 block">Metode Pembayaran</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($paymentMethods as $method)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="payment_method" value="{{ $method['name'] }}" required class="peer sr-only">
                                    <div class="h-full rounded-xl border-2 border-gray-200 bg-white p-4 transition duration-200 hover:border-gray-300 peer-checked:border-facc peer-checked:bg-blue-50 flex flex-col items-center justify-center text-center gap-2 shadow-sm">
                                        <div class="w-16 h-10 flex items-center justify-center">
                                            <img src="{{ asset('images/' . $method['logo']) }}" alt="{{ $method['name'] }}" class="max-w-full max-h-full object-contain">
                                        </div>
                                        <span class="text-xs font-bold text-gray-700 peer-checked:text-facc">{{ $method['name'] }}</span>
                                    </div>
                                    <!-- Indicator Checklist -->
                                    <div class="absolute top-3 right-3 hidden peer-checked:block text-facc">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('payment_method')<p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>@enderror
                    </div>

                    {{-- Nomor Rekening / E-Wallet --}}
                    <div id="account-number-wrapper">
                        <label class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-2 block" id="account-number-label">Nomor Rekening / E-Wallet</label>
                        <input type="text" name="account_number" id="account_number" value="{{ old('account_number') }}"
                               placeholder="Masukkan nomor rekening atau nomor e-wallet Anda"
                               required
                               class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 font-bold tracking-widest outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                        <p class="text-xs text-gray-400 mt-2">Nomor ini akan dicatat sebagai bukti kepemilikan pembayaran Anda.</p>
                        @error('account_number')<p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-2 block">Email Pengiriman</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 font-medium focus:border-facc focus:ring-1 focus:ring-facc outline-none transition">
                        @error('email')<p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-2 block">Nomor WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="0812xxxxxxx" required class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 font-medium focus:border-facc focus:ring-1 focus:ring-facc outline-none transition">
                        @error('whatsapp')<p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>@enderror
                    </div>

                    <div class="rounded-xl border border-blue-200 bg-blue-50 p-5 text-sm text-blue-800 shadow-sm mt-8">
                        <p class="font-bold uppercase tracking-wider text-[11px] text-facc mb-1.5 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Midtrans Sandbox
                        </p>
                        <p class="font-medium">Ini adalah mode sandbox. Transaksi akan diproses sebagai simulasi Midtrans, dan status akan diperbarui setelah klik Bayar.</p>
                    </div>

                    <button type="submit" class="w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md mt-4">Bayar Sekarang</button>
                </form>
            </section>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
