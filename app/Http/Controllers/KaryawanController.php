<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class KaryawanController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny', Karyawan::class);

        $search = $request->search;

        // menyatukan search dengan join tabel
        $karyawan = Karyawan::join('jabatan', 'karyawan.kd_jabatan', '=', 'jabatan.id_jabatan')
            ->select('karyawan.*', 'jabatan.nm_jabatan')
            ->where('jabatan.nm_jabatan', 'LIKE', '%' . $search . '%')
            ->orWhere('karyawan.nm_karyawan', 'LIKE', '%' . $search . '%')
            ->orWhere('karyawan.nm_karyawan', 'LIKE', '%' . $search . '%')
            ->orWhere('karyawan.nip', 'LIKE', '%' . $search . '%')
            ->orWhere('karyawan.ttl', 'LIKE', '%' . $search . '%')
            ->orWhere('karyawan.no_telp', 'LIKE', '%' . $search . '%')
            ->orWhere('karyawan.jenis_kelamin', 'LIKE', '%' . $search . '%')
            ->oldest()->paginate(5)->withQueryString();

        $bulanIndo = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // memecah format ttl menjadi tempat dan tanggal lahir
        foreach ($karyawan as $k) {
            $ttl = explode(',', $k->ttl);
            $k->tempat_lahir = $ttl[0];
            $k->tgl_lahir = $ttl[1];
            // mengubah format tanggal lahir menjadi dd-mm-yyyy
            $tanggal = date('j', strtotime($k->tgl_lahir));
            $bulan = $bulanIndo[date('n', strtotime($k->tgl_lahir)) - 1];
            $tahun = date('Y', strtotime($k->tgl_lahir));
            $tgl_lahir = "{$tanggal} {$bulan} {$tahun}";
            $k->tgl_lahir = $tgl_lahir;
            // menggambar format tempat dan tanggal lahir menjadi ttl
            $k->ttl = $k->tempat_lahir . ', ' . $k->tgl_lahir;
        }

        // mengirim tittle dan judul ke view
        return view(
            'pages.Karyawan.index',
            [
                'karyawan' => $karyawan,
                'tittle' => 'Data Karyawan',
                'judul' => 'Data Karyawan',
                'menu' => 'Data Karyawan',
                'submenu' => 'Data Karyawan'
            ]
        );
    }

    public function create()
    {
        $this->authorize('create', Karyawan::class);

        // mengirim tittle dan judul ke view
        return view(
            'pages.Karyawan.create',
            [
                'jabatan' => Jabatan::all(),
                'tittle' => 'Tambah Data Karyawan',
                'menu' => 'Data Karyawan',
                'judul' => 'Tambah Data Karyawan',
                'submenu' => 'Tambah Data'
            ]
        );
    }


    public function store(Request $request)
    {
        $this->authorize('create', Karyawan::class);

        // mengubah nama validasi
        $messages = [
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.min' => 'NIP minimal 11 karakter',
            'nip.max' => 'NIP maksimal 11 karakter',
            'nip.unique' => 'NIP sudah terdaftar',
            'namaDepan.required' => 'Nama Depan tidak boleh kosong',
            'kd_jabatan.required' => 'Kode jabatan tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'no_telp.required' => 'Nomor Telepon tidak boleh kosong',
            'no_telp.min' => 'Nomor Telepon minimal 11 karakter',
            'no_telp.max' => 'Nomor Telepon maksimal 12 karakter',
            'no_telp.numeric' => 'Nomor Telepon harus berupa angka',
            'provinsi.required' => 'Provinsi tidak boleh kosong',
            'select_kota.required' => 'Kota / Kabupaten',
            'kota.required' => 'Kota tidak boleh kosong',
            'kecamatan.required' => 'Kecamatan tidak boleh kosong',
            'kodepos.required' => 'Kode Pos tidak boleh kosong',
            'alamat_lengkap.required' => 'Alamat tidak boleh kosong',
            'pendidikan.required' => 'Pendidikan Terakhir tidak boleh kosong',
            'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
            'role.required' => 'Harap tentukan dia login sebagai apa!',
            'foto.required' => 'Foto tidak boleh kosong',
            'foto.images' => 'File yang anda pilih bukan foto atau gambar',
            'foto.mimes' => 'File atau Foto harus berupa jpeg,png,jpg,gif,webp',
            'foto.dimensions' => 'Foto harus memiliki ratio 1:1 atau berbentuk persegi'
        ];

        $this->validate($request, [
            'nip' => 'required|min:11|max:11|unique:karyawan,nip',
            'namaDepan' => 'required',
            'kd_jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'status' => 'required',
            'no_telp' => 'required|min:11|min:12|numeric',
            'provinsi' => 'required',
            'select_kota' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kodepos' => 'required',
            'alamat_lengkap' => 'required',
            'pendidikan' => 'required',
            'tanggal_masuk' => 'required',
            'role' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|dimensions:ratio=1/1'
        ], $messages);

        // cek apakah nama belakang diisi
        if ($request->namaBelakang) {
            $nm_karyawan = [
                $request->namaDepan,
                $request->namaBelakang
            ];
            $nm_karyawan = implode(' ', $nm_karyawan);
        } else {
            $nm_karyawan = $request->namaDepan;
        }

        $tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));

        // menggabungkan tempat dan tanggal lahir
        $ttl = [
            $request->tempat_lahir,
            $tgl_lahir
            // date('d F Y', strtotime($request->tgl_lahir))
        ];
        $ttl = implode(', ', $ttl);

        // menggabungkan kecamatan, kota, provinsi, dan nama jalan menjadi alamat lengkap
        $alamat = [
            $request->alamat_lengkap,
            'Kec. ' . $request->kecamatan,
            $request->kodepos,
            $request->select_kota . ' ' . $request->kota,
            'Prov. ' . $request->provinsi
        ];
        $alamat = strtoupper(implode(', ', $alamat)); // mengubah string menjadi huruf besar semua

        $no_telp = '+62' . $request->no_telp;

        $tgl_masuk = date('Y-m-d', strtotime($request->tgl_masuk));

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


        Karyawan::create([
            'nip' => $request->nip,
            'nm_karyawan' => $nm_karyawan,
            'kd_jabatan' => $request->kd_jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'ttl' => $ttl,
            'status' => $request->status,
            'no_telp' => $no_telp,
            'alamat' => $alamat,
            'pendidikan' => $request->pendidikan,
            'tanggal_masuk' => $tgl_masuk,
            'role' => $request->role,
            'foto' => $foto
        ]);

        Alert::success('Data Karyawan', 'Berhasil Ditambahkan!');
        return redirect('karyawan');
    }


    public function show(Karyawan $karyawan)
    {
        $this->authorize('view', $karyawan);

        $karyawan = DB::table('karyawan')
            ->join('jabatan', 'karyawan.kd_jabatan', '=', 'jabatan.id_jabatan')
            ->select('karyawan.*', 'jabatan.nm_jabatan')
            ->where('id_karyawan', $karyawan->id_karyawan)->first();

        return view('pages.Karyawan.detail', compact('karyawan'));
    }


    public function edit(Karyawan $karyawan)
    {
        $this->authorize('update', $karyawan);

        // memisahkan nama depan dan nama belakang
        $dataNama = explode(' ', $karyawan->nm_karyawan);
        $namaDepan = $dataNama[0];
        // $namaBelakang = $dataNama[1];
        if (!isset($dataNama[1])) {
            $namaBelakang = " ";
        } else {
            $namaBelakang = $dataNama[1];
        }

        // memisahkan tempat dan tanggal lahir
        $dataTtl = explode(', ', $karyawan->ttl);
        $tempatLahir = $dataTtl[0];
        $tanggalLahir = $dataTtl[1];

        // mwngubah huruf kecil semua
        $karyawan->alamat = strtolower($karyawan->alamat);

        // mwngubah awal setiap kalimat jadi huruf kapital
        $karyawan->alamat = ucwords($karyawan->alamat);

        // memisahkan bagian bagian dari alamat
        $dataAlamat = explode(', ', $karyawan->alamat);
        $namaJalan = $dataAlamat[0];

        // memisahkan kecamatan
        $dataKecamatan = explode('. ', $dataAlamat[1]);
        $kecamatan = $dataKecamatan[1];

        // memisahkan kode pos
        $kodePos = $dataAlamat[2];

        // memisahkan kota
        $dataKota = explode(' ', $dataAlamat[3]);
        $selectKota = $dataKota[0];
        $kota = $dataKota[1];

        // memisahkan provinsi
        $dataProvinsi = explode('. ', $dataAlamat[4]);
        $provinsi = $dataProvinsi[1];

        // memisahkan nomor telepon
        $dataNoTelp = explode('+62', $karyawan->no_telp);
        $noTelp = $dataNoTelp[1];

        // dd($namaDepan, $namaBelakang, $tempatLahir, $tanggalLahir, $namaJalan, $kecamatan, $selectKabupaten, $kabupaten, $provinsi);

        // mengirim tittle dan judul ke view
        return view(
            'pages.Karyawan.edit',
            [
                'dataKaryawan' => [
                    'namaDepan' => $namaDepan,
                    'namaBelakang' => $namaBelakang,
                    'tempat_lahir' => $tempatLahir,
                    'tgl_lahir' => $tanggalLahir,
                    'no_telp' => $noTelp,
                    'alamat_lengkap' => $namaJalan,
                    'kecamatan' => $kecamatan,
                    'kodepos' => $kodePos,
                    'select_kota' => $selectKota,
                    'kota' => $kota,
                    'provinsi' => $provinsi
                ],
                'karyawan' => $karyawan,
                'jabatan' => Jabatan::all(),
                'tittle' => 'Edit Data',
                'judul' => 'Edit Data Karyawan',
                'menu' => 'Data Karyawan',
                'submenu' => 'Edit Data'
            ]
        );
    }


    public function update(Request $request, Karyawan $karyawan)
    {
        $this->authorize('view', $karyawan);

        // cek apakah user mengganti foto atau tidak
        if ($request->has('foto')) {

            // hapus foto lama
            $karyawan = Karyawan::find($karyawan->id_karyawan);
            File::delete('images/' . $karyawan->foto);

            // mengubah nama validasi
            $messages = [
                'namaDepan.required' => 'Nama Depan tidak boleh kosong',
                'kd_jabatan.required' => 'Kode jabatan tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
                'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
                'tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
                'status.required' => 'Status tidak boleh kosong',
                'no_telp.required' => 'Nomor Telepon tidak boleh kosong',
                'no_telp.min' => 'Nomor Telepon minimal 11 karakter',
                'no_telp.max' => 'Nomor Telepon maksimal 12 karakter',
                'no_telp.numeric' => 'Nomor Telepon harus berupa angka',
                'provinsi.required' => 'Provinsi tidak boleh kosong',
                'select_kota.required' => 'Kota / Kabupaten',
                'kota.required' => 'Kota tidak boleh kosong',
                'kecamatan.required' => 'Kecamatan tidak boleh kosong',
                'kodepos.required' => 'Kode Pos tidak boleh kosong',
                'alamat_lengkap.required' => 'Alamat tidak boleh kosong',
                'pendidikan.required' => 'Pendidikan Terakhir tidak boleh kosong',
                'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                'role.required' => 'Harap tentukan dia login sebagai apa!',
                'foto.required' => 'Foto tidak boleh kosong',
                'foto.images' => 'File yang anda pilih bukan foto atau gambar',
                'foto.mimes' => 'File atau Foto harus berupa jpeg,png,jpg,gif,webp',
                'nip.required' => 'NIP tidak boleh kosong',
                'nip.min' => 'NIP minimal 11 karakter',
                'nip.max' => 'NIP maksimal 11 karakter',
                'nip.unique' => 'NIP sudah terdaftar',
                'foto.dimensions' => 'Foto harus memiliki ratio 1:1 atau berbentuk persegi'
            ];

            $rules = [
                'namaDepan' => 'required',
                'kd_jabatan' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'status' => 'required',
                'no_telp' => 'required|min:11|min:12|numeric',
                'provinsi' => 'required',
                'select_kota' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kodepos' => 'required',
                'alamat_lengkap' => 'required',
                'pendidikan' => 'required',
                'tanggal_masuk' => 'required',
                'role' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|dimensions:ratio=1/1'
            ];

            if ($request->nip != $karyawan->nip) {
                $rules['nip'] = 'required|min:11|max:11|unique:karyawan,nip';
            };

            $input = $request->validate($rules, $messages);

            // cek apakah nama belakang diisi
            if (isset($request->namaBelakang)) {
                $nama = [
                    $input['namaDepan'],
                    $request->namaBelakang
                ];
                $input['nm_karyawan'] = implode(' ', $nama);
            } else {
                $input['nm_karyawan'] = $input['namaDepan'];
            }

            $tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));

            // menggabungkan tempat dan tanggal lahir
            $ttl = [
                $input['tempat_lahir'],
                $input['tgl_lahir'] = $tgl_lahir,
                // date('d F Y', strtotime($input['tgl_lahir))
            ];
            $input['ttl'] = implode(', ', $ttl);

            // menggabungkan kecamatan, kota, provinsi, dan nama jalan menjadi alamat lengkap
            $alamat = [
                $input['alamat_lengkap'],
                'Kec. ' . $input['kecamatan'],
                $input['kodepos'],
                $input['select_kota'] . ' ' . $input['kota'],
                'Prov. ' . $input['provinsi']
            ];
            $input['alamat'] = strtoupper(implode(', ', $alamat)); // mengubah string menjadi huruf besar semua

            $input['no_telp'] = '+62' . $input['no_telp'];

            $input['tanggal_masuk'] = date('Y-m-d', strtotime($request->tanggal_masuk));


            if ($image = $request->file('foto')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . "webp";
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(150, 150);
                $image_resize->save(public_path($destinationPath . $profileImage));
                $input['foto'] = "$profileImage";
            }

            $karyawan->update($input);

            Alert::success('Data Karyawan', 'Berhasil diubah!');
            return redirect()->route('karyawan.index');
        } else {
            // mengubah nama validasi
            $messages = [
                'namaDepan.required' => 'Nama Depan tidak boleh kosong',
                'kd_jabatan.required' => 'Kode jabatan tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
                'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
                'tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
                'status.required' => 'Status tidak boleh kosong',
                'no_telp.required' => 'Nomor Telepon tidak boleh kosong',
                'no_telp.min' => 'Nomor Telepon minimal 11 karakter',
                'no_telp.max' => 'Nomor Telepon maksimal 12 karakter',
                'no_telp.numeric' => 'Nomor Telepon harus berupa angka',
                'provinsi.required' => 'Provinsi tidak boleh kosong',
                'select_kota.required' => 'Kota / Kabupaten',
                'kota.required' => 'Kota tidak boleh kosong',
                'kecamatan.required' => 'Kecamatan tidak boleh kosong',
                'kodepos.required' => 'Kode Pos tidak boleh kosong',
                'alamat_lengkap.required' => 'Alamat tidak boleh kosong',
                'pendidikan.required' => 'Pendidikan Terakhir tidak boleh kosong',
                'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                'role.required' => 'Harap tentukan dia login sebagai apa!',
            ];

            $rules = [
                'namaDepan' => 'required',
                'kd_jabatan' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'status' => 'required',
                'no_telp' => 'required|min:11|min:12|numeric',
                'provinsi' => 'required',
                'select_kota' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kodepos' => 'required',
                'alamat_lengkap' => 'required',
                'pendidikan' => 'required',
                'tanggal_masuk' => 'required',
                'role' => 'required',
            ];

            $karyawan = Karyawan::find($karyawan->id_karyawan);

            if ($request->nip != $karyawan->nip) {
                $rules['nip'] = 'required|min:11|max:11|unique:karyawan,nip';
            };

            $input = $request->validate($rules, $messages);

            // cek apakah nama belakang diisi
            if (isset($request->namaBelakang)) {
                $nama = [
                    $input['namaDepan'],
                    $request->namaBelakang
                ];
                $input['nm_karyawan'] = implode(' ', $nama);
            } else {
                $input['nm_karyawan'] = $input['namaDepan'];
            }

            $tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));

            // menggabungkan tempat dan tanggal lahir
            $ttl = [
                $input['tempat_lahir'],
                $input['tgl_lahir'] = $tgl_lahir,
                // date('d F Y', strtotime($input['tgl_lahir))
            ];
            $input['ttl'] = implode(', ', $ttl);

            // menggabungkan kecamatan, kota, provinsi, dan nama jalan menjadi alamat lengkap
            $alamat = [
                $input['alamat_lengkap'],
                'Kec. ' . $input['kecamatan'],
                $input['kodepos'],
                $input['select_kota'] . ' ' . $input['kota'],
                'Prov. ' . $input['provinsi']
            ];
            $input['alamat'] = strtoupper(implode(', ', $alamat)); // mengubah string menjadi huruf besar semua

            $input['no_telp'] = '+62' . $input['no_telp'];

            $input['tanggal_masuk'] = date('Y-m-d', strtotime($request->tanggal_masuk));

            // dd($input['tanggal_masuk']);

            $karyawan->update($input);
            Alert::success('Data Karyawan', 'Berhasil diubah!');
            return redirect()->route('karyawan.index');
        }
    }

    public function destroy(Karyawan $karyawan)
    {
        $this->authorize('delete', $karyawan);

        if (Auth::user()->id_karyawan == $karyawan->id_karyawan) {
            Alert::error('Gagal menghapus', 'Tidak dapat menghapus data diri sendiri!');
            return redirect()->route('karyawan.index');
        } else {
            File::delete('images/' . $karyawan->foto);
            $karyawan->delete();
            // delete juga data user yang bersangkutan
            $user = User::where('id_karyawan', $karyawan->id_karyawan)->first();
            $user->delete();
            Alert::success('Data Karyawan', 'Berhasil dihapus!');
            return redirect()->route('karyawan.index');
        }
    }
}
