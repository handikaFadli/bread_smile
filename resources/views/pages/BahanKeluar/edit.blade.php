@extends('../layout/' . $layout)

@section('subhead')
<title>Edit Pemakaian Bahan - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/bahanKeluar" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form action="{{ route('bahanKeluar.update', $bahanKeluar->id_bahanKeluar) }}" method="POST">
                @csrf
                @method('PUT')
                <input id="kd_bahan" name="kd_bahan" type="hidden" value="{{ $bahanKeluar->kd_bahan }}">
                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="bg-slate-100 -ml-1 col-span-6 w-full flex justify-center py-2 rounded-lg shadow-lg">
                        <span class="text-slate-800 font-medium uppercase text-center">Kode Bahan - {{ $bahanKeluar->kd_bahan }}</span>
                    </div>
                    <div class="bg-slate-100 -ml-1 col-span-6 flex justify-center py-2 rounded-lg shadow-lg">
                        <span class="text-slate-800 font-medium uppercase text-center">{{ $bahanKeluar->nm_bahan }}</span>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="jumlah" class="form-label"> Jumlah Bahan </label>
                    <div class="relative rounded-md">
                        <input type="text" class="form-control w-full shadow-md @error('jumlah') border-danger @enderror" name="jumlah" id="jumlah" value="{{ old('jumlah', $bahanKeluar->jumlah) }}" required>
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <input id="satuan" class="form-control h-full w-14 rounded-md shadow-md border-transparent bg-transparent py-0  text-gray-500 sm:text-sm text-center" readonly value="Gram">
                        </div>
                    </div>
                </div>
                @error('jumlah')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
                @enderror
                <div class="mt-6">
                    <label for="tgl_keluar" class="form-label"> Tanggal Keluar </label>
                    <input type="text" class="datepicker form-control w-full shadow-md @error('tgl_keluar') border-danger @enderror" data-single-mode="true" value="{{ old('tgl_keluar', $bahanKeluar->tgl_keluar) }}" name="tgl_keluar" id="tgl_keluar" required>
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
                    <textarea name="ket" id="ket" class="form-control w-full shadow-md @error('ket') border-danger @enderror">{{ old('ket', $bahanKeluar->ket) }}</textarea>
                    @error('ket')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/bahanKeluar" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
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