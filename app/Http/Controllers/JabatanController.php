<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny', Jabatan::class);

        $search = $request->search;

        $jabatan = Jabatan::where('nm_jabatan', 'LIKE', '%' . $search . '%')
            ->oldest()->paginate(10)->withQueryString();

        // mengirim tittle dan judul ke view
        return view(
            'pages.Jabatan.index',
            [
                'jabatan' => $jabatan,
                'tittle' => 'Data Jabatan',
                'judul' => 'Data Jabatan',
                'menu' => 'Data Jabatan',
                'submenu' => 'Data Jabatan'
            ]
        );
    }


    public function store(Request $request)
    {
        $this->authorize('create', Jabatan::class);

        // mengubah error ke bahasa indonesia
        $messages = [
            'required' => 'Nama Jabatan tidak boleh kosong',
            'unique' => 'Nama Jabatan sudah ada',
        ];

        // validasi data
        $request->validate([
            'nm_jabatan' => 'required|unique:jabatan,nm_jabatan',
        ], $messages);


        Jabatan::create($request->all());

        Alert::success('Data Jabatan', 'Berhasil Ditambahkan!');
        return redirect('jabatan');
    }


    public function show($id)
    {
        //
    }


    public function edit(Jabatan $jabatan)
    {
    }


    public function update(Request $request, Jabatan $jabatan)
    {
        $this->authorize('update', $jabatan);


        // mengubah error ke bahasa indonesia
        $messages = [
            'required' => 'Nama Jabatan tidak boleh kosong',
            'unique' => 'Nama Jabatan sudah ada',
        ];

        $request->validate([
            'nm_jabatan' => 'required|unique:jabatan,nm_jabatan',
        ], $messages);

        $jabatan->update($request->all());
        Alert::success('Data Jabatan', 'Berhasil diubah!');
        return redirect('jabatan');
    }


    public function destroy(Jabatan $jabatan)
    {
        $this->authorize('delete', $jabatan);

        $jabatan->delete();
        Alert::success('Data Jabatan', 'Berhasil dihapus!');
        return redirect('jabatan');
    }
}
