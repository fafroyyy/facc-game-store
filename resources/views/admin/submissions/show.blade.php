<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Detail Pengajuan - Admin FACC GAME STORE</title>
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
                <a href="{{ route('admin.dashboard') }}" class="flex-shrink-0 flex items-center gap-2">
                    <img src="{{ asset('images/facc-logo.png') }}" alt="FACC" class="w-10 h-10 md:w-12 md:h-12 object-contain rounded-lg">
                    <div class="leading-tight hidden md:block">
                        <div class="font-black text-gray-900 text-sm tracking-widest uppercase">FACC</div>
                        <div class="font-semibold text-gray-500 text-xs tracking-widest uppercase">Admin Panel</div>
                    </div>
                </a>
            </div>
            <div class="flex items-center space-x-3 flex-shrink-0">
                @include('partials.navbar-profile')
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-6xl mx-auto w-full px-4 py-10">
        <div class="mb-6">
            <a href="{{ route('admin.submissions.index') }}" class="inline-block px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-xl transition text-sm">Kembali</a>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Detail Pengajuan Akun</h1>
                <p class="text-gray-500 mt-1 font-medium">Tinjau informasi akun dan berikan keputusan.</p>
            </div>
            
            {{-- Status Badge --}}
            <div class="rounded-2xl px-6 py-3 shadow-sm border text-center
                @if($submission->status === 'accepted' || $submission->status === 'completed') bg-green-50 border-green-200
                @elseif($submission->status === 'rejected') bg-red-50 border-red-200
                @elseif($submission->status === 'payment_info_submitted') bg-blue-50 border-blue-200
                @else bg-yellow-50 border-yellow-200 @endif">
                <p class="text-[10px] font-bold uppercase tracking-widest
                    @if($submission->status === 'accepted' || $submission->status === 'completed') text-green-600
                    @elseif($submission->status === 'rejected') text-red-600
                    @elseif($submission->status === 'payment_info_submitted') text-blue-600
                    @else text-yellow-600 @endif">
                    Status Saat Ini
                </p>
                <p class="font-black text-gray-900 mt-1">{{ $submission->status_label }}</p>
            </div>
        </div>




        <div class="grid gap-6 lg:grid-cols-3">
            
            {{-- KOLOM KIRI: Informasi Akun --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Data Seller & Akun --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-6 md:p-8 shadow-xl shadow-gray-200/50">
                    <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider mb-6 pb-3 border-b border-gray-100">Informasi Pengajuan</h2>
                    
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-1">Nama Customer</p>
                            <p class="font-semibold text-gray-900">{{ $submission->seller_name }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-1">Email / Kontak</p>
                            <p class="font-semibold text-gray-900">{{ $submission->seller_email }}</p>
                            <p class="text-sm text-gray-500">WA: {{ $submission->whatsapp }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-1">Game</p>
                            <span class="bg-blue-50 text-facc px-2.5 py-1 rounded-full text-xs font-black uppercase tracking-wider">{{ $submission->game_category }}</span>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-1">Harga yang Diminta</p>
                            <p class="font-black text-green-600 text-xl">Rp {{ number_format($submission->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-1">Metode Login</p>
                            <p class="font-semibold text-gray-900 bg-gray-50 px-4 py-2 rounded-xl inline-block">{{ $submission->login_method }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-[11px] font-black text-gray-500 uppercase tracking-wider mb-1">Deskripsi Detail</p>
                            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4">
                                <p class="text-gray-700 whitespace-pre-line leading-relaxed text-sm">{{ $submission->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Screenshots --}}
                @php $allScreenshots = $submission->getAllScreenshots(); @endphp
                @if(count($allScreenshots) > 0)
                <div class="bg-white border border-gray-200 rounded-3xl p-6 md:p-8 shadow-xl shadow-gray-200/50">
                    <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider mb-6 pb-3 border-b border-gray-100">Screenshot Akun</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($allScreenshots as $img)
                            <a href="{{ asset('storage/' . $img) }}" target="_blank" class="block aspect-video rounded-xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition group">
                                <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="Screenshot">
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
            </div>

            {{-- KOLOM KANAN: Aksi Admin --}}
            <div class="space-y-6">
                
                {{-- Data Rekening (Jika Ada) --}}
                @if($submission->bank_type && $submission->bank_number)
                <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-4">Informasi Rekening Customer</h3>
                    <div class="bg-white border border-blue-100 rounded-2xl p-4 text-center">
                        <p class="text-xs text-gray-500 font-bold mb-1">Metode</p>
                        <p class="font-black text-gray-900 text-lg mb-3">{{ $submission->bank_type }}</p>
                        
                        <p class="text-xs text-gray-500 font-bold mb-1">Nomor Rekening / E-Wallet</p>
                        <p class="font-black text-facc text-xl tracking-wider">{{ $submission->bank_number }}</p>
                    </div>
                </div>
                @endif

                {{-- Panel Aksi --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-xl shadow-gray-200/50">
                    <h3 class="text-[11px] font-black text-gray-500 uppercase tracking-widest mb-4">Tindakan Admin</h3>
                    
                    {{-- Form Terima/Tolak (Hanya jika pending) --}}
                    @if($submission->status === 'pending')
                    <form action="{{ route('admin.submissions.action', $submission) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider mb-2">Catatan untuk Customer</label>
                            <textarea name="admin_note" rows="3" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none focus:border-facc focus:ring-1 focus:ring-facc transition" placeholder="Opsional (Misal: Alasan ditolak)">{{ old('admin_note', $submission->admin_note) }}</textarea>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <button type="button" class="w-full bg-green-500 hover:bg-green-600 text-white font-black py-3 rounded-xl transition text-sm uppercase tracking-wider shadow-md shadow-green-500/30" onclick="swalSubmitAction(this.closest('form'), 'accept', 'Terima Pengajuan', 'Yakin ingin menerima pengajuan ini?', '#16a34a')">Terima</button>
                            <button type="button" class="w-full bg-red-500 hover:bg-red-600 text-white font-black py-3 rounded-xl transition text-sm uppercase tracking-wider shadow-md shadow-red-500/30" onclick="swalSubmitAction(this.closest('form'), 'reject', 'Tolak Pengajuan', 'Yakin ingin menolak pengajuan ini?', '#dc2626')">Tolak</button>
                        </div>
                    </form>
                    
                    {{-- Form Selesai Transfer (Hanya jika payment_info_submitted) --}}
                    @elseif($submission->status === 'payment_info_submitted')
                    <form action="{{ route('admin.submissions.complete', $submission) }}" method="POST">
                        @csrf
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-4 text-sm text-yellow-800">
                            Customer telah mengisi nomor rekening. Lakukan transfer dana sekarang, lalu klik tombol di bawah untuk menyelesaikan proses.
                        </div>
                        <button type="button" class="w-full bg-facc hover:bg-facc-dark text-white font-black py-3 px-6 rounded-xl transition text-sm uppercase tracking-widest shadow-md" onclick="swalConfirmTransfer(this.closest('form'))">
                            Selesaikan Transfer
                        </button>
                    </form>
                    
                    {{-- Info jika sudah Selesai/Ditolak/Diterima (menunggu rekening) --}}
                    @else
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 text-center">
                        <p class="font-semibold text-gray-600 text-sm">
                            @if($submission->status === 'accepted')
                                Menunggu Customer mengisi data rekening/e-wallet.
                            @elseif($submission->status === 'completed')
                                Transaksi ini telah diselesaikan.
                            @elseif($submission->status === 'rejected')
                                Pengajuan ini telah ditolak.
                            @endif
                        </p>
                        @if($submission->admin_note)
                            <div class="mt-4 pt-4 border-t border-gray-200 text-left">
                                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Catatan Admin</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $submission->admin_note }}</p>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
                
                {{-- Hapus Data --}}
                <div class="bg-white border border-red-100 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-[11px] font-black text-red-500 uppercase tracking-widest mb-2">Zona Bahaya</h3>
                    <p class="text-xs text-gray-500 mb-4">Menghapus pengajuan akan menghilangkan seluruh data dan gambar secara permanen.</p>
                    <form action="{{ route('admin.submissions.destroy', $submission) }}" method="POST" class="swal-delete-form" data-message="Tindakan ini tidak dapat dibatalkan. Seluruh data dan gambar akan dihapus permanen.">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full border border-red-500 text-red-500 hover:bg-red-50 font-bold py-2.5 rounded-xl transition text-sm">Hapus Pengajuan</button>
                    </form>
                </div>
                
            </div>
        </div>
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Hapus form SweetAlert
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
                confirmButtonText: 'Ya, Hapus Permanen!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Terima / Tolak dengan SweetAlert
    function swalSubmitAction(form, actionValue, title, text, confirmColor) {
        Swal.fire({
            title: title,
            text: text,
            icon: actionValue === 'reject' ? 'warning' : 'question',
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Lanjutkan',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.isConfirmed) {
                // Set hidden input action value
                let input = form.querySelector('input[name="action"]');
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'action';
                    form.appendChild(input);
                }
                input.value = actionValue;
                form.submit();
            }
        });
    }

    // Selesaikan Transfer SweetAlert
    function swalConfirmTransfer(form) {
        Swal.fire({
            title: 'Konfirmasi Transfer',
            text: 'Apakah Anda sudah mentransfer dana ke customer? Tindakan ini akan menyelesaikan transaksi.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#00008B',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Sudah Transfer',
            cancelButtonText: 'Belum'
        }).then(function(result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
    </script>
</body>
</html>
