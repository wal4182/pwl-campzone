@extends('layouts.client')
@section('konten')

<div class="container mb-4 mt-4">
  <div class="col-md-10 m-auto">
    <a href="{{ url()->previous() }}" class="nav-item nav-link text-secondary">
      <i class="fas fa-arrow-left mr-3"></i>Kembali
    </a>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{$produk->brand->nama_brand}} {{$produk->nama_produk}}</h4>
        <div class="row">
          <div class="col-md-5 m-auto">
            <div class="rental-imgBox">
              <img src="{{ asset('img/produk/'.$produk->foto) }}" alt="">
            </div>
          </div>
          <div class="col-md-7">
            <table class="table">
              <tbody>
                <tr>
                  <td>Nama Produk</td>
                  <td>:</td>
                  <td>{{$produk->brand->nama_brand}} {{$produk->nama_produk}}</td>
                </tr>
                <tr>
                  <td>Deskripsi</td>
                  <td>:</td>
                  <td>{{$produk->deskripsi}}</td>
                </tr>
                <tr>
                  <td>Brand</td>
                  <td>:</td>
                  <td>{{$produk->brand->nama_brand}}</td>
                </tr>
                <tr>
                  <td>Kategori</td>
                  <td>:</td>
                  <td>{{$produk->kategori->kategori}}</td>
                </tr>
                <tr>
                  <td>Spesifikasi</td>
                  <td>:</td>
                  <td>{{$produk->spesifikasi}}</td>
                </tr>
                <tr>
                  <td>Harga Sewa</td>
                  <td>:</td>
                  <td>{{number_format($produk->harga_sewa)}}/hari</td>
                </tr>
                <tr>
                  <td>Stok</td>
                  <td>:</td>
                  @if($produk->stok == 0)
                  <td>Stok Habis</td>
                  @else
                  <td>{{$produk->stok}}</td>
                  @endif
                </tr>
              </tbody>
            </table>
            @if($produk->stok == 0) <a class="btn btn-warning disabled" href="{{url('rental')}}/{{$produk->id}}">
              Tidak Tersedia</a>
            @else
            <a class="btn btn-warning" href="{{url('rental')}}/{{$produk->id}}">Rental</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
