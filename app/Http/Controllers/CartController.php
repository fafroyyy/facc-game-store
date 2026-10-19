<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan isi keranjang belanja
    public function index()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            session()->forget('cart');
            return redirect()->route('admin.dashboard')->with('info', 'Admin tidak dapat menggunakan keranjang belanja.');
        }

        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Memasukkan produk ke dalam keranjang session
    public function add($id)
    {
        // Guest harus login dulu sebelum bisa belanja
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan login atau daftar terlebih dahulu untuk dapat berbelanja.');
        }

        if (auth()->user()->isAdmin()) {
            session()->forget('cart');
            return redirect()->route('admin.dashboard')->with('info', 'Admin tidak dapat menambahkan produk ke keranjang.');
        }

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Karena stok akun game = 1, cegah duplikasi item yang sama di keranjang
        if(isset($cart[$id])) {
            return redirect()->route('cart.index')->with('info', 'Akun ini sudah ada di dalam keranjang belanja Anda.');
        }

        // Ambil gambar utama
        $images = $product->getAllImages();
        $primaryImage = count($images) > 0 ? $images[0] : null;

        // Simpan data spesifik akun ke session
        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $primaryImage,
            "description" => $product->description,
            "category" => $product->category->name ?? 'Game'
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Akun game berhasil dimasukkan ke keranjang!');
    }

    // Menghapus produk dari keranjang belanja
    public function remove($id)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            session()->forget('cart');
            return redirect()->route('admin.dashboard')->with('info', 'Admin tidak dapat menghapus item dari keranjang.');
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Akun berhasil dihapus dari keranjang.');
    }

    // Memproses item yang dipilih (checklist) untuk dicheckout
    public function processCheckout(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);

        if (empty($selectedItems)) {
            return redirect()->route('cart.index')->with('info', 'Silakan pilih minimal satu akun untuk melanjutkan checkout.');
        }

        $cart = session()->get('cart', []);
        $checkoutItems = [];

        foreach ($selectedItems as $id) {
            if (isset($cart[$id])) {
                $checkoutItems[$id] = $cart[$id];
            }
        }

        if (empty($checkoutItems)) {
            return redirect()->route('cart.index')->with('info', 'Item yang dipilih tidak valid atau sudah tidak ada di keranjang.');
        }

        // Simpan item yang dipilih ke session khusus checkout
        session()->put('checkout_items', $checkoutItems);

        return redirect()->route('checkout.index');
    }
}