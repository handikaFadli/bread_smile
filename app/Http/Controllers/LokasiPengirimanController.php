<?php

namespace App\Http\Controllers;

use App\Models\lokasiPengiriman;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LokasiPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', lokasiPengiriman::class);

        $search = $request->search;

        $lokasiPengiriman = lokasiPengiriman::where('tempat', 'LIKE', '%' . $search . '%')
            ->oldest()->paginate(10)->withQueryString();

        // mengirim tittle dan judul ke view
        return view(
            'pages.LokasiPengiriman.index',
            [
                'lokasiPengiriman' => $lokasiPengiriman,
                'tittle' => 'Data lokasi Pengiriman',
                'judul' => 'Data lokasi Pengiriman',
                'menu' => 'Pengiriman',
                'submenu' => 'Lokasi Pengiriman'
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
        $this->authorize('create', lokasiPengiriman::class);

        // mengubah error ke bahasa indonesia
        $messages = [
            'tempat.required' => 'Nama Tempat tidak boleh kosong',
            'tempat.unique' => 'Nama Tempat sudah ada',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.min:3' => 'Isi Minimal 3 karakter',

        ];

        // validasi data
        $request->validate([
            'tempat' => 'required|unique:lokasipengiriman,tempat',
            'alamat' => 'required|min:3'
        ], $messages);


        lokasiPengiriman::create($request->all());

        Alert::success('Data Lokasi', 'Berhasil Ditambahkan!');
        return redirect('lokasiPengiriman');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lokasiPengiriman  $lokasiPengiriman
     * @return \Illuminate\Http\Response
     */
    public function show(lokasiPengiriman $lokasiPengiriman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lokasiPengiriman  $lokasiPengiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(lokasiPengiriman $lokasiPengiriman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lokasiPengiriman  $lokasiPengiriman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lokasiPengiriman $lokasiPengiriman)
    {
        $this->authorize('update', $lokasiPengiriman);


        // mengubah error ke bahasa indonesia
        $messages = [
            'tempat.required' => 'Nama Tempat tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'alamat.min:3' => 'Isi Minimal 3 karakter',

        ];

        // validasi data
        $request->validate([
            'tempat' => 'required',
            'alamat' => 'required|min:3'
        ], $messages);

        $lokasiPengiriman->update($request->all());
        Alert::success('Data Lokasi', 'Berhasil Diubah!');
        return redirect('lokasiPengiriman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lokasiPengiriman  $lokasiPengiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(lokasiPengiriman $lokasiPengiriman)
    {
        $this->authorize('delete', $lokasiPengiriman);

        $lokasiPengiriman->delete();
        Alert::success('Data Lokasi', 'Berhasil dihapus!');
        return redirect('lokasiPengiriman');
    }
}
