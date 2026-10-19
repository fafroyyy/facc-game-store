<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Tambah Akun - Admin FACC GAME STORE</title>
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
            <a href="{{ route('admin.products.index') }}" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Tambah Produk Baru</h1>
            <p class="text-gray-500 mt-1 font-medium">Lengkapi form di bawah ini untuk menambahkan akun game ke dalam etalase toko.</p>
        </div>



        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border border-gray-200 rounded-3xl p-8 shadow-xl shadow-gray-200/50 space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Kategori Game</label>
                <select name="category_id" required class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition cursor-pointer">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Nama Produk / Judul Akun</label>
                <input type="text" name="name" required placeholder="Contoh: Akun eFootball Epic | 5 Card Showtime" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Harga (Rupiah)</label>
                <input type="number" name="price" required placeholder="Contoh: 250000" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Deskripsi & Spesifikasi Akun</label>
                <textarea name="description" rows="5" required placeholder="Tulis detil login, item langka, dsb." class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-4 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Screenshot Bukti Akun (Maks 5 Gambar)</label>
                <div id="image-upload-wrapper">
                    <div id="image-inputs-container" class="space-y-3">
                        <div class="image-input-group flex items-center gap-3">
                            <input type="file" name="images[]" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-facc hover:file:bg-blue-100 transition cursor-pointer" onchange="previewImage(this)">
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

            <button type="submit" class="w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md mt-4">
                Simpan & Pajang Produk
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
            }
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
            <input type="file" name="images[]" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-facc hover:file:bg-blue-100 transition cursor-pointer" onchange="previewImage(this)">
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