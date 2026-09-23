<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Services\WhatsappService;

class PendaftaranController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans global
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    // 🔹 Halaman form pendaftaran
    public function form()
    {
        return view('pendaftaran.form');
    }

    // 🔹 Halaman setelah sukses
    public function finish(Request $request)
    {
        return redirect()->route('login')->with('success', 'Pembayaran berhasil! Silakan login.');
    }

    // 🔹 Proses pembayaran & simpan formulir lengkap
    public function bayar(Request $request)
    {
        $request->validate([
            // 1. Data Diri Calon Santri
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pendaftar,email',
            'telepon' => 'required|string|max:20',
            'nik' => 'nullable|string|max:25',
            'nisn' => 'nullable|string|max:25',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jenjang' => 'required|string|max:50',
            'jurusan' => 'nullable|string|max:100',

            // 2. Data Asal Sekolah
            'asal_sekolah' => 'nullable|string|max:255',
            'alamat_sekolah' => 'nullable|string|max:255',

            // 3. Data Orang Tua / Wali
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_hp_ortu' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',

            // 4. Lampiran Dokumen Berkas
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_akta' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
        ], [
            'email.unique' => 'Alamat email ini sudah terdaftar sebelumnya.',
            'jenis_kelamin.required' => 'Pilih jenis kelamin calon santri.',
            'jenjang.required' => 'Pilih jenjang pendidikan yang dituju.',
            'file_kk.max' => 'Ukuran file Kartu Keluarga maksimal 5MB.',
            'file_akta.max' => 'Ukuran file Akta Kelahiran maksimal 5MB.',
            'file_ijazah.max' => 'Ukuran file Ijazah/SKL maksimal 5MB.',
            'file_foto.max' => 'Ukuran pas foto maksimal 3MB.',
        ]);

        // Upload berkas jika dilampirkan
        $fileKK = $request->hasFile('file_kk') ? $request->file('file_kk')->store('pendaftaran/kk', 'public') : null;
        $fileAkta = $request->hasFile('file_akta') ? $request->file('file_akta')->store('pendaftaran/akta', 'public') : null;
        $fileIjazah = $request->hasFile('file_ijazah') ? $request->file('file_ijazah')->store('pendaftaran/ijazah', 'public') : null;
        $fileFoto = $request->hasFile('file_foto') ? $request->file('file_foto')->store('pendaftaran/foto', 'public') : null;

        // Normalisasi nomor HP
        $telepon = $this->convertPhone($request->telepon);

        // Buat order ID unik
        $orderId = 'PSB-' . time();

        // Simpan ke database dengan seluruh data lengkap
        $pendaftar = Pendaftar::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $telepon,
            'order_id' => $orderId,
            'status_bayar' => 'pending',
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jenjang' => $request->jenjang,
            'jurusan' => $request->jurusan,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat_sekolah' => $request->alamat_sekolah,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'no_hp_ortu' => $request->no_hp_ortu,
            'alamat' => $request->alamat,
            'file_kk' => $fileKK,
            'file_akta' => $fileAkta,
            'file_ijazah' => $fileIjazah,
            'file_foto' => $fileFoto,
        ]);

        // Data transaksi ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 200000,
            ],
            'customer_details' => [
                'first_name' => $pendaftar->nama,
                'email' => $pendaftar->email,
                'phone' => $pendaftar->no_hp,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::warning("Midtrans Snap Error (Fallback to mock sandbox token): " . $e->getMessage());
            $snapToken = 'mock-snap-' . md5($orderId);
        }

        // Simpan snap token
        $pendaftar->update(['snap_token' => $snapToken]);

        return view('pendaftaran.bayar', compact('pendaftar', 'snapToken'));
    }

    // 🔹 Midtrans Notification Handler
    public function notification(Request $request)
    {
        try {
            $notif = new Notification();

            $transaction = $notif->transaction_status;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status ?? null;

            Log::info("📩 Notif diterima: order_id={$orderId}, status={$transaction}");

            $pendaftar = Pendaftar::where('order_id', $orderId)->first();

            if (!$pendaftar) {
                Log::error("❌ Pendaftar dengan order_id $orderId tidak ditemukan");
                return response()->json(['message' => 'Pendaftar tidak ditemukan'], 404);
            }

            // Update status berdasarkan transaksi
            switch ($transaction) {
                case 'capture':
                    $pendaftar->status_bayar = ($fraud == 'challenge') ? 'challenge' : 'settlement';
                    break;
                case 'settlement':
                    $pendaftar->status_bayar = 'settlement';
                    break;
                case 'pending':
                    $pendaftar->status_bayar = 'pending';
                    break;
                case 'deny':
                    $pendaftar->status_bayar = 'deny';
                    break;
                case 'expire':
                    $pendaftar->status_bayar = 'expire';
                    break;
                case 'cancel':
                    $pendaftar->status_bayar = 'cancel';
                    break;
                default:
                    $pendaftar->status_bayar = $transaction;
                    break;
            }

            $pendaftar->save();

            // ✅ Jika sudah lunas → buat akun
            if ($pendaftar->status_bayar === 'settlement') {
                $this->buatAkunUser($pendaftar);
            }

            return response()->json(['message' => 'Notifikasi berhasil diproses']);
        } catch (\Exception $e) {
            Log::error("❌ Error proses notifikasi: " . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    // 🔹 Membuat akun user otomatis
    private function buatAkunUser(Pendaftar $pendaftar)
    {
        if (User::where('email', $pendaftar->email)->exists()) {
            return;
        }

        $passwordPlain = Str::random(8);

        $user = User::create([
            'name' => $pendaftar->nama,
            'email' => $pendaftar->email,
            'phone' => $pendaftar->no_hp, // ✅ mapping no_hp → phone
            'password' => Hash::make($passwordPlain),
            'role' => 'user',
        ]);

        // Otomatis masukkan ke Santri & DataPendaftar
        \App\Models\Santri::firstOrCreate(
            ['nama_lengkap' => $pendaftar->nama],
            [
                'user_id' => $user->id,
                'pendaftar_id' => $pendaftar->id,
                'nisn' => $pendaftar->nisn,
                'jenis_kelamin' => $pendaftar->jenis_kelamin ?? 'Laki-laki',
                'no_hp' => $pendaftar->no_hp,
                'alamat' => $pendaftar->alamat,
                'status' => 'Aktif',
            ]
        );

        \App\Models\DataPendaftar::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap' => $pendaftar->nama,
                'nik' => $pendaftar->nik ?: ('NIK-' . time()),
                'tempat_lahir' => $pendaftar->tempat_lahir ?: 'Tangerang',
                'tanggal_lahir' => $pendaftar->tanggal_lahir ?: '2012-01-01',
                'jenis_kelamin' => $pendaftar->jenis_kelamin ?? 'Laki-laki',
                'alamat' => $pendaftar->alamat ?: '-',
                'nama_ayah' => $pendaftar->nama_ayah ?: '-',
                'nama_ibu' => $pendaftar->nama_ibu ?: '-',
                'kk' => $pendaftar->file_kk ?: '-',
                'akta' => $pendaftar->file_akta ?: '-',
                'ijazah' => $pendaftar->file_ijazah ?: '-',
                'status' => 'Terverifikasi',
            ]
        );

        Log::info("✅ User baru dibuat: {$pendaftar->email}");

        // 🔹 Kirim password via Email
        try {
            Mail::raw(
                "Akun berhasil dibuat.\n\nEmail: {$pendaftar->email}\nPassword: {$passwordPlain}",
                function ($message) use ($pendaftar) {
                    $message->to($pendaftar->email)
                        ->subject('Akun Baru - PSB Al-Fattah');
                }
            );
        } catch (\Exception $e) {
            Log::error("❌ Gagal kirim email: " . $e->getMessage());
        }

        // 🔹 Kirim password via WhatsApp (Fonnte)
        try {
            $pesan = "📢 *Pendaftaran Santri Baru Al-Fattah* 📢\n\n" .
                "Assalamu'alaikum Wr. Wb, {$pendaftar->nama} 👋\n\n" .
                "Alhamdulillah, pendaftaran Anda telah *BERHASIL* ✅\n\n" .
                "📌 Berikut adalah akun untuk login ke sistem:\n" .
                "• ✉️ Email : *{$pendaftar->email}*\n" .
                "• 🔑 Password : *{$passwordPlain}*\n\n" .
                "Silakan login ke sistem untuk melengkapi biodata Anda.\n\n" .
                "🔗 Link Login: " . url('/login') . "\n\n" .
                "_Pesan ini dikirim otomatis oleh sistem PSB Al-Fattah_\n\n" .
                "Wassalamu'alaikum Wr. Wb.";
            app(WhatsappService::class)->send($pendaftar->no_hp, $pesan);
            Log::info("✅ WA terkirim ke {$pendaftar->no_hp}");
        } catch (\Exception $e) {
            Log::error("❌ Gagal kirim WA: " . $e->getMessage());
        }
    }

    // 🔹 Normalisasi nomor telepon
    private function convertPhone($phone)
    {
        $phone = preg_replace('/[\s\-\+]/', '', $phone);

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }
}
