<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Notification;
use Midtrans\Config;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function callback(Request $request)
    {
        // 🔹 log semua request dari Midtrans
        Log::info('Midtrans Callback:', $request->all());

        $notification = new Notification();

        $status = $notification->transaction_status;
        $orderId = $notification->order_id;

        $pendaftar = Pendaftar::where('order_id', $orderId)->first();

        if (!$pendaftar) {
            Log::error("Order ID $orderId tidak ditemukan");
            return response()->json(['message' => 'Order ID tidak ditemukan'], 404);
        }

        // 🔹 Update status pembayaran
        if (in_array($status, ['capture', 'settlement'])) {
            $pendaftar->status_bayar = 'settlement';
        } elseif ($status == 'pending') {
            $pendaftar->status_bayar = 'pending';
        } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
            $pendaftar->status_bayar = 'failed';
        }

        $pendaftar->save();

        Log::info("Pembayaran untuk {$pendaftar->email} diupdate ke {$pendaftar->status_bayar}");

        return response()->json(['message' => 'Callback processed']);
    }
}
