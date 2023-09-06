<?php

namespace App\Exports;

use App\Models\ProdukKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukKeluarExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProdukKeluar::join('produkjadi', 'produkkeluar.kd_produk', '=', 'produkjadi.kd_produk')
            ->select('produkjadi.nm_produk', 'produkkeluar.jumlah', 'produkkeluar.tgl_keluar', 'produkkeluar.harga_jual', 'produkkeluar.total')->get();
    }

    public function headings(): array
    {
        return ['NAMA PRODUK', 'JUMLAH', 'TANGGAL PENJUALAN', 'HARGA JUAL', 'TOTAL'];
    }
}
