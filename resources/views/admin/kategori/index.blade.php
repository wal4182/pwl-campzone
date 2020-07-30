@extends('layouts.admin')
@section('konten')

<div class="container-fluid p-4">
  <h3 class="text-center">Kategori</h3>
  <div class="row">
    <button class="btn btn-primary ml-auto" id="createNewKategori"><i class="fa fa-plus"></i> Tambah Kategori</button>
  </div>
  <br>
  <div class="table">
    <table id="dataTable" class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Kategori Produk</th>
          <th width="280px">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

{{-- create/update kategori modal--}}
<div class="modal fade" id="ajaxKatModel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading"></h4>
      </div>
      <div class="modal-body">
        <form id="kategoriForm" name="kategoriForm" class="form-horizontal">
          <input type="hidden" name="kategori_id" id="kategori_id">
          <div class="form-group">
            <label for="kategori" class="control-label">Nama Kategori</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan Nama Kategori"
                value="" maxlength="50" required="" autocomplete="off">
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
<script>
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
    ajax: "{{ url('admin/kategori') }}",
    columns: [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex'
      },
      {
        data: 'kategori',
        name: 'kategori'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
      },
    ]
  });

  // create new kategori
  $('#createNewKategori').click(function() {
    $('#saveBtn').html("Simpan");
    $('#kategori_id').val('');
    $('#kategoriForm').trigger("reset");
    $('#modelHeading').html("Tambah Kategori");
    $('#ajaxKatModel').modal('show');
  });

  // create or update kategori
  $('#saveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Menyimpan..');

    $.ajax({
      data: $('#kategoriForm').serialize(),
      url: "{{ url('admin/kategori') }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        $('#kategoriForm').trigger("reset");
        $('#ajaxKatModel').modal('hide');
        table.draw();
        $('#saveBtn').html('Simpan');
      },
      error: function(data) {
        console.log('Error:', data);
        $('#saveBtn').html('Simpan');
      }
    });
  });

  // edit kategori
  $('body').on('click', '.edit-post', function() {
    var kategori_id = $(this).data('id');
    $.get("{{ url('admin/kategori') }}" + '/' + kategori_id + '/edit', function(data) {
      $('#modelHeading').html("Edit Kategori");
      $('#saveBtn').html('Update');
      $('#ajaxKatModel').modal('show');
      $('#kategori_id').val(data.id);
      $('#kategori').val(data.kategori);
    })
  });

  // delete kategori
  $('body').on('click', '.delete', function() {
    var id = $(this).data("id");
    confirm("Hapus Data? ?!");

    $.ajax({
      type: "DELETE",
      url: "{{ url('admin/kategori') }}" + '/' + id,
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
