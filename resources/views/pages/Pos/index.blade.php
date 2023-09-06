@extends('../layout/' . $layout)

@section('subhead')
<title>{{ $tittle }} - Bread Smile</title>
@endsection

@section('subcontent')
<div class="mt-10">
    <h2 class="text-lg font-medium mr-auto">{{ $judul }}</h2>
</div>
<div class="intro-y grid grid-cols-12 gap-5 mt-5">
    <!-- BEGIN: Item List -->
    <div class="intro-y col-span-12 lg:col-span-8">
        <div class="lg:flex intro-y">
            <form action="">
                <div class="relative">
                    <input type="text" class="form-control py-3 px-4 w-full lg:w-64 box pr-10" placeholder="Search item..." autocomplete="off" name="search" value="{{ request('search') }}">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 text-slate-500" data-feather="search"></i>
                </div>
            </form>
            <!-- <select class="form-select py-3 px-4 box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
                <option>Sort By</option>
                <option>A to Z</option>
                <option>Z to A</option>
                <option>Lowest Price</option>
                <option>Highest Price</option>
            </select> -->
        </div>

        {{-- display produk --}}
        <div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t">
            @foreach ($produk as $p)
            @if ($p->harga_jual != 0 && $p->modal != 0) <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#produk{{ $p->kd_produk }}" class="intro-y block col-span-12 sm:col-span-4 2xl:col-span-3">
                    <div class="box rounded-md p-3 relative zoom-in">
                        <div class="flex-none relative block before:block before:w-full before:pt-[100%]">
                            <div class="absolute top-0 left-0 w-full h-full image-fit">
                                <img alt="Roti" class="rounded-md" src="{{ asset('images/'.$p->foto) }}">
                            </div>
                        </div>
                        <div class="block font-medium text-center truncate mt-3">{{ $p->nm_produk }}</div>
                        <div class="block font-medium text-center truncate mt-3">Rp {{ number_format($p->harga_jual, 0, ',', '.') }}</div>
                    </div>
                    </a>
                    @endif
                    @endforeach
        </div>
        {{-- end display produk --}}

    </div>
    <!-- END: Item List -->

    <!-- BEGIN: Ticket -->
    <div class="col-span-12 lg:col-span-4">
        <div class="intro-y pr-1">
            <div class="box p-2">
                <ul class="nav nav-pills" role="tablist">
                    <li id="ticket-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#ticket" type="button" role="tab" aria-controls="ticket" aria-selected="true">
                            Pesan
                        </button>
                    </li>
                    <li id="details-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">
                            Kwitansi
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="ticket" class="tab-pane active" role="tabpanel" aria-labelledby="ticket-tab">

                {{-- data order sementara --}}
                <div class="box p-2 mt-5">
                    <div class="flex mt-2 ml-1 pl-1 pb-2 border-b-2">
                        <div class="font-medium">Item</div>
                    </div>
                    @foreach ($temp as $tmp)
                    <div class="flex items-center p-3 transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 dark:hover:bg-darkmode-400 rounded-md">
                        <div class="max-w-[50%] truncate mr-1">{{ $tmp->nm_produk }}</div>
                        <div class="text-slate-500"><span class="bg-success text-white p-1 rounded text-xs">x{{ $tmp->jumlah }}</span></div>
                        <div class="ml-auto font-medium">Rp {{ number_format($tmp->harga, 0, ',', '.') }}</div>
                        <i data-feather="edit" class="w-4 h-4 text-primary ml-5 cursor-pointer" data-tw-toggle="modal" data-tw-target="#edit_temp{{ $tmp->id }}"></i>
                        <form action="{{ route('temp_delete',$tmp->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <span class="text-danger my-auto ml-2">x</span>
                                {{-- <i data-feather="trash-2" class="w-4 h-4 text-danger ml-1"></i> --}}
                            </button>
                        </form>

                    </div>
                    @endforeach
                </div>
                {{-- end data order sementara --}}

                {{-- form total harga --}}
                <form action="{{ route('order_create') }}" method="POST">
                    @csrf
                    <div class="box p-5 mt-5">
                        <div class="flex">
                            <div class="mr-auto">Subtotal</div>
                            <div class="font-medium">Rp {{ number_format($sum, 0, ',', '.') }}</div>
                        </div>
                        @php
                        $pajak = $sum * 0.05;
                        $totalBayar = $pajak + $sum;
                        @endphp
                        <div class="flex mt-4">
                            <div class="mr-auto">Pajak</div>
                            <div class="font-medium">Rp {{ number_format($pajak, 0, ',', '.') }}</div>
                        </div>
                        <div class="flex mt-4 pt-4 border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="mr-auto font-medium text-base">Total</div>
                            <div class="font-medium text-base">Rp {{ number_format($totalBayar, 0, ',', '.') }}</div>
                            <input type="hidden" name="total" value="{{ $totalBayar }}">
                        </div>


                    </div>
                    <div class="box p-5 mt-5">
                        <input type="text" class="form-control w-full bg-slate-100 border-slate-200/60" name="bayar" placeholder="Bayar">
                    </div>


                    <div class="flex mt-5">
                        <button type="submit" class="btn btn-primary w-32 shadow-md">Simpan</button>
                </form>
                <form action="{{ route('temp_delete_all') }}" method="POST" class="ml-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn w-32 border-slate-300 dark:border-darkmode-400 text-slate-500">Clear Items</button>
                </form>

            </div>
            {{-- end form total harga --}}

        </div>

        {{-- data faktur pembelian --}}
        <div id="details" class="tab-pane" role="tabpanel" aria-labelledby="details-tab">
            @if (!empty($kwitansi) || $kwitansi == !null)
            <div class="box p-5 mt-5">
                <div class="text-center text-base">Pt. Bread Smile</div>
                <div class="text-center text-xs mt-1.5 mb-2">CSB Mall - Jl. Dr. Cipto Mangunkusumo No. 26, Kota Cirebon, Jawa Barat, Indonesia</div>
                <hr>
                <div class="flex mt-3 mb-1">
                    <div class="mr-auto">NOTA</div>
                    <div class="">{{ $kwitansi->no_kwitansi }}</div>
                </div>
                <div class="flex mb-1">
                    <div class="mr-auto">No. Referensi</div>
                    <div class="">{{ $kwitansi->no_referensi }}</div>
                </div>
                <div class="flex mb-1">
                    <div class="mr-auto">Kasir</div>
                    <div class="">{{ ucwords(auth()->user()->name) }}</div>
                </div>
                <div class="flex mb-3">
                    <div class="mr-auto"></div>
                    <div class="">{{ $kwitansi->created_at }}</div>
                </div>
                <hr>
                @php
                $details = App\Models\PosOrderDetail::join('produkjadi', 'pos_order_details.produk_id', '=', 'produkjadi.kd_produk')->select('pos_order_details.*', 'produkjadi.nm_produk')->where('order_id', $kwitansi->order_id)->get();

                $sumKwi = DB::table('pos_order_details')->where('order_id', $kwitansi->order_id)->sum('harga');
                @endphp
                @foreach ($details as $detail)
                <div class="flex mt-3 mb-1">
                    <div class="mr-auto"><span>{{ $detail->jumlah }}</span> {{ $detail->nm_produk }}</div>
                    <div class="">{{ $detail->harga }}</div>
                </div>
                @endforeach
                <hr>
                <div class="flex mt-2">
                    <div class="mr-auto">Subtotal</div>
                    <div class="font-medium">Rp {{ number_format($sumKwi, 0, ',', '.') }}</div>
                </div>
                @php
                $pajakKwi = $sumKwi * 0.05;
                $totalKwi = $pajakKwi + $sumKwi;
                @endphp
                <div class="flex mt-2">
                    <div class="mr-auto">Pajak</div>
                    <div class="font-medium">Rp {{ number_format($pajakKwi, 0, ',', '.') }}</div>
                </div>
                <div class="flex mt-2 pt-2 mb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="mr-auto font-medium text-base">Total</div>
                    <div class="font-medium text-base">Rp {{ number_format($totalKwi, 0, ',', '.') }}</div>
                </div>
                <hr>
                <div class="flex mt-2">
                    <div class="mr-auto">Bayar</div>
                    <div class="font-medium">Rp {{ number_format($kwitansi->bayar, 0, ',', '.') }}</div>
                </div>
                @php
                $kmbl = $kwitansi->bayar - $totalKwi;
                @endphp
                <div class="flex mt-2">
                    <div class="mr-auto">Kembalian</div>
                    <div class="font-medium">Rp {{ number_format($kmbl, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="mt-5 flex justify-end">
                <a href="/cetak-kwitansi" target="_blank">
                    <button type="submit" class="btn btn-primary shadow-md">
                        <i data-feather="printer" class="mr-1 w-4 h-4"></i> Print
                    </button>
                </a>
            </div>
            @endif

        </div>
        {{-- end data faktur pembelian --}}

    </div>
</div>
<!-- END: Ticket -->
</div>

<!-- BEGIN: New Order Modal -->
{{-- <div id="new-order-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">New Order</h2>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label">Name</label>
                    <input id="pos-form-1" type="text" class="form-control flex-1" placeholder="Customer name">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-2" class="form-label">Table</label>
                    <input id="pos-form-2" type="text" class="form-control flex-1" placeholder="Customer table">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-3" class="form-label">Number of People</label>
                    <input id="pos-form-3" type="text" class="form-control flex-1" placeholder="People">
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                <button type="button" class="btn btn-primary w-32">Create Ticket</button>
            </div>
        </div>
    </div>
</div> --}}
<!-- END: New Order Modal -->

{{-- modal order produk --}}
@foreach ($produk as $prdk)
<div id="produk{{ $prdk->kd_produk }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">{{ $prdk->nm_produk }}</h2>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <form action="{{ route('temp_create') }}" method="POST">
                    @csrf
                    <div class="col-span-12">
                        <label for="pos-form-4" class="form-label">Jumlah</label>
                        <div class="flex mt-2 flex-1">
                            <button type="button" id="kurang" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 mr-1">-</button>
                            <input id="jumlah" type="number" name="jumlah" class="form-control w-24 text-center" placeholder="Item quantity" min="1" value="1">
                            <button type="button" id="tambah" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 ml-1">+</button>
                        </div>
                        <input type="hidden" name="kd_produk" value="{{ $prdk->kd_produk }}">
                    </div>

                    {{-- <div class="col-span-12">
                    <label for="pos-form-5" class="form-label">Notes</label>
                    <textarea id="pos-form-5" class="form-control w-full mt-2" placeholder="Item notes"></textarea>
                </div> --}}
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                <button type="submit" class="btn btn-primary w-24">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- modal edit temp --}}
@foreach ($temp as $tmp)
<div id="edit_temp{{ $tmp->id }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">{{ $tmp->nm_produk }}</h2>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <form action="{{ route('temp_update',$tmp->id) }}" method="POST">
                    @csrf
                    <div class="col-span-12">
                        <label for="pos-form-4" class="form-label">Jumlah</label>
                        <div class="flex mt-2 flex-1">
                            <button type="button" id="kurang" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 mr-1">-</button>
                            <input id="jumlah" type="number" name="jumlah" class="form-control w-24 text-center" placeholder="Item quantity" min='1' value="{{ $tmp->jumlah }}">
                            <button type="button" id="tambah" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 ml-1">+</button>
                        </div>
                    </div>
                    <input type="hidden" name="kd_produk" value="{{ $tmp->produk_id }}">


                    {{-- <div class="col-span-12">
                    <label for="pos-form-5" class="form-label">Notes</label>
                    <textarea id="pos-form-5" class="form-control w-full mt-2" placeholder="Item notes"></textarea>
                </div> --}}
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                <button type="submit" class="btn btn-primary w-24">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- menjadikan button tambah dan kurang -->
<script>
    $(document).ready(function() {
        $('#tambah').click(function() {
            var jumlah = $('#jumlah').val();
            jumlah++;
            $('#jumlah').val(jumlah);
        });
        $('#kurang').click(function() {
            var jumlah = $('#jumlah').val();
            jumlah--;
            $('#jumlah').val(jumlah);
        });
    });
</script>

@endsection