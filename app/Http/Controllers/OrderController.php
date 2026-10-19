<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan login untuk melihat riwayat pesanan.');
        }

        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('info', 'Admin tidak memiliki riwayat pesanan.');
        }

        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }
}
