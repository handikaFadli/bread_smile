<?php

namespace Database\Seeders;

use App\Models\DataBahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataBahan::create(
            [
                'kd_bahan' => 'BHN001',
                'nm_bahan' => 'Tepung Serbaguna',
                'harga_beli' => 12600,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN002',
                'nm_bahan' => 'Garam',
                'harga_beli' => 6000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN003',
                'nm_bahan' => 'Gula Pasir',
                'harga_beli' => 10000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN004',
                'nm_bahan' => 'Gula Bubuk',
                'harga_beli' => 10000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN005',
                'nm_bahan' => 'Brown Sugar',
                'harga_beli' => 30000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN006',
                'nm_bahan' => 'Baking Powder',
                'harga_beli' => 25000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN007',
                'nm_bahan' => 'Baking Soda',
                'harga_beli' => 30000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN008',
                'nm_bahan' => 'Ragi',
                'harga_beli' => 55000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN009',
                'nm_bahan' => 'Susu Bubuk',
                'harga_beli' => 34000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN010',
                'nm_bahan' => 'Maizena',
                'harga_beli' => 17000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN011',
                'nm_bahan' => 'Minyak Sayur',
                'harga_beli' => 20000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN012',
                'nm_bahan' => 'Lemak Nabati (Shortening)',
                'harga_beli' => 60000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN013',
                'nm_bahan' => 'Bubuk Cokelat',
                'harga_beli' => 40000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN014',
                'nm_bahan' => 'Rempah-Rempah',
                'harga_beli' => 50000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN015',
                'nm_bahan' => 'Daging Ayam',
                'harga_beli' => 29000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN016',
                'nm_bahan' => 'Keju',
                'harga_beli' => 76000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN017',
                'nm_bahan' => 'Abon Sapi',
                'harga_beli' => 40000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN018',
                'nm_bahan' => 'Pandan',
                'harga_beli' => 23000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN019',
                'nm_bahan' => 'Mayones',
                'harga_beli' => 30000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN020',
                'nm_bahan' => 'Bubuk Moca',
                'harga_beli' => 40000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN021',
                'nm_bahan' => 'Pisang',
                'harga_beli' => 15000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN022',
                'nm_bahan' => 'Sosis',
                'harga_beli' => 40000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN023',
                'nm_bahan' => 'Cokelat Batang',
                'harga_beli' => 50000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
        DataBahan::create(
            [
                'kd_bahan' => 'BHN024',
                'nm_bahan' => 'Telur',
                'harga_beli' => 32000,
                'stok' => 50,
                'ket' => 'Siap Pakai',
            ]
        );
    }
}
