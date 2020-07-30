@extends('layouts.admin')

@section('konten')
<div class="container-fluid p-4">
  <h4 class="mt-3 mb-3 text-center">Tambah Produk</h4>

  <div class="col-md-6 mx-auto">

    <div class="card">
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <strong>Whoops!</strong> Periksa Kembali Inputan Anda.<br><br>
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('list-produk.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="kategori">Nama Produk</label>
            <input type="text" name="nama_produk" required="required" class="form-control" id="nama_produk"
              placeholder="Nama Produk">
          </div>
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" id="kategori_id" name="kategori_id">
              <option selected disabled>Pilih Kategori
              </option>
              @foreach ($kategori as $k)
              <option value="{{$k->id}}">{{ $k->kategori }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="brand">Brand</label>
            <select class="form-control" id="brand_id" name="brand_id">
              <option selected disabled>Pilih Brand
              </option>
              @foreach ($brand as $b)
              <option value="{{$b->id}}">{{ $b->nama_brand }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="harga_sewa">Harga Sewa</label>
            <input type="number" name="harga_sewa" required="required" class="form-control" id="harga_sewa">
          </div>
          <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" name="stok" required="required" class="form-control" id="stok">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="2"></textarea>
          </div>
          <div class="form-group">
            <label for="spesifikasi">Spesifikasi</label>
            <textarea name="spesifikasi" class="form-control" id="spesifikasi" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="foto">Foto Produk (max 2Mb)</label>
            <input type="file" class="form-control-file" id="foto" name="foto">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{ route('list-produk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
