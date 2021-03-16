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
        <form action="/absensi/store" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
          {{ csrf_field() }}

          <input type="hidden" name="id" value="@if(!is_null($absen)) {{$absen->id}} @endif" class="form-control">
           
                   
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">NIK</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="nik" value="{{ str_pad( auth()->user()->nik, 4, '0', STR_PAD_LEFT) }}" class="form-control" disabled>
              <input type="hidden" name="id_pegawai" value="{{ auth()->user()->id }}" class="form-control" readonly>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="nama" class="form-control" required="" placeholder="Masukkan nama" value="{{ auth()->user()->nama }}" disabled>
            </div>
          </div>
          

          <div class="form-group">

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tanggal</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" id="tanggal" name="tanggal" class="form-control" required readonly value="{{ $tgl }}">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Jam</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" id="jam" name="jam" class="form-control" required readonly value="{{ $jam }}">
            </div>

          </div> 
          

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Absen</label>

            <div class="radio col-md-4 col-sm-4 col-xs-6" style="">
              <label class="control-label">
                <input type="radio" name="absen" id="masuk" value="masuk" @if(is_null($absen)) checked @endif>
                Masuk
              </label>

              <label class="control-label">
                <input type="radio" name="absen" id="pulang" value="pulang" @if(!is_null($absen) ) checked @endif >
                Pulang
              </label>

            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-6">Jarak</label>
              <div class="col-md-4 col-sm-4 col-xs-6">
                <input type="number" name="jarak" id="jarak" class="form-control" required readonly placeholder="Masukkan jarak" >
              </div>
              <label class="control-label col-md-2 col-sm-2 col-xs-6">Kantor</label>
              <div class="col-md-4 col-sm-4 col-xs-6">
                <input type="text" name="nama_kantor" id="nama_kantor" class="form-control" required disabled placeholder="Masukkan nama_kantor" value="{{ $kantor->nama }}">
                <input type="hidden" name="id_kantor" id="id_kantor" class="form-control" required readonly placeholder="Masukkan id_kantor" value="{{ $kantor->id }}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude</label>
              <div class="col-md-4 col-sm-4 col-xs-6">
                <input type="text" name="latitude" id="latitude" class="form-control" required readonly placeholder="Masukkan latitude" >
              </div>
              <label class="control-label col-md-2 col-sm-2 col-xs-6">Longtitude</label>
              <div class="col-md-4 col-sm-4 col-xs-6">
                <input type="text" name="longitude" id="longitude" class="form-control" required readonly placeholder="Masukkan longitude" >
              </div>
            </div>

          </div> 


          <div class="ln_solid"></div>  
          <div class="form-group ">
            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-9">
              <a class="btn btn-default btn-md" href="/absensi">Kembali</a>
              <button class="btn btn-warning " type="submit" id="btn-submit" name="submit" value="submit" disabled>Absen</button>
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
  function showTime(){
      var date = new Date();
      var h = date.getHours(); 
      var m = date.getMinutes(); 
      var s = date.getSeconds(); 
      var session = "AM";
      
      h = (h < 10) ? "0" + h : h;
      m = (m < 10) ? "0" + m : m;
      s = (s < 10) ? "0" + s : s;
      
      var time = h + ":" + m + ":" + s;
      $('#jam').val(time);
      setTimeout(showTime, 1000);
  } 
  

  var current_position, current_accuracy;
  var kantorRad = Number('{{$kantor->radius}}');
  var kantorLat = Number('{{$kantor->latitude}}');
  var kantorLong = Number('{{$kantor->longitude}}');
  var kantorLatLong = [kantorLat, kantorLong];
  var jarak = 0;
  var absenRad = 0;
  var absenLat = 0;
  var absenLong = 0;
  var absenLatLong = [];

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


  // Convert Degress to Radians
  function Deg2Rad( deg ) {
     return deg * Math.PI / 180;
  }

  function getDistance(lat1, lon1, lat2, lon2)
  {
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
      var dist = Math.acos( Math.sin(φ1)*Math.sin(φ2) + Math.cos(φ1)*Math.cos(φ2) * Math.cos(Δλ) ) * R;
      return dist;
  }

  function locateMap() {
    map.locate({setView: true, maxZoom: 16});
  }

  function addMapPicker() {
    var mapCenter = kantorLatLong;
    
    map = L.map('map', {
      center: kantorLatLong,
    }).setView( mapCenter ,17);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
       attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map); 
    
    var circle = L.circle( kantorLatLong, circleIcon ).addTo(map);
    L.marker( kantorLatLong, {icon: kantor}).addTo(map);
  }

  $(document).ready(function(){
    showTime();

    addMapPicker();

    map.locate({setView: true});
    map.on('locationfound', (e) => {
        radius = e.accuracy / 2;
        latlong = [e.latitude, e.longitude];
        absenRad = e.accuracy;
        absenLat = e.latitude;
        absenLong = e.longitude ;
        absenLatLong = latlong;

        distance = Math.round(getDistance(kantorLat, kantorLong, absenLat, absenLong) );
        
        var msgIcon = "";

        if (mark) {
            map.removeLayer(mark);
        }

        if( (distance * 2) <= kantorRad){
          $('#btn-submit').removeClass('btn-warning').addClass('btn-success').prop('disabled',false);
            msgIcon = "Anda saat ini berada di area kantor {{ $kantor->nama }}.<br>Silahkan Absen";
        }else{
          $('#btn-submit').removeClass('btn-success').addClass('btn-warning').prop('disabled',true);
            msgIcon = "Anda saat ini " + distance + " meter dari kantor.<br>Absensi bisa dilakukan "+( kantorRad / 2)+" meter dari kantor";
        }

        $('#jarak').val( distance );
        $('#latitude').val(e.latitude);
        $('#longitude').val(e.longitude);

        mark = L.marker([e.latitude, e.longitude], { icon: userIcon }).addTo(map).bindPopup(msgIcon).openPopup();


        var latlngs = [
          kantorLatLong,
          absenLatLong
        ];

        var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
        map.fitBounds(polyline.getBounds());

        //console.log(distance);
        
    });
    setInterval(locateMap, 2000);

  });

</script>

@endpush