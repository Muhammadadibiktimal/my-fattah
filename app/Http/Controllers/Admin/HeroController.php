<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        return view('admin.heroes.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.heroes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string|max:255',
            'button_text'  => 'nullable|string|max:100',
            'button_link'  => 'nullable|url',
            'image'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar
        $path = $request->file('image')->store('heroes', 'public');

        // Simpan data ke DB
        Hero::create([
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'image'       => $path,
        ]);

        return redirect()->route('admin.heroes.index')->with('success', 'Hero berhasil ditambahkan!');
    }

    public function edit(Hero $hero)
    {
        return view('admin.heroes.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string|max:255',
            'button_text'  => 'nullable|string|max:100',
            'button_link'  => 'nullable|url',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'subtitle', 'button_text', 'button_link']);

        // Jika upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }

            // Upload gambar baru
            $data['image'] = $request->file('image')->store('heroes', 'public');
        }

        $hero->update($data);

        return redirect()->route('admin.heroes.index')->with('success', 'Hero berhasil diupdate!');
    }

    public function destroy(Hero $hero)
    {
        // Hapus gambar kalau ada
        if ($hero->image && Storage::disk('public')->exists($hero->image)) {
            Storage::disk('public')->delete($hero->image);
        }

        $hero->delete();

        return redirect()->route('admin.heroes.index')->with('success', 'Hero berhasil dihapus!');
    }
}
