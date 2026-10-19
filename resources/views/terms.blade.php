<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Syarat & Ketentuan - FACC Game Store</title>
    <meta name="description" content="Baca syarat dan ketentuan penggunaan platform FACC Game Store sebelum bertransaksi.">
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
        .dot-pattern { background-image: radial-gradient(rgba(255,255,255,0.08) 1px, transparent 1px); background-size: 22px 22px; }
        .section-card { background: white; border: 1px solid #e5e7eb; border-radius: 1.5rem; padding: 2rem; margin-bottom: 1.5rem; box-shadow: 0 4px 16px rgba(0,0,0,0.05); }
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

        {{-- Hero --}}
        <section class="bg-facc dot-pattern text-white pt-16 pb-16 relative overflow-hidden mb-12">
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full bg-white/5 blur-3xl"></div>
            </div>
            <div class="max-w-5xl mx-auto px-6 relative z-10">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <p class="text-blue-200 text-xs font-bold uppercase tracking-widest mb-1">Legal</p>
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight">Syarat &amp; Ketentuan</h1>
                </div>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-2xl px-6 py-4 inline-flex items-center gap-3 backdrop-blur">
                <svg class="w-5 h-5 text-yellow-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-blue-100 text-sm">Harap membaca dokumen ini secara saksama sebelum menggunakan platform kami.</p>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto w-full px-6">

        {{-- Pengantar --}}
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-10 text-sm text-blue-800 leading-relaxed">
            <p>Selamat datang di <strong>FACC GAME STORE</strong>. Harap membaca Syarat &amp; Ketentuan ini secara saksama sebelum menggunakan platform kami. Dengan mengakses, mendaftar, atau bertransaksi di situs kami, Anda dinyatakan <strong>menyetujui seluruh poin di bawah ini</strong>.</p>
        </div>

        {{-- A. Ketentuan Umum --}}
        <div class="section-card">
            <div class="flex items-center gap-3 mb-5">
                <span class="w-9 h-9 rounded-xl bg-facc text-white flex items-center justify-center text-sm font-black flex-shrink-0">A</span>
                <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider">Ketentuan Umum Pengguna</h2>
            </div>
            <ul class="space-y-4">
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">Pengguna wajib melakukan registrasi akun secara jujur dengan menggunakan alamat email dan kontak WhatsApp aktif untuk keperluan pengiriman kredensial akun dan notifikasi transaksi.</p>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">Pengguna bertanggung jawab penuh atas kerahasiaan akun, kata sandi, dan segala aktivitas digital yang terjadi di dalam akun personal mereka.</p>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">FACC GAME STORE berhak membekukan atau menghapus akun pengguna secara sepihak jika ditemukan indikasi kecurangan, manipulasi sistem, atau pelanggaran hukum siber.</p>
                </li>
            </ul>
        </div>

        {{-- B. Ketentuan Penjual --}}
        <div class="section-card">
            <div class="flex items-center gap-3 mb-5">
                <span class="w-9 h-9 rounded-xl bg-facc text-white flex items-center justify-center text-sm font-black flex-shrink-0">B</span>
                <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider">Ketentuan Bagi Penjual <span class="normal-case font-semibold text-gray-500">(Seller)</span></h2>
            </div>
            <ul class="space-y-4">
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">Setiap akun game yang diajukan untuk dijual wajib melalui <em>Submission Wizard</em> dengan mengisi data spesifikasi teknis dan kredensial mentah secara akurat dan valid.</p>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">Penjual memberikan hak penuh kepada tim Verifikator FACC GAME STORE untuk melakukan pengujian dan verifikasi internal terhadap kredensial akun yang diajukan sebelum diterbitkan ke katalog publik.</p>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed"><strong class="text-red-600">Penjual dilarang keras</strong> mencoba mengubah data pemulihan (<em>bind data</em>) akun selama proses peninjauan berlangsung.</p>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">Apabila akun dinyatakan valid dan berhasil terjual oleh sistem, dana hasil penjualan akan diteruskan ke rekening/e-wallet penjual setelah dipotong biaya administrasi platform resmi yang tertera pada sistem.</p>
                </li>
            </ul>
        </div>

        {{-- C. Ketentuan Pembeli --}}
        <div class="section-card">
            <div class="flex items-center gap-3 mb-5">
                <span class="w-9 h-9 rounded-xl bg-facc text-white flex items-center justify-center text-sm font-black flex-shrink-0">C</span>
                <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider">Ketentuan Bagi Pembeli &amp; Sistem Pembayaran</h2>
            </div>
            <ul class="space-y-4">
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">Pembeli wajib menyelesaikan pembayaran sesuai dengan invoice dan batas waktu yang ditentukan melalui metode gerbang pembayaran resmi kami.</p>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">Kredensial akun game yang dibeli (username, password, dan panduan pemulihan) hanya akan diberikan secara otomatis di dashboard akun pembeli setelah status transaksi dinyatakan <strong>Success</strong> oleh sistem pembayaran.</p>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-facc flex-shrink-0 mt-2.5"></span>
                    <p class="text-gray-600 text-sm leading-relaxed">Seluruh harga yang tertera di dalam katalog adalah bersifat final dan transparan. Biaya administrasi tambahan akan langsung dikalkulasikan pada halaman checkout sebelum pembayaran dilakukan.</p>
                </li>
            </ul>
        </div>

        {{-- D. Jaminan Kepemilikan --}}
        <div class="section-card border-green-200 bg-green-50/30">
            <div class="flex items-center gap-3 mb-5">
                <span class="w-9 h-9 rounded-xl bg-green-600 text-white flex items-center justify-center text-sm font-black flex-shrink-0">D</span>
                <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider">Kebijakan Jaminan Kepemilikan &amp; Garansi</h2>
            </div>
            <ul class="space-y-4">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <p class="text-gray-600 text-sm leading-relaxed">FACC GAME STORE menjamin bahwa seluruh akun yang terbit di katalog telah lolos proses inspeksi kelayakan dan keamanan awal.</p>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <p class="text-gray-600 text-sm leading-relaxed">Platform menyediakan <strong>Garansi Perlindungan Terbatas selama 1 (satu) bulan</strong> sejak tanggal transaksi sukses terhadap risiko penarikan akun secara sepihak (<em>hackback</em>) oleh pemilik lama, dengan syarat pembeli mengikuti instruksi pengamanan akun yang disediakan di halaman panduan.</p>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <p class="text-gray-600 text-sm leading-relaxed">Klaim garansi wajib diajukan melalui Sistem Tiket Garansi resmi di dashboard pembeli dengan menyertakan bukti kronologis yang valid. Jika klaim terbukti sah, platform akan memfasilitasi solusi pengembalian dana (refund) sesuai dengan kebijakan perlindungan konsumen yang berlaku.</p>
                </li>
            </ul>
        </div>

        {{-- E. Batasan Tanggung Jawab --}}
        <div class="section-card border-red-100">
            <div class="flex items-center gap-3 mb-5">
                <span class="w-9 h-9 rounded-xl bg-red-500 text-white flex items-center justify-center text-sm font-black flex-shrink-0">E</span>
                <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider">Batasan Tanggung Jawab</h2>
            </div>
            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                <p class="text-gray-600 text-sm leading-relaxed">
                    FACC GAME STORE <strong>tidak bertanggung jawab</strong> atas sanksi hukuman penangguhan akun (<em>banned</em>) yang diakibatkan oleh pelanggaran aturan pihak ketiga (pengembang/publisher game resmi) pasca-serah terima akun berhasil, seperti penggunaan program ilegal (<em>cheat</em>), perilaku toksik, atau aktivitas top-up ilegal yang dilakukan oleh pembeli baru.
                </p>
            </div>
        </div>

        {{-- CTA --}}
        <div class="mt-10 text-center">
            <p class="text-gray-500 text-sm mb-4">Ada pertanyaan tentang Syarat & Ketentuan ini?</p>
            <a href="https://wa.me/6289520264777" target="_blank" rel="noopener"
               class="inline-block bg-facc hover:bg-facc-dark text-white font-black px-8 py-3 rounded-xl uppercase tracking-widest transition shadow-md text-sm">
                Hubungi Admin
            </a>
        </div>

    </div>
    </main>

    @include('partials.footer')
</body>
</html>
