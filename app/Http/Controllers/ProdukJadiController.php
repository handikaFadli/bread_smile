<?php

namespace App\Http\Controllers;

use App\Models\ProdukJadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class ProdukJadiController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', ProdukJadi::class);

        $search = $request->search;

        // menyatukan search dengan join tabel
        $produkJadi = ProdukJadi::select('produkjadi.*')
            ->where('produkjadi.kd_produk', 'LIKE', '%' . $search . '%')
            ->orWhere('produkjadi.harga_jual', 'LIKE', '%' . $search . '%')
            ->orWhere('produkjadi.nm_produk', 'LIKE', '%' . $search . '%')
            ->orWhere('produkjadi.stok', 'LIKE', '%' . $search . '%')
            ->oldest()->paginate(8)->withQueryString();

        // mengirim tittle dan judul ke view
        return view('pages.ProdukJadi.index', ['produkJadi' => $produkJadi], ['tittle' => 'Data Produk', 'judul' => 'Data Produk', 'menu' => 'Produk', 'submenu' => 'Data Produk']);
    }

    public function create()
    {
        $this->authorize('create', ProdukJadi::class);

        $kode = ProdukJadi::max('kd_produk');
        $kode = (int) substr($kode, 4, 4);
        $kode = $kode + 1;
        $kode_otomatis = "PRDK" . sprintf("%03s", $kode);

        return view(
            'pages.ProdukJadi.create',
            ['kode_otomatis' => $kode_otomatis, 'tittle' => 'Tambah Data', 'judul' => 'Tambah Data Produk', 'menu' => 'Data Produk', 'submenu' => 'Tambah Data']
        );
    }

    public function store(Request $request)
    {
        $this->authorize('create', ProdukJadi::class);

        // mengubah nama validasi
        $messages = [
            'kd_produk.required' => 'Kode Produk tidak boleh kosong',
            'nm_produk.required' => 'Nama Produk tidak boleh kosong',
            'stok.required' => 'Stok tidak boleh kosong',
            'stok.integer' => 'Stok harus berupa angka',
            'berat.required' => 'Berat Produk tidak boleh kosong',
            'berat.numeric' => 'Berat Produk harus berupa angka',
            'ket.required' => 'Keterangan tidak boleh kosong',
            'ket.min' => 'Keterangan minimal 3 karakter',
            'foto.required' => 'Foto tidak boleh kosong',
            'foto.image' => 'File yang anda pilih bukan foto atau gambar',
            'foto.mimes' => 'File atau Foto harus berupa jpeg,png,jpg,gif,webp',
            'foto.dimensions' => 'Foto harus memiliki ratio 1:1 atau berbentuk persegi'
        ];

        $request->validate([
            'kd_produk' => 'required',
            'nm_produk' => 'required',
            'stok' => 'required|integer',
            'berat' => 'required|numeric',
            // 'ket' => 'required|min:3',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|dimensions:ratio=1/1'
        ], $messages);

        $input = $request->all();

        $input['berat'] = $input['berat'] / 1000;

        // upload foto
        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }
            $profileImage = date('YmdHis') . "." . "webp";
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(150, 150);
            $image_resize->save(public_path($destinationPath . $profileImage));
            $foto = "$profileImage";
        }

        // masukkan berat ke dalam $input
        $input['berat'] = 0.05;

        ProdukJadi::create($input);

        Alert::success('Data Produk', 'Berhasil Ditambahkan!');
        return redirect('/produkJadi');
    }
    public function show(ProdukJadi $produkJadi)
    {
        //
    }


    public function edit(ProdukJadi $produkJadi)
    {
        $this->authorize('update', $produkJadi);

        $produkJadi = DB::table('produkjadi')->select('produkjadi.*')->where('kd_produk', $produkJadi->kd_produk)->first();

        $berat = $produkJadi->berat * 1000;

        return view(
            'pages.ProdukJadi.edit',
            compact('produkJadi'),
            ['tittle' => 'Edit Data', 'judul' => 'Edit Data Produk', 'menu' => 'Data Produk', 'submenu' => 'Edit Data', 'berat' => $berat]
        );
    }

    public function update(Request $request, ProdukJadi $produkJadi)
    {
        $this->authorize('update', $produkJadi);

        // cek apakah user mengganti foto atau tidak
        if ($request->has('foto')) {
            $produkJadi = ProdukJadi::find($produkJadi->kd_produk);
            File::delete('images/' . $produkJadi->foto);

            // mengubah nama validasi
            $messages = [
                'kd_produk.required' => 'Kode Produk tidak boleh kosong',
                'nm_produk.required' => 'Nama Produk tidak boleh kosong',
                'stok.required' => 'Stok tidak boleh kosong',
                'stok.integer' => 'Stok harus berupa angka',
                'berat.required' => 'Berat Produk tidak boleh kosong',
                'berat.numeric' => 'Berat harus berupa angka',
                'ket.required' => 'Keterangan tidak boleh kosong',
                'ket.min' => 'Keterangan minimal 3 karakter',
                'foto.required' => 'Foto tidak boleh kosong',
                'foto.image' => 'File yang anda pilih bukan foto atau gambar',
                'foto.mimes' => 'File atau Foto harus berupa jpeg,png,jpg,gif,webp',
                'foto.dimensions' => 'Foto harus memiliki ratio 1:1 atau berbentuk persegi'
            ];

            $rules = [
                'kd_produk' => 'required',
                'nm_produk' => 'required',
                'stok' => 'required|integer',
                'berat' => 'required|numeric',
                // 'ket' => 'required|min:3',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|dimensions:ratio=1/1'
            ];

            $input = $request->validate($rules, $messages);

            // if ($image = $request->file('foto')) {
            //     $destinationPath = 'images/';
            //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension() . ".webp";
            //     $image->move($destinationPath, $profileImage);
            //     $input['foto'] = "$profileImage";
            // }

            $input['berat'] = $input['berat'] / 1000;

            if ($image = $request->file('foto')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . "webp";
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(150, 150);
                $image_resize->save(public_path($destinationPath . $profileImage));
                $input['foto'] = "$profileImage";
            }


            $produkJadi->update($input);

            Alert::success('Data Produk', 'Berhasil Diubah!');
            return redirect('/produkJadi');
        } else {
            // mengubah nama validasi
            $messages = [
                'kd_produk.required' => 'Kode Produk tidak boleh kosong',
                'nm_produk.required' => 'Nama Produk tidak boleh kosong',
                'stok.required' => 'Stok tidak boleh kosong',
                'stok.integer' => 'Stok harus berupa angka',
                'berat.required' => 'Berat Produk tidak boleh kosong',
                'berat.numeric' => 'Berat harus berupa angka',
                'ket.required' => 'Keterangan tidak boleh kosong',
                'ket.min' => 'Keterangan minimal 3 karakter',
            ];

            $rules = [
                'kd_produk' => 'required',
                'nm_produk' => 'required',
                'stok' => 'required|integer',
                'berat' => 'required|numeric',
                // 'ket' => 'required|min:3',
            ];

            $input = $request->validate($rules, $messages);

            $input['berat'] = $input['berat'] / 1000;


            $produkJadi->update($input);
            Alert::success('Data Produk', 'Berhasil diubah!');
            return redirect('/produkJadi');
        }
    }

    public function destroy(ProdukJadi $produkJadi)
    {
        $this->authorize('delete', $produkJadi);

        File::delete('images/' . $produkJadi->foto);
        $produkJadi->delete();
        Alert::success('Data Produk', 'Berhasil dihapus!');
        return redirect('produkJadi');
    }

    public function home(Request $request)
    {
        // $this->authorize('viewAny', ProdukJadi::class);

        $search = $request->search;

        // menyatukan search dengan join tabel
        $produkJadi = ProdukJadi::select('produkjadi.*')
            ->where('produkjadi.harga_jual', '>', 0)
            ->oldest()->paginate(20);

        // // ambil id_produkKeluar dari pengirimanProduk
        // $produkJadi = ProdukJadi::select('harga_jual')->get();

        // // cek apakah id produkKeluar sudah ada di pengirimanProduk
        // foreach ($produkJadi as $key => $value) {
        //     if ($value->harga_jual < 0) {
        //         unset($produkJadi[$key]);
        //     }
        // }

        // $produkJadi = ProdukJadi::all();

        // mengirim tittle dan judul ke view
        return view('pages.home.index', ['produkJadi' => $produkJadi]);
    }
    public function about(Request $request)
    {
        // $this->authorize('viewAny', ProdukJadi::class);

        $search = $request->search;

        // menyatukan search dengan join tabel
        $produkJadi = ProdukJadi::select('produkjadi.*')
            ->where('produkJadi.harga_jual', '>', 0)
            ->oldest()->paginate(20);

        // // ambil id_produkKeluar dari pengirimanProduk
        // $produkJadi = ProdukJadi::select('harga_jual')->get();

        // // cek apakah id produkKeluar sudah ada di pengirimanProduk
        // foreach ($produkJadi as $key => $value) {
        //     if ($value->harga_jual < 0) {
        //         unset($produkJadi[$key]);
        //     }
        // }

        // $produkJadi = ProdukJadi::all();

        // mengirim tittle dan judul ke view
        return view('pages.home.about', ['produkJadi' => $produkJadi]);
    }
}
