@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/datakaryawan" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-9">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form class="" action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-3">
                    <label for="nip" class="form-label"> NIP </label>
                    <input name="nip" id="nip" type="number" class="form-control w-full shadow-md @error('nip') border-danger @enderror" placeholder="Masukkan NIP" value="{{ old('nip') }}">
                    @error('nip')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="col-span-6">
                        <label for="namaDepan" class="form-label"> Nama Depan </label>
                        <input name="namaDepan" id="namaDepan" type="text" class="form-control w-full shadow-md @error('namaDepan') border-danger @enderror" placeholder="Masukkan Nama Depan" value="{{ old('namaDepan') }}">
                        @error('namaDepan')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-span-6">
                        <label for="namaBelakang" class="form-label"> Nama Belakang </label>
                        <input name="namaBelakang" id="namaBelakang" type="text" class="form-control w-full shadow-md @error('namaBelakang') border-danger @enderror" placeholder="Masukkan Nama Belakang" value="{{ old('namaBelakang') }}">
                        @error('namaBelakang')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="col-span-6">
                        <label for="kd_jabatan">Jabatan</label>
                        <div class="mt-2">
                            <select data-placeholder="Silahkan pilih jabatan" class="tom-select w-full shadow-md @error('kd_jabatan') border-danger @enderror" id="kd_jabatan" name="kd_jabatan">
                                <option value="0" hidden disabled selected>-- Silahkan Pilih --</option>
                                @foreach ($jabatan as $jbtn)
                                @if (old('kd_jabatan') == $jbtn->id_jabatan)
                                <option value="{{ $jbtn->id_jabatan }}" selected>{{ $jbtn->nm_jabatan }}</option>
                                @else
                                <option value="{{$jbtn->id_jabatan }}">{{ $jbtn->nm_jabatan }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('kd_jabatan')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="mt-2">
                            <select data-placeholder="Silahkan pilih jenis kelamin" class="tom-select w-full shadow-md @error('jenis_kelamin') border-danger @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="0" hidden disabled selected>-- Silahkan Pilih --</option>
                                @if (old('jenis_kelamin') == "Laki-laki")
                                <option value="Laki-laki" selected>Laki-laki</option>
                                @elseif (old('jenis_kelamin') == "Perempuan")
                                <option value="Perempuan" selected>Perempuan</option>
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
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="col-span-6">
                        <label for="tempat_lahir" class="form-label"> Tempat Lahir </label>
                        <input name="tempat_lahir" id="tempat_lahir" type="text" class="form-control w-full shadow-md @error('tempat_lahir') border-danger @enderror" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-span-6">
                        <label for="tgl_lahir" class="form-label"> Tanggal Lahir </label>
                        <input type="text" class="datepicker form-control shadow-md w-full @error('tgl_lahir') border-danger @enderror" data-single-mode="true" value="{{ old('tgl_lahir') }}" name="tgl_lahir" id="tgl_lahir">
                        @error('tgl_lahir')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="status" class="form-label"> Status Perkawinan </label>
                    <input name="status" id="status" type="text" class="form-control w-full shadow-md @error('status') border-danger @enderror" placeholder="Masukkan Status Perkawinan" value="{{ old('status') }}">
                    @error('status')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="no_telp" class="form-label"> Nomor Telepon </label>
                    <div class="input-group">
                        <div id="no_telp" class="input-group-text">+62</div>
                        <input type="text" class="form-control w-full shadow-md @error('no_telp') border-danger @enderror" id="no_telp" name="no_telp" placeholder="Masukkan Nomor Telepon" value="{{ old('no_telp') }}">
                    </div>
                    @error('no_telp')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="grid grid-cols-12 gap-4 md:gap-2 mt-6">
                    <div class="col-span-6">
                        <label for="provinsi" class="form-label"> Provinsi </label>
                        <input name="provinsi" id="provinsi" type="text" class="form-control w-full shadow-md @error('provinsi') border-danger @enderror" minlength="3" value="{{ old('provinsi') }}">
                        @error('provinsi')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-span-6">
                        <label for="kota" class="form-label"> Kota/Kabupaten </label>
                        <div class="input-group">
                            <select name="select_kota" id="kota" class="form-select form-select-md w-24 shadow-md @error('select_kota') border-danger @enderror">
                                <option disabled hidden selected>Pilih</option>
                                @if (old('select_kota') == "Kab.")
                                <option value="Kab." selected>Kab.</option>
                                @elseif (old('select_kota') == "Kota")
                                <option value="Kota" selected>Kota</option>
                                @else
                                <option value="Kab.">Kab.</option>
                                <option value="Kota">Kota</option>
                                @endif
                            </select>
                            <input type="text" class="form-control shadow-md @error('kota') border-danger @enderror" id="kota" name="kota" value="{{ old('kota') }}">
                        </div>
                        @error('provinsi')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 md:gap-2 mt-6">
                    <div class="col-span-6">
                        <label for="kecamatan" class="form-label"> Kecamatan </label>
                        <input name="kecamatan" id="kecamatan" type="text" class="form-control w-full shadow-md @error('kecamatan') border-danger @enderror" minlength="3" value="{{ old('kecamatan') }}">
                        @error('kecamatan')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-span-6">
                        <label for="kodepos" class="form-label"> Kode Pos </label>
                        <input name="kodepos" id="kodepos" type="text" class="form-control w-full shadow-md @error('kodepos') border-danger @enderror" minlength="3" value="{{ old('kodepos') }}">
                        @error('kodepos')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="alamat_lengkap" class="form-label">
                        Alamat Lengkap
                    </label>
                    <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control w-full shadow-md @error('alamat_lengkap') border-danger @enderror" placeholder="Masukkan Alamat Lengkap">{{ old('alamat_lengkap') }}</textarea>
                    @error('alamat_lengkap')
                    <div class="text-danger ">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="pendidikan" class="form-label"> Pendidikan Terakhir </label>
                    <input name="pendidikan" id="pendidikan" type="text" class="form-control w-full shadow-md @error('pendidikan') border-danger @enderror" placeholder="Masukkan Pendidikan Terakhir" value="{{ old('pendidikan') }}">
                    @error('pendidikan')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="tanggal_masuk" class="form-label"> Tanggal Masuk </label>
                    <input type="text" class="datepicker form-control shadow-md w-full @error('tanggal_masuk') border-danger @enderror" data-single-mode="true" value="{{ old('tanggal_masuk') }}" name="tanggal_masuk" id="tanggal_masuk">
                    @error('tanggal_masuk')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="role" class="form-label"> Login Sebagai</label>
                    <select data-placeholder="Silahkan pilih role" class="tom-select w-full shadow-md @error('role') border-danger @enderror" id="role" name="role">
                        <option value="0" hidden disabled selected>-- Silahkan Pilih --</option>
                        @if (old('role') == "backoffice")
                        <option value="backoffice" selected>Backoffice</option>
                        @elseif (old('role') == "gudang")
                        <option value="gudang" selected>Gudang</option>
                        @elseif (old('role') == "produksi")
                        <option value="produksi" selected>Produksi</option>
                        @elseif (old('role') == "distribusi")
                        <option value="distribusi" selected>Distribusi</option>
                        @elseif (old('role') == "kasir")
                        <option value="kasir" selected>Kasir</option>
                        @else
                        <option value="backoffice">Backoffice</option>
                        <option value="gudang">Gudang</option>
                        <option value="produksi">Produksi</option>
                        <option value="distribusi">Distribusi</option>
                        <option value="kasir">Kasir</option>
                        @endif
                    </select>
                    @error('role')
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
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/karyawan" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
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
<script>
    // menggunakan library copperjs
    var input = document.getElementById('dropzone-file');
    var infoArea = document.getElementById('dropzone-file-label');

    input.addEventListener('change', showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }
</script>


@endsection


@section('script')
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>

@endsection