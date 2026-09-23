<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.fonnte.token'); // 🔑 Ambil dari config/services.php
        $this->baseUrl = 'https://api.fonnte.com/send';
    }

    /**
     * Kirim pesan WhatsApp via Fonnte
     */
    public function send(string $target, string $message)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey,
            ])->asForm()->post($this->baseUrl, [
                        'target' => $target,
                        'message' => $message,
                    ]);

            if ($response->successful()) {
                Log::info("✅ WA berhasil dikirim ke {$target}");
                return true;
            } else {
                Log::error("❌ Gagal kirim WA ke {$target}: " . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error("❌ Exception WA Service: " . $e->getMessage());
            return false;
        }
    }
}
