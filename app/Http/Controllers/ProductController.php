<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilan Halaman Utama Toko (Untuk Semua Orang)
    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->query('category');

        $products = Product::where('status', 'available')
            ->when($selectedCategory, function ($query, $categorySlug) {
                $query->whereHas('category', function ($query) use ($categorySlug) {
                    $query->where('slug', $categorySlug);
                });
            })
            ->latest()
            ->get();

        return view('welcome', compact('products', 'categories', 'selectedCategory'));
    }

    // Halaman Semua Akun (terbaru di atas, support search)
    public function allProducts(Request $request)
    {
        $search = $request->query('search');
        $categorySlug = $request->query('category');
        $categories = Category::all();

        $products = Product::with('category')
            ->where('status', 'available')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->when($categorySlug, function ($query) use ($categorySlug) {
                $query->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->latest()
            ->paginate(12);

        return view('products.all', compact('products', 'search', 'categories', 'categorySlug'));
    }

    // Halaman Khusus Mobile Legends
    public function mobileLegends()
    {
        $products = Product::with('category')
            ->where('status', 'available')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'mobile-legends')->orWhere('name', 'like', '%Mobile Legends%');
            })
            ->latest()
            ->get();

        return view('games.mobile-legends', compact('products'));
    }

    // Halaman Khusus PUBG Mobile
    public function pubg()
    {
        $products = Product::with('category')
            ->where('status', 'available')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'pubg-mobile')->orWhere('name', 'like', '%PUBG%');
            })
            ->latest()
            ->get();

        return view('games.pubg', compact('products'));
    }

    // Halaman Khusus eFootball
    public function efootball()
    {
        $products = Product::with('category')
            ->where('status', 'available')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'efootball')->orWhere('name', 'like', '%eFootball%')->orWhere('name', 'like', '%Football%');
            })
            ->latest()
            ->get();

        return view('games.efootball', compact('products'));
    }

    // Menampilkan halaman detail spesifikasi akun game
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Tampilan Dashboard Manajemen Produk (Hanya Admin)
    public function adminIndex()
    {
        abort_if(!auth()->user()->isAdmin(), 403, 'Anda bukan Admin!');
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Tampilan Detail Produk untuk Admin (Melihat pembeli)
    public function showAdmin($id)
    {
        abort_if(!auth()->user()->isAdmin(), 403, 'Anda bukan Admin!');
        $product = Product::findOrFail($id);
        
        // Cari order item yang terkait dengan produk ini
        $orderItem = \App\Models\OrderItem::where('product_id', $id)->with('order.user')->first();
        
        return view('admin.products.show', compact('product', 'orderItem'));
    }

    // Form Tambah Produk (Hanya Admin)
    public function create()
    {
        abort_if(!auth()->user()->isAdmin(), 403);
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Simpan Produk Baru (Hanya Admin)
    public function store(Request $request)
    {
        abort_if(!auth()->user()->isAdmin(), 403);
        
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'images' => empty($imagePaths) ? null : $imagePaths,
            'status' => 'available',
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambah!');
    }

    // Form Edit Produk (Hanya Admin)
    public function edit($id)
    {
        abort_if(!auth()->user()->isAdmin(), 403);
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update Data Produk (Hanya Admin)
    public function update(Request $request, $id)
    {
        abort_if(!auth()->user()->isAdmin(), 403);
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
        ]);

        if ($request->hasFile('images')) {
            // Ambil daftar gambar saat ini
            $existingImages = $product->getAllImages();
            foreach ($request->file('images') as $image) {
                if ($image && $image->isValid()) {
                    $existingImages[] = $image->store('products', 'public');
                }
            }
            // Batasi maksimal 5
            $existingImages = array_slice($existingImages, 0, 5);
            $product->images = $existingImages;
            $product->image = null; // clear old single image field
            $product->save();
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diubah!');
    }

    // Hapus Satu Foto Produk (AJAX, Hanya Admin)
    public function deleteImage(Request $request, $id)
    {
        abort_if(!auth()->user()->isAdmin(), 403);
        $product = Product::findOrFail($id);
        $imgToDelete = $request->input('image');

        $images = $product->getAllImages();
        $images = array_values(array_filter($images, fn($img) => $img !== $imgToDelete));

        // Hapus file fisik
        \Storage::disk('public')->delete($imgToDelete);

        $product->images = count($images) > 0 ? $images : null;
        $product->image = null;
        $product->save();

        return response()->json(['success' => true]);
    }

    // Hapus Produk (Hanya Admin)
    public function destroy($id)
    {
        abort_if(!auth()->user()->isAdmin(), 403);
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}