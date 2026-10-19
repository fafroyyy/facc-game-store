<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Pesanan Berhasil - FACC GAME STORE</title>
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

    <main class="flex-grow max-w-4xl mx-auto w-full px-4 py-12 md:py-20">
        <div class="bg-white border border-gray-200 rounded-3xl p-8 md:p-12 shadow-xl shadow-gray-200/50">
            <div class="text-center mb-10">
                <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-green-100">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tight">Transaksi Berhasil</h1>
                <p class="text-gray-500 mt-3 max-w-xl mx-auto font-medium">Terima kasih, pesanan Anda sudah dicatat. Cek detail pesanan di bawah ini dan segera selesaikan pembayaran sesuai instruksi.</p>
            </div>

            {{-- Grid Info Utama --}}
            <div class="grid gap-4 md:grid-cols-2 mb-8">
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6 shadow-sm">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-500">Nomor Invoice</p>
                    <p class="text-xl font-black text-gray-900 mt-2 tracking-wider">{{ $order->invoice_number }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6 shadow-sm">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-500">Status Pesanan</p>
                    <p class="text-xl font-black {{ $order->status === 'success' ? 'text-green-600' : 'text-yellow-600' }} mt-2 uppercase tracking-wider">
                        {{ $order->status === 'success' ? 'Sukses' : ucfirst($order->status) }}
                    </p>
                </div>
            </div>

            {{-- Info Metode Pembayaran --}}
            @if($order->payment_method)
            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6 shadow-sm mb-6">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">Metode Pembayaran</p>
                <div class="flex items-center gap-4">
                    @php
                        $logoMap = [
                            'BRI' => 'bri.png', 'BCA' => 'bca.png', 'MANDIRI' => 'mandiri.png',
                            'DANA' => 'dana.png', 'GOPAY' => 'gopay.png', 'SHOPEEPAY' => 'shopeepay.png',
                        ];
                        $logo = $logoMap[$order->payment_method] ?? null;
                    @endphp
                    @if($logo)
                        <img src="{{ asset('images/' . $logo) }}" alt="{{ $order->payment_method }}" class="h-10 w-auto object-contain">
                    @endif
                    <div>
                        <p class="font-black text-gray-900 text-base">{{ $order->payment_method }}</p>
                        @if($order->account_number)
                            <p class="text-gray-500 font-mono font-bold tracking-widest text-sm mt-0.5">{{ $order->account_number }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Ringkasan Pesanan --}}
            <div class="rounded-2xl border border-blue-200 bg-blue-50 p-6 mb-8 shadow-sm">
                <h2 class="font-black text-gray-900 mb-3 uppercase tracking-wider text-sm">Ringkasan Pesanan</h2>
                @php
                    $subtotal = $order->items->sum('price');
                    $adminFee = max(0, $order->total_price - $subtotal);
                @endphp
                <div class="space-y-2 border-b border-blue-100 pb-3 mb-3">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Subtotal</p>
                        <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Biaya Admin (4%)</p>
                        <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($adminFee, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between border-b border-blue-100 pb-3 mb-3">
                    <p class="text-sm font-bold text-gray-600 uppercase tracking-wider">Total pembayaran</p>
                    <p class="font-black text-facc text-xl">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
                <div class="space-y-3">
                    <div class="flex items-start gap-2 bg-white p-4 rounded-xl border border-blue-100 shadow-sm">
                        <svg class="w-5 h-5 text-facc mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <p class="text-sm text-gray-700 font-medium">Data-data terkait Akun Game yang dibeli, termasuk detail login dan Panduan Cara Pengamanan telah berhasil <strong>dikirimkan ke Email Anda</strong>.</p>
                    </div>
                    <div class="flex items-start gap-2 bg-white p-4 rounded-xl border border-blue-100 shadow-sm">
                        <svg class="w-5 h-5 text-facc mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm text-gray-700 font-medium">Jika Anda mengalami kesulitan saat mengamankan akun atau akun bermasalah, silakan <a href="https://wa.me/6289520264777" target="_blank" rel="noopener" class="text-facc font-bold underline">hubungi Admin</a> (Garansi 1 Bulan berlaku).</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="w-full sm:w-auto text-center bg-white border-2 border-facc text-facc hover:bg-facc hover:text-white px-8 py-3 rounded-xl font-black transition shadow-md uppercase tracking-widest text-sm">Kembali ke Beranda</a>
                <a href="{{ route('orders.index') }}" class="w-full sm:w-auto text-center bg-gray-800 hover:bg-gray-900 text-white px-8 py-3 rounded-xl font-black transition shadow-md uppercase tracking-widest text-sm">Lihat Pesanan Saya</a>
                <a href="{{ route('checkout.invoice', $order) }}" target="_blank"
                   class="w-full sm:w-auto text-center bg-facc hover:bg-facc-dark text-white px-8 py-3 rounded-xl font-black transition shadow-md uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh Invoice (PDF)
                </a>
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
