<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    /**
     * Tampilkan seluruh data transaksi pembayaran formulir Midtrans
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Pendaftar::query()->latest();

        if ($status && $status !== 'all') {
            $query->where('status_bayar', $status);
        }

        $transaksi = $query->paginate(15);

        // Ringkasan statistik
        $totalTransaksi = Pendaftar::count();
        $totalLunas = Pendaftar::where('status_bayar', 'settlement')->count();
        $totalPending = Pendaftar::where('status_bayar', 'pending')->count();
        $nominalLunas = $totalLunas * 200000;

        return view('admin.transaksi.index', compact(
            'transaksi', 'totalTransaksi', 'totalLunas', 'totalPending', 'nominalLunas', 'status'
        ));
    }

    /**
     * Konfirmasi Lunas Manual (untuk kemudahan admin & pengujian sandbox)
     */
    public function manualLunas($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->status_bayar = 'settlement';
        $pendaftar->save();

        // Otomatis buatkan akun jika belum ada
        $user = User::where('email', $pendaftar->email)->first();
        $passwordPlain = 'Santri@' . rand(1000, 9999);

        if (!$user) {
            $user = User::create([
                'name' => $pendaftar->nama,
                'email' => $pendaftar->email,
                'phone' => $pendaftar->no_hp,
                'password' => Hash::make($passwordPlain),
                'role' => 'user',
            ]);

            \App\Models\Santri::firstOrCreate(
                ['nama_lengkap' => $pendaftar->nama],
                [
                    'user_id' => $user->id,
                    'pendaftar_id' => $pendaftar->id,
                    'no_hp' => $pendaftar->no_hp,
                    'status' => 'Aktif',
                ]
            );

            return back()->with('akun_created', [
                'nama' => $pendaftar->nama,
                'email' => $pendaftar->email,
                'password' => $passwordPlain,
            ])->with('success', "Pembayaran #{$pendaftar->order_id} berhasil dikonfirmasi Lunas dan Akun Santri otomatis dibuat!");
        }

        return back()->with('success', "Status pembayaran #{$pendaftar->order_id} berhasil diubah menjadi Lunas.");
    }
}
