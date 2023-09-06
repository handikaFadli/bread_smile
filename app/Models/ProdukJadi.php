<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukJadi extends Model
{
    use HasFactory;

    protected $table = 'produkjadi';

    protected $primaryKey = 'kd_produk';

    protected $keyType = 'string';

    protected $fillable = [
        'kd_produk',
        'nm_produk',
        'stok',
        'berat',
        'ket',
        'foto',
    ];
}
