@extends('layouts.admin')
@section('konten')

<div class="container-fluid p-4">
  @if(session('sukses'))
  <div class="alert alert-success text-center">
    {{session('sukses')}}
  </div>
  @endif
  <h3 class="text-center">Pesanan</h3>
  @if(!empty($pesanan))
  <div class="table table-responsive">
    <table class="table table-bordered">
      <tr class="text-center">
        <th>No. Pesanan</th>
        <th>Tanggal Transaksi</th>
        <th>User</th>
        <th>Total Harga</th>
        <th>Bukti Pembayaran</th>
        <th>Status Pembayaran</th>
        <th>Status Pengambilan</th>
        <th>Status Pengembalian</th>
        <th>Detail</th>
      </tr>

      @foreach ($pesanan as $p)
      <tr>
        <td>{{ $p->id }}</td>
        <td>{{date('d-M-Y, h:s', strtotime($p->tanggal))}}</td>
        <td>{{$p->user->name}}</td>
        <td>Rp. {{ number_format($p->total_harga) }}</td>
        <td>
          <img src="{{asset('img/pembayaran/'.$p->bukti_pembayaran) }}" alt="" width="80px">
        </td>

        <td>
          @if($p->bukti_pembayaran == null)
          <button class="btn btn-warning btn-xs w-100 mb-2 disabled">
            Konfirmasi
          </button>
          </form>
          @elseif ($p->status_pembayaran == 0)
          <form action="pesanan/konfirmasi-pembayaran/{{$p->id}}" method="post">
            {{ csrf_field() }}
            <button type="hidden" name="status_pembayaran" value="1" class="btn btn-warning btn-xs w-100 mb-2">
              Konfirmasi
            </button>
          </form>
          @else
          <p class="text-success text-xs text-center mb-2"><i class="fas fa-check mr-2"></i>Dikonfirmasi</p>
          <form action="pesanan/batal-konfirmasi-pembayaran/{{$p->id}}" method="post">
            {{ csrf_field() }}
            <button type="hidden" name="status_pembayaran" value="0" class="btn btn-danger btn-xs w-100 mb-2">
              Batal
            </button>
          </form>
          @endif
        </td>

        <td>

          @if($p->status_pembayaran == 0)
          <button class="btn btn-warning btn-xs w-100 mb-2 disabled">
            Konfirmasi
          </button>
          @elseif ($p->status_pengambilan == 0)
          <form action="pesanan/konfirmasi-pengambilan/{{$p->id}}" method="post">
            {{ csrf_field() }}
            <button type="hidden" name="status_pengambilan" value="1" class="btn btn-warning btn-xs w-100 mb-2">
              Konfirmasi
            </button>
          </form>
          @else
          <p class="text-success text-xs text-center mb-2"><i class="fas fa-check mr-2"></i>Dikonfirmasi</p>
          <form action="pesanan/batal-konfirmasi-pengambilan/{{$p->id}}" method="post">
            {{ csrf_field() }}
            <button type="hidden" name="status_pengambilan" value="0" class="btn btn-danger btn-xs w-100 mb-2">
              Batal
            </button>
          </form>
          @endif
        </td>

        <td>
          @if($p->status_pengambilan == 0)
          <button class="btn btn-warning btn-xs w-100 mb-2 disabled">
            Konfirmasi
          </button>
          @elseif ($p->status_pengembalian == 0)
          <form action="pesanan/konfirmasi-pengembalian/{{$p->id}}" method="post">
            {{ csrf_field() }}
            <button type="hidden" name="status_pengembalian" value="1" class="btn btn-warning btn-xs w-100 mb-2">
              Konfirmasi
            </button>
          </form>
          @else
          <p class="text-success text-xs text-center mb-2"><i class="fas fa-check mr-2"></i>Dikonfirmasi</p>
          <form action="pesanan/batal-konfirmasi-pengembalian/{{$p->id}}" method="post">
            {{ csrf_field() }}
            <button type="hidden" name="status_pengembalian" value="0" class="btn btn-danger btn-xs w-100 mb-2">
              Batal
            </button>
          </form>
          @endif
        </td>
        <td>
          <a href="/admin/pesanan-detail/{{$p->id}}" class="btn btn-success btn-xs">Detail Pesanan</a>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
  @endif

</div>

@endsection
