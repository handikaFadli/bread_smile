@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/produkKeluar" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form action="{{ route('produkKeluar.update', $produkKeluar->id_produkKeluar) }}" method="POST">
                @csrf
                @method('PUT')
                <input id="kd_produk" name="kd_produk" type="hidden" value="{{ $produkKeluar->kd_produk }}">
                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="bg-slate-100 -ml-1 col-span-6 flex justify-center py-2 rounded-lg shadow-lg">
                        <span class="text-slate-800 font-medium uppercase text-center">Kode Produk - {{ $produkKeluar->kd_produk }}</span>
                    </div>
                    <div class="bg-slate-100 -ml-1 col-span-6 flex justify-center py-2 rounded-lg shadow-lg">
                        <span class="text-slate-800 font-medium uppercase text-center">{{ $produkJadi->nm_produk }}</span>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="jumlah" class="form-label"> Jumlah Produk </label>
                    <input type="number" class="form-control w-full shadow-md @error('jumlah') border-danger @enderror" name="jumlah" id="jumlah" value="{{ old('jumlah', $produkKeluar->jumlah) }}" required>
                    @error('jumlah')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="tgl_keluar" class="form-label"> Tanggal Penjualan </label>
                    <input type="text" class="datepicker form-control w-full shadow-md @error('tgl_keluar') border-danger @enderror" data-single-mode="true" value="{{ old('tgl_keluar', $produkKeluar->tgl_keluar) }}" name="tgl_keluar" id="tgl_keluar">
                    @error('tgl_keluar')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="ket" class="form-label">
                        Keterangan
                    </label>
                    <textarea name="ket" id="ket" class="form-control w-full shadow-md @error('ket') border-danger @enderror" required>{{ old('ket', $produkKeluar->ket) }}</textarea>
                    @error('ket')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/produkKeluar" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
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