@extends('../layout/' . $layout)

@section('head')
<title>Registrasi - Bread Smile</title>
@endsection

@section('content')
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Register Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="" class="-intro-x flex items-center pt-5">
                <img alt="Logo Perusahaan" class="w-6" src="{{ asset('dist/images/logoh.png') }}">
                <span class="text-white text-lg ml-3">
                    Bread Smile
                </span>
            </a>
            <div class="my-auto">
                <img alt="Logo" class="-intro-x w-1/2 -mt-16 rounded-md shadow-lg xl:shadow" src="{{ asset('dist/images/logo.png') }}">
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">Selamat datang<br>di halaman registrasi <br> Bread Smile.</div>
                <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Silahkan mendaftar agar bisa login</div>
            </div>
        </div>
        <!-- END: Register Info -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 mb-10">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Registrasi</h2>
                <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">Selamat datang di halaman registrasi Bread Smile.<br>Silahkan mendaftar agar bisa login</div>
                <!-- BEGIN: Register Form -->
                <form action="/register" method="POST">
                    @csrf
                    @php
                    $jsArray = "var prdName = new Array();\n";
                    @endphp
                    <div class="intro-x mt-8">
                        <input placeholder="NIP" type="text" class="intro-x login__input form-control py-3 px-4 block @error('nip') border-danger @enderror" name="nip" id="nip" value="{{ old('nip') }}" placeholder="Nip" required onkeyup="isi_nama(this.value)" onclick="isi_nama(this.value)" onkeydown="hapus(this.value)">
                        @foreach ($karyawan as $krywn)
                        @php
                        $jsArray .= "prdName['" . $krywn['nip'] . "']= {
                        nm_karyawan : '" . addslashes($krywn['nm_karyawan']) . "',
                        };\n";
                        @endphp
                        @endforeach
                        @error('nip')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                        <input placeholder="Nama Karyawan" type="hidden" class="intro-x login__input form-control py-3 px-4 block mt-4" name="nm_karyawan" id="nm_karyawan" value="{{ old('nm_karyawan') }}" placeholder="Nama Lengkap" readonly>
                        <!-- <input type="text" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Email"> -->
                        <input name="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4 @error('password') border-danger @enderror" placeholder="Password">
                        @error('password')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                        <input name="rePassword" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4 @error('rePassword') border-danger @enderror" placeholder="Konfirmasi Password">
                        @error('rePassword')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="intro-x flex items-center text-slate-600 dark:text-slate-500 mt-4 text-xs sm:text-sm">
                        <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                        <label class="cursor-pointer select-none" for="remember-me">I agree to the Envato</label>
                        <a class="text-primary dark:text-slate-200 ml-1" href="">Privacy Policy</a>.
                    </div> --}}
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Daftar</button>
                        <a href="/login" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Login</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- END: Register Form -->
    </div>
</div>
<script type="text/javascript">
    <?= $jsArray; ?>

    function isi_nama(x) {
        if (x == "") {
            document.getElementById('nm_karyawan').value = "";
        } else {
            document.getElementById('nm_karyawan').value = prdName[x].nm_karyawan;
        }
    }
</script>
@endsection