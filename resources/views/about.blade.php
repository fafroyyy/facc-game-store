<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Profil Kami - FACC Game Store</title>
    <meta name="description" content="Kenali FACC Game Store — platform jual beli akun game terpercaya dengan sistem keamanan terpusat di Indonesia.">
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
    <style>
        .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,139,0.12); }
        .dot-pattern { background-image: radial-gradient(rgba(255,255,255,0.08) 1px, transparent 1px); background-size: 22px 22px; }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">

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

    <main class="flex-grow w-full py-10">
        <div class="max-w-5xl mx-auto px-6 mb-6">
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>

        {{-- Hero Section --}}
        <section class="bg-facc dot-pattern text-white pt-16 pb-16 relative overflow-hidden mb-12">
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full bg-white/5 blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 rounded-full bg-white/5 blur-3xl"></div>
            </div>
            <div class="max-w-5xl mx-auto px-6 relative z-10">
            <div class="flex items-center gap-4 mb-6">
                <img src="{{ asset('images/facc-logo.png') }}" alt="Logo FACC" class="w-16 h-16 rounded-2xl object-contain shadow-xl border-2 border-white/20">
                <div>
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight">Profil Kami</h1>
                </div>
            </div>
            <p class="text-blue-100 text-lg max-w-2xl leading-relaxed">
                Platform jual beli akun game yang aman, transparan, dan terpercaya — hadir untuk melindungi setiap transaksi Anda.
            </p>
        </div>
    </section>

    <div class="max-w-5xl mx-auto w-full px-6">

        {{-- Tentang FACC --}}
        <section class="mb-16">
            <div class="bg-white border border-gray-200 rounded-3xl p-8 md:p-12 shadow-xl shadow-gray-200/50 card-hover">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-facc" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-wider">Tentang FACC Game Store</h2>
                </div>
                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-600 leading-relaxed text-base mb-4">
                        <span class="font-bold text-facc">FACC GAME STORE</span> adalah platform e-commerce pionir yang dirancang khusus untuk menyediakan layanan jual beli akun game yang aman, transparan, dan tepercaya. Berangkat dari keresahan komunitas gamer terhadap tingginya angka penipuan dan tindakan pengambilalihan akun secara sepihak (<em>hackback</em>) di pasar sekunder, kami hadir membawa solusi mutakhir melalui metode <strong>arsitektur keamanan terpusat</strong>.
                    </p>
                    <p class="text-gray-600 leading-relaxed text-base">
                        Kami memahami bahwa sebuah akun game bukan sekadar komoditas digital, melainkan representasi dari kerja keras, waktu, dan investasi emosional seorang gamer. Oleh karena itu, FACC GAME STORE menolak menjadi sekadar papan iklan baris (marketplace konvensional). Kami bertindak sebagai <strong>pihak ketiga tepercaya (escrow/middleman)</strong> berbasis sistem yang menjamin keamanan penuh bagi pembeli maupun penjual.
                    </p>
                </div>
            </div>
        </section>

        {{-- Visi & Misi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            {{-- Visi --}}
            <div class="bg-gradient-to-br from-facc to-facc-dark text-white rounded-3xl p-8 shadow-xl shadow-blue-900/30 card-hover relative overflow-hidden">
                <div class="absolute inset-0 dot-pattern opacity-30"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center mb-5 border border-white/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <p class="text-blue-200 text-[10px] font-black uppercase tracking-widest mb-3">01 — Visi</p>
                    <h3 class="text-xl font-black mb-4">Menjadi No. 1 di Indonesia</h3>
                    <p class="text-blue-100 text-sm leading-relaxed">
                        Menjadi platform jual beli akun game nomor satu di Indonesia yang menyediakan ekosistem transaksi paling aman, terpercaya, dan cepat.
                    </p>
                </div>
            </div>

            {{-- Misi --}}
            <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-xl shadow-gray-200/50 card-hover">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center mb-5 border border-blue-100">
                    <svg class="w-6 h-6 text-facc" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-facc text-[10px] font-black uppercase tracking-widest mb-3">02 — Misi</p>
                <h3 class="text-xl font-black text-gray-900 mb-4">Komitmen Kami</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-facc text-white flex items-center justify-center text-[10px] font-black flex-shrink-0 mt-0.5">1</span>
                        <p class="text-gray-600 text-sm leading-relaxed">Menghilangkan risiko penipuan dengan sistem verifikasi berlapis dan pengambilalihan aset secara penuh sebelum dijual kembali.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-facc text-white flex items-center justify-center text-[10px] font-black flex-shrink-0 mt-0.5">2</span>
                        <p class="text-gray-600 text-sm leading-relaxed">Menyediakan katalog akun berkualitas dari berbagai jenis game populer.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-facc text-white flex items-center justify-center text-[10px] font-black flex-shrink-0 mt-0.5">3</span>
                        <p class="text-gray-600 text-sm leading-relaxed">Memberikan pengalaman belanja digital yang praktis dengan dukungan tutorial pengamanan pasca-pembelian yang komprehensif.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-5 h-5 rounded-full bg-facc text-white flex items-center justify-center text-[10px] font-black flex-shrink-0 mt-0.5">4</span>
                        <p class="text-gray-600 text-sm leading-relaxed">Memberikan pengalaman jual yang adil bagi pemilik akun melalui proses kurasi transparan dan pencairan yang dilakukan setelah akun sepenuhnya diamankan.</p>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Nilai Unggulan --}}
        <section class="mb-8">
            <h2 class="text-2xl font-black text-gray-900 uppercase tracking-wider mb-8 text-center">Mengapa Memilih Kami?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-md card-hover">
                    <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-100">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h4 class="font-black text-gray-900 mb-2">100% Aman</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Sistem keamanan terpusat memastikan setiap akun telah diamankan sebelum sampai ke tangan pembeli.</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-md card-hover">
                    <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-100">
                        <svg class="w-7 h-7 text-facc" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h4 class="font-black text-gray-900 mb-2">Proses Cepat</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Setelah pembayaran terkonfirmasi, kredensial akun dikirimkan secara otomatis ke dashboard Anda.</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-md card-hover">
                    <div class="w-14 h-14 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-yellow-100">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                    <h4 class="font-black text-gray-900 mb-2">Terpercaya</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">Sebagai pihak ketiga (escrow), kami menjamin keadilan dan transparansi bagi pembeli maupun penjual.</p>
                </div>
            </div>
        </section>

    </div>
    </main>

    @include('partials.footer')
</body>
</html>
