<?php

namespace App\Http\Controllers;

use App\Models\DataPendaftar;
use Illuminate\Http\Request;

class AdminPendaftarController extends Controller
{
    public function index()
    {
        $pendaftar = DataPendaftar::with('user')->latest()->get();
        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Terverifikasi,Ditolak',
        ]);

        $pendaftar = DataPendaftar::findOrFail($id);
        $pendaftar->update(['status' => $request->status]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }
}
