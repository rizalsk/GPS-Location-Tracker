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
        <form action="/gaji/create" method="get" enctype="multipart/form-data" class="form-inline" autocomplete="off">
          {{ csrf_field() }}
          <div class="pull-right">
            <select class="form-control" name="bulan" >
              @foreach( $yearMonth['month'] as $m => $v )
                <option value="{{ $v['value'] }}" @if( $v['value'] == Date('m') ) selected @endif >{{ $v['name'] }}</option>
              <!-- <option value="1" >January</option>
              <option value="2" >February</option>
              <option value="3" >March</option>
              <option value="4" >April</option>
              <option value="5" >May</option>
              <option value="6" >June</option>
              <option value="7" >July</option>
              <option value="8" >August</option>
              <option value="9" >September</option>
              <option value="10" >October</option>
              <option value="11" >November</option>
              <option value="12" >December</option> -->
              @endforeach
            </select>
            <select class="form-control" name="tahun" >
              <option value="2019" >2019</option>
              <option value="2020" selected>2020</option>
              <option value="2021" >2021</option>
              <option value="2022" >2022</option>
            </select>
            <button type="submit" class="btn btn-primary" style="margin-bottom: 0">Ambil Data</button>
          </div>
          
        </form>
      </div>

      <div class="x_content col-md-12"  >
        <form action="/gaji/store" method="post" enctype="multipart/form-data" class="form-responsive" autocomplete="off" >
          {{ csrf_field() }}
          <div style="">
            <div style="overflow-x: scroll; overflow-y: hidden;">
              <table class="table table-striped table-bordered nowrap " cellspacing="0" >
                <thead>
                  <tr>
                    <th rowspan="2" class="text-center">No.</th>
                    <th rowspan="2" class="text-center">NIK</th>
                    <th rowspan="2" class="text-center">Nama</th>
                    <th colspan="2" class="text-center">Periode</th>
                    <th rowspan="2" class="text-center">Gaji Pokok</th>
                    <th colspan="4" class="text-center">Ringkasan Kehadiran</th>
                    <th colspan="4" class="text-center">Potongan</th>
                    <th rowspan="2" class="text-center">Bonus</th>
                    <th rowspan="2" class="text-center">Total</th>

                  </tr>
                  <tr>
                    <th class="text-center">Bulan</th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Hr Kerja</th>
                    <th class="text-center">Hr Izin</th>
                    <th class="text-center">Hr Sakit</th>
                    <th class="text-center">Hr Cuti</th>
                    <th class="text-center">BPJS Kes.</th>
                    <th class="text-center">BPJS TK.</th>
                    <th class="text-center">BPJS JHT.</th>
                    <th class="text-center">Pot. Lain</th>              
                  </tr>
                </thead>
                @if(count($data) > 0 )            
                  <tbody class="" >
                    <?php $no=1; $idx = 0; ?>
                    @foreach($data as $d)
                    <tr  >
                      <td align="center">{{ $no++ }}</td>
                      <td>
                        <input type="hidden" size="5" class="text-center" name="idx[]" id="idx-{{$idx}}" value="{{ $idx }}" data-idx="{{$idx}}">
                        <input type="text" size="5" class="text-center" name="nik[]" id="nik-{{$idx}}" disabled value="{{ str_pad( $d->nik, 4, '0', STR_PAD_LEFT) }}" data-idx="{{$idx}}">
                      </td>
                      <td>
                        <input type="hidden" size="30" name="id_pegawai[]" id="id_pegawai-{{$idx}}"value="{{ $d->id_pegawai }}" data-idx="{{$idx}}">
                        <input type="text" size="30" name="nama[]" disabled id="nama-{{$idx}}"value="{{ $d->nama }}" data-idx="{{$idx}}">
                      </td>
                      <td>
                        <input type="text" size="10" class="text-center" name="nama_bulan[]"  id="nama_bulan-{{$idx}}" disabled value="{{ $periode['nama_bulan'] }}">
                        <input type="hidden" name="bulan[]"  id="bulan-{{$idx}}" value="{{ $periode['bulan'] }}" data-idx="{{$idx}}">
                      </td>
                      <td>
                        <input type="text" size="4" class="text-center" name="tahun[]"  id="nik-{{$idx}}" readonly value="{{ $periode['tahun'] }}" data-idx="{{$idx}}">
                      </td>
                      <td align="right" >
                        <input type="number" class="text-right" min="0" max="999999999" name="gaji_pokok[]"  id="gaji_pokok-{{$idx}}" readonly value="{{ $d->gaji_pokok }}" data-idx="{{$idx}}">
                      </td>
                      <td>
                        <input type="number" min="0" max="31" class="text-center" name="hari_kerja[]"  id="hari_kerja-{{$idx}}" value="{{ $d->hari_kerja }}">
                      </td>
                      <td>
                        <input type="number" min="0" max="31" class="text-center" name="hari_izin[]"  id="hari_izin-{{$idx}}" value="{{ $d->hari_izin }}">
                      </td>
                      <td>
                        <input type="number" min="0" max="31" class="text-center" name="hari_sakit[]"  id="hari_sakit-{{$idx}}" value="{{ $d->hari_sakit }}">
                      </td>
                      <td>
                        <input type="number" min="0" max="31" class="text-center" name="hari_cuti[]" id="hari_cuti-{{$idx}}"  value="{{ $d->hari_cuti }}">
                      </td>
                      <td>
                        <input type="number" min="0" max="9999999" class="text-right" name="bpjs_kesehatan[]"  id="bpjs_kesehatan-{{$idx}}" value="{{ $d->total_bpjs_kesehatan }}" data-idx="{{$idx}}" onkeyup="kalkulasi()" onchange="kalkulasi()">
                      </td>
                      <td>
                        <input type="number" min="0" max="9999999" class="text-right" name="bpjs_tk[]"  id="bpjs_tk-{{$idx}}" value="{{ $d->total_bpjs_tk }}" data-idx="{{$idx}}" onkeyup="kalkulasi()" onchange="kalkulasi()">
                      </td>
                      <td>
                        <input type="number" min="0" max="9999999" class="text-right" name="bpjs_jht[]"  id="bpjs_jht-{{$idx}}" value="{{ $d->total_bpjs_jht }}" data-idx="{{$idx}}" onkeyup="kalkulasi()" onchange="kalkulasi()">
                      </td>
                      <td>
                        <input type="number" min="0" max="9999999" class="text-right" name="potongan_lain[]"  id="potongan_lain-{{$idx}}" value="0" data-idx="{{$idx}}" onkeyup="kalkulasi()" onchange="kalkulasi()">
                      </td>
                      <td>
                        <input type="number" min="0" max="9999999" class="text-right" name="bonus[]"  id="bonus-{{$idx}}" value="0" data-idx="" onkeyup="kalkulasi()" onchange="kalkulasi()">
                      </td>

                      <td>
                        <input type="number" name="total[]"  id="total-{{$idx}}" class="text-right" readonly value="{{ $d->total_gaji }}" data-idx="{{$idx}}">
                      </td>

                      <td>
                        <input type="text" name="keterangan[]"  id="keterangan-{{$idx}}" class="text-right" readonly data-idx="{{$idx}}">
                      </td>

                    </tr>
                    <?php $idx++; ?>
                    @endforeach
                  </tbody>

                @endif
              </table>
            </div>
          </div>

          <div class="ln_solid"></div>  
          <div class="form-group col-md-12 col-sm-12 col-xs-12 d-flex justify-item-right">
            <div class="pull-right">
              <a class="btn btn-default btn-md" href="/gaji">Kembali</a>
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

      var x = document.getElementsByName("idx[]");
      $("input[name='idx[]']").map(function(){
          var i_elm = $(this).val();
          var total = 0;
          var gaji = Number( isNaN( $('#gaji_pokok-'+i_elm ).val() ) ? 0 : $('#gaji_pokok-'+i_elm ).val() );


          //potongan
          const kes = Number( isNaN( $('#bpjs_kesehatan-'+i_elm ).val() ) ? 0 : $('#bpjs_kesehatan-'+i_elm ).val() );
          const tk = Number( isNaN( $('#bpjs_tk-'+i_elm ).val() ) ? 0 : $('#bpjs_tk-'+i_elm ).val() );
          const jht = Number( isNaN( $('#bpjs_jht-'+i_elm ).val() ) ? 0 : $('#bpjs_jht-'+i_elm ).val() );
          const potongan = Number( isNaN( $('#potongan_lain-'+i_elm ).val() ) ? 0 : $('#potongan_lain-'+i_elm ).val() );

          //bonus
          const bonus = Number( isNaN( $('#bonus-'+i_elm ).val() ) ? 0 : $('#bonus-'+i_elm ).val() );


          var total = gaji - ( kes + tk + jht + potongan ) + bonus ;

          $('#total-'+i_elm).val( total ); 
          //console.log(total);
          return false;
      });
      /*$.each( x, function(i_elm, v) {
          
      });*/
      return false; 
  }
  
  
</script>
@endpush