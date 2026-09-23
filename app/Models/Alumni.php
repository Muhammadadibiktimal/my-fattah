<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    // nama tabel
    protected $table = 'alumnis';

    // kolom yang bisa diisi
    protected $fillable = [
        'name',
        'angkatan',
        'pekerjaan',
        'kesan_pesan',
        'photo',
    ];
}
