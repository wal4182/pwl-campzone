@extends('layouts.admin')
@section('konten')

<div class="container-fluid p-4">

  <h3 class="text-center">Rekening</h3>
  <div class="row">
    <button class="btn btn-primary ml-auto" id="createNewRekening"><i class="fa fa-plus"></i> Tambah Rekening</button>
  </div>

  <br>
  <div class="table">
    <table id="dataTable" class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Bank</th>
          <th>No Rekening</th>
          <th width="280px">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

{{-- create/update rekening modal--}}
<div class="modal fade" id="ajaxRekModel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading"></h4>
      </div>
      <div class="modal-body">
        <form id="rekeningForm" name="rekeningForm" class="form-horizontal">
          <input type="hidden" name="rekening_id" id="rekening_id">
          <div class="form-group">
            <label for="nama_bank" class="control-label">Nama Bank</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Masukkan Nama Bank"
                value="" maxlength="50" required="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">No Rekening</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="no_rekening" name="no_rekening"
                placeholder="Masukkan No Rekening" value="" maxlength="50" required="" autocomplete="off">
            </div>
          </div>
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
  //ajax setup
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // datatable
  var table = $('#dataTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('admin/rekening') }}",
    columns: [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex'
      },
      {
        data: 'nama_bank',
        name: 'nama_bank'
      },
      {
        data: 'no_rekening',
        name: 'no_rekening'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
      },
    ]
  });

  // create new rekening
  $('#createNewRekening').click(function() {
    $('#saveBtn').html("Simpan");
    $('#rekening_id').val('');
    $('#rekeningForm').trigger("reset");
    $('#modelHeading').html("Tambah Rekening");
    $('#ajaxRekModel').modal('show');
  });

  // create or update rekening
  $('#saveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Menyimpan..');

    $.ajax({
      data: $('#rekeningForm').serialize(),
      url: "{{ url('admin/rekening') }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        $('#rekeningForm').trigger("reset");
        $('#ajaxRekModel').modal('hide');
        table.draw();
        $('#saveBtn').html('Simpan');
      },
      error: function(data) {
        console.log('Error:', data);
        $('#saveBtn').html('Simpan');
      }
    });
  });

  // edit rekening
  $('body').on('click', '.edit-post', function() {
    var rekening_id = $(this).data('id');
    $.get("{{ url('admin/rekening') }}" + '/' + rekening_id + '/edit', function(data) {
      $('#modelHeading').html("Edit Rekening");
      $('#saveBtn').html('Update');
      $('#ajaxRekModel').modal('show');
      $('#rekening_id').val(data.id);
      $('#nama_bank').val(data.nama_bank);
      $('#no_rekening').val(data.no_rekening);
    })
  });

  // delete rekening
  $('body').on('click', '.delete', function() {
    var rekening_id = $(this).data("id");
    confirm("Hapus Data?");

    $.ajax({
      type: "DELETE",
      url: "{{ url('admin/rekening') }}" + '/' + rekening_id,
      success: function(data) {
        table.draw();
      },
      error: function(data) {
        console.log('Error:', data);
      }
    });
  });

});
</script>
@endsection
