@extends('layouts.master')
@push('style')
    <!-- Leaflet -->
   <style type="text/css">
     #map { 
      height: 300px; 
      margin-bottom: 10px;
      border : solid 1px #cbbeb5;
    }
   </style>
@endpush
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
        <div id="map"></div>
        @foreach($data as $d)
        <form action="/absensi/update/{{$d->id}}" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
          {{ csrf_field() }}

                   
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">NIK</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="nik" value="{{ str_pad( $d->pegawai->nik, 4, '0', STR_PAD_LEFT) }}"  class="form-control" disabled>
              <input type="hidden" name="id_pegawai" value="{{ $d->pegawai->id }}" class="form-control" readonly>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="nama" class="form-control" value="{{ $d->pegawai->nama }}" disabled>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tanggal</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-tanggal'>
                  <input type='text' name="tanggal" class="form-control" value="{{ $d->tanggal }}"required/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Kantor</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="hidden" name="id_kantor" class="form-control" value="{{ $d->id_kantor }}" required>
              <input type="text" name="nama_kantor" class="form-control" value="{{ $d->kantor->nama }}" disabled>
            </div>

            {{-- <label class="control-label col-md-2 col-sm-2 col-xs-6">Kantor</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <select name="id_tower" required class="form-control">
                <option value="0">pilih Tower</option>
                @foreach( $tower as $t )
                  <option value="{{ $t->id }}" @if($d->id_tower == $t->id) selected @endif >{{ $t->nama }}</option>

                @endforeach
              </select>
            </div> --}}
          </div>

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Jam Masuk</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-jam_masuk'>
                  <input type='text' name="jam_masuk" class="form-control" value="{{ $d->jam_masuk }}" required/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                  </span>
              </div>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Jam Pulang</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-jam_pulang'>
                  <input type='text' name="jam_pulang" class="form-control" value="{{ $d->jam_pulang }}"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                  </span>
              </div>
            </div>

          </div> 
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Radius</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="number" name="jarak" id="jarak" value="{{ $d->jarak }}" class="form-control" required readonly placeholder="Masukkan radius" >
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="latitude" id="latitude" value="{{ $d->latitude }}" class="form-control" required readonly placeholder="Masukkan latitude" >
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Longtitude</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="longitude" id="longitude" value="{{ $d->longitude }}" class="form-control" required readonly placeholder="Masukkan longitude" >
            </div>
          </div>

          <div class="ln_solid"></div>  
          <div class="form-group ">
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-9">
              <a class="btn btn-default btn-md" href="/absensi">Kembali</a>
              <button class="btn btn-primary" type="submit" name="submit" value="submit">Simpan</button>
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
  var current_position, current_accuracy;
  var kantorRad = Number('{{$kantor->radius}}');
  var kantorLat = Number('{{$kantor->latitude}}');
  var kantorLong = Number('{{$kantor->longitude}}');
  var kantorLatLong = [kantorLat, kantorLong];

  var map;
  var radius = 0;
  var latlong = [];
  var mark;
  var markCircle;
  var kantor = L.icon({
      iconUrl: '{{ asset('img/officebuilding.png') }}',
      iconSize:     [50, 50],
  });

  var userIcon = L.icon({
      iconUrl: '{{ asset('img/user.png') }}',
      iconSize:     [28, 28],
  });

  var circleIcon = {
      color: 'red',
      fillColor: '#f03',
      fillOpacity: 0.5,
      radius: 30
  };

  $(function () {
      $('#dt-tanggal').datetimepicker({
        format: 'YYYY-MM-DD', 
      });
      $('#dt-jam_masuk, #dt-jam_pulang').datetimepicker({
        //use24hours: true,
        format: 'HH:mm:ss'
      });

      $('#dt-jam_masuk').data({date: '{{ $data[0]->jam_masuk }}'});
      $('#dt-jam_pulang').data({date: '{{ $data[0]->jam_pulang }}'});

  });

  // Convert Degress to Radians
  function Deg2Rad( deg ) {
     return deg * Math.PI / 180;
  }

  function getDistance(lat1, lon1, lat2, lon2)
  {       
      //Toronto Latitude  43.74 and longitude  -79.37
      //Vancouver Latitude  49.25 and longitude  -123.12
      lat1 = Deg2Rad(lat1); 
      lon1 = Deg2Rad(lon1); 
      lat2 = Deg2Rad(lat2); 
      lon2 = Deg2Rad(lon2);
      latDiff = lat2-lat1;
      lonDiff = lon2-lon1;
      var R = 6371000; // metres
      var φ1 = lat1;
      var φ2 = lat2;
      var Δφ = latDiff;
      var Δλ = lonDiff;

      var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
              Math.cos(φ1) * Math.cos(φ2) *
              Math.sin(Δλ/2) * Math.sin(Δλ/2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

      var d = R * c;
      //alert('d: ' + d);

      var dist = Math.acos( Math.sin(φ1)*Math.sin(φ2) + Math.cos(φ1)*Math.cos(φ2) * Math.cos(Δλ) ) * R;
      //alert('dist: ' + dist);
      return dist;
  }  

  function showTime(){
      var date = new Date();
      var h = date.getHours(); // 0 - 23
      var m = date.getMinutes(); // 0 - 59
      var s = date.getSeconds(); // 0 - 59
      var session = "AM";
      
      
      h = (h < 10) ? "0" + h : h;
      m = (m < 10) ? "0" + m : m;
      s = (s < 10) ? "0" + s : s;
      
      var time = h + ":" + m + ":" + s;
      $('#jam').val(time);
      setTimeout(showTime, 1000);
  }

  function addMapPicker() {
    var absenLat = Number('{{ is_null($data[0]->latitude) ? '-8.699058299999999' : $data[0]->latitude }}' );
    var absenLong = Number('{{ is_null($data[0]->longitude) ? '115.17754090000001' : $data[0]->longitude }}' );
    var mapCenter = [ absenLat ,absenLong ];
    
    map = L.map('map',{
      center: kantorLatLong,
    }).setView( kantorLatLong ,17);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
       attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map); 
    
    L.marker( kantorLatLong, {icon: kantor}).addTo(map);

    marker = L.marker( mapCenter, { icon: userIcon }).addTo(map).bindPopup("Posisi absen").openPopup();

    var circle = L.circle( kantorLatLong, circleIcon ).addTo(map);

    
    var updateMarker = function(lat, lng) {
        marker
            .setLatLng([lat, lng])
            .bindPopup("Posisi anda :  " + marker.getLatLng().toString())
            .openPopup();

        return false;
    };

    map.on('draw:created', function (e) {

      console.log('created',e)

    });

    map.on('click', function(e) {

        $('#latInput, #latitude').val(e.latlng.lat);
        $('#lngInput, #longitude').val(e.latlng.lng);
        var dist = getDistance(e.latlng.lat, e.latlng.lng, kantorLat, kantorLong);
        $('#jarak').val(Math.round(dist));


        updateMarker(e.latlng.lat, e.latlng.lng);
        console.log('click',e);
    });
        
    var updateMarkerByInputs = function() {
      return updateMarker( $('#latInput').val() , $('#lngInput').val());
    }
    $('#latInput').on('input', updateMarkerByInputs);
    $('#lngInput').on('input', updateMarkerByInputs);

    
  }


  showTime();
  addMapPicker();
  
</script>

@endpush

@push('script')
<script type="text/javascript">
    
</script>
@endpush