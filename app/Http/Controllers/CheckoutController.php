<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('info', 'Admin tidak dapat mengakses halaman checkout.');
        }

        $cart = session()->get('checkout_items', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('info', 'Tidak ada item yang dipilih untuk checkout. Silakan pilih dari keranjang.');
        }

        $total = array_sum(array_column($cart, 'price'));
        $adminFee = round($total * 0.04);
        $finalTotal = $total + $adminFee;
        $paymentMethods = [
            ['name' => 'BRI', 'logo' => 'bri.png'],
            ['name' => 'BCA', 'logo' => 'bca.png'],
            ['name' => 'MANDIRI', 'logo' => 'mandiri.png'],
            ['name' => 'DANA', 'logo' => 'dana.png'],
            ['name' => 'GOPAY', 'logo' => 'gopay.png'],
            ['name' => 'SHOPEEPAY', 'logo' => 'shopeepay.png'],
        ];

        return view('checkout.index', compact('cart', 'total', 'adminFee', 'finalTotal', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('info', 'Admin tidak dapat melakukan pembelian.');
        }

        $request->validate([
            'payment_method' => 'required|string',
            'account_number' => 'required|string|max:50',
            'email' => 'required|email',
            'whatsapp' => 'required|string|max:20',
        ]);

        $checkoutItems = session()->get('checkout_items', []);

        if (!$checkoutItems) {
            return redirect()->route('cart.index')->with('info', 'Tidak ada item untuk di-checkout.');
        }

        $total = array_sum(array_column($checkoutItems, 'price'));
        $adminFee = round($total * 0.04);
        $finalTotal = $total + $adminFee;
        $invoiceNumber = 'FACC-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4));

        $order = Order::create([
            'user_id' => Auth::id(),
            'invoice_number' => $invoiceNumber,
            'total_price' => $finalTotal,
            'status' => 'success',
            'snap_token' => null,
            'payment_method' => $request->payment_method,
            'account_number' => $request->account_number,
        ]);

        $mainCart = session()->get('cart', []);

        foreach ($checkoutItems as $productId => $item) {
            $product = Product::find($productId);
            if (! $product || $product->status !== 'available') {
                continue;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'price' => $item['price'],
            ]);

            // Ubah status produk menjadi sold
            $product->update(['status' => 'sold']);

            // Hapus dari keranjang utama jika ada
            if (isset($mainCart[$productId])) {
                unset($mainCart[$productId]);
            }
        }

        session()->put('cart', $mainCart);
        session()->forget('checkout_items');

        return redirect()->route('checkout.success', $order)->with('success', 'Pembayaran Berhasil! Akun game telah dihapus dari katalog dan instruksi pengamanan telah dikirimkan ke email.');
    }

    public function quickBuy($id)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('info', 'Admin tidak dapat membeli produk.');
        }

        $product = Product::findOrFail($id);

        if ($product->status !== 'available') {
            return redirect()->back()->with('error', 'Maaf, akun game ini sudah terjual.');
        }

        $images = $product->getAllImages();
        $primaryImage = count($images) > 0 ? $images[0] : null;

        $item = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $primaryImage,
            'description' => $product->description,
            'category' => $product->category->name ?? 'Game',
        ];

        // Langsung set ke checkout_items tanpa harus mempengaruhi seluruh isi keranjang
        session()->put('checkout_items', [$id => $item]);

        return redirect()->route('checkout.index')->with('success', 'Siap untuk melanjutkan ke pembayaran.');
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('checkout.success', compact('order'));
    }

    public function invoice(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke invoice ini.');
        }

        $order->load(['user', 'items.product.category']);

        return view('checkout.invoice', compact('order'));
    }
}
