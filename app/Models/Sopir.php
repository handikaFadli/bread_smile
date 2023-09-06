<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    use HasFactory;

    protected $table = 'sopir';

    protected $primaryKey = 'kd_sopir';

    protected $keyType = 'string';

    protected $fillable = [
        'kd_sopir',
        'nm_sopir',
        'no_ktp',
        'jenis_kelamin',
        'alamat',
        'foto',
    ];
}
