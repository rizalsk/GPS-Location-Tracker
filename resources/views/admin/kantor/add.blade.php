@extends('layouts.master')

@section('content')
@php
    $title = "";
    $logo = "no-logo.png";
    if( !is_null($aplikasi) ){
        $title = $aplikasi->nama;
        $logo = is_null($aplikasi->logo) || $aplikasi->logo == "" ? $logo : $aplikasi->logo;
    }
@endphp
 
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title text-center">
        <h2>{{ $title }}</h2>
        <div class="clearfix"></div>

      </div>

      <div class="x_content">
        <form action="/kantor/store" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
          {{ csrf_field() }}

                   
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama kantor</label>
            <div class="col-md-10 col-sm-10 col-xs-6">
              <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Alamat</label>

            <div class="col-md-10 col-sm-10 col-xs-6">
              <textarea name="alamat" class="form-control" required="" placeholder="Alamat" rows="3"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Telp</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="telp" class="form-control" required placeholder="Masukkan telp" >
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Radius</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="radius" class="form-control" required placeholder="Masukkan radius" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="latitude" class="form-control" required placeholder="Masukkan latitude" >
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Longitude</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="longitude" class="form-control" required placeholder="Masukkan longitude" >
            </div>
          </div>
          

          <div class="ln_solid"></div>  
          <div class="form-group ">
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-9">
              <a class="btn btn-default btn-md" href="/kantor">Kembali</a>
              <button class="btn btn-primary" type="submit" name="submit" value="submit">Simpan</button>
            </div>
          </div>


        </form>


      </div>
    </div>

  </div>
</div>


@endsection

@push('script')

@endpush