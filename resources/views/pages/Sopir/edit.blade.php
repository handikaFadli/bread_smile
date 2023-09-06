@extends('../layout/' . $layout)

@section('subhead')
<title>Edit Data Sopir - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Data Sopir</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form class="" action="{{ route('sopir.update', $sopir->kd_sopir) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input id="kd_sopir" name="kd_sopir" type="hidden" value="{{ $sopir->kd_sopir }}">
                <div class="bg-slate-100 -ml-1 w-full flex justify-center py-2 rounded-lg shadow-lg">
                    <span class="text-slate-800 font-medium uppercase text-center">Kode Sopir - {{ $sopir->kd_sopir }}</span>
                </div>
                <div class="mt-8">
                    <label for="no_ktp" class="form-label"> Nomor KTP </label>
                    <input name="no_ktp" id="no_ktp" type="number" class="form-control w-full shadow-md @error('no_ktp') border-danger @enderror" value="{{ old('no_ktp', $sopir->no_ktp) }}">
                    @error('no_ktp')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="nm_sopir" class="form-label"> Nama Sopir </label>
                    <input name="nm_sopir" id="nm_sopir" type="text" class="form-control w-full shadow-md @error('nm_sopir') border-danger @enderror" value="{{ old('nm_sopir', $sopir->nm_sopir) }}">
                    @error('nm_sopir')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="jenis_kelamin" class="form-label"> Jenis Kelamin </label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select form-select-md shadow-md @error('jenis_kelamin') border-danger @enderror">
                        @if (old('jenis_kelamin', $sopir->jenis_kelamin) == $sopir->jenis_kelamin)
                            <option value="{{ $sopir->jenis_kelamin }}" hidden selected>{{ $sopir->jenis_kelamin }}</option>
                        @else
                            <option value="{{ $sopir->jenis_kelamin }}" hidden selected>{{ $sopir->jenis_kelamin }}</option>
                        @endif
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
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
                    <textarea name="alamat" id="alamat" class="form-control w-full shadow-md @error('alamat') border-danger @enderror">{{ old('alamat', $sopir->alamat) }}</textarea>
                    @error('alamat')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="foto" class="form-label"> Foto </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-fit border-2 border-gray-50 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 @error('foto') border-danger @enderror">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img src="{{ asset('images/'.$sopir->foto) }}" class="my-0 rounded-lg w-32" id="output">
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