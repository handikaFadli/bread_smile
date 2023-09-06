<?php

namespace App\Exports;

use App\Models\ProdukMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukMasukExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProdukMasuk::join('produkjadi', 'produkmasuk.kd_produk', '=', 'produkjadi.kd_produk')->select('produkjadi.nm_produk', 'produkmasuk.tgl_produksi', 'produkmasuk.tgl_expired', 'produkmasuk.jumlah', 'produkjadi.modal', 'produkmasuk.total')->get();
    }

    public function headings(): array
    {
        return ['NAMA PRODUK', 'TANGGAL PRODUKSI', 'TANGGAL KADALUWARSA', 'JUMLAH', 'MODAL', 'TOTAL'];
    }
}
