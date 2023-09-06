<?php

namespace App\Http\Controllers;

use App\Models\DataBahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataBahanController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny', DataBahan::class);

        $search = $request->search;
        $paginate = $request->paginate;


        // menyatukan search dengan join tabel
        $dataBahan = DataBahan::select('databahan.*')
            ->where('databahan.kd_bahan', 'LIKE', '%' . $search . '%')
            ->orWhere('databahan.nm_bahan', 'LIKE', '%' . $search . '%')
            ->orWhere('databahan.harga_beli', 'LIKE', '%' . $search . '%')
            ->orWhere('databahan.stok', 'LIKE', '%' . $search . '%')
            ->oldest()->paginate($paginate)->withQueryString();

        // mengirim tittle dan judul ke view
        return view('pages.DataBahan.index', [
            'dataBahan' => $dataBahan,
            'tittle' => 'Data Bahan',
            'judul' => 'Data Bahan',
            'menu' => 'Bahan Baku',
            'submenu' => 'Data Bahan'
        ]);
    }


    public function create()
    {
        $this->authorize('create', DataBahan::class);

        $kode = DataBahan::max('kd_bahan');
        $kode = (int) substr($kode, 3, 3);
        $kode = $kode + 1;
        $kode_otomatis = "BHN" . sprintf("%03s", $kode);

        return view(
            'pages.DataBahan.create',
            [
                'kode_otomatis' => $kode_otomatis,
                'tittle' => 'Tambah Data',
                'judul' => 'Tambah Data Bahan',
                'menu' => 'Data Bahan',
                'submenu' => 'Tambah Data'
            ]
        );
    }


    public function store(Request $request)
    {
        $this->authorize('create', DataBahan::class);

        // mengubah nama validasi
        $messages = [
            'kd_bahan.required' => 'Kode Bahan tidak boleh kosong',
            'nm_bahan.required' => 'Nama Bahan tidak boleh kosong',
            'nm_bahan.min' => 'Nama Bahan minimal 3 karakter',
            'nm_bahan.max' => 'Nama Bahan maksimal 50 karakter',
            'harga_beli.required' => 'Harga Beli tidak boleh kosong',
            'harga_beli.numeric' => 'Harga Beli harus berupa angka',
            'stok.required' => 'Stok tidak boleh kosong',
            'stok.numeric' => 'Stok harus berupa angka',
            'ket.required' => 'Keterangan tidak boleh kosong',
            'ket.min' => 'Keterangan tidak boleh kosong',
            'ket.min' => 'Keterangan minimal 3 karakter',
        ];

        $request->validate([
            'kd_bahan' => 'required|min:3|max:10',
            'nm_bahan' => 'required|min:3|max:50',
            'harga_beli' => 'required|numeric',
            'stok' => 'required|numeric',
            // 'ket' => 'required|min:3',
        ], $messages);

        DataBahan::create($request->all());

        Alert::success('Data Bahan', 'Berhasil Ditambahkan');

        return redirect('/dataBahan');
    }

    public function show(DataBahan $dataBahan)
    {
        //
    }

    public function edit(DataBahan $dataBahan)
    {
        $this->authorize('update', $dataBahan);

        $dataBahan = DataBahan::select('databahan.*')
        ->where('kd_bahan', $dataBahan->kd_bahan)
        ->first();

        return view(
            'pages.DataBahan.edit',
            compact('dataBahan'),
            ['tittle' => 'Edit Data', 'judul' => 'Edit Data Bahan', 'menu' => 'Data Bahan', 'submenu' => 'Edit Data']
        );
    }

    public function update(Request $request, DataBahan $dataBahan)
    {
        $this->authorize('update', $dataBahan);

        // mengubah nama validasi
        $messages = [
            'kd_bahan.required' => 'Kode Bahan tidak boleh kosong',
            'nm_bahan.required' => 'Nama Bahan tidak boleh kosong',
            'nm_bahan.min' => 'Nama Bahan minimal 3 karakter',
            'nm_bahan.max' => 'Nama Bahan maksimal 50 karakter',
            'harga_beli.required' => 'Harga Beli tidak boleh kosong',
            'harga_beli.numeric' => 'Harga Beli harus berupa angka',
            'stok.required' => 'Stok tidak boleh kosong',
            'stok.numeric' => 'Stok harus berupa angka',
            'ket.required' => 'Keterangan tidak boleh kosong',
            'ket.min' => 'Keterangan tidak boleh kosong',
            'ket.min' => 'Keterangan minimal 3 karakter',
        ];

        $request->validate([
            'kd_bahan' => 'required|min:3|max:10',
            'nm_bahan' => 'required|min:3|max:50',
            'harga_beli' => 'required|numeric',
            'stok' => 'required|numeric',
            // 'ket' => 'required|min:3',
        ], $messages);


        $dataBahan->update($request->all());

        Alert::success('Data Bahan', 'Berhasil Diubah');


        return redirect('/dataBahan');
    }

    public function destroy(DataBahan $dataBahan, Request $request)
    {
        $this->authorize('delete', $dataBahan);

        $dataBahan->delete('kd_bahan', $request->kd_bahan);

        Alert::success('Data Bahan', 'Berhasil Dihapus');

        return redirect('/dataBahan');
    }
}
