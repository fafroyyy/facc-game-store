<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Riwayat Pesanan - FACC GAME STORE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { facc: { DEFAULT: '#00008B', dark: '#000055', light: '#1A1AA6' } },
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
                    <img src="{{ asset('images/facc-logo.png') }}" alt="FACC" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                    <div class="leading-tight hidden md:block">
                        <div class="font-black text-gray-900 text-sm tracking-widest uppercase">FACC</div>
                        <div class="font-semibold text-gray-500 text-xs tracking-widest uppercase">Game Store</div>
                    </div>
                </a>

            </div>
            <div class="flex items-center space-x-3 flex-shrink-0">
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-facc bg-gray-50 border border-gray-200 rounded-full transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    @if(count((array) session('cart')) > 0)
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 flex justify-center items-center bg-facc text-white text-[10px] font-bold h-5 w-5 rounded-full border-2 border-white">{{ count((array) session('cart')) }}</span>
                    @endif
                </a>
                @include('partials.navbar-profile')
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-5xl mx-auto w-full px-4 py-10">
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Riwayat Pesanan</h1>
            <p class="text-gray-500 mt-1">Daftar semua transaksi pembelian akun game yang pernah Anda lakukan.</p>
        </div>



        @if($orders->isEmpty())
            <div class="bg-white border border-gray-200 rounded-3xl p-16 text-center shadow-sm">
                <svg class="w-20 h-20 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h2 class="text-xl font-black text-gray-600 mb-2">Belum Ada Pesanan</h2>
                <p class="text-gray-400 mb-6">Anda belum pernah melakukan pembelian di FACC Game Store.</p>
                <a href="{{ route('products.all') }}" class="inline-block bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md text-sm">
                    Lihat Katalog Akun
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-md hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4 pb-4 border-b border-gray-100">
                            <div>
                                <p class="text-[11px] font-black text-gray-500 uppercase tracking-widest mb-1">Invoice</p>
                                <p class="font-black text-gray-900 tracking-wider">{{ $order->invoice_number }}</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="px-3 py-1.5 text-xs font-black uppercase tracking-wider rounded-full
                                    @if($order->status === 'success') bg-green-100 text-green-700
                                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ $order->status === 'success' ? 'Sukses' : ucfirst($order->status) }}
                                </span>
                                <span class="text-xs text-gray-400 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>

                        {{-- Item Pesanan --}}
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover" alt="{{ $item->product->name ?? 'Akun' }}">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-gray-900 truncate">{{ $item->product->name ?? 'Akun Telah Dihapus' }}</p>
                                        <p class="text-xs text-facc font-bold uppercase tracking-widest mt-0.5">{{ $item->product->category->name ?? '-' }}</p>
                                    </div>
                                    <p class="font-black text-green-600 flex-shrink-0">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Total Pembayaran</p>
                                <p class="text-xl font-black text-facc">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('checkout.invoice', $order) }}" target="_blank" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh Invoice
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </main>

    @include('partials.footer')
</body>
</html>
