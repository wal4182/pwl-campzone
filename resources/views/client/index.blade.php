@extends('layouts.client')
@section('konten')
@if(session('sukses'))
<div class="alert alert-success">
  {{session('sukses')}}
</div>
@endif
<!-- hero -->
<div class="hero">
  <div class="jumbotron-fluid">
    <div class="row">
      <div class="col-md-7 mx-auto text-center">
        <p class="lead hero-caption text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo quam eos
          iure
          provident, consequatur dolorem dolor! Pariatur possimus, sequi numquam..</p>
        <a class="btn btn-lg btn-warning" href="/produk" role="button">Explore Perlengkapan</a>
      </div>
    </div>
  </div>
</div>
<!-- / hero -->
<!-- alur -->
<section class="bg-light">
  <div class="container">
    <h3 class="sec-title">Alur Pesanan</h3>
    <div class="row">
      <div class="col-sm-12 col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"></i>1. Explore</h5>
            <p class="card-text">Explore produk dan temukan item yang Anda butuhkan.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">2. Rent</h5>
            <p class="card-text">Lengkapi detail pesanan, dan kami akan memproses pesanan Anda.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">3. Pickup</h5>
            <p class="card-text">Ambil pesanan sesuai tanggal yang telah ditentukan.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">4. Return</h5>
            <p class="card-text">Kembalikan pesanan sesuai tanggal yang telah ditentukan.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / alur -->
<!-- produk -->
<section>
  <div class="container">
    <h3 class="sec-title">Produk Terbaru</h3>
    <div class="row">
      @foreach($produk as $p)
      <div class="col-sm-12 col-md-3 bg-white">
        <div class="product">
          <div class="card border-0">
            <div class="produkImg">
              <img src="{{ asset('img/produk/'.$p->foto) }}" class="card-img-top" alt="foto produk">
            </div>
            <div class="card-body">
              <h6 class="card-title">{{$p->nama_produk}}</h6>
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
  </div>
</section>
<!-- / produk-->
<!-- tentang kami -->
<section class="bg-light">
  <div class="container">
    <h3 class="sec-title">Tentang Kami</h3>
    <div class="row">
      <div class="col-md-5">
        <div class="tentang-imgBox">
          <img src="/img/office.jpg" alt="" class="rounded">
        </div>
      </div>
      <div class="col-md-7">
        <div class="tentang-konten">
          <h5>Campzone</h5>
          <p class="sec-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore voluptatem
            eveniet, quas deleniti error qui fugit, culpa architecto distinctio consequatur voluptates.
            Fuga, rem labore cum consequuntur illum excepturi, quis explicabo a magnam recusandae inventore!
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / tentang kami -->
<!-- galeri -->
<section class="galeri">
  <div class="container">
    <h3 class="sec-title">Galeri</h3>
    <div class="row">
      <div class="col-md-4">
        <div class="galeri-img mx-auto">
          <img src="/img/galeri1.jpg" alt="" class="rounded">
        </div>
      </div>
      <div class="col-md-4">
        <div class="galeri-img">
          <img src="/img/galeri1.jpg" alt="" class="rounded" height="200px">
        </div>
      </div>
      <div class="col-md-4">
        <div class="galeri-img">
          <img src="/img/galeri1.jpg" alt="" class="rounded" height="200px">
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="galeri-img mx-auto">
          <img src="/img/galeri1.jpg" alt="" class="rounded">
        </div>
      </div>
      <div class="col-md-4">
        <div class="galeri-img mx-auto">
          <img src="/img/galeri1.jpg" alt="" class="rounded">
        </div>
      </div>
      <div class="col-md-4">
        <div class="galeri-img mx-auto">
          <img src="/img/galeri1.jpg" alt="" class="rounded">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / galeri -->
<!-- review -->
<section class="review bg-light">
  <div class="container">
    <h3 class="sec-title">Review</h3>
    <div class="row">
      <div class="col-md-4 text-center">
        <div class="pp">
          <img src="/img/pp1.jpg" alt="">
        </div>
        <p>
          "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui deleniti quo sit optio aliquam totam
          vero incidunt.accusantium."
        </p>
        <p>- Mas Ganteng -</p>
      </div>
      <div class="col-md-4 text-center">
        <div class="pp">
          <img src="/img/pp1.jpg" alt="">
        </div>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea dolor illum accusantium adipisci
          repellat iusto unde temporibus, blanditiis dolore aperiam magni expedita.
        </p>
        <p>- Mas Ganteng -</p>
      </div>
      <div class="col-md-4 text-center">
        <div class="pp">
          <img src="/img/pp1.jpg" alt="">
        </div>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis, aliquam odit sit incidunt vero
          illo perferendis tenetur.
        </p>
        <p>- Mas Ganteng -</p>
      </div>
    </div>
  </div>
</section>
<!-- / review -->
<!-- hubungi kami -->
<section class="kontak">
  <div class="container">
    <h3 class="sec-title">Hubungi Kami</h3>
    <div class="row">
      <div class="col-md-6">
        <h5>Campzone</h5>
        <div class="office-imgBox">
          <img src="/img/office.jpg" alt="office" class="rounded">
        </div>
        <div class="contact">
          <h6>ALAMAT KANTOR</h6>
          <p>Jl. Kaliurang KM 4, Depok, Sleman, Yogyakarta</p>
        </div>
        <div class="contact">
          <h6>TELEPON</h6>
          <p>0822-2019828</p>
        </div>
        <div class="contact">
          <h6>EMAIL</h6>
          <p>campzone@email.com</p>
        </div>
      </div>
      <div class="col-md-6">
        <div>
          <form>
            <div class="form-group">
              <label for="nama">Nama Lengkap</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Almat Email</label>
              <input type="email" class="form-control">
              <small id="emailHelp" class="form-text text-muted">Kami tidak membagikan alamat email Anda
                ke siapapun.</small>
            </div>
            <div class="form-group">
              <label for="pesan">Pesan</label>
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Kirim</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / hubungi kami -->
@endsection
