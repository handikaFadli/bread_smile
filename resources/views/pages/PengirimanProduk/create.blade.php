@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10 mb-6">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="/pengirimanProduk" class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box px-10 py-5">
            <form class="" action="{{ route('pengirimanProduk.store') }}" method="POST">
                @csrf
                <div class="mt-8">
                    <label for="kd_sopir" class="form-label font-bold">Sopir</label>
                    <select data-placeholder="Silahkan pilih sopir" class="tom-select w-full shadow-md @error('kd_sopir') border-danger @enderror" id="kd_sopir" name="kd_sopir">
                        <option value="0" hidden disabled selected>-- Silahkan Pilih --</option>
                        @foreach ($sopir as $spr)
                        @if (old('kd_sopir') == $spr->kd_sopir)
                        <option value="{{ $spr->kd_sopir }}" selected>{{ $spr->nm_sopir }}</option>
                        @else
                        <option value="{{$spr->kd_sopir }}">{{ $spr->nm_sopir }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('kd_sopir')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="kd_mobil" class="form-label font-bold">Mobil</label>
                    <select data-placeholder="Silahkan pilih mobil" class="tom-select w-full shadow-md @error('kd_mobil') border-danger @enderror" id="kd_mobil" name="kd_mobil">
                        <option value="0" hidden disabled selected>-- Silahkan Pilih --</option>
                        @foreach ($mobil as $mbl)
                        @if (old('kd_mobil') == $mbl->kd_mobil)
                        <option value="{{ $mbl->kd_mobil }}" selected>{{ $mbl->plat_nomor }}</option>
                        @else
                        <option value="{{$mbl->kd_mobil }}">{{ $mbl->plat_nomor }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('kd_mobil')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="id_lokasi" class="form-label font-bold">Lokasi</label>
                    <select data-placeholder="Silahkan pilih Lokasi" class="tom-select w-full shadow-md @error('id_lokasi') border-danger @enderror" id="id_lokasi" name="id_lokasi">
                        <option value="0" hidden disabled selected>-- Silahkan Pilih --</option>
                        @foreach ($lokasiPengiriman as $lp)
                        @if (old('id_lokasi') == $lp->id_lokasiPengiriman)
                        <option value="{{ $lp->id_lokasiPengiriman }}" selected>{{ $lp->tempat }}</option>
                        @else
                        <option value="{{$lp->id_lokasiPengiriman }}">{{ $lp->tempat }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('id_lokasi')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="id_produkKeluar" class="form-label font-bold">Pilih Produk yang akan dikirim</label>
                    <!-- <div class="flex items-center sm:ml-auto">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-4">
                                <label for="dari" class="form-label italic"><i>Dari</i></label>
                                <input type="text" class="datepicker form-control w-full shadow-md @error('dari') border-danger @enderror" data-single-mode="true" value="{{ old('dari') }}" name="dari" id="dari">
                                @error('dari')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-4">
                                <label for="sampai" class="form-label"><i> Sampai </i></label>
                                <input type="text" class="datepicker form-control w-full shadow-md @error('sampai') border-danger @enderror" data-single-mode="true" value="{{ old('sampai') }}" name="sampai" id="sampai">
                                @error('sampai')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-4">
                                <label class="form-label"></label>
                                <button type="submit" class="btn form-control mt-2 btn-primary shadow-md">Cari</button>
                            </div>
                        </div>
                    </div> -->
                    <!-- BEGIN: Inbox Content -->
                    <div class="overflow-x-auto sm:overflow-x-visible shadow-md">
                        <div class="intro-y inbox box mt-5">
                            <div class="p-5 flex flex-col-reverse sm:flex-row text-slate-500 border-b border-slate-200/60">
                                <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-slate-200/60 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                                    <!-- <div class="dropdown ml-1" data-tw-placement="bottom-start">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                                            <i data-feather="chevron-down" class="w-5 h-5"></i>
                                        </a>
                                        <div class="dropdown-menu w-32">
                                            <ul class="dropdown-content">
                                                <li>
                                                    <a href="" class="dropdown-item">All</a>
                                                </li>
                                                <li>
                                                    <a href="" class="dropdown-item">None</a>
                                                </li>
                                                <li>
                                                    <a href="" class="dropdown-item">Read</a>
                                                </li>
                                                <li>
                                                    <a href="" class="dropdown-item">Unread</a>
                                                </li>
                                                <li>
                                                    <a href="" class="dropdown-item">Starred</a>
                                                </li>
                                                <li>
                                                    <a href="" class="dropdown-item">Unstarred</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <!-- <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                                        <i class="w-4 h-4" data-feather="refresh-cw"></i>
                                    </a>
                                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                                        <i class="w-4 h-4" data-feather="more-horizontal"></i> 
                                    </a>
                                </div>
                                <div class="flex items-center sm:ml-auto">
                                    <div class="">1 - 50 of 5,238</div>
                                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                                        <i class="w-4 h-4" data-feather="chevron-left"></i>
                                    </a>
                                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                                        <i class="w-4 h-4" data-feather="chevron-right"></i>
                                    </a>
                                    <a href="javascript:;" class="w-5 h-5 ml-5 flex items-center justify-center">
                                        <i class="w-4 h-4" data-feather="settings"></i>
                                    </a>-->
                                </div>
                            </div>
                            @foreach ($produkKeluar as $keluar)
                            <!-- jangan tampilkan produk jika sudah ada di database -->
                            <div class="intro-y">
                                <div class="inbox__item{{ $keluar[0] ? ' inbox__item--active' : '' }} inline-block sm:block text-slate-600 dark:text-slate-500 bg-slate-100 dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400 @error('id_produkKeluar') border-danger @enderror">
                                    <div class="flex px-5 py-3">
                                        <div class="w-64 flex-none flex items-center mr-5">
                                            <input class="form-check-input flex-none" type="checkbox" value="{{ $keluar->id_produkKeluar }}" name="id_produkKeluar[]" @if(old('id_produkKeluar') && in_array($keluar->id_produkKeluar, old('id_produkKeluar'))) checked @endif>
                                            <div class="w-6 h-6 flex-none image-fit relative ml-5">
                                                <img alt="Foto Produk" class="rounded-md" src="{{ asset('images/'.$keluar->foto) }}">
                                            </div>
                                            <div class="inbox__item--sender truncate ml-3">{{ $keluar->nm_produk }}</div>
                                            <div class="inbox__item--sender truncate ml-6">{{ $keluar->jumlah}} Pcs</div>
                                        </div>
                                        <div class="w-48 sm:w-auto truncate">
                                            <span class="inbox__item--highlight">{{ date('d F Y',strtotime($keluar->tgl_keluar)) }}</span>
                                        </div>
                                        <div class="inbox__item--time whitespace-nowrap ml-auto pl-10">[{{ $keluar->kd_produk }}]</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- menampilkan keterangan tidak ada produk jika tidak produk tidak ditampilkan -->
                            @if ($produkKeluar->count() == 0)
                            <div class="intro-y">
                                <div class="inbox__item inline-block sm:block text-slate-600 dark:text-slate-500 bg-slate-100 dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400">
                                    <div class="flex px-5 py-3">
                                        <div class="w-full flex-none flex items-center">
                                            <div class="inbox__item--sender truncate mx-auto text-center">Tidak ada produk untuk dikirimkan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @error('id_produkKeluar')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                    <!-- END: Inbox Content -->
                </div>
                <div class="relative">
                    <div class="intro-y col-span-11 2xl:col-span-9 mb-3">
                        <div class="flex justify-center flex-col md:flex-row gap-2 mt-8">
                            <a href="/pengirimanProduk" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                            <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function checkAll(checkbox) {
        var checkboxes = document.getElementsByName("id_produkKeluar[]");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checkbox.checked;
        }
    }
</script>
@endsection

@section('script')
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>

@endsection