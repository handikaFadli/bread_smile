@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/produkMasuk" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form action="{{ route('produkMasuk.update', $produkMasuk->id_produkMasuk) }}" method="POST">
                @csrf
                @method('PUT')
                <input id="kd_produk" name="kd_produk" type="hidden" value="{{ $produkMasuk->kd_produk }}">
                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="bg-slate-100 -ml-1 col-span-6 flex justify-center py-2 rounded-lg shadow-lg">
                        <span class="text-slate-800 font-medium uppercase text-center">Kode Produk - {{ $produkMasuk->kd_produk }}</span>
                    </div>
                    <div class="bg-slate-100 -ml-1 col-span-6 flex justify-center py-2 rounded-lg shadow-lg">
                        <span class="text-slate-800 font-medium uppercase text-center">{{ $produkJadi->nm_produk }}</span>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="jumlah" class="form-label"> Kapasitas Pembuatan </label>
                    <div class="relative rounded-md">
                        <input type="number" class="form-control w-full shadow-md @error('jumlah') border-danger @enderror" name="jumlah" id="jumlah" value="{{ $produkMasuk->jumlah }}" readonly>
                        <div class="absolute inset-y-0 right-0 flex items-center text-center">
                            <input id="satuan" class="form-control w-24 h-full rounded-md shadow-md @error('kd_satuan') border-danger @enderror border-transparent bg-transparent py-0 text-gray-500 sm:text-sm text-center" readonly value="Pcs">
                        </div>
                    </div>
                    @error('jumlah')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="col-span-6">
                        <label for="tgl_produksi" class="form-label"> Tanggal Produksi </label>
                        <input type="text" class="datepicker form-control w-full shadow-md @error('tgl_produksi') border-danger @enderror" data-single-mode="true" value="{{ old('tgl_produksi', $produkMasuk->tgl_produksi) }}" name="tgl_produksi" id="tgl_produksi">
                        @error('tgl_produksi')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-span-6">
                        <label for="tgl_expired" class="form-label"> Tanggal Expired </label>
                        <input type="text" class="datepicker form-control w-full shadow-md @error('tgl_expired') border-danger @enderror" data-single-mode="true" value="{{ old('tgl_expired', $produkMasuk->tgl_expired) }}" name="tgl_expired" id="tgl_expired">
                        @error('tgl_expired')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <label for="ket" class="form-label">
                        Keterangan
                    </label>
                    <textarea name="ket" id="ket" class="form-control w-full shadow-md @error('ket') border-danger @enderror" required>{{ old('ket', $produkMasuk->ket) }}</textarea>
                    @error('ket')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/produkMasuk" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                            <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection

    @section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
    @endsection