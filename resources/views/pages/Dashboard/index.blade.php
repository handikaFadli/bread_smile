@extends('../layout/' . $layout)

@section('subhead')
<title>Dashboard - Bread Smile</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('subcontent')
@can('backoffice')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Data Keseluruhan</h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">

                    <a href="/karyawan" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-primary"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success cursor-pointer">
                                            <span class="pr-1">Data</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $karyawan }}</div>
                                <div class="text-base text-slate-500 mt-1">Karyawan</div>
                            </div>
                        </div>
                    </a>
                    <a href="/pengirimanProduk" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="truck" class="report-box__icon text-pending"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success cursor-pointer">
                                                <span class="pr-1">Data</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $pengirimanProduk }}</div>
                                    <div class="text-base text-slate-500 mt-1">Pengiriman</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/produkJadi" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="package" class="report-box__icon text-warning"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success cursor-pointer">
                                                <span class="pr-1">{{ $produkStok }} Pcs</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $produkJadi }}</div>
                                    <div class="text-base text-slate-500 mt-1">Jenis Roti</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/dataBahan" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="box" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success cursor-pointer">
                                                <span class="pr-1">{{ $stokBahan }} Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $dataBahan }}</div>
                                    <div class="text-base text-slate-500 mt-1">Jenis Bahan</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Laporan Produk</h2>
                    <!-- <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                        <i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                        <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                    </div> -->
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center mb-6">
                        <div class="flex">
                            <div>
                                <!-- menampilkan dalam bentuk rupiah $produkKeluar_lap_bulanIni -->
                                <div class="text-primary dark:text-slate-300 text-lg xl:text-xl font-medium">Rp. {{ number_format($produkKeluar_lap_bulanIni, 0, ',', '.') }}</div>
                                <div class="mt-0.5 text-slate-500">Penjualan Produk Bulan ini</div>
                            </div>
                            <div class="w-px h-12 border border-r border-dashed border-slate-200 dark:border-darkmode-300 mx-4 xl:mx-5"></div>
                            <div>
                                <div class="text-warning text-lg xl:text-xl font-medium">Rp. {{ number_format($produkMasuk_lap_bulanIni, 0, ',', '.') }}</div>
                                <div class="mt-0.5 text-slate-500">Pembuatan Produk Bulan ini</div>
                            </div>
                        </div>
                        <!-- <div class="dropdown xl:ml-auto mt-5 xl:mt-0">
                            <button class="dropdown-toggle btn btn-outline-secondary font-normal" aria-expanded="false" data-tw-toggle="dropdown">
                                Filter by Category <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i>
                            </button>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content overflow-y-auto h-32">
                                    <li><a href="" class="dropdown-item">PC & Laptop</a></li>
                                    <li><a href="" class="dropdown-item">Smartphone</a></li>
                                    <li><a href="" class="dropdown-item">Electronic</a></li>
                                    <li><a href="" class="dropdown-item">Photography</a></li>
                                    <li><a href="" class="dropdown-item">Sport</a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <div>
                        <canvas id="lineChart" height="200"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Roti Terlaris</h2>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="pieChart" height="300"></canvas>
                </div>
            </div>
            <!-- END: Weekly Top Seller -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Pengiriman Terbanyak</h2>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="doughnutChart" height="300"></canvas>
                </div>
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Official Store -->
            <div class="col-span-12 xl:col-span-6 mt-6">
                <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y mt-10">
                    <div class="box p-5 zoom-in">
                        <div class="flex items-center">
                            <div class="w-2/4 flex-none">
                                <div class="text-lg font-medium truncate">Keuntungan Bulan Ini</div>
                                <div class="text-slate-500 mt-1">Rp. {{ number_format($keuntungan, 0, ',', '.') }}</div>
                            </div>
                            <div class="flex-none ml-auto relative">
                                <img src="{{ asset('dist/images/profits.png') }}" alt="gambar diagram batang" width="95">
                                <div class="font-extrabold absolute w-full h-full flex items-center justify-center top-0 left-0 -ml-1">{{ $persentaseKeuntungan }} %</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y mt-4">
                    <div class="box p-5 zoom-in">
                        <div class="flex items-center">
                            <div class="w-2/4 flex-none">
                                <div class="text-lg font-medium truncate">Produk Terjual Bulan Ini</div>
                                <div class="text-slate-500 mt-1">{{ $produkTerjual }} Roti</div>
                            </div>
                            <div class="flex-none ml-auto relative">
                                <img src="{{ asset('dist/images/bread.png') }}" alt="gambar roti" width="95">
                                <div class="font-extrabold absolute w-full h-full flex items-center justify-center top-0 left-0">{{ $persentaseTerjual }} %</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Official Store -->
            <!-- BEGIN: Weekly Best Sellers -->
            <div class="col-span-12 xl:col-span-6 mt-4">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Sopir Terbaik Bulan ini</h2>
                </div>
                <div class="mt-5">
                    @foreach ($sopirTerbanyak as $st)
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                <img alt="Foto Sopir" src="{{ asset('images/'.$st->foto) }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">{{ $st->nm_sopir }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">{{ $st->jumlah}} kali Mengirim</div>
                            </div>
                            <div class="py-1 px-2 rounded-full text-xs bg-success text-white cursor-pointer font-medium">{{ $st->jumlah_produk }} Produk Dikirim</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // produkTerlaris
    let produkKeluar_lap_pie_label = @json($produkKeluar_lap_pie_label);
    let produkKeluar_lap_pie = @json($produkKeluar_lap_pie);
    // produkMasuk
    let labelsMasuk = @json($labelsMasuk);
    let jumlahMasuk = @json($jumlahMasuk);
    // produkKeluar
    let labels = @json($labels);
    let jumlah = @json($jumlah);
    // lokasiTerlaris
    let labelsLokasi = @json($labelsLokasi);
    let jumlahLokasi = @json($jumlahLokasi);


    let ctx = document.getElementById("lineChart");
    let myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelsMasuk,
            datasets: [{
                    label: "Pembuatan Produk",
                    lineTension: 0.5,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(255,165,0,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255,165,0,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(255,165,0,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: jumlahMasuk,
                },
                {
                    label: "Penjualan Produk",
                    lineTension: 0.5,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: jumlah,
                }
            ],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        fontSize: 10,
                        padding: 5,
                        callback: function(value, index, values) {
                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'start',
                }
            },
            responsive: true,
        }
    });

    let pctx = document.getElementById('pieChart');
    let myPieChart = new Chart(pctx, {
        type: 'pie',
        data: {
            labels: produkKeluar_lap_pie_label,
            datasets: [{
                label: 'Jumlah Roti Terjual',
                data: produkKeluar_lap_pie,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }],
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'start',
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    let dctx = document.getElementById('doughnutChart');
    let myDoughnutChart = new Chart(dctx, {
        type: 'doughnut',
        data: {
            labels: labelsLokasi,
            datasets: [{
                label: 'Produk Dikirim Ke Lokasi',
                data: jumlahLokasi,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }],
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'start',
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
@endcan
@can('gudang')
<!-- BEGIN: Important Notes -->
<div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto mt-3">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-auto">Dashboard</h2>
    </div>
    <div class="mt-5 intro-x">
        <div class="box zoom-in">
            <div class="container" id="important-notes">
                <div class="p-5">
                    <div class="font-medium text-3xl mb-2">{{ $sambutan }}!</div>
                    <hr>
                    <div class="font-medium text-lg mt-2">Selamat Datang {{ $user }} di Bagian {{ $role }}, Tetap Semangat dan Bahagia Selalu</div>
                    <div class="text-slate-500 text-justify mt-1"> <q>Satu-satunya cara untuk melakukan pekerjaan hebat yaitu dengan mencintai apa yang sedang kamu lakukan.</q> - Steve Jobs</div>
                    <div class="text-slate-400 mt-1">Pukul {{ $jam }}, {{ $tanggal }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Important Notes -->
<!-- BEGIN: General Report -->
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Data-data</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <a href="/bahanMasuk" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="box" class="report-box__icon text-primary"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-success cursor-pointer">
                                <span class="pr-1">Data</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $sumPembelian }} Kg</div>
                    <div class="text-base text-slate-500 mt-1">Pembelian Bahan</div>
                </div>
            </div>
        </a>
        <a href="/bahanKeluar" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="box" class="report-box__icon text-pending"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $sumPemakaian }} Kg</div>
                        <div class="text-base text-slate-500 mt-1">Pemakaian Bahan</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/dataBahan" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="box" class="report-box__icon text-warning"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $stokBahan }} Kg</div>
                        <div class="text-base text-slate-500 mt-1">Stok Bahan</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/dataBahan" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="box" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $dataBahan }}</div>
                        <div class="text-base text-slate-500 mt-1">Jenis Bahan</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- END: General Report -->
@endcan
@can('produksi')
<!-- BEGIN: Important Notes -->
<div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto mt-3">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-auto">Dashboard</h2>
    </div>
    <div class="mt-5 intro-x">
        <div class="box zoom-in">
            <div class="container" id="important-notes">
                <div class="p-5">
                    <div class="font-medium text-3xl mb-2">{{ $sambutan }}!</div>
                    <hr>
                    <div class="font-medium text-lg mt-2">Selamat Datang {{ $user }} di Bagian {{ $role }}, Tetap Semangat dan Bahagia Selalu</div>
                    <div class="text-slate-500 text-justify mt-1"> <q>Satu-satunya cara untuk melakukan pekerjaan hebat yaitu dengan mencintai apa yang sedang kamu lakukan.</q> - Steve Jobs</div>
                    <div class="text-slate-400 mt-1">Pukul {{ $jam }}, {{ $tanggal }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Important Notes -->
<!-- BEGIN: General Report -->
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Data-data</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <a href="/produkMasuk" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="package" class="report-box__icon text-primary"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-success cursor-pointer">
                                <span class="pr-1">Data</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $sumPenjualan }} Pcs</div>
                    <div class="text-base text-slate-500 mt-1">Penjualan Produk</div>
                </div>
            </div>
        </a>
        <a href="/produkKeluar" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="package" class="report-box__icon text-pending"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $sumProduksi }} Pcs</div>
                        <div class="text-base text-slate-500 mt-1">Pembuatan Produk</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/produkJadi" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="package" class="report-box__icon text-warning"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $produkStok }} Pcs</div>
                        <div class="text-base text-slate-500 mt-1">Stok Roti</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/produkJadi" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="package" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $produkJadi }}</div>
                        <div class="text-base text-slate-500 mt-1">Jenis Roti</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- END: General Report -->
@endcan
@can('distribusi')
<!-- BEGIN: Important Notes -->
<div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto mt-3">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-auto">Dashboard</h2>
    </div>
    <div class="mt-5 intro-x">
        <div class="box zoom-in">
            <div class="container" id="important-notes">
                <div class="p-5">
                    <div class="font-medium text-3xl mb-2">{{ $sambutan }}!</div>
                    <hr>
                    <div class="font-medium text-xl">Selamat Datang {{ $user }} di Bagian {{ $role }} Tetap Semangat dan Bahagia Selalu</div>
                    <div class="text-slate-500 text-justify mt-1"> <q>Satu-satunya cara untuk melakukan pekerjaan hebat yaitu dengan mencintai apa yang sedang kamu lakukan.</q> - Steve Jobs</div>
                    <div class="text-slate-400 mt-1">Pukul {{ $jam }}, {{ $tanggal }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Important Notes -->
<!-- BEGIN: General Report -->
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Data-data</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <a href="/sopir" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="user" class="report-box__icon text-primary"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-success cursor-pointer">
                                <span class="pr-1">Data</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $countSopir }} Orang</div>
                    <div class="text-base text-slate-500 mt-1">Jumlah Sopir</div>
                </div>
            </div>
        </a>
        <a href="/mobil" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="truck" class="report-box__icon text-pending"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $countMobil }} Mobil</div>
                        <div class="text-base text-slate-500 mt-1">Jumlah Mobil</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/pengirimanProduk" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="truck" class="report-box__icon text-warning"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $countPengiriman }} Pengiriman</div>
                        <div class="text-base text-slate-500 mt-1">Total Pengiriman</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/lokasiPengiriman" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="map-pin" class="report-box__icon text-success"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $countLokasi }} Lokasi</div>
                        <div class="text-base text-slate-500 mt-1">Jumlah Lokasi</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- END: General Report -->
@endcan
@can('kasir')
<!-- BEGIN: Important Notes -->
<div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto mt-3">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-auto">Dashboard</h2>
    </div>
    <div class="mt-5 intro-x">
        <div class="box zoom-in">
            <div class="container" id="important-notes">
                <div class="p-5">
                    <div class="font-medium text-3xl mb-2">{{ $sambutan }}!</div>
                    <hr>
                    <div class="font-medium text-lg mt-2">Selamat Datang {{ $user }} di Bagian {{ $role }}, Tetap Semangat dan Bahagia Selalu</div>
                    <div class="text-slate-500 text-justify mt-1"> <q>Satu-satunya cara untuk melakukan pekerjaan hebat yaitu dengan mencintai apa yang sedang kamu lakukan.</q> - Steve Jobs</div>
                    <div class="text-slate-400 mt-1">Pukul {{ $jam }}, {{ $tanggal }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Important Notes -->
<!-- BEGIN: General Report -->
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Data-data</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <a href="/riwayat-transaksi" class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="package" class="report-box__icon text-primary"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-success cursor-pointer">
                                <span class="pr-1">Data</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $countTransaksi }} Transaksi</div>
                    <div class="text-base text-slate-500 mt-1">Riwayat Transaksi</div>
                </div>
            </div>
        </a>
        <a href="/produkJadi" class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="package" class="report-box__icon text-pending"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $countSiapJual }} Produk</div>
                        <div class="text-base text-slate-500 mt-1">Produk Siap Jual</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/produkJadi" class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y">
            <div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="package" class="report-box__icon text-warning"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $countStokHabis }} Produk</div>
                        <div class="text-base text-slate-500 mt-1">Stok Kosong</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- END: General Report -->
@endcan
@can('sopir')
<!-- BEGIN: Important Notes -->
<div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto mt-3">
    <div class="intro-x flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-auto">Dashboard</h2>
    </div>
    <div class="mt-5 intro-x">
        <div class="box zoom-in">
            <div class="container" id="important-notes">
                <div class="p-5">
                    <div class="font-medium text-3xl mb-2">{{ $sambutan }}!</div>
                    <hr>
                    <div class="font-medium text-lg mt-2">Selamat Datang {{ $user }} di Bagian {{ $role }}, Tetap Semangat dan Bahagia Selalu</div>
                    <div class="text-slate-500 text-justify mt-1"> <q>Satu-satunya cara untuk melakukan pekerjaan hebat yaitu dengan mencintai apa yang sedang kamu lakukan.</q> - Steve Jobs</div>
                    <div class="text-slate-400 mt-1">Pukul {{ $jam }}, {{ $tanggal }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Important Notes -->
<!-- BEGIN: General Report -->
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Data-data</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <a href="/pengirimanProduk" class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-feather="package" class="report-box__icon text-primary"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-success cursor-pointer">
                                <span class="pr-1">Data</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $countPengirimanSopir }} kali</div>
                    <div class="text-base text-slate-500 mt-1">Total Pengiriman</div>
                </div>
            </div>
        </a>
        <a href="/pengirimanProduk" class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="package" class="report-box__icon text-pending"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $countLokasiSopir }} Lokasi</div>
                        <div class="text-base text-slate-500 mt-1">Lokasi Pengiriman</div>
                    </div>
                </div>
            </div>
        </a>
        <a href="/pengirimanProduk" class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y">
            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="package" class="report-box__icon text-pending"></i>
                            <div class="ml-auto">
                                <div class="report-box__indicator bg-success cursor-pointer">
                                    <span class="pr-1">Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">{{ $sumPengiriman }} Produk</div>
                        <div class="text-base text-slate-500 mt-1">Total Produk Dikirim</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<!-- END: General Report -->
@endcan
@endsection
