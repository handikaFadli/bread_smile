<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanKeluar extends Model
{
    use HasFactory;

    protected $table = 'bahankeluar';

    protected $primaryKey = 'id_bahanKeluar';

    protected $fillable = [
        'kd_bahan',
        'nm_bahan',
        'tgl_keluar',
        'jumlah',
        'total',
        'ket',
    ];
}
