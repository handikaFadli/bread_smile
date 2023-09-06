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
            <form action="{{ route('produkMasuk.store') }}" method="POST">
                @csrf
                <div class="mt-3">
                    <label for="kd_produk" class="form-label font-medium"> Produk </label>
                    <select name="kd_produk" data-placeholder="Silahkan Pilih produk" class="tom-select w-full shadow-md @error('kd_produk') is-invalid @enderror @error('stok') is-invalid @enderror" required autofocus onchange="changeValue(this.value)" onclick="changeValue(this.value)">
                        <option hidden disabled selected>- Pilih produk -</option>

                        @php
                        $jsArray = "var prdName = new Array();\n";
                        $pcs = " Pcs";
                        @endphp

                        @foreach ($produkJadi as $produk)
                        <option value="{{ $produk->kd_produk }}">{{ $produk->nm_produk }} </option>

                        @php
                        $jsArray .= "prdName['" . $produk['kd_produk'] . "']= {
                        nm_produk : '" . addslashes($produk['nm_produk']) . "',
                        jumlah : '" . addslashes($produk['roti_terbuat']) . "',
                        tampilJumlah : '" . addslashes($produk['roti_terbuat'] . "" . $pcs) . "',
                        stok : '" . addslashes($produk['stok']) . "',
                        stokTampil : '" . addslashes($produk['stok'] . "" . $pcs) . "',

                        };\n";
                        @endphp

                        @endforeach
                    </select>
                    @error('kd_produk')
                    <div class="col-12 text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                    @error('stok')
                    <div class="col-12 text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="text-dark mt-1">
                    <small>*Pastikan sudah memasukkan resep untuk produk yang akan dibuat</small>
                </div>
                <div class="overflow-x-auto mt-6 shadow-md">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Nama Produk</th>
                                <th class="whitespace-nowrap">Stok</th>
                                <th class="whitespace-nowrap">Kapasitas Pembuatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="tampilProduk"></td>
                                <td id="tampilStok"></td>
                                <td id="tampilJumlah"></td>
                            </tr>
                        </tbody>
                    </table>
                    <input name="stok" id="stok" type="hidden" value="{{ old('stok') }}">
                    <input name="nm_produk" id="produk" type="hidden" value="{{ old('nm_produk') }}">
                    <input name="jumlah" id="jumlah" type="hidden" value="{{ old('jumlah') }}">
                    <!-- <input name="harga_beli" id="produk" type="hidden" value="{{ old('harga_beli') }}"> -->
                </div>
                <!-- <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="col-span-12">
                        <label for="jumlah" class="form-label"> Jumlah </label>
                        <div class="relative rounded-md">
                            <input name="jumlah" id="jumlah" type="text" class="form-control w-full shadow-md @error('jumlah') border-danger @enderror" placeholder="Masukkan Jumlah" value="{{ old('jumlah') }}">
                            <div class="absolute inset-y-0 right-0 flex items-center text-center">
                                <input id="satuan" class="form-control w-24 h-full rounded-md shadow-md border-transparent bg-transparent py-0 text-gray-500 sm:text-sm text-center" readonly value="Pcs">
                            </div>
                        </div>
                        @error('jumlah')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div> -->
                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="col-span-6">
                        <label for="tgl_produksi" class="form-label"> Tanggal Produksi </label>
                        <input type="text" class="datepicker form-control w-full shadow-md @error('tgl_produksi') border-danger @enderror" data-single-mode="true" value="{{ old('tgl_produksi') }}" name="tgl_produksi" id="tgl_produksi">
                        @error('tgl_produksi')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-span-6">
                        <label for="tgl_expired" class="form-label"> Tanggal Expired </label>
                        <input type="text" class="datepicker form-control w-full shadow-md @error('tgl_expired') border-danger @enderror" data-single-mode="true" value="{{ old('tgl_expired') }}" name="tgl_expired" id="tgl_expired">
                        @error('tgl_expired')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-6">
                    <label for="ket" class="form-label"> Keterangan </label>
                    <textarea name="ket" id="ket" type="text" class="form-control w-full shadow-md @error('ket') border-danger @enderror" placeholder="Masukkan Keterangan">{{ old('ket') }}</textarea>
                    @error('ket')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- END: Form Layout -->
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
</div>
@endsection

@section('script')
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
<script type="text/javascript">
    <?= $jsArray; ?>

    function changeValue(x) {
        document.getElementById('tampilProduk').innerHTML = prdName[x].nm_produk;
        document.getElementById('tampilStok').innerHTML = prdName[x].stokTampil;
        document.getElementById('tampilJumlah').innerHTML = prdName[x].tampilJumlah;
        document.getElementById('stok').value = prdName[x].stok;
        document.getElementById('harga').value = prdName[x].harga;
        document.getElementById('produk').value = prdName[x].nm_produk;
        document.getElementById('jumlah').value = prdName[x].jumlah;
    }
</script>
@endsection