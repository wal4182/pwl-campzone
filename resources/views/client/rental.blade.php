@extends('layouts.client')
@section('konten')
<div class="container mb-4 mt-4">
  <div class="col-md-10 m-auto">
    @if(session('gagal'))
    <div class="alert alert-danger text-center">
      {{session('gagal')}}
    </div>
    @endif
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
                  <td>Brandoduk</td>
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
                  <td>{{$produk->stok}}</td>
                </tr>
              </tbody>
            </table>
            <hr>
            <form action=" {{ url('rental') }}/{{$produk->id}}" method="POST">
              {{csrf_field()}}
              <div class="form-group pl-2 pr-2">
                <label for="tanggal pinjam">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" required="required" class="form-control" placeholder="">
              </div>
              <div class="form-group pl-2 pr-2">
                <label for="tanggal kembali">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" required="required" class="form-control" placeholder="">
              </div>
              <div class="form-group pl-2 pr-2">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" required="required" class="form-control" placeholder="">
              </div>
              <button type="submit" class="btn btn-warning mt-3 ml-2">
                <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
              </button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
