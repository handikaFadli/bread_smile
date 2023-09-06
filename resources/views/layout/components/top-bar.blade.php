@php
use App\Models\Karyawan;
use App\Models\Sopir;

$karyawan = Karyawan::where('nip', Auth::user()->nip)
->join('jabatan', 'jabatan.id_jabatan', '=', 'karyawan.kd_jabatan')
->select('karyawan.*', 'jabatan.nm_jabatan')
->first();

$sopir = Sopir::where('no_ktp', Auth::user()->nip)->first();


if ($karyawan == null) {
$foto = asset('dist/images/user.png');
$jabatan = 'User';
if ($sopir) {
$foto = asset('images/'.$sopir->foto);
$jabatan = 'User';
}
} else {
$foto = asset('images/'.$karyawan->foto);
$jabatan = $karyawan->nm_jabatan;
}
@endphp
<!-- BEGIN: Top Bar -->
<div class="top-bar-boxed h-[70px] z-[51] relative border-b border-white/[0.08] -mt-7 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
    <div class="h-full flex items-center">
        <!-- BEGIN: Logo -->
        <a href="" class="-intro-x hidden md:flex mr-auto">
            <img class="w-8" src="{{ asset('dist/images/logoh.png') }}">
            <span class="text-white text-lg ml-3">
                Bread Smile
            </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        {{-- <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
            <ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="#">Application</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav> --}}
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg bg-no-repeat bg-local bg-top zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                <img alt="User Profile" src="{{ $foto }}">
            </div>
            <div class="dropdown-menu w-56">
                <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ auth()->user()->name }}</div>
                        <!-- agar huruf depan role bisa kapital -->
                        <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">{{ $jabatan }} | {{ auth()->user()->role }}</div>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>

                    @if ($karyawan !== null || $sopir !== null)
                    <li>
                        <a href="{{ route('UserProfile.index') }}" class="dropdown-item hover:bg-white/5">
                            <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                        </a>
                    </li>
                    @endif

                    <!-- 
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5">
                            <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5">
                            <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5">
                            <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li> -->
                    <li>
                        @if (Auth::check())
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="w-full h-full dropdown-item overflow-hidden hover:bg-white/5">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i>
                                Logout
                            </button>
                        </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>
<!-- END: Top Bar -->