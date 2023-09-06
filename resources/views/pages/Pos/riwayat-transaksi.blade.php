@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="intro-y mt-10">
    <h2 class="text-lg font-medium">{{ $judul }}</h2>
    <ol class="breadcrumb breadcrumb-dark mt-2 mr-auto ml-1">
        <li class="breadcrumb-item"><a href="" class="text-slate-600">{{ $menu }}</a></li>
    </ol>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center">
                    <i class="w-4 h-4" data-feather="plus"></i>
                </span>
            </button>
            <div class="dropdown-menu w-40">
                <ul class="dropdown-content">
                    <li>
                        <a href="/lap-transaksipenjualan-print" target="_blank" class="dropdown-item">
                            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                        </a>
                    </li>
                    <li>
                        <a href="/lap-transaksipenjualan-pdf" target="_blank" class="dropdown-item">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-slate-500"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-120 relative text-slate-500">
                <form action="/riwayat-transaksi/cari">
                    <input type="date" class="form-control w-56 box pr-10" placeholder="Search..." autocomplete="off" name="dari" >
                    <input type="date" class="form-control w-56 box pr-10" placeholder="Search..." autocomplete="off" name="sampai">
                    <button type="submit">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">NO.</th>
                    <th class="whitespace-nowrap text-center">No. Ref</th>
                    <th class="whitespace-nowrap text-center">Tanggal</th>
                    <th class="whitespace-nowrap text-center">Produk</th>
                    <th class="whitespace-nowrap text-center">Total</th>
                    <th class="whitespace-nowrap text-center">Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                <tr class="intro-x">
                    <td class="text-center">{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                    <td class="text-center">{{ $dt->no_referensi }}</td>
                    <td class="text-center">{{ date('d F Y', strtotime($dt->created_at)) }}</td>
                    <td class="text-center">
                        <div class="dropdown" data-tw-placement="bottom-start">
                            <a class="dropdown-toggle w-32 mr-1 cursor-pointer text-success text-" aria-expanded="false" data-tw-toggle="dropdown">Detail</a>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">
                                    @php
                                        $produk = App\Models\PosOrderDetail::join('produkjadi', 'pos_order_details.produk_id', '=', 'produkjadi.kd_produk')->select('pos_order_details.*', 'produkjadi.nm_produk')->where('order_id', $dt->id)->get(); 
                                    @endphp
                                    @foreach ($produk as $p)
                                        
                                    <li>
                                        <a class="dropdown-item">
                                            {{ $p->nm_produk. ' x'. $p->jumlah }}
                                        </a>
                                    </li>

                                    @endforeach

                            </div>
                        </div>
                    </td>
                    <td class="text-center">Rp {{ number_format($dt->total, 0, ',', '.') }}</td>
                    <td class="text-center">Rp {{ number_format($dt->bayar, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- END: Data List -->

    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <div class="w-full sm:w-auto sm:mr-auto">
            {{ $data->withQueryString()->links() }}
        </div>
    </div>
    <!-- END: Pagination -->

</div>
@endsection