<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Edit Pengguna - Admin FACC GAME STORE</title>
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

    <main class="flex-grow max-w-3xl mx-auto w-full px-4 py-10">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Edit Pengguna</h1>
            <p class="text-gray-500 mt-1 font-medium">Perbarui data atau ubah hak akses pengguna.</p>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white border border-gray-200 rounded-3xl p-8 shadow-xl shadow-gray-200/50 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
            </div>

            <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5 mt-6 mb-4">
                <p class="text-xs font-bold text-facc uppercase tracking-wider mb-4">Ubah Kata Sandi (Opsional)</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Konfirmasi Sandi Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi sandi baru" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Role Akses</label>
                <select name="role" required class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
                    <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer (Pengguna Biasa)</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin (Pengelola Sistem)</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md mt-4">
                Simpan Perubahan
            </button>
        </form>
    </main>

    @include('partials.footer')
</body>
</html>
