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
        <a href="{{route ('bahanMasuk.create') }}">
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
                        <a href="/lap-bahanmasuk-print" target="_blank" class="dropdown-item">
                            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                        </a>
                    </li>
                    <li>
                        <a href="/lap-bahanmasuk-excel" target="_blank" class="dropdown-item">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                        </a>
                    </li>
                    <li>
                        <a href="/lap-bahanmasuk-pdf" target="_blank" class="dropdown-item">
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
                    <th class="text-center whitespace-nowrap">TANGGAL MASUK </th>
                    <th class="text-center whitespace-nowrap">HARGA BELI</th>
                    <th class="text-center whitespace-nowrap">JUMLAH</th>
                    <th class="text-center whitespace-nowrap">TOTAL</th>
                    <th class="text-center whitespace-nowrap">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahanMasuk as $masuk)
                <!-- menampilkan bulan dengan bahasa indonesia -->
                @php
                $bulanIndo = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];

                $tanggal = date('j', strtotime($masuk->tgl_masuk));
                $bulan = $bulanIndo[date('n', strtotime($masuk->tgl_masuk)) - 1];
                $tahun = date('Y', strtotime($masuk->tgl_masuk));
                @endphp
                <tr class="intro-x">
                    <!-- agar nomer mengikuti pagination -->
                    <td class="text-center">{{ $loop->iteration + ($bahanMasuk->currentPage() - 1) * $bahanMasuk->perPage() }}</td>
                    <td class="text-center">{{ $masuk->kd_bahan }}</td>
                    <td class="text-center">{{ $masuk->nm_bahan }}</td>
                    <td class="text-center">{{ $tanggal }} {{ $bulan }} {{ $tahun }}</td>
                    <td class="text-center">{{ 'Rp. ' . number_format($masuk->harga_beli) }}</td>
                    <td class="text-center">{{ $masuk->jumlah }} Kg</td>
                    <td class="text-center">{{ 'Rp. ' . number_format($masuk->total) }}</td>
                    <td class="table-report__action">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-2 tooltip text-success" data-theme="light" title="Edit" href="{{ route('bahanMasuk.edit', $masuk->id_bahanMasuk) }}">
                                <i data-feather="check-square" class="w-4 h-4"></i>
                            </a>
                            <!-- trigger modal -->
                            <button class="flex items-center tooltip text-danger" data-theme="light" title="Hapus" data-tw-toggle="modal" data-tw-target="#hapus{{ $masuk->id_bahanMasuk }}">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                            </button>
                            <!-- BEGIN: Delete Confirmation Modal -->
                            <div id="hapus{{ $masuk->id_bahanMasuk }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <form action="{{ route('bahanMasuk.destroy', $masuk->id_bahanMasuk) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-5 text-center">
                                                    <i data-feather="trash-2" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                    <div id="exampleModalLabel" class="text-2xl mt-5">Apakah yakin akan menghapus bahan <br> {{ $masuk->nm_bahan }}?</div>
                                                    <div class="mt-3">
                                                        <span class="text-danger">*data yang dihapus tidak dapat dikembalikan!</span>
                                                    </div>
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
                    <td class="text-center">{{ 'Rp. ' . number_format($bahanMasuk->sum('total')) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <div class="w-full sm:w-auto sm:mr-auto">
            {{ $bahanMasuk->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->
</div>
@endsection