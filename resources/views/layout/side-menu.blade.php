@php
use App\Models\Karyawan;
use App\Models\Sopir;

$karyawan = Karyawan::where('nip', Auth::user()->nip)
->join('jabatan', 'jabatan.id_jabatan', '=', 'karyawan.kd_jabatan')
->select('karyawan.*', 'jabatan.nm_jabatan')
->first();

$sopir = Sopir::where('no_ktp', Auth::user()->nip)->first();
@endphp
@extends('../layout/main')

@section('head')
@yield('subhead')
@endsection

@section('content')
@include('../layout/components/mobile-menu')
@include('../layout/components/top-bar')
@include('sweetalert::alert')

<div class="wrapper">
    <div class="wrapper-box">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <ul>
                <li>
                    <a href="/dashboard" class="side-menu {{ Request::is('/') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon">
                            <i data-feather="home"></i>
                        </div>
                        <div class="side-menu__title">
                            Dashboard
                        </div>
                    </a>
                </li>

                <li class="side-nav__devider my-6"></li>

                @can('backoffice')

                <li>
                    <a href="/jabatan" class="side-menu {{ Request::is('jabatan*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon">
                            <i data-feather="award"></i>
                        </div>
                        <div class="side-menu__title">
                            Jabatan
                        </div>
                    </a>
                </li>

                <li>
                    <a href="/karyawan" class="side-menu {{ Request::is('karyawan*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon">
                            <i data-feather="users"></i>
                        </div>
                        <div class="side-menu__title">
                            Data Karyawan
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu {{ Request::is('dataBahan*', 'bahanMasuk*', 'bahanKeluar*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon">
                            <i data-feather="box"></i>
                        </div>
                        <div class="side-menu__title">
                            Bahan Baku
                            <div class="side-menu__sub-icon {{ Request::is('dataBahan*', 'bahanMasuk*', 'bahanKeluar*') ? 'transform rotate-180' : '' }}">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class=" {{ Request::is('dataBahan*', 'bahanMasuk*', 'bahanKeluar*') ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <a href="/dataBahan" class="side-menu {{ Request::is('dataBahan*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="box"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data Bahan
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/bahanMasuk" class="side-menu {{ Request::is('bahanMasuk*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="box"></i>
                                </div>
                                <div class="side-menu__title">
                                    Pembelian Bahan
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/bahanKeluar" class="side-menu {{ Request::is('bahanKeluar*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="box"></i>
                                </div>
                                <div class="side-menu__title">
                                    Pemakaian Bahan
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="side-menu {{ Request::is('resep*', 'produkJadi*', 'produkMasuk*', 'produkKeluar*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon">
                            <i data-feather="package"></i>
                        </div>
                        <div class="side-menu__title">
                            Produk
                            <div class="side-menu__sub-icon {{ Request::is('resep*', 'produkJadi*', 'produkMasuk*', 'produkKeluar*') ? 'transform rotate-180' : '' }}">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class=" {{ Request::is('resep*', 'produkJadi*', 'produkMasuk*', 'produkKeluar*') ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <a href="/resep" class="side-menu {{ Request::is('resep*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="package"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data Resep
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/produkJadi" class="side-menu {{ Request::is('produkJadi*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="package"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data Produk
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/produkMasuk" class="side-menu {{ Request::is('produkMasuk*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="package"></i>
                                </div>
                                <div class="side-menu__title">
                                    Pembuatan Produk
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/produkKeluar" class="side-menu {{ Request::is('produkKeluar*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="package"></i>
                                </div>
                                <div class="side-menu__title">
                                    Penjualan Produk
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/riwayat-transaksi" class="side-menu {{ Request::is('riwayat-transaksi*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="inbox"></i>
                                </div>
                                <div class="side-menu__title">
                                    Riwayat Transaksi
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="side-menu {{ Request::is('pengirimanProduk*', 'terkirimProduk*' , 'sopir*', 'mobil*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon">
                            <i data-feather="truck"></i>
                        </div>
                        <div class="side-menu__title">
                            Pengiriman
                            <div class="side-menu__sub-icon {{ Request::is('pengirimanProduk*', 'terkirimProduk*' , 'sopir*', 'mobil*') ? 'transform rotate-180' : '' }}">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class=" {{ Request::is('pengirimanProduk*', 'terkirimProduk*' , 'sopir*', 'mobil*') ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <a href="/pengirimanProduk" class="side-menu {{ Request::is('pengirimanProduk*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="truck"></i>
                                </div>
                                <div class="side-menu__title">
                                    Pengiriman Produk
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/lokasiPengiriman" class="side-menu {{ Request::is('lokasiPengiriman*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="truck"></i>
                                </div>
                                <div class="side-menu__title">
                                    Lokasi Pengiriman
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/sopir" class="side-menu {{ Request::is('sopir*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="truck"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data Sopir
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/mobil" class="side-menu {{ Request::is('mobil*') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="truck"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data Mobil
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            </li>
            @if ($karyawan !== null || $sopir !== null)
            <li>
                <a href="/UserProfile" class="side-menu {{ Request::is('karyawan*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="user"></i>
                    </div>
                    <div class="side-menu__title">
                        Profile
                    </div>
                </a>
            </li>
            @endif
            @endcan

            @can('gudang')

            <li>
                <a href="/dataBahan" class="side-menu {{ Request::is('dataBahan*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Data Bahan
                    </div>
                </a>
            </li>

            <li>
                <a href="/bahanMasuk" class="side-menu {{ Request::is('bahanMasuk*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Pembelian Bahan
                    </div>
                </a>
            </li>

            <li>
                <a href="/bahanKeluar" class="side-menu {{ Request::is('bahanKeluar*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Pemakaian Bahan
                    </div>
                </a>
            </li>
            @if ($karyawan !== null || $sopir !== null)
            <li>
                <a href="/UserProfile" class="side-menu {{ Request::is('karyawan*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="user"></i>
                    </div>
                    <div class="side-menu__title">
                        Profile
                    </div>
                </a>
            </li>
            @endif

            @endcan

            @can('produksi')

            <li>
                <a href="/resep" class="side-menu {{ Request::is('resep*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Data Resep
                    </div>
                </a>
            </li>

            <li>
                <a href="/produkJadi" class="side-menu {{ Request::is('produkJadi*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Data Produk
                    </div>
                </a>
            </li>

            <li>
                <a href="/produkMasuk" class="side-menu {{ Request::is('produkMasuk*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Pembuatan Produk
                    </div>
                </a>
            </li>

            <li>
                <a href="/produkKeluar" class="side-menu {{ Request::is('produkKeluar*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Penjualan Produk
                    </div>
                </a>
            </li>

            @if ($karyawan !== null || $sopir !== null)
            <li>
                <a href="/UserProfile" class="side-menu {{ Request::is('karyawan*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="user"></i>
                    </div>
                    <div class="side-menu__title">
                        Profile
                    </div>
                </a>
            </li>
            @endif

            @endcan

            @can('distribusi')

            <li>
                <a href="/produkJadi" class="side-menu {{ Request::is('produkJadi*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="clipboard"></i>
                    </div>
                    <div class="side-menu__title">
                        Data Produk
                    </div>
                </a>
            </li>

            <li>
                <a href="/pengirimanProduk" class="side-menu {{ Request::is('pengirimanProduk*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="truck"></i>
                    </div>
                    <div class="side-menu__title">
                        Pengiriman Produk
                    </div>
                </a>
            </li>

            <li>
                <a href="/lokasiPengiriman" class="side-menu {{ Request::is('lokasiPengiriman*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="truck"></i>
                    </div>
                    <div class="side-menu__title">
                        Lokasi Pengiriman
                    </div>
                </a>
            </li>

            <li>
                <a href="/sopir" class="side-menu {{ Request::is('sopir*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="clipboard"></i>
                    </div>
                    <div class="side-menu__title">
                        Data Sopir
                    </div>
                </a>
            </li>

            <li>
                <a href="/mobil" class="side-menu {{ Request::is('mobil*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="clipboard"></i>
                    </div>
                    <div class="side-menu__title">
                        Data Mobil
                    </div>
                </a>
            </li>

            @if ($karyawan !== null || $sopir !== null)
            <li>
                <a href="/UserProfile" class="side-menu {{ Request::is('karyawan*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="user"></i>
                    </div>
                    <div class="side-menu__title">
                        Profile
                    </div>
                </a>
            </li>
            @endif

            @endcan

            @can('sopir')
            <li>
                <a href="/pengirimanProduk" class="side-menu {{ Request::is('pengirimanProduk*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="truck"></i>
                    </div>
                    <div class="side-menu__title">
                        Pengiriman Produk
                    </div>
                </a>
            </li>

            @if ($karyawan !== null || $sopir !== null)
            <li>
                <a href="/UserProfile" class="side-menu {{ Request::is('karyawan*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="user"></i>
                    </div>
                    <div class="side-menu__title">
                        Profile
                    </div>
                </a>
            </li>
            @endif

            @endcan

            @can('kasir')
            <li>
                <a href="/produkJadi" class="side-menu {{ Request::is('produkJadi*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Produk
                    </div>
                </a>
            </li>
            <li>
                <a href="/pos" class="side-menu {{ Request::is('pos') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        POS System
                    </div>
                </a>
            </li>
            <li>
                <a href="/riwayat-transaksi" class="side-menu {{ Request::is('riwayat-transaksi*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="inbox"></i>
                    </div>
                    <div class="side-menu__title">
                        Riwayat Transaksi
                    </div>
                </a>
            </li>

            @if ($karyawan !== null || $sopir !== null)
            <li>
                <a href="/UserProfile" class="side-menu {{ Request::is('karyawan*') ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon">
                        <i data-feather="user"></i>
                    </div>
                    <div class="side-menu__title">
                        Profile
                    </div>
                </a>
            </li>
            @endif
            @endcan

            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
</div>
@endsection