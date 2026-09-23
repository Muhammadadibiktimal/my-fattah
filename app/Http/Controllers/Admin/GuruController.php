<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = User::where('role', 'guru')->latest()->paginate(15);
        return view('admin.guru.index', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        return back()->with('success', "Akun guru {$request->name} berhasil ditambahkan!");
    }

    public function update(Request $request, $id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        $guru->name = $request->name;
        $guru->email = $request->email;
        $guru->phone = $request->phone;

        if ($request->filled('password')) {
            $guru->password = Hash::make($request->password);
        }

        $guru->save();

        return back()->with('success', "Data guru {$guru->name} berhasil diperbarui!");
    }

    public function destroy($id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);
        $guru->delete();

        return back()->with('success', 'Akun guru berhasil dihapus.');
    }
}
