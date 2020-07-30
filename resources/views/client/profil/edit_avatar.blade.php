@extends('layouts.client')
@section('konten')
<div class="container">
  <h4 class="mt-3 mb-3 text-center">Upload Foto Profil</h4>
  <div class="row mt-3">
    <div class="col-md-8 m-auto">
      <div class="card">
        <div class="card-body">
          <form action="{{route('profil.update_avatar')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="foto_profil"></label>
              <input type="file" class="form-control-file" name="foto_profil">
            </div>
            <input type="submit" class="btn btn-warning" value="Update">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
