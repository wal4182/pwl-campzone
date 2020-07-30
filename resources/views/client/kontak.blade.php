@extends('layouts.client')
@section('konten')
<!-- hubungi kami -->
<section class="kontak">
  <div class="container">
    <h2 class="sec-title">Hubungi Kami</h2>
    <div class="row">
      <div class="col-md-6">
        <h5>CampZone</h5>
        <div class="office-imgBox">
          <img src="/img/office.jpg" alt="office">
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
          <p>mountzone@email.com</p>
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
