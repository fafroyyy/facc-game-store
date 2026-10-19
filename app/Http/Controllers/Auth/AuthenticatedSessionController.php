<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman formulir login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani proses verifikasi autentikasi login masuk.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Jika admin login, pastikan keranjang tidak tersisa.
        if (auth()->user()->role === 'admin' || (method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin())) {
            $request->session()->forget('cart');
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('home'));
    }

    /**
     * Menangani proses logout (menghancurkan session).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}