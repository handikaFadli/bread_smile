@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/tampilsopir" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form class="" action="{{ route('sopir.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input id="kd_sopir" name="kd_sopir" type="hidden" value="{{ $kode_otomatis }}">
                <div class="bg-slate-100 -ml-1 w-full flex justify-center py-2 rounded-lg shadow-lg">
                    <span class="text-slate-800 font-medium uppercase text-center">Kode Sopir - {{ $kode_otomatis }}</span>
                </div>
                <div class="mt-8">
                    <label for="no_ktp" class="form-label"> Nomor KTP </label>
                    <input name="no_ktp" id="no_ktp" type="number" class="form-control w-full shadow-md @error('no_ktp') border-danger @enderror" placeholder="Masukkan Nomor KTP" minlength="3" value="{{ old('no_ktp') }}">
                    @error('no_ktp')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="nm_sopir" class="form-label"> Nama Sopir </label>
                    <input name="nm_sopir" id="nm_sopir" type="text" class="form-control w-full shadow-md @error('nm_sopir') border-danger @enderror" placeholder="Masukkan Nama Sopir" value="{{ old('nm_sopir') }}">
                    @error('nm_sopir')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="jenis_kelamin" class="form-label"> Jenis Kelamin </label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select form-select-md shadow-md @error('jenis_kelamin') border-danger @enderror">
                        <option disabled hidden selected>-- Silahkan Pilih --</option>
                        @if (old('jenis_kelamin') == "Laki-laki")
                            <option value="Laki-laki" selected>Laki-laki</option>
                        @elseif (old('jenis_kelamin') == "Perempuan")
                            <option value="Perempuan">Perempuan</option>
                        @else
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        @endif
                    </select>
                    @error('jenis_kelamin')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="alamat" class="form-label">
                        Alamat
                    </label>
                    <textarea name="alamat" id="alamat" class="form-control w-full shadow-md @error('alamat') border-danger @enderror" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="foto" class="form-label"> Foto </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-fit border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 @error('foto') border-danger @enderror">
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
                    @error('foto')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/sopir" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                            <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('dropzone-file').addEventListener('change', function() {
        document.getElementById('hilang').style.display = 'none';
    });
</script>

@endsection

@section('script')
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection