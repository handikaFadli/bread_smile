<?php

namespace App\Http\Controllers;

use App\Exports\ProdukMasukExport;
use App\Models\BahanKeluar;
use App\Models\buatResep;
use App\Models\DataBahan;
use App\Models\ProdukJadi;
use App\Models\ProdukMasuk;
use App\Models\Resep;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ProdukMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->authorize('viewAny', ProdukMasuk::class);

        $search = $request->search;

        // menyatukan search dengan join table
        $produkMasuk = ProdukMasuk::join('produkjadi', 'produkmasuk.kd_produk', '=', 'produkjadi.kd_produk')->join('users', 'produkmasuk.nip_karyawan', '=', 'users.nip')->select('produkmasuk.*', 'produkjadi.nm_produk', 'produkjadi.modal', 'users.name')
            ->where('produkmasuk.kd_produk', 'LIKE', '%' . $search . '%')
            ->orWhere('produkjadi.nm_produk', 'LIKE', '%' . $search . '%')
            ->orWhere('produkmasuk.tgl_produksi', 'LIKE', '%' . $search . '%')
            ->orWhere('produkjadi.modal', 'LIKE', '%' . $search . '%')
            ->orWhere('produkmasuk.jumlah', 'LIKE', '%' . $search . '%')
            ->orWhere('produkmasuk.ket', 'LIKE', '%' . $search . '%')
            ->oldest()->paginate(10)->withQueryString();

        // ambil nama karyawan dari session
        $nama = session('name');
        // mengirim tittle dan judul ke view
        return view(
            'pages.ProdukMasuk.index',
            [
                'produkMasuk' => $produkMasuk,
                'nama' => $nama,
                'tittle' => 'Data Pembuatan Produk',
                'judul' => 'Data Pembuatan Produk',
                'menu' => 'Produk',
                'submenu' => 'Pembuatan Produk'
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
        $this->authorize('create', ProdukMasuk::class);

        // join dengan tabel satuan
        $produkJadi = ProdukJadi::select('produkjadi.*')
            ->join('resep', 'produkjadi.kd_produk', '=', 'resep.kd_produk')
            ->select('produkjadi.*', 'resep.roti_terbuat')
            ->get();

        return view(
            'pages.ProdukMasuk.create',
            ['produkJadi' => $produkJadi],
            [
                'tittle' => 'Tambah Data',
                'judul' => 'Tambah Pembuatan Produk',
                'menu' => 'Pembuatan Produk',
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
        $this->authorize('create', ProdukMasuk::class);


        // mengubah nama validasi
        $messages = [
            'kd_produk.required' => 'Pilih Produk terlebih dahulu',
            'tgl_produksi.required' => 'Tanggal Produksi Harus Diisi',
            'tgl_expired.required' => 'Tanggal Expired Harus Diisi',
            'stok.required' => 'Pilih Produk terlebih dahulu',
            'jumlah.required' => 'Jumlah Harus Diisi',
            'jumlah.numeric' => 'Jumlah Harus Angka',
            'ket.required' => 'Keterangan Harus Diisi',
        ];

        $request->validate([
            'kd_produk' => 'required',
            'tgl_produksi' => 'required',
            'tgl_expired' => 'required',
            'stok' => 'required',
            // 'jumlah' => 'required|numeric',
            // 'ket' => 'required',
        ], $messages);

        // dd($request->all());
        $resep = Resep::where('kd_produk', $request->kd_produk)->get();
        $jumlah = Resep::where('kd_produk', $request->kd_produk)->get();
        if (empty($resep->first())) {
            Alert::warning('Resep untuk Produk ini belum tersedia', 'Silahkan tambahkan resep terlebih dahulu!');
            return redirect('resep');
        } else {
            $resep = $resep->first()->kd_resep;
            $jumlah = $jumlah->first()->roti_terbuat;
        }
        $nip = auth()->user()->nip;

        // ubah format tgl_keluar dari varchar ke date
        $tgl_produksi = date('Y-m-d', strtotime($request->tgl_produksi));

        $tgl_expired = date('Y-m-d', strtotime($request->tgl_expired));

        // ambil semua kd_bahan di tabel buatresep berdasarkan request kd_produk lalu kurangi setiap stok bahan di tabel dataBahan berdasarkan jumlah pemakaian di tabel buatresep
        $bahan = buatResep::where('kd_resep', $resep)->get();
        $jumlah_bahan = buatResep::where('kd_resep', $resep)->get();
        // kurangi stok bahan berdasarkan jumlah tiap bahan yang ada di tabel buatresep dengan mneyamakan kd_resep ditabel resep dengan kd_resep di tabel buatresep
        foreach ($bahan as $key => $value) {
            $stok = DataBahan::where('kd_bahan', $value->kd_bahan)->first();
            $stok->stok = $stok->stok - ($jumlah_bahan[$key]->jumlah);
            $stok->save();

            // input juga ke bahanKeluar
            $bahanKeluar = new BahanKeluar;
            $bahanKeluar->kd_bahan = $value->kd_bahan;
            $bahanKeluar->nm_bahan = DataBahan::where('kd_bahan', $value->kd_bahan)->first()->nm_bahan;
            $bahanKeluar->tgl_keluar = $tgl_produksi;
            $bahanKeluar->jumlah = $jumlah_bahan[$key]->jumlah;
            $bahanKeluar->total = $jumlah_bahan[$key]->jumlah * DataBahan::where('kd_bahan', $value->kd_bahan)->first()->harga_beli;
            $bahanKeluar->ket = $request->ket;
            $bahanKeluar->save();
        }

        // stok bahan bertambah
        $stok = ProdukJadi::where('kd_produk', $request->kd_produk)->first();
        $stok->stok = $stok->stok + $jumlah;
        $stok->save();

        $modal = ProdukJadi::where('kd_produk', $request->kd_produk)->first()->modal;

        $total = $modal * $jumlah;



        ProdukMasuk::create([
            'kd_produk' => $request->kd_produk,
            'nip_karyawan' => $nip,
            'tgl_produksi' => $tgl_produksi,
            'tgl_expired' => $tgl_expired,
            'jumlah' => $jumlah,
            'total' => $total,
            'ket' => $request->ket,
        ]);


        Alert::success('Data Pembuatan Produk', 'Berhasil Ditambahkan!');
        return redirect('produkMasuk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukMasuk  $produkMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(ProdukMasuk $produkMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProdukMasuk  $produkMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdukMasuk $produkMasuk)
    {
        $this->authorize('update', $produkMasuk);

        // join dengan tabel satuan
        $produkJadi = ProdukJadi::select('produkjadi.*')
            ->where('kd_produk', $produkMasuk->kd_produk)
            ->first();

        return view(
            'pages.ProdukMasuk.edit',
            ['produkMasuk' => $produkMasuk, 'produkJadi' => $produkJadi],
            [
                'tittle' => 'Edit Data Pembuatan Produk',
                'judul' => 'Edit Pembuatan Produk',
                'menu' => 'Pembuatan Produk',
                'submenu' => 'Edit Data'
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdukMasuk  $produkMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdukMasuk $produkMasuk)
    {
        $this->authorize('update', $produkMasuk);

        // mengubah nama validasi
        $messages = [
            'kd_produk.required' => 'Kode Produk Harus Diisi',
            'tgl_produksi.required' => 'Tanggal Produksi Harus Diisi',
            'tgl_expired.required' => 'Tanggal Expired Harus Diisi',
            'jumlah.required' => 'Jumlah Harus Diisi',
            'jumlah.numeric' => 'Jumlah Harus Angka',
            'ket.required' => 'Keterangan Harus Diisi',
        ];

        $request->validate([
            'kd_produk' => 'required',
            'tgl_produksi' => 'required',
            'tgl_expired' => 'required',
            // 'jumlah' => 'required|numeric',
            // 'ket' => 'required',
        ], $messages);

        $nip = auth()->user()->nip;

        // mengembalikan stok produk
        $stok = ProdukJadi::where('kd_produk', $produkMasuk->kd_produk)->first();
        $stok->stok = $stok->stok - $produkMasuk->jumlah;
        $stok->save();

        // update stok produk jadi
        $stok = ProdukJadi::where('kd_produk', $request->kd_produk)->first();
        $stok->stok = $stok->stok + $request->jumlah;
        $stok->save();

        // ubah format tgl_produksi dari varchar ke date
        $tgl_produksi = date('Y-m-d', strtotime($request->tgl_produksi));

        $tgl_expired = date('Y-m-d', strtotime($request->tgl_expired));

        $modal = ProdukJadi::where('kd_produk', $request->kd_produk)->first()->modal;

        $total = $modal * $request->jumlah;

        $produkMasuk->update([
            'kd_produk' => $request->kd_produk,
            'nip_karyawan' => $nip,
            'tgl_produksi' => $tgl_produksi,
            'tgl_expired' => $tgl_expired,
            'jumlah' => $request->jumlah,
            'total' => $total,
            'ket' => $request->ket,
        ]);

        Alert::success('Data Pembuatan Produk', 'Berhasil Diubah!');
        return redirect('produkMasuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukMasuk  $produkMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukMasuk $produkMasuk)
    {
        $this->authorize('delete', $produkMasuk);

        // update stok produk jadi
        $stok = ProdukJadi::where('kd_produk', $produkMasuk->kd_produk)->first();
        $stok->stok = $stok->stok - $produkMasuk->jumlah;
        $stok->save();
        // ambil semua kd_bahan di tabel buatresep berdasarkan request kd_produk lalu tambahkan setiap stok bahan di tabel dataBahan berdasarkan jumlah pemakaian di tabel buatresep
        $resep = Resep::where('kd_produk', $produkMasuk->kd_produk)->get();
        $resep = $resep->first()->kd_resep;
        $bahan = buatResep::where('kd_resep', $resep)->get();
        $jumlah_bahan = buatResep::where('kd_resep', $resep)->get();
        // tambhkan stok bahan berdasarkan jumlah tiap bahan yang ada di tabel buatresep dengan mneyamakan kd_resep ditabel resep dengan kd_resep di tabel buatresep
        foreach ($bahan as $key => $value) {
            $stok = DataBahan::where('kd_bahan', $value->kd_bahan)->first();
            $stok->stok = $stok->stok + ($jumlah_bahan[$key]->jumlah);
            $stok->save();
        }

        // hapus yang di bahanKeluar juga dengan foreach
        foreach ($bahan as $key => $value) {
            $bahanKeluar = BahanKeluar::where('kd_bahan', $value->kd_bahan)->first();
            $bahanKeluar->delete();
        }



        $produkMasuk->delete();
        Alert::success('Data Pembuatan Produk', 'Berhasil Dihapus!');

        return redirect('/produkMasuk');
    }

    public function print_pdf()
    {
        $data = ProdukMasuk::join('produkjadi', 'produkmasuk.kd_produk', '=', 'produkjadi.kd_produk')->join('users', 'produkmasuk.nip_karyawan', '=', 'users.nip')->select('produkmasuk.*', 'produkjadi.nm_produk', 'produkjadi.modal', 'users.name')->get();
        // return view('pages.ProdukMasuk.laporan', ['data' => $data]);

        $pdf = Pdf::loadView('pages.ProdukMasuk.laporan', ['data' => $data]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('laporan-produkmasuk.pdf');
    }

    public function print_excel()
    {
        return Excel::download(new ProdukMasukExport, 'produkmasuk.xlsx');
    }

    public function print()
    {
        $data = ProdukMasuk::join('produkjadi', 'produkmasuk.kd_produk', '=', 'produkjadi.kd_produk')->join('users', 'produkmasuk.nip_karyawan', '=', 'users.nip')->select('produkmasuk.*', 'produkjadi.nm_produk', 'produkjadi.modal', 'users.name')->get();
        return view('pages.ProdukMasuk.laporan', ['data' => $data, 'print' => 'print']);
    }
}
