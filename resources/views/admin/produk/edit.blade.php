@extends('layouts.admin')

@section('konten')
<div class="container-fluid p-4">
  <h4 class="mt-3 mb-3 text-center">Edit Produk</h4>


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
        <form action="{{ route('list-produk.update',$produk->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" name="nama_produk" required="required" class="form-control"
              value="{{$produk->nama_produk}}">
          </div>

          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" id="" name="kategori_id">
              <option selected disabled>Pilih Kategori
              </option>
              @foreach ($kategori as $k)
              <option value="{{$k->id}}" @if ($k->id === $produk->kategori_id)
                selected
                @endif
                > {{ $k->kategori }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="brand">Brand</label>
            <select class="form-control" id="" name="brand_id">
              <option selected disabled>Pilih Brand
              </option>
              @foreach ($brand as $b)
              <option value="{{$b->id}}" @if ($b->id === $produk->brand_id)
                selected
                @endif
                > {{ $b->nama_brand }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="harga_sewa">Harga Sewa</label>
            <input type="number" name="harga_sewa" required="required" class="form-control"
              value="{{$produk->harga_sewa}}">
          </div>
          <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" name="stok" required="required" class="form-control" value="{{$produk->stok}}">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="2">{{$produk->deskripsi}}</textarea>
          </div>
          <div class="form-group">
            <label for="spesifikasi">Spesifikasi</label>
            <textarea name="spesifikasi" class="form-control" rows="3">{{$produk->spesifikasi}}</textarea>
          </div>

          <div class="form-group">
            <label for="foto">Foto Produk</label>
            <input type="file" class="form-control-file" name="foto">
          </div>
          <input type="submit" class="btn btn-warning" value="Update">
          <a href="{{ route('list-produk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
