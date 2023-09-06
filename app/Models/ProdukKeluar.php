<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKeluar extends Model
{
    use HasFactory;

    protected $table = 'produkkeluar';

    protected $primaryKey = 'id_produkKeluar';

    protected $fillable = [
        'kd_produk',
        'nip_karyawan',
        'jumlah',
        'tgl_keluar',
        'harga_jual',
        'total',
        'ket',
        'stts',
    ];
}
