<!-- agar menit tidak lebih dari 60 -->
@php
$hours = $produk->created_at->diffInHours($produk->updated_at);
$minutes = $produk->created_at->diffInMinutes($produk->updated_at) - ($hours * 60);
@endphp
<div id="info-{{ $produk->id_pengirimanProduk }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h3 class="font-medium text-base mr-auto">Detail Pengiriman Produk</h3>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4">
                <div class="intro-y col-span-12 md:col-span-12 lg:col-span-12 border-2 border-slate-200/60 rounded-md shadow-lg shadow-slate-900">
                    <div class="box">
                        <div class="flex items-start px-5 pt-5 pb-5 border-b border-slate-400">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-20 h-20 rounded-lg overflow-hidden shadow-lg bg-no-repeat bg-local bg-top zoom-in scale-110">
                                    <img alt="Foto Produk" class="rounded-lg object-scale-down" src="{{ asset('images/'.$produk->foto) }}">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-large font-semibold">{{ $produk->nm_produk }} ({{ $produk->jumlah }} Pcs)</a>
                                    <div class="text-slate-500 text-xs mt-0.5">{{ $produk->kd_produk }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-left lg:text-left px-5 pb-5 pt-3">

                            <div class="flex items-center justify-start lg:justify-start text-slate-700 mt-3">
                                <i data-feather="bell" class="w-3 h-3 mr-2"></i>
                                @if ($produk->status == 0)
                                <span class="text-warning">Menunggu Konfirmasi Sopir</span>
                                @elseif ($produk->status == 1)
                                <span class="text-primary">Sedang Dikirim</span>
                                @elseif ($produk->status == 2)
                                <span class="text-success">Selesai</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-start lg:justify-start text-slate-700 mt-3">
                                <i data-feather="user" class="w-3 h-3 mr-2"></i> {{ $produk->nm_sopir }}
                            </div>
                            <div class="flex items-center justify-start lg:justify-start text-slate-700 mt-2">
                                <i data-feather="tool" class="w-3 h-3 mr-2"></i>Sebagai {{ ucwords($produk->role) }}
                            </div>
                            <div class="flex items-center justify-start lg:justify-start text-slate-700 mt-2">
                                <i data-feather="truck" class="w-3 h-3 mr-2"></i>Plat mobil ({{ $produk->plat_nomor }})
                            </div>
                            <div class="flex items-center justify-start lg:justify-start text-slate-700 mt-2 font-semibold">
                                <i data-feather="map-pin" class="w-3 h-3 mr-2"></i> Lokasi
                            </div>
                            @if ($produk->status == 2)
                            <div class="flex justify-start lg:justify-start text-slate-700 mt-1 pl-5">
                                Penerima : {{ $produk->nm_penerima }}
                            </div>
                            @endif
                            <div class="flex justify-start lg:justify-start text-slate-700 mt-1 pl-5">
                                Tempat : {{ $produk->tempat }}
                            </div>
                            <div class="flex justify-start lg:justify-start text-slate-700 mt-1 pl-5">
                                Alamat : {{ $produk->alamat }}
                            </div>
                            <div class="flex items-center justify-start lg:justify-start text-slate-700 mt-2 font-semibold">
                                <!-- format tanggal pengiriman agar menampilkan hari dan jam juga dari field created_at -->
                                <i data-feather="calendar" class="w-3 h-3 mr-2"></i> Tanggal Pengiriman
                            </div>
                            @if ($produk->status == 1 || $produk->status == 2)
                            <div class="flex justify-start lg:justify-start text-slate-700 mt-1 pl-5">
                                <!-- agar menampilkan tanggal dalam bahasa indonesia menggunakan isoFormat -->
                                {{ $produk->created_at->isoFormat('dddd, D MMMM Y') }}
                            </div>
                            <span class="text-xs text-slate-500 pl-5">(Pukul : {{ date('H:i', strtotime($produk->created_at)) }})</span>
                            @if ($produk->status == 1)
                            <span class="text-xs text-slate-500">({{ $produk->created_at->diffForHumans() }})</span>
                            @endif
                            @endif
                            <div class="flex items-center justify-start lg:justify-start text-slate-700 mt-2 font-semibold">
                                <!-- format tanggal pengiriman agar menampilkan hari dan jam juga dari field updated_at -->
                                <i data-feather="calendar" class="w-3 h-3 mr-2"></i> Tanggal Sampai
                            </div>
                            @if ($produk->status == 2)
                            <div class="flex justify-start lg:justify-start text-slate-700 mt-1 pl-5">
                                {{ $produk->updated_at->isoFormat('dddd, D MMMM Y') }}
                            </div>
                            <span class="text-xs text-slate-500 pl-5">(Pukul : {{ date('H:i', strtotime($produk->updated_at)) }})</span>
                            <span class="text-xs text-slate-500">({{ $produk->updated_at->diffForHumans() }})</span>
                            @endif
                            @if ($produk->status == 2)
                            <div class="flex items-center justify-start lg:justify-start text-slate-700 mt-2 font-semibold">
                                <!-- format tanggal pengiriman agar menampilkan hari dan jam juga dari field updated_at -->
                                <i data-feather="clock" class="w-3 h-3 mr-2"></i> Waktu Tempuh : <span class="text-slate-500"> {{ $hours }} Jam {{ $minutes }} Menit</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer mb-1">
                <button type="button" data-tw-dismiss="modal" class="btn btn-primary">Kembali</button>
            </div>
            </form>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>