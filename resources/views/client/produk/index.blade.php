@extends('layouts.client')
@section('konten')
<div class="container-fluid">
  <div class="row mt-2">
    <div class="col-md-2">
      <ul class="list-group list-group-flush fixed">
        <li class="list-group-item bg-detail">Brand</li>
        <a href="{{ route('produk.index') }}" class="list-group-item list-group-item-action">Semua Brand</a>
        @foreach ($brand as $b)
        <a class="list-group-item list-group-item-action"
          href="{{route('produk.show_brand', $b->slug)}}">{{$b->nama_brand}}</a>
        @endforeach
      </ul>
    </div>
    <div class="col-md-10">
      @if(session('sukses'))
      <div class="alert alert-success">
        {{session('sukses')}}
      </div>
      @endif
      <section class="new-product">
        <h3 class="text-center sec-title">Produk</h3>
        <div class="dropdown mb-5">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Kategori Produk
          </button>
          <!-- kategori dropdown here -->
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach ($kategori as $k)
            <a class="dropdown-item" href="{{route('produk.show_kategori', $k->kategori)}}">{{$k->kategori}}</a>
            @endforeach
          </div>
        </div>
        <div class="row mb-4">
          @foreach ($produk as $p)
          <div class="col-md-3">
            <div class="product">
              <div class="card border-0">
                <div class="produkImg">
                  <img src="{{ asset('img/produk/'.$p->foto) }}" class="card-img-top" alt="foto produk">
                </div>
                <div class="card-body">
                  <h6 class="card-title">{{$p->brand->nama_brand}} {{$p->nama_produk}}</h6>
                  <p class="card-text">{{$p->deskripsi}}.</p>
                  <p class="harga-sewa">
                    Rp. {{number_format($p->harga_sewa)}}/hari
                  </p>
                  @if($p->stok == 0) <a class="btn btn-warning disabled" href="{{url('rental')}}/{{$p->id}}">
                    Tidak Tersedia</a>
                  @else
                  <a class="btn btn-warning" href="{{url('rental')}}/{{$p->id}}">Rent</a>
                  @endif
                  <a class="btn btn-secondary" href="{{route('produk.show',$p->id)}}">Detail</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </section>
    </div>
  </div>
</div>
@endsection
