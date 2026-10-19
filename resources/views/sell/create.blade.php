<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Ajukan Penjualan Akun - FACC GAME STORE</title>
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

    <main class="flex-grow max-w-3xl mx-auto w-full px-4 py-10">
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 uppercase tracking-tight">Ajukan Penjualan Akun</h1>
            <p class="mt-2 text-gray-500 max-w-xl mx-auto">Isi data lengkap agar admin dapat menilai akun dengan cepat dan menghubungi Anda.</p>
        </div>




        <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white border border-gray-200 rounded-3xl p-8 shadow-xl shadow-gray-200/50 space-y-6">
            @csrf

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Nama Penjual</label>
                    <input type="text" name="seller_name" value="{{ old('seller_name', $user->name) }}"
                           class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="seller_email" value="{{ old('seller_email', $user->email) }}"
                           class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition" required>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                           placeholder="0812xxxxxxx"
                           class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Kategori Game</label>
                    <select name="game_category"
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition cursor-pointer" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('game_category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Harga Jual (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}"
                           placeholder="Contoh: 350000"
                           class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition" required min="1000">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Login Menggunakan</label>
                    <input type="text" name="login_method" value="{{ old('login_method') }}"
                           placeholder="Email / Username / Nomor HP"
                           class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Deskripsi Akun</label>
                <textarea name="description" rows="5"
                          placeholder="Detail rank, skin, hero, item langka, dan catatan penting lainnya..."
                          class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition" required>{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">
                    Screenshot Akun <span class="text-gray-400 font-normal normal-case">(maks. 5 gambar)</span>
                </label>
                <div id="image-upload-wrapper">
                    <div id="image-inputs-container" class="space-y-3">
                        <div class="image-input-group flex items-center gap-3">
                            <input type="file" name="screenshots[]" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-facc hover:file:bg-blue-100 transition cursor-pointer" onchange="previewImage(this)">
                            <div class="preview-container w-12 h-12 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex-shrink-0 hidden">
                                <img src="" class="w-full h-full object-cover">
                            </div>
                            <button type="button" onclick="removeImageInput(this)" class="bg-red-50 text-red-500 hover:bg-red-100 p-2 rounded-full transition hidden remove-btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                    <button type="button" onclick="addImageInput()" class="mt-3 text-xs font-bold text-facc bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl transition flex items-center gap-2 w-max">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Foto Lainnya
                    </button>
                </div>
            </div>

            <div class="rounded-xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-800">
                <p class="font-bold uppercase tracking-wider text-[11px] text-facc mb-1">Catatan Penting</p>
                <p>Setelah klik Ajukan, admin akan memeriksa akun. Status dapat dilihat di halaman pengajuan. Pastikan data yang Anda masukkan akurat.</p>
            </div>

            <button type="submit"
                    class="w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md">
                Ajukan Sekarang
            </button>
        </form>
    </main>

    @include('partials.footer')

    <script>
    function previewImage(input) {
        const group = input.closest('.image-input-group');
        const previewContainer = group.querySelector('.preview-container');
        const img = group.querySelector('img');
        const removeBtn = group.querySelector('.remove-btn');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                previewContainer.classList.remove('hidden');
                removeBtn.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('hidden');
            removeBtn.classList.add('hidden');
            img.src = '';
        }
    }

    function addImageInput() {
        const container = document.getElementById('image-inputs-container');
        if (container.children.length >= 5) {
            alert('Maksimal 5 gambar diperbolehkan.');
            return;
        }
        const newGroup = document.createElement('div');
        newGroup.className = 'image-input-group flex items-center gap-3 mt-3';
        newGroup.innerHTML = `
            <input type="file" name="screenshots[]" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-facc hover:file:bg-blue-100 transition cursor-pointer" onchange="previewImage(this)">
            <div class="preview-container w-12 h-12 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex-shrink-0 hidden">
                <img src="" class="w-full h-full object-cover">
            </div>
            <button type="button" onclick="removeImageInput(this)" class="bg-red-50 text-red-500 hover:bg-red-100 p-2 rounded-full transition hidden remove-btn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        `;
        container.appendChild(newGroup);
    }

    function removeImageInput(btn) {
        const group = btn.closest('.image-input-group');
        const container = document.getElementById('image-inputs-container');
        if (container.children.length === 1) {
            group.querySelector('input').value = '';
            group.querySelector('.preview-container').classList.add('hidden');
            group.querySelector('.remove-btn').classList.add('hidden');
            group.querySelector('img').src = '';
        } else {
            group.remove();
        }
    }
    </script>
</body>
</html>
