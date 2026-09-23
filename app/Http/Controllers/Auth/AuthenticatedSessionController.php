<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Proses login (pakai LoginRequest bawaan Breeze)
        $request->authenticate();

        // Regenerasi session agar aman
        $request->session()->regenerate();

        // Ambil user yang sedang login
        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user && $user->role === 'yayasan') {
            return redirect()->route('yayasan.dashboard');
        } elseif ($user && $user->role === 'kepsek') {
            return redirect()->route('kepsek.dashboard');
        } elseif ($user && $user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah berhasil keluar dari akun.');
    }
}
