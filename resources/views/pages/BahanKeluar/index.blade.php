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
        <a href="{{route ('bahanKeluar.create') }}">
            <button class="btn btn-primary shadow-md mr-2">Tambah Data</button>
        </a>
        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center">
                    <i class="w-4 h-4" data-feather="plus"></i>
                </span>
            </button>
            <div class="dropdown-menu w-40">
                <ul class="dropdown-content">
                    <li>
                        <a href="/lap-bahankeluar-print" target="_blank" class="dropdown-item">
                            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                        </a>
                    </li>
                    <li>
                        <a href="/lap-bahankeluar-excel" target="_blank" class="dropdown-item">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                        </a>
                    </li>
                    <li>
                        <a href="/lap-bahankeluar-pdf" target="_blank" class="dropdown-item">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>
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
                    <th class="text-center whitespace-nowrap">NO.</th>
                    <th class="text-center whitespace-nowrap">KODE BAHAN</th>
                    <th class="text-center whitespace-nowrap">NAMA BAHAN</th>
                    <th class="text-center whitespace-nowrap">TANGGAL KELUAR</th>
                    <th class="text-center whitespace-nowrap">HARGA BELI</th>
                    <th class="text-center whitespace-nowrap">JUMLAH</th>
                    <th class="text-center whitespace-nowrap">TOTAL</th>
                    <!-- <th class="text-center whitespace-nowrap">KETERANGAN</th> -->
                    <th class="text-center whitespace-nowrap">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahanKeluar as $keluar)
                <!-- menampilkan bulan dengan bahasa indonesia -->
                @php
                $bulanIndo = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];

                $tanggal = date('j', strtotime($keluar->tgl_keluar));
                $bulan = $bulanIndo[date('n', strtotime($keluar->tgl_keluar)) - 1];
                $tahun = date('Y', strtotime($keluar->tgl_keluar));
                @endphp
                <tr class="intro-x">
                    <!-- agar nomer mengikuti pagination -->
                    <td class="text-center">{{ $loop->iteration + ($bahanKeluar->currentPage() - 1) * $bahanKeluar->perPage() }}</td>
                    <td class="text-center">{{ $keluar->kd_bahan }}</td>
                    <td class="text-center">{{ $keluar->nm_bahan }}</td>
                    <td class="text-center ">{{ $tanggal }} {{ $bulan }} {{ $tahun }}</td>
                    <td class="text-center ">{{ 'Rp. ' . number_format($keluar->harga_beli) }}</td>
                    <td class="text-center ">{{ $keluar->jumlah }} Gram</td>
                    <td class="text-center ">{{ 'Rp. ' . number_format($keluar->total) }}</td>
                    <!-- <td class="text-center ">{{ $keluar->ket }}</td> -->
                    <td class="table-report__action">
                        <div class="flex justify-center items-center">
                            <!--<a href="{{ route('bahanKeluar.edit', $keluar->id_bahanKeluar) }}" data-theme="light" title="Edit" class="flex tooltip text-success mr-2">-->
                            <!--    <i data-feather="check-square" class="w-4 h-4 mr-1"></i>-->
                            <!--</a>-->
                            <!-- trigger modal -->
                            <button class="flex items-center tooltip text-danger" data-tw-toggle="modal" data-theme="light" title="Hapus" data-tw-target="#hapus{{ $keluar->id_bahanKeluar }}">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                            </button>
                            <!-- BEGIN: Delete Confirmation Modal -->
                            <div id="hapus{{ $keluar->id_bahanKeluar }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <form action="{{ route('bahanKeluar.destroy', $keluar->id_bahanKeluar) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-5 text-center">
                                                    <i data-feather="trash-2" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                    <div id="exampleModalLabel" class="text-3xl mt-5">Apakah yakin akan menghapus bahan {{ $keluar->nm_bahan }}?</div>
                                                    <div class="text-slate-500 mt-2">Data yang dihapus tidak dapat dikembalikan!</div>
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
            <!-- buat untuk total keseluruhan -->
            <tfoot>
                <tr class="font-bold">
                    <td colspan="6" class="text-left">Total</td>
                    <td class="text-center">{{ 'Rp. ' . number_format($bahanKeluar->sum('total')) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <div class="w-full sm:w-auto sm:mr-auto">
            {{ $bahanKeluar->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->
</div>

<!-- BEGIN: Notification Content -->
<div id="success-notification-content" class="toastify-content hidden flex">
    <i class="text-success" data-feather="check-circle"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium">Data Berhasil Di simpan Saved!</div>
        <div class="text-slate-500 mt-1">The message will be sent in 5 minutes.</div>
    </div>
</div>
<!-- END: Notification Content -->
@endsection