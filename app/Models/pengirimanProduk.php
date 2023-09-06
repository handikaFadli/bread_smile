<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengirimanProduk extends Model
{
    use HasFactory;

    protected $table = 'pengirimanproduk';

    protected $primaryKey = 'id_pengirimanProduk';

    protected $fillable =
    [
        'id_pengirimanProduk',
        'kd_produk',
        'id_produkKeluar',
        'kd_sopir',
        'kd_mobil',
        'id_lokasi',
        'status',
        'bukti_foto',
        'nm_penerima',
    ];
}
