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
        <a href="{{route ('produkKeluar.create') }}">
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
                        <a href="/lap-produkkeluar-print" target="_blank" class="dropdown-item">
                            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                        </a>
                    </li>
                    <li>
                        <a href="/lap-produkkeluar-excel" target="_blank" class="dropdown-item">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                        </a>
                    </li>
                    <li>
                        <a href="/lap-produkkeluar-pdf" target="_blank" class="dropdown-item">
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
        <table class="table table-report mt-2 table-fixed">
            <thead>
                <tr>
                    <!-- <th class="whitespace-nowrap">KODE PRODUK</th> -->
                    <!-- <th class="text-center whitespace-nowrap">RESEP</th> -->
                    <th class="text-center whitespace-nowrap">STATUS</th>
                    <th class="text-center whitespace-nowrap">NAMA PRODUK</th>
                    <!-- <th class="text-center whitespace-nowrap">PENCATAT</th> -->
                    <th class="text-center whitespace-nowrap">JUMLAH </th>
                    <th class="text-center whitespace-nowrap">TANGGAL PENJUALAN</th>
                    <!-- <th class="text-center whitespace-nowrap">TANGGAL EXPIRED</th> -->
                    <th class="text-center whitespace-nowrap">HARGA JUAL</th>
                    <th class="text-center whitespace-nowrap">TOTAL</th>
                    <!-- <th class="text-center whitespace-nowrap">KETERANGAN</th> -->
                    <th class="text-center whitespace-nowrap">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produkKeluar as $keluar)
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
                    <!-- <td class="text-center">{{ $keluar->kd_produk }}</td> -->
                    <!-- <td class="text-center">{{ $keluar->kd_resep }}</td> -->
                    <!-- status pengiriman produk -->
                    @if ($keluar->stts == 1)
                    <td class="text-center text-success">Dikirim</td>
                    @elseif ($keluar->stts == 0)
                    <td class="text-center text-danger">Belum Dikirim</td>
                    @endif
                    <td class="text-center">{{ $keluar->nm_produk }}</td>
                    <!-- <td class="text-center">{{ $keluar->name }}</td> -->
                    <td class="text-center">{{ $keluar->jumlah }} Pcs</td>
                    <!-- menampilkan format bulan dengan bahasa indonesia -->
                    <td class="text-center">{{ $tanggal }} {{ $bulan }} {{ $tahun }}</td>
                    <td class="text-center">Rp. {{ number_format($keluar->harga_jual, 0, ',', '.') }}</td>
                    <td class="text-center">Rp. {{ number_format($keluar->total, 0, ',', '.') }}</td>
                    <!-- <td class="text-center">{{ $keluar->ket }}</td> -->
                    <td class="table-report__action">
                        @if ($keluar->stts == 0)
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-2 tooltip text-success" title="Edit" data-theme="light" href="{{ route('produkKeluar.edit', $keluar->id_produkKeluar) }}">
                                <i data-feather="check-square" class="w-4 h-4"></i>
                            </a>
                            <!-- trigger modal -->
                            <button class="flex items-center tooltip text-danger" data-tw-toggle="modal" data-theme="light" title="Hapus" data-tw-target="#hapus{{ $keluar->id_produkKeluar }}">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                            </button>
                            <!-- BEGIN: Delete Confirmation Modal -->
                            <div id="hapus{{ $keluar->id_produkKeluar }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <form action="{{ route('produkKeluar.destroy', $keluar->id_produkKeluar) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="p-5 text-center">
                                                    <i data-feather="trash-2" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                                    <div id="exampleModalLabel" class="text-3xl mt-5">Apakah yakin akan menghapus produk {{ $keluar->nm_produk }}?</div>
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
                        @else
                        <button class="flex items-center text-danger mx-auto" data-tw-toggle="modal" data-tw-target="#why{{ $keluar->id_produkKeluar }}">
                            <i data-feather="slash" class="w-4 h-4 mx-auto"></i>
                        </button>
                        <!-- BEGIN: Confirmation Modal -->
                        <div id="why{{ $keluar->id_produkKeluar }}" class="modal pt-16" tabindex="-1" aria-hidden="true" varia-labelledby="exampleModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="p-5 text-center">
                                            <i data-feather="slash" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                            <div id="exampleModalLabel" class="text-3xl mt-5">Penjualan Produk Sudah Dikirim!</div>
                                            <div class="text-danger mt-2">Tidak dapat di modifikasi</div>
                                            <div class="text-slate-500 mt-2"><i>Kecuali dibatalkan oleh bagian pengiriman</i>!</div>
                                        </div>
                                        <div class="px-5 pb-8 text-center">
                                            <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24 mr-1">Oke</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Confirmation Modal -->
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="font-bold">
                    <td colspan="5" class="text-left">Total</td>
                    <td class="text-center">{{ 'Rp. ' . number_format($produkKeluar->sum('total')) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <div class="w-full sm:w-auto sm:mr-auto">
            {{ $produkKeluar->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->
</div>
@endsection