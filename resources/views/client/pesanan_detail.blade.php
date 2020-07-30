@extends('layouts.client')
@section('konten')

<div class="container">
  <div class="text-center mb-3">
    <h3 class="text-center">Detail Pesanan</h3>
    <a href="{{ url()->previous() }}" class="nav-item nav-link text-secondary">
      <i class="fas fa-arrow-left mr-3"></i>Kembali
    </a>
  </div>
  @if(!empty($pesanan_detail))
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
        No. Pesanan: {{$p->pesanan->id}} <br>
        No. HP: {{$p->pesanan->user->hp}} <br>
        No. KTP: {{$p->pesanan->user->no_ktp}} <br>
        Alamat: {{$p->pesanan->user->alamat}} <br>
      </div>
      <div class="col-md-6 text-right">
        Tanggal Transaksi: {{date('d-M-Y', strtotime($p->created_at))}}<br>
        <strong>Total Belanja: Rp. {{number_format($p->pesanan->total_harga)}}</strong><br>
      </div>
    </div>
    @endif

    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $p->produk->brand->nama_brand }} {{ $p->produk->nama_produk }}</td>
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
  @endif
</div>

</div>

@endsection
