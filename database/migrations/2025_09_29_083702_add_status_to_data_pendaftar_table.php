<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_pendaftar', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'Terverifikasi', 'Ditolak'])->default('Pending')->after('ijazah');
        });
    }

    public function down(): void
    {
        Schema::table('data_pendaftar', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
