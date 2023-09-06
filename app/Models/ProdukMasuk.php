<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukMasuk extends Model
{
    use HasFactory;

    protected $table = 'produkmasuk';

    protected $primaryKey = 'id_produkMasuk';

    protected $fillable = [
        'kd_produk',
        'nip_karyawan',
        'jumlah',
        'tgl_produksi',
        'tgl_expired',
        'total',
        'ket',
    ];
}
