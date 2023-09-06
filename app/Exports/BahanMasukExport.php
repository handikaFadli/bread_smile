<?php

namespace App\Exports;

use App\Models\BahanMasuk;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BahanMasukExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BahanMasuk::join('databahan', 'bahanmasuk.kd_bahan', '=', 'databahan.kd_bahan')->select('bahanmasuk.id_bahanMasuk', 'bahanmasuk.kd_bahan', 'databahan.nm_bahan', 'bahanmasuk.tgl_masuk', 'databahan.harga_beli', 'bahanmasuk.jumlah', 'bahanmasuk.total')->get();
    }

    public function headings(): array
    {
        return ['ID', 'KODE BAHAN', 'NAMA BAHAN', 'TANGGAL MASUK', 'HARGA BELI', 'JUMLAH', 'TOTAL'];
    }
}
