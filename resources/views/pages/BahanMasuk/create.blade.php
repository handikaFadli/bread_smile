@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/bahanMasuk" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form action="{{ route('bahanMasuk.store') }}" method="POST">
                @csrf
                <div class="mt-3">
                    <label for="kd_bahan" class="form-label"> Bahan </label>
                    <select name="kd_bahan" type="text" data-placeholder="Silahkan pilih bahan" class="tom-select w-full form-control shadow-md @error('kd_bahan') border-danger @enderror font-medium" required autofocus onchange="changeValue(this.value)" onclick="changeValue(this.value)">
                        <option hidden disabled selected>- Pilih Bahan -</option>
                        @php
                        $jsArray = "var prdName = new Array();\n";
                        @endphp

                        @foreach ($dataBahan as $bahan)
                        @if (old('kd_bahan') == $bahan->kd_bahan)
                        <option value="{{ $bahan->kd_bahan }}" selected>{{ $bahan->kd_bahan }} - {{ $bahan->nm_bahan }} </option>
                        @else
                        <option value="{{ $bahan->kd_bahan }}">{{ $bahan->kd_bahan }} - {{ $bahan->nm_bahan }} </option>
                        @endif

                        @php
                        $jsArray .= "prdName['" . $bahan['kd_bahan'] . "']= {
                        nm_bahan : '" . addslashes($bahan['nm_bahan']) . "',
                        harga : '" . addslashes($bahan['harga_beli']) . "',
                        hargaTampil : '" . addslashes('Rp. ' . number_format($bahan['harga_beli'])) . "',
                        stokTampil : '" . addslashes($bahan['stok']. " " . 'Kg') . "',
                        stok : '" . addslashes($bahan['stok']) . "',

                        };\n";
                        @endphp

                        @endforeach
                    </select>
                    @error('kd_bahan')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="overflow-x-auto mt-6 shadow-md " >
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Nama Bahan</th>
                                <th class="whitespace-nowrap">Stok</th>
                                <th class="whitespace-nowrap">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="tampilBahan"></td>
                                <td id="tampilStok"></td>
                                <td id="tampilHarga"></td>
                            </tr>
                        </tbody>
                    </table>
                    <input name="stok" id="stok" type="hidden" value="{{ old('stok') }}">
                    <input name="nm_bahan" id="bahan" type="hidden" value="{{ old('nm_bahan') }}">
                    <input name="harga_beli" id="harga" type="hidden" value="{{ old('harga_beli') }}">
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div class="col-span-6">
                        <label for="jumlah" class="form-label font-medium"> Jumlah </label>
                        <div class="relative rounded-md">
                            <input name="jumlah" id="jumlah" type="text" class="form-control w-full shadow-md @error('jumlah') border-danger @enderror" placeholder="Masukkan Jumlah" value="{{ old('jumlah') }}">
                            <div class="absolute inset-y-0 right-0 flex items-center text-center">
                                <input id="satuan" class="form-control w-24 h-full rounded-md shadow-md @error('kd_satuan') border-danger @enderror border-transparent bg-transparent py-0 text-gray-500 sm:text-sm text-center" readonly value="Kg">
                            </div>
                        </div>
                        @error('jumlah')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-span-6">
                        <label for="tgl_masuk" class="form-label font-medium"> Tanggal Beli </label>
                        <input type="text" class="datepicker form-control w-full shadow-md @error('tgl_masuk') border-danger @enderror" data-single-mode="true" value="{{ old('tgl_masuk') }}" name="tgl_masuk" id="tgl_masuk">
                        @error('tgl_masuk')
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
                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/bahanMasuk" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                            <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    <?= $jsArray; ?>

    function changeValue(x) {
        document.getElementById('tampilBahan').innerHTML = prdName[x].nm_bahan;
        document.getElementById('tampilHarga').innerHTML = prdName[x].hargaTampil;
        document.getElementById('tampilStok').innerHTML = prdName[x].stokTampil;
        document.getElementById('harga').value = prdName[x].harga;
        document.getElementById('bahan').value = prdName[x].nm_bahan;
        document.getElementById('stok').value = prdName[x].stok;
    }
</script>
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection
