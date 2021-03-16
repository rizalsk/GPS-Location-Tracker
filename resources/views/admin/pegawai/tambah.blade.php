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
        <form action="/pegawai/store" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
          {{ csrf_field() }}
          
          <div class="form-group">
            <div class="col-md-12 col-sm-2 col-xs-6 text-center">
              <div class="" style="height:200px">
                <img id="img-pegawai" src="{{ asset('img/pegawai/user.png') }}" class="img-thumbnail" alt="..." style="height:200px">
                
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
              <input type="text" name="nik" value="{{ $nik }}" class="form-control" readonly placeholder="{{ $nik }}">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Username</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="username" class="form-control" required="" placeholder="Masukkan username">
              <h6><b>* </b> Password User sama dengan Username</h6>
            </div>
          </div>
          

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="nama" class="form-control" required="" placeholder="Masukkan nama">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Level</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <select name="level" required class="form-control">
                <option disabled>pilih level</option>
                <option value="pegawai">Pegawai</option>
                <option value="hrd">HRD</option>
              </select>
            </div>

          </div> 

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tempat Lahir</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="tempat_lahir" class="form-control" required="" placeholder="Masukkan tempat lahir">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tgl Lahir</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-tanggal_lahir'>
                  <input type='text' name="tanggal_lahir" class="form-control" required/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>
          </div> 

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Jabatan</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="jabatan" class="form-control" required="" placeholder="Masukkan jabatan">
            </div>


            <label class="control-label col-md-2 col-sm-2 col-xs-6">Departemen</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="departemen" class="form-control" required="" placeholder="Masukkan departemen">
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
              <input type="text" name="telp" class="form-control" required="" placeholder="Masukkan Telp">
            </div>


            <label class="control-label col-md-2 col-sm-2 col-xs-6">Email</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="email" name="email" class="form-control" required="" placeholder="Masukkan Email">
            </div>

          </div>

          <div class="ln_solid"></div>  

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Mulai Kerja</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-mulai_kerja'>
                  <input type='text' name="mulai_kerja" class="form-control" required/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>
          </div>

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Gaji Pokok</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="gaji_pokok" class="form-control" required="" placeholder="Masukkan gaji" value="0">
            </div>


            <label class="control-label col-md-2 col-sm-2 col-xs-6">BPJS Kesehatan (%)</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="bpjs_kesehatan" class="form-control" required="" placeholder="Masukkan BPJS Kesehatan" value="1">
            </div>

          </div>

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">BPJS Jaminan Hari Tua (%)</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="bpjs_jht" class="form-control" required="" placeholder="Masukkan BPJS jaminan hari tua" value="1">
            </div>


            <label class="control-label col-md-2 col-sm-2 col-xs-6">BPJS Tenaga kerja (%)</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="bpjs_tk" class="form-control" required="" placeholder="Masukkan BPJS Tenaga kerja" value="1">
            </div>

          </div>

          <div class="ln_solid"></div>  
          <div class="form-group ">
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-9">
              <a class="btn btn-default btn-md" href="/pegawai">Kembali</a>
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
<script type="text/javascript">
    $(function () {
        $('#dt-mulai_kerja, #dt-tanggal_lahir').datetimepicker({
          format: 'YYYY-MM-DD', 
        });
    });
</script>
@endpush