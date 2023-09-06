@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/resep" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-dismissible show flex items-center mb-2 w-full lg:w-1/2 shadow-md" role="alert">
    <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{ $error }}
    <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
        <i data-feather="x" class="w-4 h-4"></i>
    </button>
</div>
@endforeach
@endif
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form class="" action="{{ route('resep.store') }}" method="POST">
                @csrf
                <input id="kd_resep" name="kd_resep" type="hidden" value="{{ $kode_otomatis }}">
                <div class="bg-slate-100 -ml-1 w-full flex justify-center py-2 rounded-lg shadow-lg">
                    <span class="text-slate-800 font-medium uppercase text-center">Kode Resep - {{ $kode_otomatis }}</span>
                </div>
                <div class="mt-8">
                    <label for="kd_produk" class="form-label font-bold">Nama Produk</label>
                    <div class="mt-1">
                        <select data-placeholder="Silahkan pilih Produk" class="tom-select w-full @error('kd_produk') border-danger @enderror shadow-md" id="kd_produk" name="kd_produk">
                            <option value="0" hidden disabled selected>-- Silahkan Pilih --</option>
                            @foreach ($produkJadi as $produk)
                            @if (old('kd_produk') == $produk->kd_produk)
                            <option value="{{ $produk->kd_produk }}" selected>[{{ $produk->kd_produk }}] {{ $produk->nm_produk }}</option>
                            @else
                            <option value="{{$produk->kd_produk }}">[{{ $produk->kd_produk }}] {{ $produk->nm_produk }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- buat inputan untuk biaya tenaga_kerja -->
                <div class="mt-6">
                    <label for="biaya_tenaga_kerja" class="form-label font-bold">Biaya Tenaga Kerja</label>
                    <div class="mt-1">
                        <input type="text" class="form-control @error('biaya_tenaga_kerja') border-danger @enderror shadow-md" id="biaya_tenaga_kerja" name="biaya_tenaga_kerja" value="{{ old('biaya_tenaga_kerja') }}" placeholder="Masukkan biaya tenaga kerja">
                    </div>
                </div>
                @error('biaya_tenaga_kerja')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
                @enderror
                <!-- buat inputan untuk biaya kemasan -->
                <div class="mt-6">
                    <label for="biaya_kemasan" class="form-label font-bold">Harga kemasan per produk</label>
                    <div class="mt-1">
                        <input type="text" class="form-control @error('biaya_kemasan') border-danger @enderror shadow-md" id="biaya_kemasan" name="biaya_kemasan" value="{{ old('biaya_kemasan') }}" placeholder="Masukkan harga kemasan per produk">
                    </div>
                </div>
                @error('biaya_kemasan')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
                @enderror
                <!-- buat inputan untuk biaya peralatan dan operasional -->
                <div class="mt-6">
                    <label for="biaya_peralatan_operasional" class="form-label font-bold">Biaya Peralatan dan Operasional</label>
                    <div class="mt-1">
                        <input type="text" class="form-control @error('biaya_peralatan_operasional') border-danger @enderror shadow-md" id="biaya_peralatan_operasional" name="biaya_peralatan_operasional" value="{{ old('biaya_peralatan_operasional') }}" placeholder="Masukkan biaya peralatan dan operasional">
                    </div>
                </div>
                @error('biaya_peralatan_operasional')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
                @enderror
                <div class="mt-6">
                    <label for="kd_bahan" class="form-label font-bold">Pilih Bahan-bahan disertai jumlah</label>
                    <div class="intro-y inbox box mt-3 @error('kd_bahan') border-danger @enderror">
                        <div class="overflow-x-auto sm:overflow-x-visible shadow-md">
                            @foreach ($dataBahan as $bahan)
                            <div class="intro-y">
                                <div class="inbox__item inline-block sm:block text-slate-600 dark:text-slate-500 bg-white dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400">
                                    <div class="flex px-5 py-3">
                                        <div class="w-40 flex-none flex items-center mr-5">
                                            <input class=" form-check-input flex-none @error('kd_bahan') border-danger @enderror" type="checkbox" value="{{ $bahan->kd_bahan }}" name="kd_bahan[]" @if(old('kd_bahan') && in_array($bahan->kd_bahan, old('kd_bahan'))) checked @endif>
                                            <div class="inbox__item--sender truncate ml-3">{{ $bahan->nm_bahan }}</div>
                                        </div>
                                        </select>
                                        <div class="w-80 sm:w-auto truncate">
                                            <span class="inbox__item--highlight">
                                                <!-- cara agar saat tidak tervalidasi lalu kembali lagi ke halaman sebelumnya jumlah yang sudah terisi bisa tetap terisi jika kd_bahannya di centang -->
                                                <input type="text" class="form-control @error('jumlah') border-danger @enderror" name="jumlah[]" value="{{ old('jumlah')[$loop->index] ?? (isset($kd_bahan) && $kd_bahan == 'checked' ? old('jumlah')[$loop->index] : '') }}" placeholder="berapa Gram">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @error('jumlah')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @error('kd_bahan')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
                @enderror
                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/resep" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
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