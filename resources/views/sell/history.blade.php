<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Riwayat Ajuan - FACC GAME STORE</title>
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
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Periksa Ajuan</h1>
            <p class="text-gray-500 mt-1">Daftar riwayat pengajuan penjualan akun game Anda.</p>
        </div>



        @if($submissions->isEmpty())
            <div class="bg-white border border-gray-200 rounded-3xl p-16 text-center shadow-sm">
                <svg class="w-20 h-20 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h2 class="text-xl font-black text-gray-600 mb-2">Belum Ada Ajuan</h2>
                <p class="text-gray-400 mb-6">Anda belum pernah mengajukan penjualan akun di FACC Game Store.</p>
                <a href="{{ route('sell.create') }}" class="inline-block bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md text-sm">
                    Jual Akun Sekarang
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($submissions as $submission)
                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-md hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4 pb-4 border-b border-gray-100">
                            <div>
                                <p class="text-[11px] font-black text-gray-500 uppercase tracking-widest mb-1">Tanggal Ajuan</p>
                                <p class="font-black text-gray-900 tracking-wider">{{ $submission->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="px-3 py-1.5 text-xs font-black uppercase tracking-wider rounded-full border
                                    @if($submission->status === 'accepted' || $submission->status === 'completed') bg-green-50 border-green-200 text-green-700
                                    @elseif($submission->status === 'rejected') bg-red-50 border-red-200 text-red-700
                                    @elseif($submission->status === 'payment_info_submitted') bg-blue-50 border-blue-200 text-blue-700
                                    @else bg-yellow-50 border-yellow-200 text-yellow-700 @endif">
                                    {{ $submission->status_label }}
                                </span>
                            </div>
                        </div>

                        {{-- Info Akun --}}
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-gray-900 truncate mb-1">{{ $submission->game_category }}</p>
                                <p class="text-xs text-gray-500">{{ Str::limit($submission->description, 60) }}</p>
                            </div>
                            <div class="text-right flex-shrink-0 ml-4">
                                <p class="text-[11px] font-black text-gray-500 uppercase tracking-widest mb-1">Harga Diminta</p>
                                <p class="font-black text-green-600">Rp {{ number_format($submission->price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-t border-gray-100 flex justify-end">
                            <a href="{{ route('sell.status', $submission) }}" class="inline-flex items-center gap-2 text-sm font-bold text-facc hover:text-facc-dark transition">
                                Lihat Detail & Status
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $submissions->links() }}
            </div>
        @endif
    </main>

    @include('partials.footer')
</body>
</html>
