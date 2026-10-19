<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->isAdmin(), 403, 'Anda bukan Admin!');

        $submissions = AccountSubmission::with('user')->latest()->get();
        return view('admin.submissions.index', compact('submissions'));
    }

    public function show(AccountSubmission $submission)
    {
        abort_if(!auth()->user()->isAdmin(), 403, 'Anda bukan Admin!');

        return view('admin.submissions.show', compact('submission'));
    }

    public function action(Request $request, AccountSubmission $submission)
    {
        abort_if(!auth()->user()->isAdmin(), 403, 'Anda bukan Admin!');

        $request->validate([
            'action'     => 'required|in:accept,reject',
            'admin_note' => 'nullable|string|max:1000',
        ]);

        $status = match ($request->action) {
            'accept' => 'accepted',
            'reject' => 'rejected',
        };

        $submission->update([
            'status'     => $status,
            'admin_note' => $request->admin_note,
        ]);

        $msg = $request->action === 'accept'
            ? 'Pengajuan berhasil DITERIMA. Customer sekarang bisa mengisi nomor rekening.'
            : 'Pengajuan berhasil DITOLAK.';

        return redirect()->route('admin.submissions.show', $submission)->with('success', $msg);
    }

    public function complete(Request $request, AccountSubmission $submission)
    {
        abort_if(!auth()->user()->isAdmin(), 403, 'Anda bukan Admin!');

        if ($submission->status !== 'payment_info_submitted') {
            return redirect()->route('admin.submissions.show', $submission)
                ->with('info', 'Status pengajuan tidak memungkinkan untuk diselesaikan saat ini.');
        }

        $submission->update(['status' => 'completed']);

        return redirect()->route('admin.submissions.show', $submission)
            ->with('success', 'Transfer selesai! Status pengajuan diubah menjadi "Pencairan Dana Sukses".');
    }

    public function destroy(AccountSubmission $submission)
    {
        abort_if(!auth()->user()->isAdmin(), 403, 'Anda bukan Admin!');

        // Hapus semua file screenshot
        $screenshots = $submission->getAllScreenshots();
        foreach ($screenshots as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }

        $submission->delete();

        return redirect()->route('admin.submissions.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }
}
