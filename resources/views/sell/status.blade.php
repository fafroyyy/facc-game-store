<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Status Pengajuan - FACC GAME STORE</title>
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
                </a>
                @include('partials.navbar-profile')
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-5xl mx-auto w-full px-4 py-10">

        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Status Pengajuan</h1>
                <p class="text-gray-500 mt-1">Pantau perkembangan ajuan penjualan akun game Anda.</p>
            </div>
            {{-- Status Badge --}}
            <div class="rounded-2xl px-5 py-3 shadow-sm border text-center min-w-[200px]
                @if($submission->status === 'accepted' || $submission->status === 'completed') bg-green-50 border-green-200
                @elseif($submission->status === 'rejected') bg-red-50 border-red-200
                @elseif($submission->status === 'payment_info_submitted') bg-blue-50 border-blue-200
                @else bg-yellow-50 border-yellow-200 @endif">
                <p class="text-[10px] font-bold uppercase tracking-widest
                    @if($submission->status === 'accepted' || $submission->status === 'completed') text-green-600
                    @elseif($submission->status === 'rejected') text-red-600
                    @elseif($submission->status === 'payment_info_submitted') text-blue-600
                    @else text-yellow-600 @endif">
                    Status Pengajuan
                </p>
                <p class="font-black text-gray-900 mt-1">{{ $submission->status_label }}</p>
            </div>
        </div>



        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kolom Kiri: Detail Ajuan --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-gray-200 rounded-3xl p-6 md:p-8 shadow-xl shadow-gray-200/50">
                    <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider mb-6 pb-3 border-b border-gray-100">Detail Pengajuan</h2>
                    <dl class="space-y-4 text-sm">
                        <div class="flex flex-col sm:flex-row sm:gap-4">
                            <dt class="text-[11px] font-black text-gray-500 uppercase tracking-wider sm:w-40 flex-shrink-0 mb-1 sm:mb-0 sm:pt-0.5">Nama Penjual</dt>
                            <dd class="font-semibold text-gray-900">{{ $submission->seller_name }}</dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:gap-4 pt-3 border-t border-gray-50">
                            <dt class="text-[11px] font-black text-gray-500 uppercase tracking-wider sm:w-40 flex-shrink-0 mb-1 sm:mb-0 sm:pt-0.5">Email</dt>
                            <dd class="font-semibold text-gray-900">{{ $submission->seller_email }}</dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:gap-4 pt-3 border-t border-gray-50">
                            <dt class="text-[11px] font-black text-gray-500 uppercase tracking-wider sm:w-40 flex-shrink-0 mb-1 sm:mb-0 sm:pt-0.5">WhatsApp</dt>
                            <dd class="font-semibold text-gray-900">{{ $submission->whatsapp }}</dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:gap-4 pt-3 border-t border-gray-50">
                            <dt class="text-[11px] font-black text-gray-500 uppercase tracking-wider sm:w-40 flex-shrink-0 mb-1 sm:mb-0 sm:pt-0.5">Kategori Game</dt>
                            <dd><span class="bg-blue-50 text-facc px-2.5 py-1 rounded-full text-xs font-black uppercase tracking-wider">{{ $submission->game_category }}</span></dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:gap-4 pt-3 border-t border-gray-50">
                            <dt class="text-[11px] font-black text-gray-500 uppercase tracking-wider sm:w-40 flex-shrink-0 mb-1 sm:mb-0 sm:pt-0.5">Harga Jual</dt>
                            <dd class="font-black text-green-600 text-base">Rp {{ number_format($submission->price, 0, ',', '.') }}</dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:gap-4 pt-3 border-t border-gray-50">
                            <dt class="text-[11px] font-black text-gray-500 uppercase tracking-wider sm:w-40 flex-shrink-0 mb-1 sm:mb-0 sm:pt-0.5">Login Via</dt>
                            <dd class="font-semibold text-gray-900">{{ $submission->login_method }}</dd>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:gap-4 pt-3 border-t border-gray-50">
                            <dt class="text-[11px] font-black text-gray-500 uppercase tracking-wider sm:w-40 flex-shrink-0 mb-1 sm:mb-0 sm:pt-0.5">Deskripsi</dt>
                            <dd class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $submission->description }}</dd>
                        </div>
                        @if($submission->admin_note)
                        <div class="pt-3 border-t border-gray-50">
                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                                <p class="text-[11px] font-black text-facc uppercase tracking-wider mb-1.5">Pesan dari Admin</p>
                                <p class="text-blue-800 font-semibold text-sm">{{ $submission->admin_note }}</p>
                            </div>
                        </div>
                        @endif
                    </dl>

                    {{-- Screenshots --}}
                    @php $allScreenshots = $submission->getAllScreenshots(); @endphp
                    @if(count($allScreenshots) > 0)
                    <div class="mt-6 pt-5 border-t border-gray-100">
                        <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-3">Screenshot Akun</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($allScreenshots as $img)
                                <a href="{{ asset('storage/' . $img) }}" target="_blank" class="block aspect-video rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition group">
                                    <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="Screenshot">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Kolom Kanan: Status & Aksi --}}
            <div class="space-y-5">

                {{-- STATUS: MENUNGGU --}}
                @if($submission->status === 'pending')
                <div class="bg-yellow-50 border border-yellow-200 rounded-3xl p-6 shadow-sm text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-gray-900 text-lg mb-2">Menunggu Pemeriksaan</h3>
                    <p class="text-sm text-yellow-800">Admin sedang meninjau pengajuan Anda. Harap bersabar, proses ini biasanya memakan waktu 1x24 jam.</p>
                </div>

                {{-- STATUS: DITERIMA --}}
                @elseif($submission->status === 'accepted')
                <div class="bg-green-50 border border-green-200 rounded-3xl p-6 shadow-sm text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-gray-900 text-lg mb-2">Ajuan Diterima!</h3>
                    <p class="text-sm text-green-800 mb-5">Selamat! Admin telah menerima ajuan akun Anda. Masukkan nomor rekening atau e-wallet untuk pencairan dana.</p>
                    <a href="{{ route('sell.payment-info', $submission) }}"
                       class="block w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md">
                        Masukkan Nomor Rekening
                    </a>
                </div>

                {{-- STATUS: REKENING TERKIRIM --}}
                @elseif($submission->status === 'payment_info_submitted')
                <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6 shadow-sm text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <h3 class="font-black text-gray-900 text-lg mb-2">Pencairan Diproses</h3>
                    <p class="text-sm text-blue-800 mb-4">Nomor rekening Anda telah diterima. Admin sedang memproses transfer. Mohon tunggu.</p>
                    <div class="bg-white border border-blue-100 rounded-xl p-4 text-left">
                        <p class="text-[11px] font-black text-blue-600 uppercase tracking-wider mb-1">Nomor yang Anda daftarkan</p>
                        <p class="font-black text-gray-900">{{ $submission->bank_type }}</p>
                        <p class="text-gray-700 font-semibold">{{ $submission->bank_number }}</p>
                    </div>
                </div>

                {{-- STATUS: SELESAI --}}
                @elseif($submission->status === 'completed')
                <div class="bg-green-50 border border-green-200 rounded-3xl p-6 shadow-sm text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-gray-900 text-xl mb-2">Pencairan Sukses!</h3>
                    <p class="text-sm text-green-800 mb-3">Dana telah berhasil ditransfer ke rekening Anda. Terima kasih telah mempercayai <strong>FACC Game Store</strong>!</p>
                    <a href="{{ route('home') }}" class="block w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md mt-4">Kembali ke Beranda</a>
                </div>

                {{-- STATUS: DITOLAK --}}
                @elseif($submission->status === 'rejected')
                <div class="bg-red-50 border border-red-200 rounded-3xl p-6 shadow-sm text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-gray-900 text-xl mb-2">Pengajuan Ditolak</h3>
                    <p class="text-sm text-red-800 mb-4">Mohon maaf, pengajuan akun Anda tidak dapat diterima. Terima kasih atas kepercayaan Anda kepada <strong>FACC Game Store</strong>.</p>
                    @if($submission->admin_note)
                        <div class="bg-white border border-red-100 rounded-xl p-3 text-left text-sm">
                            <p class="text-[11px] font-black text-red-600 uppercase tracking-wider mb-1">Alasan Penolakan</p>
                            <p class="text-gray-700">{{ $submission->admin_note }}</p>
                        </div>
                    @endif
                    <a href="{{ route('sell.create') }}" class="block mt-5 w-full bg-gray-700 hover:bg-gray-800 text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md">Ajukan Lagi</a>
                </div>

                @else
                {{-- Status lama (backward compat) --}}
                <div class="bg-gray-50 border border-gray-200 rounded-3xl p-6 shadow-sm text-center">
                    <p class="font-bold text-gray-900">{{ $submission->status_label }}</p>
                </div>
                @endif

                {{-- Tanggal Ajuan --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                    <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-1">Tanggal Pengajuan</p>
                    <p class="font-bold text-gray-900">{{ $submission->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
