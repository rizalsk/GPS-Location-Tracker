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
        @foreach($data as $d)
        <form action="/tower/update/{{$d->id}}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
          {{ csrf_field() }}

                   
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama Tower</label>
            <div class="col-md-10 col-sm-10 col-xs-6">
              <input type="text" name="nama" class="form-control" value="{{ $d->nama }}" required placeholder="Masukkan nama" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="latitude" class="form-control" required placeholder="Masukkan latitude" value="{{ $d->latitude }}">
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Longtitude</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="longtitude" class="form-control" required placeholder="Masukkan longtitude" value="{{ $d->longtitude }}">
            </div>
          </div>
          

          <div class="ln_solid"></div>  
          <div class="form-group ">
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-9">
              <a class="btn btn-default btn-md" href="/tower">Kembali</a>
              <button class="btn btn-primary" type="submit" name="submit" value="submit">Update</button>
            </div>
          </div>


        </form>

        @endforeach
      </div>
    </div>

  </div>
</div>


@endsection

@push('script')

@endpush