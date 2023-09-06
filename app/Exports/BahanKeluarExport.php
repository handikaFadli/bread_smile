<?php

namespace App\Exports;

use App\Models\BahanKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BahanKeluarExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BahanKeluar::join('databahan', 'bahankeluar.kd_bahan', '=', 'databahan.kd_bahan')
            ->select('bahankeluar.id_bahanKeluar', 'bahankeluar.kd_bahan', 'databahan.nm_bahan', 'bahankeluar.tgl_keluar', 'databahan.harga_beli', 'bahankeluar.jumlah', 'bahankeluar.total')->get();
    }

    public function headings(): array
    {
        return ['ID', 'KODE BAHAN', 'NAMA BAHAN', 'TANGGAL KELUAR', 'HARGA BELI', 'JUMLAH', 'TOTAL'];
    }
}
