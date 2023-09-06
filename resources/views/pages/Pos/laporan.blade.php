<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="assets/css" /> --}}

    {{-- <style>
        body{
            font-family:'Times New Roman', Times, serif;
        }
        h3{
            letter-spacing: 1px;
            font-weight: 700;
        }
        h5{
            margin-top: -5px;
            margin-bottom: 30px;
        }
        header{
            border-bottom: 2px solid black;
        }
        header img{
            width: 195px;
            margin-left: 20px;
        }
    </style> --}}
    <style>

        header{
            text-align: center;
            border-bottom: 2px solid black;
        }

        header p {
            font-size: 35px;
            margin-bottom: 0px;
        }

        header span {
            display: block;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .body{
            text-align: center;
        }

        .body p {
            margin-top: 20px;
            font-size: 25px;
            margin-bottom: 5px;
        }

        .body span {
            display: block;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .body table {
            width: 100%;
            border: 1px solid grey;
        }

        .body table th {
            border-right: 1px solid grey;
            padding: 10px 0px;
        }

        .body table td {
            text-align: center;
            border-right: 1px solid grey;
            border-top: 1px solid grey;
            padding: 10px 0px;
        }

        footer table {
            margin-top: 20px;
            float: right;
        }

        footer td {
            align-items: center;
            text-align: center;
        }

        footer p {
            align-items: center;
            text-align: center;
        }

        footer img {
            width: 10%;
        }
    </style>

</head>
<body @isset($print) onload="javascript:window.print()" @endisset>
    {{-- <header class="">
        <div class="row">
            <div class="col-lg-2"><img src="{{ asset('images/logo.png') }}" class="mt-4"></div>
            <div class="col-lg-8">
                <h3 class="mt-4 pt-3">Pt. Bread Smile</h3>
                <h6 class="">CSB Mall - Jl. Dr. Cipto Mangunkusumo No. 26, Kota Cirebon, Jawa Barat, Indonesia</h6>
            </div>
        </div>
    </header> --}}

    {{-- <header class="text-center mx-auto">
        <h3 class="mt-5">Pt. Bread Smile</h3>
        <h5 class="">CSB Mall - Jl. Dr. Cipto Mangunkusumo No. 26, Kota Cirebon, Jawa Barat, Indonesia</h5>
    </header>

    <div class="body text-center">
        <div class="mb-4">
            <h4 class="mt-4">Laporan Pembelian Bahan</h4>
            <span>2022 - 2023</span>
        </div>
        <table class="table mx-auto">
            <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode</th>
                  <th>Nama Bahan</th>
                  <th>Tanggal Masuk</th>
                  <th>Harga Beli</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $dt)
                     <!-- menampilkan bulan dengan bahasa indonesia -->
                @php
                $bulanIndo = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];

                $tanggal = date('j', strtotime($dt->tgl_masuk));
                $bulan = $bulanIndo[date('n', strtotime($dt->tgl_masuk)) - 1];
                $tahun = date('Y', strtotime($dt->tgl_masuk));
                @endphp
                <tr>
                    <!-- agar nomer mengikuti pagination -->
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $dt->kd_bahan }}</td>
                    <td>{{ $dt->nm_bahan }}</td>
                    <td>{{ $tanggal }} {{ $bulan }} {{ $tahun }}</td>
                    <td>{{ 'Rp. ' . number_format($dt->harga_beli) }}</td>
                    <td>{{ $dt->jumlah }} Kg</td>
                    <td>{{ 'Rp. ' . number_format($dt->total) }}</td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </div> --}}

    

    <header>
        <p>Pt. Bread Smile</p>
        <span>CSB Mall - Jl. Dr. Cipto Mangunkusumo No. 26, Kota Cirebon, Jawa Barat, Indonesia</span>
    </header>

    <div class="body">
        <p>Laporan Transaksi Penjualan</p>
        <span>2023 - 2024</span>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th>No</th>
                <th>No. Ref</th>
                <th>Tanggal Transaksi</th>
                <th>Produk (Jumlah)</th>
                <th>Total</th>
                <th>Bayar</th>
            </tr>
            @foreach ($data as $dt)
                <tr class="intro-x">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $dt->no_referensi }}</td>
                    <td class="text-center">{{ date('d F Y', strtotime($dt->created_at)) }}</td>
                    <td class="text-center">
                        @php
                             $produk = App\Models\PosOrderDetail::join('produkjadi', 'pos_order_details.produk_id', '=', 'produkjadi.kd_produk')->select('pos_order_details.*', 'produkjadi.nm_produk')->where('order_id', $dt->id)->get();
                        @endphp
                        @foreach ($produk as $p)
                            {{ $p->nm_produk }} ({{ $p->jumlah }})<br>
                        @endforeach
                    </td>
                    <td class="text-center">Rp {{ number_format($dt->total, 0, ',', '.') }}</td>
                    <td class="text-center">Rp {{ number_format($dt->bayar, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <footer>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    Cirebon, <?= date('d F Y'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <p>{{'ttd. '. ucwords(auth()->user()->role) }}</p>
                </td>
            </tr>
        </table>
    </footer>
</body>
</html>
