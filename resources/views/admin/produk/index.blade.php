@extends('layouts.admin')

@section('konten')

<div class="container-fluid p-4">
  <h3 class="text-center">List Produk</h3>
  @if(session('sukses'))
  <div class="alert alert-success">
    {{session('sukses')}}
  </div>
  @endif
  <div class="mb-3">
    <a href="{{ route('list-produk.create') }}" class="btn btn-primary mt-2 mb-4 float-right"><i class="fa fa-plus">
      </i> Tambah Produk</a>
  </div>
  <div class="table table-responsive">
    <table id="produkTable" class="table table-bordered table-hover">
      <tr class="text-center">
        <th>No.</th>
        <th>Nama Produk</th>
        <th>Kategori</th>
        <th>Brand</th>
        <th>Harga Sewa Per Hari</th>
        <th>Stok</th>
        <th>Deskripsi</th>
        <th>Spesifikasi</th>
        <th>Foto Produk</th>
        <th>Aksi</th>
      </tr>

      @foreach ($produk as $p)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->nama_produk }}</td>
        <td>{{$p->kategori->kategori}}</td>
        <td>{{$p->brand->nama_brand}}</td>


        <td>Rp. {{ number_format($p->harga_sewa) }}</td>
        <td>{{ $p->stok }}</td>
        <td>{{ $p->deskripsi }}</td>
        <td>{{ $p->spesifikasi }}</td>
        <td>
          <img src="{{asset('img/produk/'.$p->foto) }}" alt="" width="80px">
        </td>
        <td class="text-center">
          <form action="{{ route('list-produk.destroy',$p->id) }}" method="POST">
            <a href="{{ route('list-produk.edit',$p->id) }}" class="btn btn-success btn-sm mr-3 mb-1"><i
                class="fa fa-edit"></i>
              Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm mr-3" onclick="return confirm('Hapus Data?');"><i
                class="fa fa-trash"></i> Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
  <br />
  {{ $produk->links() }}
  Halaman : {{ $produk->currentPage() }} <br />
  Jumlah Data : {{ $produk->total() }} <br />
  Data Per Halaman : {{ $produk->perPage() }} <br />

</div>
@endsection
