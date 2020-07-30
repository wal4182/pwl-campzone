@extends('layouts.client')
@section('konten')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 m-auto">
      @if(session('sukses'))
      <div class="alert alert-success mt-3">
        {{session('sukses')}}
      </div>
      @endif
      @if(!empty($pesanan) and $pesanan->total_harga != 0)
      <div class="card mt-3 mb-3">
        <div class="card-header">
          <h4 class="card-title">Keranjang Belanja</h4>
          <p align="right">Tanggal Pesan: {{date('d M Y', strtotime($pesanan->tanggal))}}</p>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Produk</th>
                <th>Harga Sewa</th>
                <th>Jumlah</th>
                <th>Pinjam</th>
                <th>Kembali</th>
                <th>Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pesanan_detail as $pd)
              <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{$pd->produk->brand->nama_brand}} {{ $pd->produk->nama_produk }}</td>
                <td>Rp. {{ number_format($pd->produk->harga_sewa) }}/hari</td>
                <td>{{ $pd->jumlah }} Produk</td>
                <td>{{date('d-M-Y', strtotime($pd->tanggal_pinjam))}}</td>
                <td>{{date('d-M-Y', strtotime($pd->tanggal_kembali))}}</td>
                <td>Rp. {{ number_format($pd->jumlah_harga) }}</td>
                <td>
                  <form action="{{url('checkout')}}/{{$pd->id}}" method="post">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Pesanan?');"><i
                        class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
              <tr>
                <th colspan="6">Total Harga</th>
                <th colspan="">Rp. {{ number_format($pesanan->total_harga) }}</th>
                <td>
                  <a href="{{ url('pembayaran') }}" class="btn btn-sm btn-success ml-auto">Pembayaran
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          @else
          <div class="row">
            <div class="col-md-6 m-auto">
              <div class="card mt-3 mb-3">
                <div class="card-header">
                  <h6><i class="fas fa-shopping-cart mr-3"></i>Keranjang Belanja Kosong</h6>
                </div>
                <div class="card-body">
                  <a href="produk" class="btn btn-warning">Belanja Sekarang</a>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
