<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Detail Produk - Admin FACC GAME STORE</title>
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
                <a href="{{ route('admin.dashboard') }}" class="flex-shrink-0 flex items-center gap-2">
                    <img src="{{ asset('images/facc-logo.png') }}" alt="Logo FACC Game Store" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                    <div class="leading-tight hidden md:block">
                        <div class="font-black text-gray-900 text-sm tracking-widest uppercase">FACC</div>
                        <div class="font-semibold text-gray-500 text-xs tracking-widest uppercase">Admin Panel</div>
                    </div>
                </a>
            </div>
            <div class="flex items-center space-x-3 md:space-x-4 flex-shrink-0">
                @include('partials.navbar-profile')
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-5xl mx-auto w-full px-4 py-10">
        <div class="mb-6">
            <a href="{{ route('admin.products.index') }}" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Detail Produk</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-xl shadow-gray-200/50">
                    <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Informasi Akun</h2>
                    
                    <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden mb-4 border border-gray-200">
                        @php $images = $product->getAllImages(); @endphp
                        @if(count($images) > 0)
                            <img src="{{ asset('storage/' . $images[0]) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Nama Produk</p>
                            <p class="text-base font-bold text-gray-900">{{ $product->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Kategori</p>
                            <p class="text-base font-medium text-gray-900">{{ $product->category->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Harga</p>
                            <p class="text-lg font-black text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Status</p>
                            @if($product->status === 'available')
                                <span class="px-3 py-1 mt-1 inline-block text-xs font-bold rounded-full bg-green-100 text-green-700">Tersedia</span>
                            @else
                                <span class="px-3 py-1 mt-1 inline-block text-xs font-bold rounded-full bg-red-100 text-red-700">Terjual</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                @if($product->status === 'sold' && $orderItem)
                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-xl shadow-gray-200/50">
                        <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-facc" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Informasi Pembeli
                        </h2>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase">Invoice ID</p>
                                <p class="text-base font-bold text-gray-900">{{ $orderItem->order->invoice_number }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase">Nama Pembeli</p>
                                <p class="text-base font-medium text-gray-900">{{ $orderItem->order->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase">Email Pembeli</p>
                                <p class="text-base font-medium text-gray-900">{{ $orderItem->order->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase">Tanggal Pembelian</p>
                                <p class="text-base font-medium text-gray-900">{{ $orderItem->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('admin.dashboard') }}" class="inline-block w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md text-sm text-center">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                @elseif($product->status === 'sold')
                    <div class="bg-orange-50 border border-orange-200 rounded-3xl p-6 shadow-sm text-center">
                        <p class="text-orange-700 font-bold">Produk ini terjual, tetapi data transaksi tidak ditemukan.</p>
                    </div>
                @else
                    <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6 shadow-sm text-center flex flex-col items-center justify-center h-full min-h-[250px]">
                        <svg class="w-12 h-12 text-blue-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-blue-800 font-bold text-sm max-w-xs">Produk ini masih tersedia. Belum ada informasi pembeli.</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
