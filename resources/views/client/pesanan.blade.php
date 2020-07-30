@extends('layouts.client')
@section('konten')
<div class="container">
  <div class="mt-3">
    <h4 class="mb-4">Riwayat Transaksi</h4>
    @if(!empty($pesanan))
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr class="text-center">
          <th>No.</th>
          <th>Tanggal Transaksi</th>
          <th>No. <br> Pesanan</th>
          <th>Total Harga</th>
          <th>Status Pembayaran</th>
          <th>Status Pengambilan</th>
          <th>Status Pengembalian</th>
          <th>Action</th>
        </tr>
        @foreach ($pesanan as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{date('d-M-Y, h:i:s', strtotime($p->updated_at))}}</td>
          <td>{{ $p->id }}</td>
          <td>Rp. {{ number_format($p->total_harga) }}</td>
          <td>
            @if ($p->status_pembayaran == 0)
            <p class="text-warning text-xs text-center mb-2">
              <i class="fas fa-clock mr-2"></i>Menunggu
            </p>
            @else
            <p class="text-success text-xs text-center mb-2"><i class="fas fa-check mr-2"></i>Dikonfirmasi
            </p>
            @endif
          </td>
          <td>
            @if ($p->status_pengambilan == 0)
            <p class="text-warning text-xs text-center mb-2">
              <i class="fas fa-clock mr-2"></i>Menunggu
            </p>
            @else
            <p class="text-success text-xs text-center mb-2"><i class="fas fa-check mr-2"></i>Dikonfirmasi
            </p>
            @endif
          </td>
          <td>
            @if ($p->status_pengembalian == 0)
            <p class="text-warning text-xs text-center mb-2">
              <i class="fas fa-clock mr-2"></i>Menunggu
            </p>
            @else
            <p class="text-success text-xs text-center mb-2"><i class="fas fa-check mr-2"></i>Dikonfirmasi
            </p>
            @endif
          </td>
          <td>
            <a href="pesanan-detail/{{$p->id}}" class="btn btn-success btn-xs">Detail Pesanan</a>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
    @endif
  </div>
</div>
@endsection
