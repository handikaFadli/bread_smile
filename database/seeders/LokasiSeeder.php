<?php

namespace Database\Seeders;

use App\Models\lokasiPengiriman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class lokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        lokasiPengiriman::create(
            [
                'tempat' => 'CSB',
                'alamat' => 'jl. semangat menuju sukses'
            ]
        );

        lokasiPengiriman::create(
            [
                'tempat' => 'Surya Kuningan',
                'alamat' => 'jl. semangat menuju sukses'
            ]
        );

        lokasiPengiriman::create(
            [
                'tempat' => 'Surya Sumber',
                'alamat' => 'jl. semangat menuju sukses'
            ]
        );

        lokasiPengiriman::create(
            [
                'tempat' => 'Asia',
                'alamat' => 'jl. semangat menuju sukses'
            ]
        );

        lokasiPengiriman::create(
            [
                'tempat' => 'Grage Mall',
                'alamat' => 'jl. semangat menuju sukses'
            ]
        );

        lokasiPengiriman::create(
            [
                'tempat' => 'Garasi Cafe',
                'alamat' => 'jl. semangat menuju sukses'
            ]
        );
    }
}
