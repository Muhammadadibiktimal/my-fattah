<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $alumnis = Alumni::latest()->paginate(10);
        return view('admin.alumnis.index', compact('alumnis'));
    }

    public function create()
    {
        return view('admin.alumnis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'angkatan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'kesan_pesan' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('alumnis', 'public');
        }

        Alumni::create([
            'name' => $request->name,
            'angkatan' => $request->angkatan,
            'pekerjaan' => $request->pekerjaan,
            'kesan_pesan' => $request->kesan_pesan,
            'photo' => $photoPath,
        ]);
        return redirect()->route('admin.alumnis.index')->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function edit(Alumni $alumni)
    {
        return view('admin.alumnis.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'angkatan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'kesan_pesan' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = $alumni->photo;
        if ($request->hasFile('photo')) {
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('alumnis', 'public');
        }

        $alumni->update([
            'name' => $request->name,
            'angkatan' => $request->angkatan,
            'pekerjaan' => $request->pekerjaan,
            'kesan_pesan' => $request->kesan_pesan,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.alumnis.index')->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy(Alumni $alumni)
    {
        if ($alumni->photo && Storage::disk('public')->exists($alumni->photo)) {
            Storage::disk('public')->delete($alumni->photo);
        }

        $alumni->delete();
        return redirect()->route('admin.alumnis.index')->with('success', 'Data alumni berhasil dihapus.');
    }
}
