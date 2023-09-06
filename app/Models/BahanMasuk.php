<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanMasuk extends Model
{
    use HasFactory;

    protected $table = 'bahanmasuk';

    protected $primaryKey = 'id_bahanMasuk';

    protected $fillable = [
        'kd_bahan',
        'nm_bahan',
        'tgl_masuk',
        'jumlah',
        'ket',
        'total',
    ];
}
