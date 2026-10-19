<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Kelola Akun - Admin FACC GAME STORE</title>
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

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 py-10">
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Kelola Akun Game</h1>
                <p class="text-gray-500 mt-1 font-medium">Kelola seluruh produk akun game FACC GAME STORE secara realtime.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="inline-block bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl uppercase tracking-widest transition shadow-md text-sm text-center">
                Tambah Akun Baru
            </a>
        </div>



        <div class="bg-white border border-gray-200 rounded-3xl shadow-xl shadow-gray-200/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500">
                            <th class="p-5 font-bold">Nama Produk / Akun</th>
                            <th class="p-5 font-bold">Harga</th>
                            <th class="p-5 font-bold text-center">Status</th>
                            <th class="p-5 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-5">
                                    <div class="font-bold text-gray-900 text-base mb-1">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500 truncate max-w-md font-medium">{{ $product->description }}</div>
                                </td>
                                <td class="p-5 font-black text-green-600 text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="p-5 text-center">
                                    @if($product->status === 'available')
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">Tersedia</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">Terjual</span>
                                    @endif
                                </td>
                                <td class="p-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($product->status === 'available')
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs font-bold transition">Edit</a>
                                        @else
                                            <a href="{{ route('admin.products.show', $product->id) }}" class="bg-purple-50 text-purple-600 hover:bg-purple-100 px-3 py-1.5 rounded-lg text-xs font-bold transition">Detail Pembeli</a>
                                        @endif
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline swal-delete-form" data-message="Yakin ingin menghapus akun ini? Tindakan ini tidak bisa dibatalkan.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg text-xs font-bold transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 font-medium">Belum ada akun game terpajang di database.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(method_exists($products, 'links'))
            <div class="p-5 border-t border-gray-100 bg-gray-50">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.querySelectorAll('.swal-delete-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = form.dataset.message || 'Yakin ingin menghapus?';
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>
</body>
</html>