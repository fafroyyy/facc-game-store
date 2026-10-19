<?php

use App\Http\Controllers\AccountSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubmissionController as AdminSubmissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Akses Publik (Bisa diakses siapa saja, termasuk guest)
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/semua-akun', [ProductController::class, 'allProducts'])->name('products.all');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/game/mobile-legends', [ProductController::class, 'mobileLegends'])->name('games.mlbb');
Route::get('/game/pubg', [ProductController::class, 'pubg'])->name('games.pubg');
Route::get('/game/efootball', [ProductController::class, 'efootball'])->name('games.efootball');
Route::get('/profil-kami', fn() => view('about'))->name('about');
Route::get('/syarat-ketentuan', fn() => view('terms'))->name('terms');

// 2. Sistem Keranjang Belanja (dengan pengecekan auth di controller)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.checkout');

// 3. Akses Khusus User yang Sudah Login
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Riwayat Pesanan Customer
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/products/{id}/buy', [CheckoutController::class, 'quickBuy'])->name('checkout.buy');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/invoice/{order}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');

    // Route Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/export', [DashboardController::class, 'exportSales'])->name('admin.dashboard.export');
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}', [ProductController::class, 'showAdmin'])->name('admin.products.show');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}/update', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::post('/admin/products/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('admin.products.delete-image');

    Route::get('/admin/submissions', [AdminSubmissionController::class, 'index'])->name('admin.submissions.index');
    Route::get('/admin/submissions/{submission}', [AdminSubmissionController::class, 'show'])->name('admin.submissions.show');
    Route::post('/admin/submissions/{submission}/action', [AdminSubmissionController::class, 'action'])->name('admin.submissions.action');
    Route::post('/admin/submissions/{submission}/complete', [AdminSubmissionController::class, 'complete'])->name('admin.submissions.complete');
    Route::delete('/admin/submissions/{submission}', [AdminSubmissionController::class, 'destroy'])->name('admin.submissions.destroy');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}/update', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Jual Akun (Customer)
    Route::get('/sell/history', [AccountSubmissionController::class, 'index'])->name('sell.history');
    Route::get('/sell', [AccountSubmissionController::class, 'create'])->name('sell.create');
    Route::post('/sell', [AccountSubmissionController::class, 'store'])->name('sell.store');
    Route::get('/sell/status/{submission}', [AccountSubmissionController::class, 'show'])->name('sell.status');
    Route::get('/sell/status/{submission}/payment-info', [AccountSubmissionController::class, 'paymentInfoForm'])->name('sell.payment-info');
    Route::post('/sell/status/{submission}/payment-info', [AccountSubmissionController::class, 'submitPaymentInfo'])->name('sell.submit-payment-info');
    // Route lama (backward compat)
    Route::post('/sell/status/{submission}/transfer', [AccountSubmissionController::class, 'submitPaymentInfo'])->name('sell.transfer.submit');
});

require __DIR__.'/auth.php';