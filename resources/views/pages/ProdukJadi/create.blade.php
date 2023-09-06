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
            <form action="{{ route('produkJadi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input id="kd_produk" name="kd_produk" type="hidden" value="{{ $kode_otomatis }}">
                <div class="bg-slate-100 -ml-1 w-full flex justify-center py-2 rounded-lg shadow-lg">
                    <span class="text-slate-800 font-medium uppercase text-center">Kode Produk - {{ $kode_otomatis }}</span>
                </div>
                <div class="mt-8">
                    <label for="nm_produk" class="form-label"> Nama Produk </label>
                    <input type="text" class="form-control w-full shadow-md @error('nm_produk') border-danger @enderror" name="nm_produk" id="nm_produk" value="{{ old('nm_produk') }}" placeholder="Masukkan Nama Produk">
                    @error('nm_produk')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="stok" class="form-label"> Stok </label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        </div>
                        <input name="stok" id="stok" type="text" class="form-control block w-full shadow-md @error('stok') border-danger @enderror rounded-md border-gray-300 pl-3 pr-12 sm:text-sm" placeholder="Masukkan Stok" value="{{ old('stok') }}">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <input id="satuan" class="form-control h-full rounded-md shadow-md border-transparent bg-transparent py-0 pl-2 pr-7 text-gray-500 sm:text-sm" readonly value="Pcs">
                        </div>
                    </div>
                    @error('stok')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="berat" class="form-label"> Berat Produk </label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        </div>
                        <input name="berat" id="berat" type="text" class="form-control block w-full shadow-md @error('berat') border-danger @enderror rounded-md border-gray-300 pl-3 pr-12 sm:text-sm" placeholder="Masukkan Berat Produk" value="{{ old('berat') }}">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <input id="satuan" class="form-control h-full rounded-md shadow-md border-transparent bg-transparent py-0 pl-2 pr-7 text-gray-500 sm:text-sm" readonly value="gram">
                        </div>
                    </div>
                    @error('berat')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="input-form mt-6">
                    <label for="ket" class="form-label w-full flex flex-col sm:flex-row">
                        Keterangan
                    </label>
                    <textarea name="ket" id="ket" class="form-control w-full shadow-md @error('ket') border-danger @enderror" placeholder="Masukkan Keterangan">{{ old('ket') }}</textarea>
                    @error('ket')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="foto" class="form-label"> Foto </label>
                    <div class="flex items-center justify-center w-full shadow-md">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-fit border-2 border-gray-50 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 @error('foto') border-danger @enderror">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img src="" class="my-0 rounded-lg w-32" id="output">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="hilang">
                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" name="foto" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
                        </label>
                    </div>
                </div>
                @error('foto')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
                @enderror
                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/produkJadi" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                            <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- menghilangkan id hilang ketika file di upload -->
<script>
    document.getElementById('dropzone-file').addEventListener('change', function() {
        document.getElementById('hilang').style.display = 'none';
    });
</script>
@endsection
@section('script')
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection
