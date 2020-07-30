@extends('layouts.admin')
@section('konten')

<div class="container-fluid p-4">
  <h3 class="text-center">Member</h3>
  @if(!empty($member))
  <div class="table table-responsive">
    <table class="table table-bordered">
      <tr class="text-center">
        <th>No.</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>No. HP</th>
        <th>No. KTP</th>
        <th>Aksi</th>
      </tr>

      @foreach ($member as $m)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $m->name }}</td>
        <td>{{ $m->email }}</td>
        <td>{{ $m->jk }}</td>
        <td>{{ $m->alamat }}</td>
        <td>{{ $m->hp }}</td>
        <td>{{ $m->no_ktp }}</td>
        <td class="text-center">
          <form action="{{ route('member.destroy',$m->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data?')"><i
                class="fa fa-trash"></i> Hapus</button>
          </form>
          @endforeach
    </table>
  </div>
  @endif
  {{ $member->links() }}
</div>

@endsection
