@extends('layouts.admin')
@section('konten')

<div class="container-fluid p-4">

  <h3 class="text-center">Brand</h3>
  <div class="row">
    <button class="btn btn-primary ml-auto" id="createNewBrand"><i class="fa fa-plus"></i> Tambah Brand</button>
  </div>
  <br>
  <div class="table table-responsive">
    <table id="dataTable" class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Brand</th>
          <th>Author</th>
          <th width="280px">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

{{-- create/update brand modal--}}
<div class="modal fade" id="ajaxBrandModel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading"></h4>
      </div>
      <div class="modal-body">
        <form id="brandForm" name="brandForm" class="form-horizontal">
          <input type="hidden" name="brand_id" id="brand_id">
          <div class="form-group">
            <label for="nama_brand" class="control-label">Nama Brand</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="nama_brand" name="nama_brand"
                placeholder="Masukkan Nama Brand" value="" maxlength="50" required="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Slug</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="slug" name="slug" placeholder="Masukkan Nama Author" value=""
                maxlength="50" required="" autocomplete="off">
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
    ajax: "{{ url('admin/brand') }}",
    columns: [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex'
      },
      {
        data: 'nama_brand',
        name: 'nama_brand'
      },
      {
        data: 'slug',
        name: 'slug'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
      },
    ]
  });

  // create new brand
  $('#createNewBrand').click(function() {
    $('#saveBtn').html("Simpan");
    $('#brand_id').val('');
    $('#brandForm').trigger("reset");
    $('#modelHeading').html("Tambah Brand");
    $('#ajaxBrandModel').modal('show');
  });

  // create or update brand
  $('#saveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Menyimpan..');

    $.ajax({
      data: $('#brandForm').serialize(),
      url: "{{ url('admin/brand') }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        $('#brandForm').trigger("reset");
        $('#ajaxBrandModel').modal('hide');
        table.draw();
        $('#saveBtn').html('Simpan');
      },
      error: function(data) {
        console.log('Error:', data);
        $('#saveBtn').html('Simpan');
      }
    });
  });

  // edit brand
  $('body').on('click', '.edit-post', function() {
    var brand_id = $(this).data('id');
    $.get("{{ url('admin/brand') }}" + '/' + brand_id + '/edit', function(data) {
      $('#modelHeading').html("Edit Brand");
      $('#saveBtn').html('Update');
      $('#ajaxBrandModel').modal('show');
      $('#brand_id').val(data.id);
      $('#nama_brand').val(data.nama_brand);
      $('#slug').val(data.slug);
    })
  });

  // delete brand
  $('body').on('click', '.delete', function() {
    var brand_id = $(this).data("id");
    confirm("Hapus Data?");

    $.ajax({
      type: "DELETE",
      url: "{{ url('admin/brand') }}" + '/' + brand_id,
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
