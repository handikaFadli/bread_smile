@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/tampilmobil" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form class="" action="{{ route('mobil.store') }}" method="POST">
                @csrf
                <input id="kd_mobil" name="kd_mobil" type="hidden" value="{{ $kode_otomatis }}">
                <div class="bg-slate-100 -ml-1 w-full flex justify-center py-2 rounded-lg shadow-lg">
                    <span class="text-slate-800 font-medium uppercase text-center">Kode Mobil - {{ $kode_otomatis }}</span>
                </div>
                <div class="mt-8">
                    <label for="merk" class="form-label"> Merk Mobil </label>
                    <input name="merk" id="merk" type="text" class="form-control w-full shadow-md @error('merk') border-danger @enderror" placeholder="Masukkan Merk Mobil" value="{{ old('merk') }}">
                    @error('merk')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="plat_nomor" class="form-label"> Nomor Polisi </label>
                    <input name="plat_nomor" id="plat_nomor" type="text" class="form-control w-full shadow-md @error('plat_nomor') border-danger @enderror" placeholder="Masukkan Nomor Polisi" value="{{ old('plat_nomor') }}">
                    @error('plat_nomor')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="ket" class="form-label">
                        Keterangan
                    </label>
                    <textarea name="ket" id="ket" class="form-control w-full shadow-md @error('ket') border-danger @enderror" placeholder="Masukkan Keterangan">{{ old('ket') }}</textarea>
                    @error('ket')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/mobil" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                            <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection