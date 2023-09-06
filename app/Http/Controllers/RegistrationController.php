<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RegistrationController extends Controller
{
    public function index()
    {

        $karyawan = Karyawan::all();

        return view('register.main', [
            'layout' => 'login'
        ], compact('karyawan'));
    }

    public function store(Request $request)
    {
        // mengubah nama validasi
        $messages = [
            'nip.required' => 'Nip tidak boleh kosong',
            'nip.unique' => 'Nip ini sudah memiliki akun, silahkan login!',
            // 'nm_karyawan.required' => 'Nama tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 16 karakter',
            'rePassword.required' => 'Konfirmasi Password tidak boleh kosong',
            'rePassword.same' => 'Konfirmasi Password tidak valid'
        ];

        $request->validate([
            'nip' => 'required|unique:users,nip',
            // 'nm_karyawan' => 'required',
            'password' => 'required|min:8|max:16',
            'rePassword' => 'required|same:password',
        ], $messages);
        $karyawan = Karyawan::where('nip', $request->nip)->first();
        $userNip = User::where('nip', $request->nip)->first();
        $userPass = User::where('password', $request->password)->first();


        if (!empty($karyawan) || $karyawan == !null) {

            // cek apakah user itu terdaftar pada tabel karyawan
            if ($request->nip === $karyawan->nip && $request->nm_karyawan === $karyawan->nm_karyawan) {

                $nip = $karyawan->nip;
                $name = $karyawan->nm_karyawan;
                $role = $karyawan->role;
                $id_karyawan = $karyawan->id_karyawan;

                $input = $request->all();

                $input['password'] = bcrypt($input['password']);

                User::create([
                    'name' => $name,
                    'nip' => $nip,
                    'password' => $input['password'],
                    'role' => $role,
                    'id_karyawan' => $id_karyawan,
                ]);

                Alert::success('Registrasi Berhasil', 'Silahkan Login!');
                return redirect('login');
            } else {
                Alert::error('Registrasi Gagal', 'NIP yang anda masukkan tidak terdaftar!');
                return back();
            }
        } elseif (!empty($userNip) || $userNip == !null && !empty($userPass) || $userPass == !null) {
            if ($request->nip === $userNip && $request->password === $userPass) {
                Alert::error('Registrasi Gagal', 'NIP yang anda masukkan sudah memiliki, silahkan login!');
                return redirect('login');
            } else {
                Alert::error('Registrasi Gagal', 'NIP yang anda masukkan sudah memiliki akun, silahkan login!');
                return redirect('login');
            }
        } else {
            Alert::error('Registrasi Gagal', 'NIP yang anda masukkan tidak terdaftar di Perusahaan!');
            return back();
        }
    }

    public function login()
    {
        return view('login.main', [
            'layout' => 'login'
        ]);
    }

    public function loginStore(Request $request)
    {
        $messages = [
            'nip.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];

        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ], $messages);

        $credentials = $request->only('nip', 'password');

        // pesan error jika email dan password tidak sesuai dengan data di database
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect(RouteServiceProvider::HOME);
        }
        Alert::error('Login Gagal', 'Username atau Password yang anda masukkan salah!');
        return back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login')->with('success', 'Logout Berhasil');
    }
}
