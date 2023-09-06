@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/dataBahan" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form class="" action="{{ route('dataBahan.store') }}" method="POST">
                @csrf
                <input id="kd_bahan" name="kd_bahan" type="hidden" value="{{ $kode_otomatis }}">
                <div class="bg-slate-100 -ml-1 w-full flex justify-center py-2 rounded-lg shadow-lg">
                    <span class="text-slate-800 font-medium uppercase text-center">Kode Bahan - {{ $kode_otomatis }}</span>
                </div>
                <div class="mt-8">
                    <label for="nm_bahan" class="form-label"> Nama Bahan </label>
                    <input name="nm_bahan" id="nm_bahan" type="text" class="form-control w-full shadow-md @error('nm_bahan') border-danger @enderror" placeholder="Masukkan Nama Bahan" value="{{ old('nm_bahan') }}">
                    @error('nm_bahan')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-6                ">
                    <label for="harga_beli" class="form-label"> Harga Beli </label>
                    <input name="harga_beli" id="harga_beli" type="number" class="form-control w-full shadow-md @error('harga_beli') border-danger @enderror" placeholder="Masukkan Harga Beli" value="{{ old('harga_beli') }}">
                    @error('harga_beli')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="stok" class="form-label"> Stok </label>
                    <div class="relative rounded-md">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        </div>
                        <input name="stok" id="stok" type="number" class="form-control block w-full shadow-md @error('stok') border-danger @enderror rounded-md pl-3 pr-12 sm:text-sm" placeholder="Masukkan Stok" value="{{ old('stok') }}">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <input id="satuan" class="form-control h-full w-24 rounded-md shadow-md border-transparent bg-transparent py-0 text-gray-500 sm:text-sm text-center" readonly value="Kg">
                        </div>
                    </div>
                    <div class="flex">
                        @error('stok')
                        <div class="text-danger mt-1 mr-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
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
                            <a href="/dataBahan" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
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
