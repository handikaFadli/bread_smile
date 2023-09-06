@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10">
    <h2 class="text-lg font-medium">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a class="text-slate-600">{{ $menu }}</a></li>
        <li class="breadcrumb-item active"><a class="text-slate-700 font-medium">{{ $submenu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        @can('create', App\Models\ProdukJadi::class)
        <a href="{{route ('produkJadi.create') }}">
            <button class="btn btn-primary shadow-md mr-2">Tambah Data</button>
        </a>
        @endcan
        <div class="hidden md:block mx-auto text-slate-500"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500">
                <form action="">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search..." autocomplete="off" name="search" value="{{ request('search') }}">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </form>
            </div>
        </div>
    </div>
    <!-- BEGIN: Users Layout -->
    @foreach ($produkJadi as $produk)
    <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 shadow-md">
        <div class="box">
            <div class="p-5">
                <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                    <!-- <img class="rounded-md" src="{{ asset('dist/images/roti.webp') }}"> -->
                    <img class="rounded-md" src="{{ asset('images/'.$produk->foto) }}">
                    <span class="absolute top-0 bg-pending/80 text-white text-xs m-5 px-2 py-1 rounded z-10"></span>
                    <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                        <a href="{{ route('produkJadi.edit',$produk->kd_produk) }}" class="block font-medium text-base">{{ $produk->nm_produk }}</a>
                    </div>
                </div>
                <div class="text-slate-600 dark:text-slate-500 mt-5">
                    <div class="flex items-center">
                        <i data-feather="link" class="w-4 h-4 mr-2"></i> Modal : Rp. {{ number_format($produk->modal, 0, ',', '.') }}
                    </div>
                    <div class="flex items-center mt-2">
                        <i data-feather="link" class="w-4 h-4 mr-2"></i> Harga : Rp. {{ number_format($produk->harga_jual, 0, ',', '.') }}
                    </div>
                    <div class="flex items-center mt-2">
                        <i data-feather="box" class="w-4 h-4 mr-2"></i> Stok : {{ $produk['stok']}} Pcs
                    </div>
                    <div class="flex items-center mt-2">
                        <i data-feather="box" class="w-4 h-4 mr-2"></i> Berat : {{ $produk['berat'] * 1000}} Gram
                    </div>
                    <!-- <div class="flex items-center mt-2">
                        <i data-feather="clipboard" class="w-4 h-4 mr-2"></i> Keterangan : {{ $produk['ket'] }}
                    </div> -->
                </div>
            </div>
            <div class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <button class="flex items-center tooltip text-primary ml-auto" data-theme="light" title="Detail" data-tw-toggle="modal" data-tw-target="#detail-{{ $produk->kd_produk }}">
                    <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                </button>
                @can('update', $produk)
                <a href="{{ route('produkJadi.edit',$produk->kd_produk) }}" data-theme="light" title="Edit" class="flex text-success items-center tooltip mx-3">
                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                </a>
                @endcan

                @can('delete', $produk)
                <button class="flex items-center tooltip text-danger mr-auto" data-theme="light" title="Hapus" data-tw-toggle="modal" data-tw-target="#hapus{{ $produk->kd_produk }}">
                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                </button>
                @endcan

            </div>
        </div>
        <div id="hapus{{ $produk->kd_produk }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <form action="{{ route('produkJadi.destroy', $produk->kd_produk) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-5 text-center">
                                <i data-feather="trash-2" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                <div id="exampleModalLabel" class="text-3xl mt-5">Apakah yakin akan menghapus produk {{ $produk->nm_produk }}?</div>
                                <div class="text-slate-500 mt-2">Data yang dihapus tidak dapat dikembalikan!</div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Kembali</button>
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-6 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END: Users Layout -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mx-auto">
        <div class="w-full sm:w-auto sm:mr-auto">
            {{ $produkJadi->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->
</div>


@foreach ($produkJadi as $produk)
@include('pages.ProdukJadi.detail')
@endforeach

@endsection