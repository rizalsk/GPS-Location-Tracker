@extends('layouts.master')

@section('content')
@php
    $title = "";
    $logo = "no-logo.png";
    if( !is_null($aplikasi) ){
        $title = $aplikasi->nama;
        $logo = is_null($aplikasi->logo) || $aplikasi->logo == "" ? $logo : $aplikasi->logo;
    }
    $c = auth()->user();
@endphp
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title text-center">
        <h2>{{ $title }}</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        @if(Session::has('message'))
          <div class="alert {{ Session::get('alert-class') }} alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ Session::get('message') }}</strong>
          </div>
        @endif
        <div class="text-center col-md-12">
          <h2>Update Biodata</h2>
        </div>
        
        <form id="form-biodata" action="/biodata/update/{{ $c->id }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
          {{ csrf_field() }}
          
          <div class="form-group">
            <div class="col-md-12 col-sm-2 col-xs-6 text-center">
              <div class="" style="height:200px">
                <img id="img-pegawai" src="{{ asset('img/pegawai/'.$c->foto) }}" class="img-thumbnail" alt="..." style="height:200px">
                
              </div>
              <input type="file" name="foto" id="foto" class="form-control border" onchange="function showPict(e){
                    var file = e.target.files[0];
                    var fileReader = new FileReader();
                    fileReader.onload = function(e) { 
                        $('#img-pegawai').attr('src',fileReader.result )
                    };
                    fileReader.readAsDataURL(file);
                } showPict(event)">
            </div>
          </div> 

                   
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">NIK</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="nik" value="{{ str_pad( $c->nik, 4, '0', STR_PAD_LEFT) }}" class="form-control" disabled placeholder="{{ $c->nik }}">
            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama</label>
              <div class="col-md-4 col-sm-4 col-xs-6">
                <input type="text" name="nama" value="{{ $c->nama }}" class="form-control" required="" placeholder="Masukkan nama">
              </div>
            </div> 
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tempat Lahir</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="tempat_lahir" value="{{ $c->tempat_lahir }}" class="form-control" required="" placeholder="Masukkan tempat lahir">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tgl Lahir</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-tanggal_lahir'>
                  <input type='text' name="tanggal_lahir" value="{{ $c->tanggal_lahir }}" class="form-control" required/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>
          </div> 

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Jabatan</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="jabatan" value="{{ $c->jabatan }}" class="form-control" disabled placeholder="Masukkan jabatan">
            </div>


            <label class="control-label col-md-2 col-sm-2 col-xs-6">Departemen</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="departemen" value="{{ $c->departemen }}" class="form-control" disabled placeholder="Masukkan departemen">
            </div>

          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Alamat</label>

            <div class="col-md-10 col-sm-10 col-xs-6">
              <textarea name="alamat" class="form-control" required="" placeholder="Alamat" rows="3">{!! $c->alamat !!}</textarea>
            </div>
          </div>

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Telp</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="telp" value="{{ $c->telp }}"  class="form-control" required="" placeholder="Masukkan Telp">
            </div>


            <label class="control-label col-md-2 col-sm-2 col-xs-6">Email</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="email" name="email" value="{{ $c->email }}" class="form-control" required="" placeholder="Masukkan Email">
            </div>

          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Mulai Kerja</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-mulai_kerja'>
                  <input type='text' name="mulai_kerja" value="{{ $c->mulai_kerja }}" class="form-control" disabled/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>
          </div>
          <div class="ln_solid"></div> 
          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Username</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="username" value="{{ $c->username }}" class="form-control" required="" placeholder="Masukkan username">
            </div>
            
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Ubah password</label>
            <label class="col-md-4 col-sm-4 col-xs-6"><input type="checkbox" id="check-password" ></label>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Password</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="password" name="password" id="password" class="form-control" required disabled placeholder="Password">
              <h6 class="text-danger"><span class="pwd_error"></span></h6>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Konfirmasi</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required disabled placeholder="Password confirmation">
              <h6 class="text-danger"><span class="pwd_error"></span></h6>
            </div>

          </div>

          <div class="ln_solid"></div>  
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
              <button class="btn btn-success btn-block" type="submit" name="submit" value="submit">Update</button>
            </div>
          </div>
        </form>

      </div>
    </div>

  </div>
</div>


@endsection

@push('script')
<script type="text/javascript">
    $(function () {
        $('#dt-mulai_kerja, #dt-tanggal_lahir').datetimepicker({
          format: 'YYYY-MM-DD', 
        });
    });
    $('#check-password').on('change, click', function(evt){
        var checked = $(this).is(":checked");
        if(checked){
          $('#password').prop('disabled', false);
          $('#password_confirmation').prop('disabled', false);
        }else{
          $('#password').prop('disabled', true);
          $('#password_confirmation').prop('disabled', true);
        }
    });
    $(document).on('click', 'form button[type=submit]', function(e) {
        var pwd = $('#password').val();
        var conf = $('#password_confirmation').val();
        var isValid = pwd == conf;
        if(!isValid) {
          $('.pwd_error').text('password tidak sesuai');
          $('#password').focus();
          e.preventDefault(); //prevent the default action
        }
    });
    @if(Session::has('message'))
      setTimeout(function(){
        $('.alert').alert('close');
      }, 2000)
    @endif
</script>
@endpush