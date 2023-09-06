<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBahan extends Model
{
    use HasFactory;

    protected $table = 'databahan';

    protected $primaryKey = 'kd_bahan';

    protected $keyType = 'string';

    protected $fillable = [
        'kd_bahan',
        'nm_bahan',
        'harga_beli',
        'stok',
        'ket',
    ];
}
