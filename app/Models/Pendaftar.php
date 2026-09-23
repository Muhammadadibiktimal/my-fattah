<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $table = 'pendaftar';
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'order_id',
        'snap_token',
        'status_bayar',
        'nik',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'jenjang',
        'jurusan',
        'asal_sekolah',
        'alamat_sekolah',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'no_hp_ortu',
        'alamat',
        'file_kk',
        'file_akta',
        'file_ijazah',
        'file_foto',
        'status',
    ];
}
