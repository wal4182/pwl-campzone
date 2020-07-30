@extends('layouts.client')
@section('konten')
<div class="container">
  <div class="row mt-3">
    <div class="col-md-8 m-auto">
      <h4 class="mt-3 mb-3 text-center">Edit Data Diri</h4>
      <div class="card">
        <div class="card-header">
          <h6>Data Diri</h6>
        </div>
        <div class="card-body p-4">
          <form action="{{route('profil.update')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="nama_produk">Nama Lengkap</label>
              <input type="text" name="name" disabled class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" disabled class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" class="form-control" rows="2">{{$user->alamat}}</textarea>
            </div>
            <div class="form-group">
              <label for="jk">Jenis Kelamin</label>
              <select class="form-control" name="jk">
                <option selected disabled>Jenis-Kelamin
                <option value="Laki-Laki" @if ($user->jk === 'Laki-Laki')
                  selected
                  @endif>Laki-Laki
                </option>
                <option value="Perempuan" @if ($user->jk === 'Perempuan')
                  selected
                  @endif>Perempuan
                </option>
              </select>
            </div>
            <div class="form-group">
              <label for="tgl_lahir">Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" class="form-control" value="{{$user->tgl_lahir}}">
            </div>
            <div class="form-group">
              <label for="hp">No. HP</label>
              <input type="text" name="hp" class="form-control" value="{{$user->hp}}">
            </div>
            <div class="form-group">
              <label for="no_ktp">No. KTP</label>
              <input type="text" name="no_ktp" class="form-control" value="{{$user->no_ktp}}">
            </div>
            <input type="submit" class="btn btn-warning" value="Update">
            <a href="{{url('profil')}}" class="btn btn-secondary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
