<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountSubmission;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'success')->sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();
        $pendingSubmissions = AccountSubmission::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalRevenue', 'pendingOrders', 'pendingSubmissions'));
    }
    public function exportSales()
    {
        $fileName = 'laporan_penjualan_facc_' . date('Y-m-d_H-i-s') . '.csv';
        $orders = Order::with('user', 'items.product')->orderBy('created_at', 'desc')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID Pesanan', 'Invoice', 'Tanggal', 'Pelanggan', 'Status', 'Metode Pembayaran', 'Total (Rp)');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            $totalRevenue = 0;
            $totalSuccessOrders = 0;

            foreach ($orders as $order) {
                $row['ID Pesanan']  = $order->id;
                $row['Invoice']    = $order->invoice_number;
                $row['Tanggal']    = $order->created_at->format('Y-m-d H:i:s');
                $row['Pelanggan']  = $order->user ? $order->user->name : 'N/A';
                $row['Status']  = $order->status;
                $row['Metode Pembayaran']  = $order->payment_method;
                $row['Total (Rp)']  = $order->total_price;

                if ($order->status == 'success') {
                    $totalRevenue += $order->total_price;
                    $totalSuccessOrders++;
                }

                fputcsv($file, array($row['ID Pesanan'], $row['Invoice'], $row['Tanggal'], $row['Pelanggan'], $row['Status'], $row['Metode Pembayaran'], $row['Total (Rp)']));
            }

            fputcsv($file, array('', '', '', '', '', '', ''));
            fputcsv($file, array('Ringkasan', '', '', '', '', '', ''));
            fputcsv($file, array('Total Pesanan Sukses', $totalSuccessOrders, '', '', '', '', ''));
            fputcsv($file, array('Total Pendapatan', $totalRevenue, '', '', '', '', ''));

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
