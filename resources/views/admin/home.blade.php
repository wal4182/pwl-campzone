@extends('layouts.admin')

@section('konten')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard Admin</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <?php
              $pesanan = \App\Pesanan::count();
            ?>
            @if(!empty($pesanan))
            <h3>{{$pesanan}}</h3>
            @else
            <h3>0</h3>
            @endif
            <p>Pesanan</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ url('admin/pesanan') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <?php
              $pesanan_baru = \App\Pesanan::where('status_pengambilan',0)->count();
            ?>
            @if(!empty($pesanan_baru))
            <h3>{{$pesanan_baru}}</h3>
            @else
            <h3>0</h3>
            @endif

            <p>Pesanan Baru</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{ url('admin/pesanan') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <?php
              $member = \App\User::where('is_admin',0)->count();
            ?>
            @if(!empty($member))
            <h3>{{$member}}</h3>
            @else
            <h3>0</h3>
            @endif

            <p>Member</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{ url('admin/member') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <?php
              $produk = \App\Produk::count();
            ?>
            @if(!empty($produk))
            <h3>{{$produk}}</h3>
            @else
            <h3>0</h3>
            @endif
            <p>Produk</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ url('admin/list-produk') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <?php
              $kategori = \App\Kategori::count();
            ?>
            @if(!empty($kategori))
            <h3>{{$kategori}}</h3>
            @else
            <h3>0</h3>
            @endif

            <p>Kategori</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{ url('admin/kategori') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <?php
              $rekening = \App\Rekening::count();
            ?>
            @if(!empty($rekening))
            <h3>{{$rekening}}</h3>
            @else
            <h3>0</h3>
            @endif

            <p>Rekening</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{ url('admin/rekening') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
