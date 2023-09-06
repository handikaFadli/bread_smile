@extends('../layout/' . $layout)

@section('subhead')
<title>Data Resep - Bread Smile</title>
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
        <a href="{{ route('resep.create') }}">
            <button class="btn btn-primary shadow-md mr-2">Tambah Data</button>
        </a>
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
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="text-center">RESEP</th>
                    <th class="text-center">BAHAN-BAHAN</th>
                    <th class="whitespace-nowrap text-center">TOTAL BERAT <br>BAHAN TERPAKAI</th>
                    <th class="whitespace-nowrap text-center">TOTAL HARGA <br>BAHAN TERPAKAI </th>
                    <th class="whitespace-nowrap text-center">MODAL <br> PER PRODUK</th>
                    <th class="whitespace-nowrap text-center">KAPASITAS <br> PEMBUATAN <br>ROTI</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buatResep as $resep)
                <tr class="intro-x">
                    <td class="text-center">
                        {{ $resep->nm_produk }}
                    </td>
                    <td class="text-center">
                        <!-- trigger modal -->
                        @if ($dataBahan->where('kd_resep', $resep->kd_resep)->count() > 0)
                        <button class="flex items-center tooltip text-primary mx-auto" data-theme="light" title="Detail Bahan" data-tw-toggle="modal" data-tw-target="#detail{{ $resep->kd_resep }}">
                            <i data-feather="info" class="w-4 h-4 mr-1"></i>
                            Detail
                        </button>
                        <div id="detail{{ $resep->kd_resep }}" class="modal pt-12" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- BEGIN: Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="font-medium text-base mr-auto">Detail Bahan-Bahan Resep</h3>
                                    </div>
                                    <div class="modal-body grid grid-cols-12 gap-4">
                                        <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12 border-2 border-slate-200/60 rounded-md shadow-lg shadow-slate-900">
                                            <div class="box">
                                                <div class="flex items-start px-5 pt-5 pb-5">
                                                    <div class="w-1/2 flex flex-col pl-5">
                                                        <ul>
                                                            @foreach ($dataBahan as $index => $bahan)
                                                            @if ($bahan->kd_resep == $resep->kd_resep)
                                                            <li>{{ $bahan->nm_bahan }} ({{ $bahan->jumlah }} Gram)</li>
                                                            @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="w-1/2">
                                                        @if ($resep->foto != null && file_exists(public_path('images/'.$resep->foto)) && !is_dir(public_path('images/'.$resep->foto)))
                                                        <img src="{{ asset('images/'.$resep->foto) }}" class="w-full h-auto shadow-lg" alt="Foto Produk">
                                                        @else
                                                        <img src="{{ asset('dist/images/roti.webp') }}" class="w-full h-auto shadow-lg" alt="Foto Produk">
                                                        @endif
                                                        <div class="text-center text-slate-500 mt-2">{{ $resep->nm_produk }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer mb-1">
                                        <button type="button" data-tw-dismiss="modal" class="btn btn-primary flex mx-auto">Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </td>

                    <td class="text-center">
                        {{ $resep->tot_jumlahPakai }} Kg
                    </td>
                    <td class="text-center">
                        <!-- format rupiah -->
                        Rp.
                        {{ number_format($resep->tot_hargaPakai) }}
                    </td>
                    <td class="text-center">
                        Rp.
                        {{ number_format($resep->tot_cost) }}
                    </td>
                    <td class="text-center">
                        {{ $resep->roti_terbuat }} Pcs
                    </td>
                    <td class="table-report__action">
                        <div class="flex justify-center items-center">
                            <!-- <a href="{{ route('resep.edit',$resep->kd_resep) }}" data-theme="light" title="Edit" class="flex items-center mr-2 tooltip text-success">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                            </a> -->
                            <!-- trigger modal -->
                            <button class="flex items-center tooltip text-danger" data-theme="light" title="Hapus" data-tw-toggle="modal" data-tw-target="#hapus{{ $resep->kd_resep }}">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                            </button>
                            <!-- BEGIN: Delete Confirmation Modal -->
                            <div id="hapus{{ $resep->kd_resep }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <form action="{{ route('resep.destroy', $resep->kd_resep) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-5 text-center">
                                                    <i data-feather="trash-2" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                    <div id="exampleModalLabel" class="text-3xl mt-5">Apakah yakin akan menghapus Resep dari {{ $resep->nm_produk }} ini?</div>
                                                    <div class="text-danger mt-2">Data yang dihapus tidak dapat dikembalikan!</div>
                                                </div>
                                                <div class="px-5 pb-8 text-center">
                                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Kembali</button>
                                                    <button type="submit" class="btn btn-danger w-24">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Delete Confirmation Modal -->
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <div class="w-full sm:w-auto sm:mr-auto">
            {{ $buatResep->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->
</div>


@endsection

<!-- <td class="whitespace-nowrap">
    <ul>
        @foreach ($dataBahan as $bahan)
        @if ($bahan->kd_resep == $resep->kd_resep)
        <li>{{ $bahan->nm_bahan }} ({{ $bahan->jumlah }} Gram)</li>
        @endif
        @endforeach
    </ul>
</td> -->