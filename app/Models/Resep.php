<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';

    protected $primaryKey = 'kd_resep';

    protected $keyType = 'string';

    protected $fillable = [
        'kd_resep',
        'kd_produk',
        'tot_jumlahPakai',
        'tot_hargaPakai',
        'tot_cost',
        'roti_terbuat',
        'biaya_tenaga_kerja',
        'biaya_kemasan',
        'biaya_peralatan_operasional',
    ];
}
