<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use App\Models\DataPendaftar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{

    public function index()
    {
        $pendaftar = DataPendaftar::latest()->get();
        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    public function verifikasi()
    {
        $pendaftar = DataPendaftar::where('status', 'Pending')->get();
        return view('admin.pendaftar.verifikasi', compact('pendaftar'));
    }

    public function arsip()
    {
        $pendaftar = DataPendaftar::whereIn('status', ['Terverifikasi', 'Ditolak'])->latest()->get();
        return view('admin.pendaftar.arsip', compact('pendaftar'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftar = DataPendaftar::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->save();

        return back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }
    public function show($id)
    {
        // Ambil data pendaftar berdasarkan ID
        $pendaftar = DataPendaftar::findOrFail($id);

        // Kirim data ke view
        return view('admin.pendaftar.show', compact('pendaftar'));
    }


}
