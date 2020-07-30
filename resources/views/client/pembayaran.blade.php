@extends('layouts.client')
@section('konten')
<div class="col-md-6 m-auto">
  @if(session('sukses'))
  <div class="alert alert-success mt-3">
    {{session('sukses')}}
  </div>
  @endif
  @if(!empty($pesanan) and $pesanan->total_harga != 0)
  <div class="card mt-3">
    <div class="card-header">
      <h5>Informasi Pembayaran</h5>
    </div>
    <div class="card-body">
      <p class="card-text">
        Silakan Melakukan Pembayaran sebesar <strong>Rp. {{ number_format ( $pesanan->total_harga ) }} </strong>
        Melalui Nomor
        Rekening di Bawah ini:
      </p>
      <table class="table table-hover">
        @foreach ($rekening as $rek)
        <tr>
          <td>{{ $rek->nama_bank }}</td>
          <td>:</td>
          <td>{{ $rek->no_rekening }}</td>
        </tr>
        @endforeach
      </table>
      @if(empty($pesanan->bukti_pembayaran))
      <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#uploadModal">
        Upload Bukti Pembayaran
      </button>
      @elseif($pesanan->status_pembayaran == 0)
      <p class="p-2 w-100 bg-warning text-white text-center"><i class="fas fa-clock mr-2"></i> Menunggu Konfirmasi
      </p>
      @else($pesanan->status_pembayaran == 1)
      <p class="p-2 bg-success w-100 text-white text-center"><i class="fas fa-check mr-2"></i> Pembayaran Sukses
      </p>
      @endif
    </div>
  </div>
  @else
  <div class="card mt-3">
    <div class="card-header">
      <h5>Tidak Ada Tagihan</h5>
    </div>
  </div>
  @endif
</div>
<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('upload-bukti-pembayaran') }}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <input type="file" class="form-control-file" name="bukti_pembayaran">
          </div>
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
