<?php

namespace App\Http\Controllers;

use App\Models\AccountSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountSubmissionController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan login terlebih dahulu.');
        }

        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('info', 'Admin tidak memiliki riwayat pengajuan akun sendiri.');
        }

        $submissions = AccountSubmission::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('sell.history', compact('submissions'));
    }

    public function create()
    {
        // Guest harus login dulu
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan login terlebih dahulu untuk menjual akun game.');
        }

        $categories = ['Mobile Legends', 'PUBG', 'eFootball'];
        $user = auth()->user();

        return view('sell.create', compact('categories', 'user'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'seller_name'   => 'required|string|max:255',
            'seller_email'  => 'required|email|max:255',
            'whatsapp'      => 'required|string|max:20',
            'game_category' => 'required|in:Mobile Legends,PUBG,eFootball',
            'price'         => 'required|numeric|min:1000',
            'login_method'  => 'required|string|max:255',
            'description'   => 'required|string',
            'screenshots'   => 'nullable|array|max:5',
            'screenshots.*' => 'image|max:4096',
        ]);

        // Simpan hingga 5 screenshot
        $screenshotPaths = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $file) {
                $screenshotPaths[] = $file->store('submissions', 'public');
            }
        }

        $submission = AccountSubmission::create([
            'user_id'       => auth()->id(),
            'seller_name'   => $request->seller_name,
            'seller_email'  => $request->seller_email,
            'whatsapp'      => $request->whatsapp,
            'game_category' => $request->game_category,
            'price'         => $request->price,
            'login_method'  => $request->login_method,
            'description'   => $request->description,
            'screenshots'   => !empty($screenshotPaths) ? $screenshotPaths : null,
            'status'        => 'pending',
        ]);

        return redirect()->route('sell.status', $submission)
            ->with('success', 'Pengajuan akun berhasil dikirim! Admin akan segera memeriksa ajuan Anda.');
    }

    public function show(AccountSubmission $submission)
    {
        if (!$this->canView($submission)) {
            abort(403, 'Anda tidak dapat melihat pengajuan ini.');
        }

        return view('sell.status', compact('submission'));
    }

    public function submitPaymentInfo(Request $request, AccountSubmission $submission)
    {
        if (!$this->canView($submission)) {
            abort(403, 'Akses ditolak.');
        }

        if ($submission->status !== 'accepted') {
            return redirect()->route('sell.status', $submission)
                ->with('info', 'Status pengajuan saat ini tidak memungkinkan pengisian rekening.');
        }

        $request->validate([
            'bank_type'   => 'required|in:BRI,MANDIRI,BCA,DANA,GOPAY,SHOPEEPAY',
            'bank_number' => 'required|string|max:50',
        ]);

        $submission->update([
            'bank_type'   => $request->bank_type,
            'bank_number' => $request->bank_number,
            'status'      => 'payment_info_submitted',
        ]);

        return redirect()->route('sell.status', $submission)
            ->with('success', 'Nomor rekening berhasil dikirim. Silakan tunggu Admin melakukan transfer.');
    }

    // Halaman form isi rekening/e-wallet
    public function paymentInfoForm(AccountSubmission $submission)
    {
        if (!$this->canView($submission)) {
            abort(403, 'Akses ditolak.');
        }

        if ($submission->status !== 'accepted') {
            return redirect()->route('sell.status', $submission)
                ->with('info', 'Halaman ini hanya bisa diakses ketika ajuan Anda sudah diterima.');
        }

        return view('sell.payment-info', compact('submission'));
    }

    protected function canView(AccountSubmission $submission): bool
    {
        if (!auth()->check()) {
            return false;
        }

        if (auth()->user()->isAdmin()) {
            return true;
        }

        return auth()->id() === $submission->user_id;
    }
}
