<?php

namespace App\Http\Controllers;

use App\Exports\ProdukKeluarExport;
use App\Models\PengirimanProduk;
use App\Models\ProdukJadi;
use App\Models\ProdukKeluar;
use App\Models\ProdukMasuk;
use App\Models\Resep;
use Illuminate\Http\Request;
use Mockery\Undefined;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ProdukKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', ProdukKeluar::class);

        $search = $request->search;

        // menyatukan search dengan join table
        $produkKeluar = ProdukKeluar::join('produkjadi', 'produkkeluar.kd_produk', '=', 'produkjadi.kd_produk')
            ->join('users', 'produkkeluar.nip_karyawan', '=', 'users.nip')
            ->select('produkkeluar.*', 'produkjadi.nm_produk', 'users.name')
            ->where('produkkeluar.kd_produk', 'LIKE', '%' . $search . '%')
            ->orWhere('produkjadi.nm_produk', 'LIKE', '%' . $search . '%')
            ->orWhere('produkkeluar.tgl_keluar', 'LIKE', '%' . $search . '%')
            ->orWhere('produkkeluar.jumlah', 'LIKE', '%' . $search . '%')
            ->orWhere('produkkeluar.ket', 'LIKE', '%' . $search . '%')
            ->oldest()->paginate(20)->withQueryString();

        // ambil nama karyawan dari session
        $nama = session('name');
        // mengirim tittle dan judul ke view
        return view(
            'pages.ProdukKeluar.index',
            [
                'produkKeluar' => $produkKeluar,
                'nama' => $nama,
                'tittle' => 'Data Penjualan Produk',
                'judul' => 'Data Penjualan Produk',
                'menu' => 'Produk',
                'submenu' => 'Penjualan Produk'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', ProdukKeluar::class);

        // join dengan tabel satuan
        $produkJadi = ProdukJadi::select('produkjadi.*')
            ->get();

        return view(
            'pages.ProdukKeluar.create',
            ['produkJadi' => $produkJadi],
            [
                'tittle' => 'Tambah Data',
                'judul' => 'Tambah Penjualan Produk',
                'menu' => 'Penjualan Produk',
                'submenu' => 'Tambah Data'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', ProdukKeluar::class);


        // mengubah nama validasi
        $messages = [
            'kd_produk.required' => 'Kode Produk Harus Diisi',
            'tgl_keluar.required' => 'Tanggal Keluar Harus Diisi',
            'jumlah.required' => 'Jumlah Harus Diisi',
            'jumlah.numeric' => 'Jumlah Harus Angka',
            'ket.required' => 'Keterangan Harus Diisi',
        ];

        $request->validate([
            'kd_produk' => 'required',
            'tgl_keluar' => 'required',
            'jumlah' => 'required|numeric',
            // 'ket' => 'required',
        ], $messages);

        $nip = auth()->user()->nip;

        // $resep = Resep::where('kd_produk', $request->kd_produk)->get();
        // if (empty($resep->first())) {
        //     Alert::warning('Resep untuk Produk ini belum tersedia', 'Silahkan tambahkan resep terlebih dahulu!');
        //     return redirect('resep');
        // } else {
        //     $resep = $resep->first()->kd_resep;
        // }

        // stok bahan bertambah
        $stok = ProdukJadi::where('kd_produk', $request->kd_produk)->first();
        $resep = Resep::where('kd_produk', $request->kd_produk)->get();
        if ($stok->stok < $request->jumlah) {
            Alert::warning('Stok tidak mencukupi', 'Silahkan tambahkan stok terlebih dahulu!');
            return redirect('produkKeluar');
        } else {
            if (empty($resep->first())) {
                Alert::warning('Resep untuk Produk ini belum tersedia', 'Silahkan tambahkan resep terlebih dahulu!');
                return redirect('resep');
            } else {
                $stok->stok = $stok->stok - $request->jumlah;
                $stok->save();
            }
        }

        // ubah format tgl_keluar dari varchar ke date
        $tgl_keluar = date('Y-m-d', strtotime($request->tgl_keluar)); // $tgl_keluar

        $harga_jual = ProdukJadi::where('kd_produk', $request->kd_produk)->first()->harga_jual;

        $total = $harga_jual * $request->jumlah;

        $stts = 0;

        ProdukKeluar::create([
            'kd_produk' => $request->kd_produk,
            'nip_karyawan' => $nip,
            'tgl_keluar' => $tgl_keluar,
            'harga_jual' => $harga_jual,
            'jumlah' => $request->jumlah,
            'total' => $total,
            'ket' => $request->ket,
            'stts' => $stts,
        ]);


        Alert::success('Data Penjualan Produk', 'Berhasil Ditambahkan!');
        return redirect('produkKeluar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(ProdukKeluar $produkKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdukKeluar $produkKeluar)
    {
        $this->authorize('update', $produkKeluar);

        // ambil status dari database berdasarkan id
        $status = ProdukKeluar::where('id_produkKeluar', $produkKeluar->id_produkKeluar)->first()->stts;

        if ($status == 0) {

            // join dengan tabel satuan
            $produkJadi = ProdukJadi::select('produkjadi.*')
                ->where('kd_produk', $produkKeluar->kd_produk)
                ->first();

            return view(
                'pages.ProdukKeluar.edit',
                ['produkKeluar' => $produkKeluar, 'produkJadi' => $produkJadi],
                [
                    'tittle' => 'Edit Data',
                    'judul' => 'Edit Penjualan Produk',
                    'menu' => 'Penjualan Produk',
                    'submenu' => 'Edit Data'
                ]
            );
        } else {
            Alert::error('Gagal!', 'Data penjualan sudah berada dipengiriman');
            return redirect('produkKeluar');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdukKeluar $produkKeluar)
    {

        $this->authorize('update', $produkKeluar);

        // ambil status dari database berdasarkan id
        $status = ProdukKeluar::where('id_produkKeluar', $produkKeluar->id_produkKeluar)->first()->stts;

        if ($status == 0) {
            // mengubah nama validasi
            $messages = [
                'kd_produk.required' => 'Kode Produk Harus Diisi',
                'tgl_keluar.required' => 'Tanggal Keluar Harus Diisi',
                'jumlah.required' => 'Jumlah Harus Diisi',
                'jumlah.numeric' => 'Jumlah Harus Angka',
                'ket.required' => 'Keterangan Harus Diisi',
            ];

            $request->validate([
                'kd_produk' => 'required',
                'tgl_keluar' => 'required',
                'jumlah' => 'required|numeric',
                // 'ket' => 'required',
            ], $messages);

            $nip = auth()->user()->nip;

            // mengembalikan stok produk
            $stok = ProdukJadi::where('kd_produk', $produkKeluar->kd_produk)->first();
            $stok->stok = $stok->stok + $produkKeluar->jumlah;
            $stok->save();

            // update stok produk
            if ($stok->stok < $request->jumlah) {
                Alert::warning('Stok tidak mencukupi', 'Silahkan tambahkan stok terlebih dahulu!');
                return redirect('produkKeluar');
            } else {
                $stok->stok = $stok->stok - $request->jumlah;
                $stok->save();
            }

            // ubah format tgl_keluar dari varchar ke date
            $tgl_keluar = date('Y-m-d', strtotime($request->tgl_keluar));

            $harga_jual = ProdukJadi::where('kd_produk', $request->kd_produk)->first()->harga_jual;

            $total = $harga_jual * $request->jumlah;

            $stts = 0;

            $produkKeluar->update([
                'kd_produk' => $request->kd_produk,
                'nip_karyawan' => $nip,
                'tgl_keluar' => $tgl_keluar,
                'harga_jual' => $harga_jual,
                'jumlah' => $request->jumlah,
                'total' => $total,
                'ket' => $request->ket,
                'stts' => $stts,
            ]);

            Alert::success('Data Penjualan Produk', 'Berhasil Diubah!');
            return redirect('produkKeluar');
        } else {
            Alert::error('Gagal!', 'Data penjualan sudah berada dipengiriman');
            return redirect('produkKeluar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukKeluar  $produkKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukKeluar $produkKeluar)
    {
        $this->authorize('delete', $produkKeluar);

        // ambil status dari database berdasarkan id
        $status = ProdukKeluar::where('id_produkKeluar', $produkKeluar->id_produkKeluar)->first()->stts;

        if ($status == 0) {
            // update stok produk
            $stok = ProdukJadi::where('kd_produk', $produkKeluar->kd_produk)->first();
            $stok->stok = $stok->stok + $produkKeluar->jumlah;
            $stok->save();

            $produkKeluar->delete();
            Alert::success('Data Penjualan Produk', 'Berhasil Dihapus!');
            return redirect('produkKeluar');
        } else {
            Alert::error('Gagal!', 'Data penjualan sudah berada di Pengiriman');
            return redirect('produkKeluar');
        }
    }

    public function print_pdf()
    {
        $data = ProdukKeluar::join('produkjadi', 'produkkeluar.kd_produk', '=', 'produkjadi.kd_produk')
            ->join('users', 'produkkeluar.nip_karyawan', '=', 'users.nip')
            ->select('produkkeluar.*', 'produkjadi.nm_produk', 'users.name')->get();
        // return view('pages.ProdukKeluar.laporan', ['data' => $data]);

        $pdf = Pdf::loadView('pages.ProdukKeluar.laporan', ['data' => $data]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('laporan-produkkeluar.pdf');
    }

    public function print_excel()
    {
        return Excel::download(new ProdukKeluarExport, 'produkkeluar.xlsx');
    }

    public function print()
    {
        $data = ProdukKeluar::join('produkjadi', 'produkkeluar.kd_produk', '=', 'produkjadi.kd_produk')
            ->join('users', 'produkkeluar.nip_karyawan', '=', 'users.nip')
            ->select('produkkeluar.*', 'produkjadi.nm_produk', 'users.name')->get();
        return view('pages.ProdukKeluar.laporan', ['data' => $data, 'print' => 'print']);
    }
}
