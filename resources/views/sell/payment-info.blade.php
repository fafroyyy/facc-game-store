<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Informasi Pencairan Dana - FACC GAME STORE</title>
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
                @include('partials.navbar-profile')
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-2xl mx-auto w-full px-4 py-12">

        <div class="mb-6">
            <a href="{{ route('sell.status', $submission) }}" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-5 shadow-sm border border-green-200">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Informasi Pencairan Dana</h1>
            <p class="mt-2 text-gray-500 max-w-md mx-auto">Pengajuan Anda telah <span class="font-bold text-green-600">DITERIMA</span>! Masukkan nomor rekening atau e-wallet untuk menerima pembayaran.</p>
        </div>




        <form action="{{ route('sell.submit-payment-info', $submission) }}" method="POST"
              class="bg-white border border-gray-200 rounded-3xl p-8 shadow-xl shadow-gray-200/50 space-y-6">
            @csrf

            {{-- Pilihan Metode --}}
            <div>
                <label class="block text-xs font-black text-gray-600 uppercase tracking-wider mb-4">Pilih Metode Pencairan</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @php
                        $methods = [
                            ['value' => 'BRI',       'label' => 'Bank BRI',    'logo' => 'bri.png'],
                            ['value' => 'MANDIRI',   'label' => 'Bank Mandiri','logo' => 'mandiri.png'],
                            ['value' => 'BCA',       'label' => 'Bank BCA',    'logo' => 'bca.png'],
                            ['value' => 'DANA',      'label' => 'DANA',        'logo' => 'dana.png'],
                            ['value' => 'GOPAY',     'label' => 'GoPay',       'logo' => 'gopay.png'],
                            ['value' => 'SHOPEEPAY', 'label' => 'ShopeePay',   'logo' => 'shopeepay.png'],
                        ];
                    @endphp
                    @foreach($methods as $method)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="bank_type" value="{{ $method['value'] }}"
                                   class="peer sr-only" {{ old('bank_type') === $method['value'] ? 'checked' : '' }} required>
                            <div class="h-full border-2 border-gray-200 rounded-2xl p-4 text-center hover:border-facc transition peer-checked:border-facc peer-checked:bg-blue-50 peer-checked:shadow-md flex flex-col items-center justify-center gap-2">
                                <div class="w-16 h-10 flex items-center justify-center">
                                    <img src="{{ asset('images/' . $method['logo']) }}" alt="{{ $method['label'] }}" class="max-w-full max-h-full object-contain">
                                </div>
                                <p class="text-xs font-black text-gray-900 tracking-wide">{{ $method['label'] }}</p>
                            </div>
                            <div class="absolute top-2 right-2 w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-facc peer-checked:bg-facc hidden peer-checked:flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Nomor Rekening --}}
            <div>
                <label class="block text-xs font-black text-gray-600 uppercase tracking-wider mb-2">Nomor Rekening / Nomor E-Wallet</label>
                <input type="text" name="bank_number" value="{{ old('bank_number') }}"
                       placeholder="Contoh: 089512345678 atau 1234567890"
                       class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 font-bold text-lg tracking-widest outline-none focus:border-facc focus:ring-1 focus:ring-facc transition"
                       required>
                <p class="text-xs text-gray-500 mt-2">Pastikan nomor yang Anda masukkan sudah benar. Admin akan melakukan transfer ke nomor ini.</p>
            </div>

            {{-- Akun yang diajukan (ringkasan) --}}
            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4">
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-2">Akun yang Diajukan</p>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-bold text-gray-900">{{ $submission->game_category }}</p>
                        <p class="text-sm text-gray-500">{{ Str::limit($submission->description, 60) }}</p>
                    </div>
                    <p class="font-black text-green-600 text-lg">Rp {{ number_format($submission->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm text-yellow-800">
                <p class="font-black uppercase tracking-wider text-[11px] text-yellow-700 mb-1">⚠️ Perhatian</p>
                <p>Pastikan nomor rekening / e-wallet yang Anda masukkan aktif dan sesuai dengan metode yang dipilih. Kesalahan nomor tidak dapat dikembalikan.</p>
            </div>

            <button type="submit"
                    class="w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md">
                Kirim Informasi Rekening
            </button>
        </form>
    </main>

    @include('partials.footer')

    <script>
        // JS tidak diperlukan lagi karena efek highlight dikontrol penuh melalui CSS 'peer-checked' di class HTML
    </script>
</body>
</html>
