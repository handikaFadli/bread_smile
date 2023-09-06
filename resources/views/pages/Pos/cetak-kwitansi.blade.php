<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Bukti Pembayaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
  .container{
    border-bottom: 1px dashed gray;
    border-top: 1px dashed gray;
  }
  tbody{
    border-bottom: 1px dashed gray;
  }
</style>
<body onload="javascript:window.print()" style="margin: 0 auto; width: 350px">
  <div class="card mt-5">
    <div class="card mt-3 p-3 pb-0 border-0 mb-2">
      <h4 class="text-center">Pt. Bread Smile</h4>
      <small class="text-center">CSB Mall - Jl. Dr. Cipto Mangunkusumo No. 26, Kota Cirebon, Jawa Barat, Indonesia</small>
    </div>
    <div class="container">
      <div class="row g-2" style="font-size: 15px;">
        <div class="col-8">
          <div class="p-3 border bg-white border-0"> <small> NOTA : <br> No. Ref : <br> Kasir : </small></div>
        </div>
        <div class="col-4">
          <div class="p-3 border bg-white border-0"><small> {{ $kwitansi->no_kwitansi }}<br> {{ $kwitansi->no_referensi }}<br> {{ ucwords(auth()->user()->name) }}<br> {{ $kwitansi->created_at }}</small></div>
        </div>
      </div>
    </div>
    <table class="text-center">
      <tbody>
        @php
            $details = App\Models\PosOrderDetail::join('produkjadi', 'pos_order_details.produk_id', '=', 'produkjadi.kd_produk')->select('pos_order_details.*', 'produkjadi.nm_produk')->where('order_id', $kwitansi->order_id)->get();

            $sumKwi = DB::table('pos_order_details')->where('order_id', $kwitansi->order_id)->sum('harga');
        @endphp
        <?php
        foreach ($details as $detail) {
        ?>
          <tr>
            <td colspan="3" class="text-start px-4 py-1"><span>{{ $detail->jumlah }}</span> {{ $detail->nm_produk }}</td>
            <td class="text-end px-4">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot class="table-borderless">
        <tr>
          <td colspan="3" class="text-start px-4 pt-2">SubTotal</td>
          <td class="text-end px-4">Rp {{ number_format($sumKwi, 0, ',', '.') }}</td>
        </tr>
        @php
            $pajakKwi = $sumKwi * 0.05;
            $totalKwi = $pajakKwi + $sumKwi;
        @endphp
        <tr>
          <td colspan="3" class="text-start px-4 pt-1">Pajak</td>
          <td class="text-end px-4">Rp {{ number_format($pajakKwi, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td colspan="3" class="text-start px-4 py-2 fw-semibold">Total</td>
          <td class="text-end px-4 fw-semibold">Rp {{ number_format($totalKwi, 0, ',', '.') }}</td>
        </tr>
        <tr>
          <td colspan="3" class="text-start px-4">Bayar</td>
          <td class="text-end px-4">Rp {{ number_format($kwitansi->bayar, 0, ',', '.') }}</td>
        </tr>
        @php
            $kmbl = $kwitansi->bayar - $totalKwi;
        @endphp
        <tr>
          <td colspan="3" class="text-start px-4 pt-1">Kembalian</td>
          <td class="text-end px-4">Rp {{ number_format($kmbl, 0, ',', '.') }}</td>
        </tr>
      </tfoot>
    </table>
    <div class="card mt-3 p-3 pb-0 border-0">
      <h6 class="text-center">*TERIMA KASIH*</h6>
    </div>
    @php
        $kwitansi->status = 2;
        $kwitansi->update();
    @endphp
  </div>
</body>
{{-- @if (!empty($kwitansi) || $kwitansi == !null)
<div class="box p-5 mt-5">
    <div class="text-center text-base">Pt. Bread Smile</div>
    <div class="text-center text-xs mt-1.5 mb-2">CSB Mall - Jl. Dr. Cipto Mangunkusumo No. 26, Kota Cirebon, Jawa Barat, Indonesia</div>
    <hr>
    <div class="flex mt-3 mb-1">
        <div class="mr-auto">No. Kwitansi</div>
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
        $details = App\models\PosOrderDetail::join('produkJadi', 'pos_order_details.produk_id', '=', 'produkJadi.kd_produk')->select('pos_order_details.*', 'produkJadi.nm_produk')->where('order_id', $kwitansi->order_id)->get();

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
        <div class="mr-auto">Cash</div>
        <div class="font-medium">Rp {{ number_format($kwitansi->bayar, 0, ',', '.') }}</div>
    </div>
    @php
        $kmbl = $kwitansi->bayar - $totalKwi;
    @endphp
    <div class="flex mt-2">
        <div class="mr-auto">Change</div>
        <div class="font-medium">Rp {{ number_format($kmbl, 0, ',', '.') }}</div>
    </div>
</div>
@endif --}}