<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// relasi dengan user
use App\Models\User;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nip',
        'nm_karyawan',
        'kd_jabatan',
        'jenis_kelamin',
        'ttl',
        'status',
        'no_telp',
        'alamat',
        'pendidikan',
        'tanggal_masuk',
        'role',
        'foto'
    ];

    // protected $guarded = [];
}
