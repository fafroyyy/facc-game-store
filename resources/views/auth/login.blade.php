<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Login - FACC GAME STORE</title>
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
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col justify-center items-center p-4">

    <div class="mb-6 w-full max-w-md mx-auto">
        <a href="/" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
    </div>

    <div class="w-full max-w-md bg-white border border-gray-200 p-8 rounded-2xl shadow-xl">
        
        <div class="text-center mb-8 flex flex-col items-center">
            <img src="{{ asset('images/facc-logo.png') }}" alt="Logo FACC Game Store" class="w-16 h-16 object-contain rounded-xl mb-3 shadow-sm border border-gray-100">
            <h2 class="text-2xl font-black text-gray-900 tracking-wider">FACC GAME STORE</h2>
            <p class="text-gray-500 text-sm mt-1">Masuk untuk melanjutkan transaksi aman Anda</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-xl mb-6 text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold uppercase text-gray-600 mb-1.5 tracking-wider">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="nama@email.com" 
                    class="w-full bg-gray-50 border border-gray-300 rounded-xl p-3 text-sm text-gray-900 focus:border-facc focus:ring-1 focus:ring-facc outline-none transition">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block text-xs font-bold uppercase text-gray-600 tracking-wider">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-facc hover:underline font-medium">Lupa Sandi?</a>
                    @endif
                </div>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                    placeholder="••••••••" 
                    class="w-full bg-gray-50 border border-gray-300 rounded-xl p-3 text-sm text-gray-900 focus:border-facc focus:ring-1 focus:ring-facc outline-none transition">
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="remember_me" name="remember" class="w-4 h-4 text-facc bg-white border-gray-300 rounded focus:ring-facc focus:ring-offset-white focus:ring-2">
                <label for="remember_me" class="ml-2 text-sm text-gray-600 select-none">Ingat perangkat ini</label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl transition text-sm uppercase tracking-widest shadow-md">
                    Masuk Akun
                </button>
            </div>
        </form>

        <div class="text-center mt-6 pt-6 border-t border-gray-100 text-sm text-gray-500">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-facc font-bold hover:underline ml-1">Daftar Sekarang</a>
        </div>

    </div>

</body>
</html>