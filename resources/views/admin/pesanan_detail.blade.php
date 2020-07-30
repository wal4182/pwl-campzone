@extends('layouts.admin')
@section('konten')

<div class="container-fluid p-4">
  <h3 class="text-center mb-3">Detail Pesanan</h3>
  @if(!empty($pesanan_detail))
  <div class="table">
    <table class="table table-bordered table-hover">
      <tr class="text-center">
        <th>No.</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Pinjam</th>
        <th>Kembali</th>
        <th>Harga</th>
      </tr>

      @foreach ($pesanan_detail as $p)
      @if($p == $pesanan_detail->first())
      <div class="row mb-3">
        <div class="col-md-6">
          Nama : {{$p->pesanan->user->name}} <br>
          No Transaksi: {{$p->id}} <br>
          No. HP: {{$p->pesanan->user->hp}} <br>
          No. KTP: {{$p->pesanan->user->no_ktp}} <br>
          Alamat: {{$p->pesanan->user->alamat}} <br>
        </div>
        <div class="col-md-6 text-right">
          Tanggal Transaksi: {{date('d-M-Y', strtotime($p->created_at))}}<br>
          Total Belanja: Rp. {{number_format($p->pesanan->total_harga)}}<br>
        </div>
      </div>
      @endif

      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->produk->nama_produk }}</td>
        <td>{{ $p->jumlah }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>{{ $p->tanggal_kembali }}</td>
        <td>Rp. {{ number_format($p->jumlah_harga) }}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="5" class="text-right">
          <strong>Total</strong>
        </td>
        <td>
          <strong>Rp. {{number_format($p->pesanan->total_harga)}}</strong>
        </td>
      </tr>
    </table>
  </div>
  @endif

</div>

@endsection
