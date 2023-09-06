<?php

namespace App\Http\Controllers;

use App\Exports\BahanKeluarExport;
use App\Models\BahanKeluar;
use Barryvdh\DomPDF\Facade\Pdf as pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataBahan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BahanKeluarController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny', BahanKeluar::class);

        $search = $request->search;
        // menyatukan search dengan join tabel
        $bahanKeluar = BahanKeluar::join('databahan', 'bahankeluar.kd_bahan', '=', 'databahan.kd_bahan')
            ->select('bahankeluar.*', 'databahan.nm_bahan', 'databahan.harga_beli')
            ->where('bahankeluar.kd_bahan', 'LIKE', '%' . $search . '%')
            ->orWhere('bahankeluar.nm_bahan', 'LIKE', '%' . $search . '%')
            ->orWhere('bahankeluar.tgl_keluar', 'LIKE', '%' . $search . '%')
            ->orWhere('bahankeluar.jumlah', 'LIKE', '%' . $search . '%')
            ->orWhere('bahankeluar.ket', 'LIKE', '%' . $search . '%')
            ->oldest()->paginate(20)->withQueryString();

        // agar jumlah di convert dari kilogram ke gram
        if ($bahanKeluar != null) {
            foreach ($bahanKeluar as $b) {
                $b->jumlah = $b->jumlah * 1000;
            }
        }

        // mengirim tittle dan judul ke view
        return view(
            'pages.BahanKeluar.index',
            ['bahanKeluar' => $bahanKeluar],
            [
                'tittle' => 'Pemakaian Bahan',
                'judul' => 'Pemakaian Bahan',
                'menu' => 'Bahan Baku',
                'submenu' => 'Pemakaian Bahan'
            ]
        );
    }


    public function create()
    {
        $this->authorize('create', BahanKeluar::class);

        // join dengan tabel satuan
        $dataBahan = DataBahan::select('databahan.*')
            ->get();

        return view(
            'pages.BahanKeluar.create',
            ['dataBahan' => $dataBahan],
            [
                'tittle' => 'Pemakaian Bahan',
                'judul' => 'Pemakaian Bahan',
                'menu' => 'Bahan Baku',
                'submenu' => 'Pemakaian Bahan'
            ]
        );
    }


    public function store(Request $request)
    {
        $this->authorize('create', bahanKeluar::class);

        // mengubah nama validasi
        $messages = [
            'kd_bahan.required' => 'Kode Bahan tidak boleh kosong',
            'nm_bahan.required' => 'Nama Bahan tidak boleh kosong',
            'tgl_keluar.required' => 'Tanggal Keluar tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'ket.required' => 'Keterangan tidak boleh kosong',
        ];

        $request->validate([
            'kd_bahan' => 'required',
            'nm_bahan' => 'required',
            'tgl_keluar' => 'required',
            'jumlah' => 'required|numeric',
            // 'ket' => 'required',
        ], $messages);

        // stok bahan berkurang
        $stok = DataBahan::where('kd_bahan', $request->kd_bahan)->first();

        // ubah jumlah dari kilogram ke gram
        $jumlah = $request->jumlah / 1000;
        // update stok bahan
        if ($stok->stok < $jumlah) {
            Alert::warning('Stok tidak mencukupi', 'Silahkan tambahkan stok terlebih dahulu!');
            return redirect('bahanKeluar');
        } else {
            $stok->stok = $stok->stok - $jumlah;
            $stok->save();
        }
        // merubah harga_beli dan jumlah menjadi integer
        $harga_beli = (int) $request->harga_beli;
        // $jumlah = (int) $jumlah;

        $total = $harga_beli * $jumlah;
        // mengubah format tgl_masuk dari text ke date
        $tgl_keluar = date('Y-m-d', strtotime($request->tgl_keluar));


        // insert data ke table bahan keluar
        BahanKeluar::create([
            'kd_bahan' => $request->kd_bahan,
            'nm_bahan' => $request->nm_bahan,
            'tgl_keluar' => $tgl_keluar,
            'jumlah' => $jumlah,
            'total' => $total,
            'ket' => $request->ket,
        ]);

        // alihkan halaman ke halaman bahan keluar
        Alert::success('Data Pemakaian Bahan', 'Berhasil Ditambahkan!');
        return redirect('bahanKeluar');
    }


    public function show(BahanKeluar $bahanKeluar)
    {
        //
    }


    public function edit(BahanKeluar $bahanKeluar)
    {
        $this->authorize('update', $bahanKeluar);

        // join tabel satuan
        $dataBahan = DataBahan::select('databahan.*')
            ->where('kd_bahan', $bahanKeluar->kd_bahan)
            ->first();

        // mengubah jumlah dari kilogram ke gram
        $bahanKeluar->jumlah = $bahanKeluar->jumlah * 1000;

        return view(
            'pages.BahanKeluar.edit',
            compact('bahanKeluar', 'dataBahan'),
            [
                'tittle' => 'Edit Data Pemakaian Bahan',
                'judul' => 'Edit Data Pemakaian Bahan',
                'menu' => 'Bahan Baku',
                'submenu' => 'Edit Data'
            ]
        );
    }


    public function update(Request $request, BahanKeluar $bahanKeluar)
    {
        $this->authorize('update', $bahanKeluar);

        // cek apakah bahannya di ubah
        if ($request->has('kd_bahan')) {
            // mengubah nama validasi
            $messages = [
                'kd_bahan.required' => 'Pilih Kode Bahan terlebih dahulu',
                'tgl_keluar.required' => 'Tanggal Keluar tidak boleh kosong',
                'jumlah.required' => 'Jumlah tidak boleh kosong',
                'jumlah.numeric' => 'Jumlah harus berupa angka',
                'ket.required' => 'Keterangan tidak boleh kosong',
            ];

            $request->validate([
                'kd_bahan' => 'required',
                'tgl_keluar' => 'required',
                'jumlah' => 'required|numeric',
                // 'ket' => 'required',
            ], $messages);

            // ubah jumlah dari kilogram ke gram
            $jumlah = $bahanKeluar->jumlah / 1000;
            // mengembalikan stok bahan yg lama
            $stok = DataBahan::where('kd_bahan', $bahanKeluar->kd_bahan)->first();
            $stok->stok = $stok->stok + $jumlah;
            $stok->save();


            if ($stok->stok < $jumlah) {
                Alert::warning('Stok tidak mencukupi', 'Silahkan tambahkan stok terlebih dahulu!');
                return redirect('bahanKeluar');
            } else {
                $stok->stok = $stok->stok - $jumlah;
                $stok->save();
            }

            // merubah harga_beli dan jumlah menjadi integer
            $harga_beli = (int) $stok->harga_beli;
            // $jumlah = (int) $jumlah;


            $input = $request->all();

            // mengubah format tgl_masuk dari text ke date
            $tgl_keluar = date('Y-m-d', strtotime($request->tgl_keluar));

            // mencari total harga
            $total = $harga_beli * $jumlah;
            $input['jumlah'] = $jumlah;
            $input['total'] = $total;
            $input['tgl_keluar'] = $tgl_keluar;

            $bahanKeluar->update($input);

            Alert::success('Data Pemakaian Bahan', 'Berhasil diubah!');
            return redirect('bahanKeluar');
        } else {
            // mengubah nama validasi
            $messages = [
                'kd_bahan.required' => 'Pilih Kode Bahan terlebih dahulu',
                'tgl_keluar.required' => 'Tanggal Keluar tidak boleh kosong',
                'jumlah.required' => 'Jumlah tidak boleh kosong',
                'jumlah.numeric' => 'Jumlah harus berupa angka',
                'ket.required' => 'Keterangan tidak boleh kosong',
            ];

            $request->validate([
                'kd_bahan' => 'required',
                'tgl_keluar' => 'required',
                'jumlah' => 'required|numeric',
                // 'ket' => 'required',
            ], $messages);

            // cek apakah jumlah diubah
            if ($request->has('jumlah')) {

                $jumlah = $bahanKeluar->jumlah / 1000;
                // update stok bahan
                $stok = DataBahan::where('kd_bahan', $request->kd_bahan)->first();
                if ($stok->stok < $jumlah) {
                    Alert::warning('Stok tidak mencukupi', 'Silahkan tambahkan stok terlebih dahulu!');
                    return redirect('bahanKeluar');
                } else {
                    $stok->stok = $stok->stok - $jumlah;
                    $stok->save();
                }

                // merubah harga_beli dan jumlah menjadi integer
                $harga_beli = (int) $stok->harga_beli;
                // $jumlah = (int) $request->jumlah;

                $input = $request->all();

                // mengubah format tgl_masuk dari text ke date
                $tgl_keluar = date('Y-m-d', strtotime($request->tgl_keluar));

                // mencari total harga
                $total = $harga_beli * $jumlah;
                $input['jumlah'] = $jumlah;
                $input['total'] = $total;
                $input['tgl_keluar'] = $tgl_keluar;

                $bahanKeluar->update($input);

                Alert::success('Data Pemakaian Bahan', 'Berhasil diubah!');
                return redirect('bahanKeluar');
            } else {
                $input = $request->all();
                // mengubah format tgl_masuk dari text ke date
                $tgl_keluar = date('Y-m-d', strtotime($request->tgl_keluar));
                $input['tgl_keluar'] = $tgl_keluar;

                $bahanKeluar->update($input);

                Alert::success('Data Pemakaian Bahan', 'Berhasil diubah!');
                return redirect('bahanKeluar');
            }
        }
    }


    public function destroy(BahanKeluar $bahanKeluar)
    {
        $this->authorize('delete', $bahanKeluar);

        // update stok bahan
        $stok = DataBahan::where('kd_bahan', $bahanKeluar->kd_bahan)->first();
        $stok->stok = $stok->stok + $bahanKeluar->jumlah;
        $stok->save();

        $bahanKeluar->delete();
        Alert::success('Data Pemakaian Bahan', 'Berhasil dihapus!');
        return redirect('bahanKeluar');
    }

    public function print_pdf()
    {
        $data = BahanKeluar::join('databahan', 'bahankeluar.kd_bahan', '=', 'databahan.kd_bahan')
            ->select('bahankeluar.*', 'databahan.nm_bahan', 'databahan.harga_beli')->get();
        // return view('pages.BahanKeluar.laporan', ['data' => $data]);

        $pdf = Pdf::loadView('pages.BahanKeluar.laporan', ['data' => $data]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('laporan-bahankeluar.pdf');
    }

    public function print_excel()
    {
        return Excel::download(new BahanKeluarExport, 'bahankeluar.xlsx');
    }

    public function print()
    {
        $data = BahanKeluar::join('databahan', 'bahankeluar.kd_bahan', '=', 'databahan.kd_bahan')
            ->select('bahankeluar.*', 'databahan.nm_bahan', 'databahan.harga_beli')->get();

        return view('pages.BahanKeluar.laporan', ['data' => $data, 'print' => 'print']);
    }
}
