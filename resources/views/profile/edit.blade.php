<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Profil Saya - FACC GAME STORE</title>
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

    <main class="flex-grow max-w-4xl mx-auto w-full px-4 py-10">
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Pengaturan Profil</h1>
            <p class="text-gray-500 mt-1 font-medium">Kelola informasi data diri, email, dan keamanan akun Anda.</p>
        </div>

        <div class="space-y-8">
            
            {{-- Navigasi Ekstra Customer --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('sell.history') }}" class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm hover:shadow-md hover:border-facc transition group flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-facc rounded-full flex items-center justify-center group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider group-hover:text-facc transition">Periksa Ajuan</h3>
                            <p class="text-xs text-gray-500 font-medium mt-0.5">Cek status akun game yang Anda jual</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-facc transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
                
                <a href="{{ route('orders.index') }}" class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm hover:shadow-md hover:border-facc transition group flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-gray-900 uppercase tracking-wider group-hover:text-facc transition">Riwayat Pesanan</h3>
                            <p class="text-xs text-gray-500 font-medium mt-0.5">Lihat pesanan akun game yang Anda beli</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-facc transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            {{-- Form Update Profil --}}
            <div class="bg-white border border-gray-200 rounded-3xl p-6 md:p-8 shadow-sm">
                <header class="mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider">Informasi Profil</h2>
                    <p class="mt-1 text-sm text-gray-500">Perbarui nama lengkap dan alamat email akun Anda.</p>
                </header>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-5 max-w-xl">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                               class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                        <x-input-error class="mt-2 text-xs text-red-600" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Alamat Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                               class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                        <x-input-error class="mt-2 text-xs text-red-600" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-3">
                                <p class="text-sm text-yellow-600 font-semibold">Alamat email Anda belum diverifikasi.</p>
                                <button form="send-verification" class="text-sm font-bold text-facc hover:text-facc-dark underline mt-1">
                                    Klik di sini untuk mengirim ulang email verifikasi.
                                </button>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-xs font-semibold text-green-600">
                                        Link verifikasi baru telah dikirim ke alamat email Anda.
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl transition text-sm uppercase tracking-widest shadow-md">
                            Simpan Perubahan
                        </button>
                        @if (session('status') === 'profile-updated')
                            <p class="text-sm font-bold text-green-600">Berhasil Disimpan.</p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Form Update Password --}}
            <div class="bg-white border border-gray-200 rounded-3xl p-6 md:p-8 shadow-sm">
                <header class="mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider">Perbarui Password</h2>
                    <p class="mt-1 text-sm text-gray-500">Pastikan akun Anda menggunakan password yang panjang dan acak demi keamanan.</p>
                </header>

                <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-xl">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Password Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                               class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs text-red-600" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Password Baru</label>
                        <input id="password" name="password" type="password" autocomplete="new-password"
                               class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs text-red-600" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                               class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs text-red-600" />
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-black py-3 px-6 rounded-xl transition text-sm uppercase tracking-widest shadow-md">
                            Ganti Password
                        </button>
                        @if (session('status') === 'password-updated')
                            <p class="text-sm font-bold text-green-600">Password Diperbarui.</p>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </main>

    @include('partials.footer')
</body>
</html>
