<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Dashboard Admin - FACC GAME STORE</title>
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
                        <div class="font-semibold text-gray-500 text-xs tracking-widest uppercase">Admin Panel</div>
                    </div>
                </a>
            </div>
            <div class="flex items-center space-x-3 md:space-x-4 flex-shrink-0">
                @include('partials.navbar-profile')
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 py-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Dashboard Admin</h1>
                <p class="text-gray-500 mt-1 font-medium">Ringkasan statistik toko dan akses cepat kelola.</p>
            </div>
            <div>
                <a href="{{ route('admin.dashboard.export') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-facc hover:bg-facc-dark text-white font-bold rounded-xl transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh Laporan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            {{-- KELOLA PENGGUNA --}}
            <a href="{{ route('admin.users.index') }}" class="block group">
                <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-md hover:shadow-2xl hover:border-facc transition duration-300 text-center h-full flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-blue-50 text-facc rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-wider mb-2 group-hover:text-facc transition">Kelola Pengguna</h2>
                    <p class="text-gray-500 text-sm">Lihat, tambah, edit, dan hapus akun customer yang terdaftar di FACC Game Store.</p>
                </div>
            </a>

            {{-- KELOLA AKUN --}}
            <a href="{{ route('admin.products.index') }}" class="block group">
                <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-md hover:shadow-2xl hover:border-facc transition duration-300 text-center h-full flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-blue-50 text-facc rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-wider mb-2 group-hover:text-facc transition">Kelola Akun Game</h2>
                    <p class="text-gray-500 text-sm">Tambah akun game baru yang akan dijual, edit detail, atau hapus akun dari katalog toko.</p>
                </div>
            </a>

            {{-- KELOLA PENGAJUAN --}}
            <a href="{{ route('admin.submissions.index') }}" class="block group">
                <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-md hover:shadow-2xl hover:border-facc transition duration-300 text-center h-full flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-blue-50 text-facc rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-wider mb-2 group-hover:text-facc transition">Kelola Pengajuan</h2>
                    <p class="text-gray-500 text-sm">Tinjau, terima, atau tolak ajuan penjualan akun game dari customer.</p>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <p class="text-xs uppercase text-gray-500 font-bold tracking-wider">Total Produk</p>
                <p class="text-3xl font-black text-gray-900 mt-2">{{ number_format($totalProducts) }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <p class="text-xs uppercase text-gray-500 font-bold tracking-wider">Total Pesanan</p>
                <p class="text-3xl font-black text-gray-900 mt-2">{{ number_format($totalOrders) }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <p class="text-xs uppercase text-gray-500 font-bold tracking-wider">Pendapatan Sukses</p>
                <p class="text-3xl font-black text-green-600 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <p class="text-xs uppercase text-gray-500 font-bold tracking-wider">Pengajuan Baru</p>
                <p class="text-3xl font-black text-facc mt-2">{{ number_format($pendingSubmissions) }}</p>
            </div>
        </div>

        <div class="rounded-2xl border border-blue-200 bg-blue-50 p-6 shadow-sm">
            <h2 class="text-sm font-black text-facc uppercase tracking-wider mb-2 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Catatan Sistem
            </h2>
            <p class="text-blue-800 text-sm leading-relaxed">Gunakan panel ini untuk mengawasi katalog produk, data pengguna, dan transaksi pengajuan. Pastikan semua akun game diperiksa kelengkapannya secara teliti sebelum dipublikasikan ke etalase toko.</p>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
