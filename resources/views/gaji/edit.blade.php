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
        <form action="/gaji/update/{{ $d->id }}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
          {{ csrf_field() }}
          <?php 
            $date = $d->tahun."-".$d->bulan."-01"; 
            $strtotime = strtotime($date);
            $namaBulan = Date('F', $strtotime);

          ?>

                   
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">NIK</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="nik" value="{{ str_pad( $d->pegawai->nik, 4, '0', STR_PAD_LEFT) }}" class="form-control" disabled>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="username" value="{{ $d->pegawai->nama }}" class="form-control" disabled >
            </div>
          </div>
          

          <div class="ln_solid"></div>  

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tahun</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="tahun" value="{{ $d->tahun }}" class="form-control" disabled >
            </div>


            <label class="control-label col-md-2 col-sm-2 col-xs-6">Bulan</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="bulan" value="{{ $namaBulan }}" class="form-control" disabled>
            </div>

          </div>

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Hari Kerja</label>
            <div class="col-md-1 col-sm-1 col-xs-6">
              <input type="number" name="hari_kerja" value="{{ $d->hari_kerja }}" class="form-control" required>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Hari Izin</label>
            <div class="col-md-1 col-sm-1 col-xs-6">
              <input type="number" name="hari_izin" value="{{ $d->hari_izin }}" class="form-control" required>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Hari Sakit</label>
            <div class="col-md-1 col-sm-1 col-xs-6">
              <input type="number" name="hari_sakit" value="{{ $d->hari_sakit }}" class="form-control" required>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Hari Cuti</label>
            <div class="col-md-1 col-sm-1 col-xs-6">
              <input type="number" name="hari_cuti" value="{{ $d->hari_cuti }}" class="form-control" required>
            </div>

          </div>
          <div class="ln_solid"></div>  

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Gaji Pokok</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="gaji_pokok" id="gaji" value="{{ $d->gaji_pokok }}" class="form-control" readonly onkeyup="kalkulasi()" onchange="kalkulasi()">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">BPJS Kesehatan</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="bpjs_kesehatan" id="bpjs_kes" value="{{ $d->bpjs_kesehatan }}" class="form-control" required="" placeholder="Masukkan BPJS Kesehatan" onkeyup="kalkulasi()" onchange="kalkulasi()">
            </div>

          </div>

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">BPJS Jaminan Hari Tua</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="bpjs_jht" id="bpjs_jht" value="{{ $d->bpjs_jht }}" class="form-control" required="" placeholder="Masukkan BPJS jaminan hari tua" onkeyup="kalkulasi()" onchange="kalkulasi()">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">BPJS Tenaga kerja</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="bpjs_tk" id="bpjs_tk" class="form-control" value="{{ $d->bpjs_tk }}" required="" placeholder="Masukkan BPJS Tenaga kerja" onkeyup="kalkulasi()" onchange="kalkulasi()">
            </div>

          </div>

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Potongan Lain</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="potongan_lain" id="potongan" value="{{ $d->potongan_lain }}" class="form-control" required  onkeyup="kalkulasi()" onchange="kalkulasi()">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Bonus</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="bonus" id="bonus" class="form-control" value="{{ $d->bonus }}" required  onkeyup="kalkulasi()" onchange="kalkulasi()">
            </div>

          </div>

          <div class="ln_solid"></div> 

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Total</label>

            <div class="col-md-10 col-sm-10 col-xs-6">
              <input type="number" name="total" id="total" value="{{ $d->total }}" class="form-control" required readonly>
            </div>

          </div>

          <div class="ln_solid"></div>  

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Keterangan</label>

            <div class="col-md-10 col-sm-10 col-xs-6">
              <textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="3">{!! $d->keterangan !!}</textarea>
            </div>
          </div>


          <div class="ln_solid"></div>  
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <a class="btn btn-default btn-md" href="/pegawai">Kembali</a>
              <button class="btn btn-success" type="submit" name="submit" value="submit">Simpan</button>
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
<script type="text/javascript">
  /*function kalkulasi(o){
    //var idx = Number( $(obj).data('idx') );
    //var gaji = $('#gaji_pokok'+idx).val();
    console.log('horeee');
    return false;
    var bpjs_kes = Number( $('#bpjs_kesehatan-'+idx).val() );
    var bpjs_tk = Number( $('#bpjs_tk-'+idx).val();
    var bpjs_jht = Number( $('#bpjs_jht-'+idx).val() );
    var potongan = Number( $('#potongan_lain-'+idx).val() );
    var bonus = Number( $('#bonus-'+idx).val() );
    
    var total = gaji - (bpjs_kes + bpjs_tk + bpjs_jht + potongan ) + bonus;
    
    $('#total-'+idx).val(total);
  }*/

  function kalkulasi(){

      var total = 0;
      var gaji = Number( isNaN( $('#gaji' ).val() ) ? 0 : $('#gaji' ).val() );

      //potongan
      const kes = Number( isNaN( $('#bpjs_kes').val() ) ? 0 : $('#bpjs_kes').val() );
      const tk = Number( isNaN( $('#bpjs_tk').val() ) ? 0 : $('#bpjs_tk' ).val() );
      const jht = Number( isNaN( $('#bpjs_jht' ).val() ) ? 0 : $('#bpjs_jht').val() );
      const potongan = Number( isNaN( $('#potongan' ).val() ) ? 0 : $('#potongan' ).val() );

      //bonus
      const bonus = Number( isNaN( $('#bonus' ).val() ) ? 0 : $('#bonus').val() );

      var total = gaji - ( kes + tk + jht + potongan ) + bonus ;

      $('#total').val( total ); 
      return false; 
  }
  
  
</script>
@endpush