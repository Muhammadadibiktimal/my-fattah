<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Data dari Midtrans
        $data = $request->all();

        // Validasi signature key (penting untuk keamanan)
        $serverKey = config('midtrans.server_key');
        $expectedSignature = hash('sha512',
            $data['order_id'] .
            $data['status_code'] .
            $data['gross_amount'] .
            $serverKey
        );

        if ($data['signature_key'] !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Jika pembayaran sukses (settlement)
        if ($data['transaction_status'] === 'settlement') {
            // Ambil nomor HP dari metadata/custom field
            $phone = $data['customer_details']['phone'] ?? null;
            $email = $data['customer_details']['email'] ?? null;
            $name  = $data['customer_details']['first_name'] ?? 'Siswa Baru';

            if (!$phone || !$email) {
                return response()->json(['message' => 'No phone or email provided'], 400);
            }

            // Generate username & password random
            $username = strtolower(Str::slug($name)) . rand(100, 999);
            $passwordPlain = Str::random(8);

            // Buat akun user baru
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($passwordPlain),
                'phone' => $phone,
            ]);

            // Kirim via Fonnte
            $token = env('FONNTE_TOKEN'); // simpan token Fonnte di .env
            $message = "Halo $name,\n\nPendaftaran berhasil! 🎉\n\nUsername: $username\nPassword: $passwordPlain\n\nSilakan login ke sistem untuk melanjutkan.";

            Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message,
            ]);

            return response()->json(['message' => 'User created and WhatsApp sent'], 200);
        }

        return response()->json(['message' => 'No action taken'], 200);
    }
}
