<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class DataPendaftar extends Model
{
    use HasFactory;

    protected $table = 'data_pendaftar';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'kk',
        'akta',
        'ijazah',
        'status', // ✅ tambah ini
    ];

    public function status()
    {
        $dataPendaftar = DataPendaftar::where('user_id', Auth::id())->first();
        return view('user.status', compact('dataPendaftar'));
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
