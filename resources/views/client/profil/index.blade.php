@extends('layouts.client')
@section('konten')
<div class="container">
  @if(session('sukses'))
  <div class="alert alert-success">
    {{session('sukses')}}
  </div>
  @elseif(session('gagal'))
  <div class="alert alert-danger">
    {{session('gagal')}}
  </div>
  @endif
  <div class="row mt-3">
    <div class="col-md-8 m-auto">
      <div class="card border-0">
        <div class="card-body text-center">
          <div class="pp mb-2">
            @if(empty($user->foto_profil))
            <img src="{{ asset('img/avatar/default/default-avatar.png') }}">
            @else
            <img src="{{ asset('img/avatar/'.$user->foto_profil) }}">
            @endif
          </div>

          <div class="dropdown mb-2">
            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-camera"></i>
              Edit Foto
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <form action="{{ route('profil.destroy_avatar') }}" method="POST">
                <a class="dropdown-item" href="{{ route('profil.edit_avatar') }}">Upload
                  Foto</a>
                @csrf
                @if(!empty($user->foto_profil))
                <div class="dropdown-divider"></div>
                <input class="dropdown-item text-danger" type="submit" name="foto_profil" value='Hapus Foto'>
                @endif
              </form>
            </div>
          </div>

          <h4>{{ $user->name }}</h4>
          <p class="card-text text-secondary">{{ $user->email }}</p>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">
                <h4>Data Diri</h4>
              </div>
              <div class="col-md-6">
                <a href="{{ route('profil.edit') }}" class="btn btn-success float-right">
                  <i class="fas fa-edit"></i> Edit
                </a>
              </div>
            </div>
          </div>
          <ul class="list-group">
            <li class="list-group-item">
              <h6>Alamat</h6>
              <p class="text-secondary">{{ $user->alamat }}</p>
            </li>
            <li class="list-group-item">
              <h6>Jenis Kelamin</h6>
              <p class="text-secondary">{{ $user->jk }}</p>
            </li>
            <li class="list-group-item">
              <h6>Tanggal Lahir</h6>
              <p class="text-secondary">{{date('d-M-Y', strtotime($user->tgl_lahir))}}</p>
            </li>
            <li class="list-group-item">
              <h6>No HP</h6>
              <p class="text-secondary">{{ $user->hp }}</p>
            </li>
            <li class="list-group-item">
              <h6>No KTP</h6>
              <p class="text-secondary">{{ $user->no_ktp }}</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
