<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Sopir;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $sopir = Sopir::where('no_ktp', auth()->user()->nip)->first();

        $karyawan = Karyawan::where('nip', auth()->user()->nip)
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'karyawan.kd_jabatan')
            ->select('karyawan.*', 'jabatan.nm_jabatan')
            ->first();


        if (!empty($karyawan) || $karyawan == !null) {
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

            return view(
                'pages.UserProfile.index',
                [
                    'tittle' => 'Profile User',
                    'sopir' => $sopir,
                    'karyawan' => $karyawan,
                    'dataKaryawan' => [
                        'namaDepan' => $namaDepan,
                        'namaBelakang' => $namaBelakang,
                        'tempatLahir' => $tempatLahir,
                        'tglLahir' => $tanggalLahir,
                        'alamatRumah' => $namaJalan,
                        'kecamatan' => $kecamatan,
                        'kodepos' => $kodePos,
                        'selectKota' => $selectKota,
                        'kota' => $kota,
                        'provinsi' => $provinsi
                    ]
                ]
            );
        } elseif (!empty($sopir) || $sopir == !null) {
            return view('pages.UserProfile.index', ['tittle' => 'Profile User', 'sopir' => $sopir, 'karyawan' => $karyawan]);
        }
    }
}
