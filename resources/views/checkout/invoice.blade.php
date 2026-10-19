<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/facc-logo.png') }}">
    <title>Invoice {{ $order->invoice_number }} - FACC GAME STORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            color: #1a1a2e;
            font-size: 13px;
            padding: 40px;
        }

        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 28px;
            border-bottom: 3px solid #00008B;
            margin-bottom: 32px;
        }
        .brand { display: flex; align-items: center; gap: 14px; }
        .brand-logo {
            width: 56px; height: 56px;
            object-fit: contain;
            border-radius: 10px;
        }
        .brand-name { font-size: 22px; font-weight: 900; color: #00008B; letter-spacing: 3px; text-transform: uppercase; }
        .brand-sub { font-size: 10px; font-weight: 600; color: #888; letter-spacing: 2px; text-transform: uppercase; margin-top: 2px; }

        .invoice-title-block { text-align: right; }
        .invoice-label { font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 2px; }
        .invoice-number { font-size: 18px; font-weight: 900; color: #1a1a2e; margin-top: 4px; letter-spacing: 1px; }
        .invoice-date { font-size: 11px; color: #888; margin-top: 6px; }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 8px;
            background: #dcfce7;
            color: #166534;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }
        .info-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 20px;
        }
        .info-card-title { font-size: 10px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; }
        .info-card p { font-size: 13px; font-weight: 600; color: #1a1a2e; margin-bottom: 4px; }
        .info-card .label { font-size: 11px; color: #888; font-weight: 500; }

        /* Payment Method */
        .payment-logo {
            height: 36px;
            width: auto;
            object-fit: contain;
            margin-bottom: 6px;
        }
        .account-number { font-family: monospace; font-size: 15px; font-weight: 700; color: #1a1a2e; letter-spacing: 2px; }

        /* Items Table */
        .items-title {
            font-size: 11px; font-weight: 800; color: #888;
            text-transform: uppercase; letter-spacing: 2px;
            margin-bottom: 12px;
        }
        table { width: 100%; border-collapse: collapse; margin-bottom: 28px; }
        thead th {
            background: #00008B; color: #fff;
            padding: 10px 14px;
            text-align: left;
            font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        }
        thead th:last-child { text-align: right; }
        tbody td {
            padding: 12px 14px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 12px;
            color: #374151;
        }
        tbody td:last-child { text-align: right; font-weight: 700; color: #1a1a2e; }
        .category-badge {
            display: inline-block;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 999px;
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Totals */
        .totals { margin-left: auto; width: 280px; }
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 12px; color: #6b7280; font-weight: 500;
        }
        .total-row .val { font-weight: 700; color: #1a1a2e; }
        .grand-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 16px;
            background: #00008B;
            border-radius: 10px;
            margin-top: 10px;
        }
        .grand-total .label { font-size: 12px; font-weight: 700; color: rgba(255,255,255,0.85); text-transform: uppercase; letter-spacing: 1px; }
        .grand-total .val { font-size: 18px; font-weight: 900; color: #fff; }

        /* Footer */
        .invoice-footer {
            margin-top: 48px;
            padding-top: 20px;
            border-top: 1px dashed #d1d5db;
            text-align: center;
            font-size: 10px; color: #9ca3af; font-weight: 500;
        }
        .invoice-footer strong { color: #00008B; }

        /* Note */
        .note-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 14px 18px;
            margin-top: 28px;
            font-size: 11px;
            color: #1e40af;
            font-weight: 500;
        }
        .note-box strong { font-weight: 800; display: block; margin-bottom: 4px; }

        @media print {
            body { padding: 20px; }
            @page { margin: 0; size: A4; }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="invoice-header">
        <div class="brand">
            <img src="{{ asset('images/facc-logo.png') }}" class="brand-logo" alt="FACC">
            <div>
                <div class="brand-name">FACC</div>
                <div class="brand-sub">Game Store</div>
            </div>
        </div>
        <div class="invoice-title-block">
            <div class="invoice-label">Invoice</div>
            <div class="invoice-number">{{ $order->invoice_number }}</div>
            <div class="invoice-date">{{ $order->created_at->format('d F Y, H:i') }} WIB</div>
            <div class="status-badge">{{ $order->status === 'success' ? 'Sukses' : ucfirst($order->status) }}</div>
        </div>
    </div>

    <!-- Info Grid -->
    <div class="info-grid">
        <!-- Info Pembeli -->
        <div class="info-card">
            <div class="info-card-title">Informasi Pembeli</div>
            <p>{{ $order->user->name }}</p>
            <p class="label">{{ $order->user->email }}</p>
        </div>

        <!-- Metode Pembayaran -->
        <div class="info-card">
            <div class="info-card-title">Metode Pembayaran</div>
            @php
                $logoMap = [
                    'BRI' => 'bri.png', 'BCA' => 'bca.png', 'MANDIRI' => 'mandiri.png',
                    'DANA' => 'dana.png', 'GOPAY' => 'gopay.png', 'SHOPEEPAY' => 'shopeepay.png',
                ];
                $logoFile = $logoMap[$order->payment_method] ?? null;
            @endphp
            @if($logoFile)
                <img src="{{ asset('images/' . $logoFile) }}" class="payment-logo" alt="{{ $order->payment_method }}">
            @endif
            <p>{{ $order->payment_method ?? 'Tidak tersedia' }}</p>
            @if($order->account_number)
                <div class="account-number">{{ $order->account_number }}</div>
            @endif
        </div>
    </div>

    <!-- Items Table -->
    <div class="items-title">Rincian Produk</div>
    <table>
        <thead>
            <tr>
                <th style="width:50%">Nama Akun Game</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>
                    <strong>{{ $item->product->name ?? 'Akun Game' }}</strong>
                </td>
                <td>
                    @if($item->product && $item->product->category)
                        <span class="category-badge">{{ $item->product->category->name }}</span>
                    @else
                        <span class="category-badge">-</span>
                    @endif
                </td>
                <td style="color:#888; font-size:11px;">{{ $item->created_at->format('d M Y') }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    @php
        $subtotal = $order->items->sum('price');
        $adminFee = max(0, $order->total_price - $subtotal);
    @endphp
    <div class="totals">
        <div class="total-row">
            <span>Subtotal</span>
            <span class="val">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>Biaya Admin (4%)</span>
            <span class="val">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
        </div>
        <div class="grand-total">
            <span class="label">Total Pembayaran</span>
            <span class="val">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Note -->
    <div class="note-box">
        <strong>📌 Informasi Penting</strong>
        Data detail login dan Panduan Cara Pengamanan telah dikirimkan ke email Anda. Simpan invoice ini sebagai bukti pembelian yang sah. Jika mengalami kendala, hubungi Admin FACC Game Store.
    </div>

    <!-- Footer -->
    <div class="invoice-footer">
        Invoice ini diterbitkan secara otomatis oleh sistem <strong>FACC Game Store</strong>.<br>
        Dokumen ini sah tanpa tanda tangan basah. &copy; {{ date('Y') }} FACC Game Store. All rights reserved.
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        window.onload = function() {
            const element = document.body;
            const opt = {
                margin:       [0.4, 0.4],
                filename:     'Invoice_{{ $order->invoice_number }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().set(opt).from(element).save();
        };
    </script>
</body>
</html>
