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
      	 <div class="x_content">
              @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
              @endif
              <form action="/aplikasi/update/{{ $aplikasi->id }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
          		{{ csrf_field() }}

              		<div class="form-group">

    		              <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama Aplikasi</label>
    		              <div class="col-md-10 col-sm-10 col-xs-12">
    			                <input type="text" name="nama" value="{{ $title }}" class="form-control" required="" placeholder="Nama Aplikasi">
    		              </div>
    	            </div>    
              		<div class="form-group ">
              			  <label class="control-label col-md-2 col-sm-2 col-xs-6">Logo</label>
              		  	<div class="col-md-10 col-sm-10 col-xs-12">
              		    	  <div class="text-center" style="height:200px">
              		      		  <img id="img-logo" src="{{ asset('img/'.$logo) }}" class="img-thumbnail" alt="..." style="height:200px">
              		      
              		    	  </div>
              		    	  <input type="file" name="logo" id="logo" class="form-control border"    onchange="function showPict(e){
                  		          	var file = e.target.files[0];
                  		          	var fileReader = new FileReader();
                  		          	fileReader.onload = function(e) { 
                  		              	$('#img-logo').attr('src',fileReader.result )
                  		          	};
                		          	  fileReader.readAsDataURL(file);
                		          } showPict(event)"
                          >
              		  	</div>
              		</div> 
                  <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-6">Alamat</label>

                      <div class="col-md-10 col-sm-10 col-xs-6">
                          <textarea name="alamat" class="form-control" required="" placeholder="Alamat" rows="3">{!! $aplikasi->alamat !!}</textarea>
                      </div>
                  </div>
                  <div class="form-group">

                      <label class="control-label col-md-2 col-sm-2 col-xs-6">Telp</label>

                      <div class="col-md-4 col-sm-4 col-xs-6">
                          <input type="text" name="telp" value="{{$aplikasi->telp}}" class="form-control" required="" placeholder="Masukkan Telp">
                      </div>


                      <label class="control-label col-md-2 col-sm-2 col-xs-6">Email</label>
                      <div class="col-md-4 col-sm-4 col-xs-6">
                          <input type="email" name="email" value="{{$aplikasi->email}}" class="form-control" required="" placeholder="Masukkan Email">
                      </div>

                  </div>
                  <div class="ln_solid"></div>  
                  <button class="btn btn-primary btn-block" type="submit" name="submit" value="submit">Update</button>
          	  </form>
          </div>
    
   	</div>
</div>

@endsection