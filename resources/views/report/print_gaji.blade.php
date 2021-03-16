<!DOCTYPE html>
<html lang="en">
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  	<!-- Meta, title, CSS, favicons, etc. -->
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

	@php
	    $title = "";
	    $logo = "no-logo.png";
	    if( !is_null($aplikasi) ){
	        $title = $aplikasi->nama;
	        $logo = is_null($aplikasi->logo) || $aplikasi->logo == "" ? $logo : $aplikasi->logo;
	    }
	@endphp
  	<link rel="icon" href="{{ asset('img/'.$logo) }}" type="any" sizes="any">
  	<title>{{$title}}</title>

  	<!-- Bootstrap -->
  	<link href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

  	<link href="{{ asset('css/admin/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
  	<link href="{{ asset('css/admin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
	<style type="text/css">
  		body{
    		font-family: times-new-roman;
  		}

  		.borderless tr, .borderless tr td, .borderless th {
    		border: 0;
  		}

  		.borderless>tbody>tr>td, .borderless>tbody>tr>th, .borderless>tfoot>tr>td, .borderless>tfoot>tr>th, .borderless>thead>tr>td, .borderless>thead>tr>th {

	      	border:0;
	  	}
	</style>
</head>

<body>
<div class="row" style="margin-top: 20px">

    <div class="col-md-12">
        
	    <table class="table dt-responsive nowrap borderless" cellspacing="0" width="100%" >
	        <tr>
	            <td width="10%">
	              	<img src="{{ asset('img/'.$logo) }}" style="width: 100px; height: auto">
	            </td>
	            <td>
	              	<h2 style="text-align: center; margin: 0"><b>{{ $title }}</b></h2>
	              	<p style="text-align: center; font-size: 12px">{{ $aplikasi->alamat }}, Telp : {{ $aplikasi->telp }}  Email : {{ $aplikasi->email }}</p>
	            </td>
	        </tr>
	    </table>

    </div>

  	<hr style="height:4px; background-color: black; margin-bottom:-18px">
  	<hr style="height:1px; background-color: black; ">
  	<div class="x_content">
    	<center><h3><b><u>LAPORAN GAJI</u></b></h3></center>
    	      	<table class="table table-striped table-bordered nowrap " cellspacing="0"  width="100%" >
    	            <thead>
    	                <tr>
    	                    <th rowspan="2" class="text-center">No.</th>
    	                    <th rowspan="2" class="text-center">Tahun</th>
    	                    <th rowspan="2" class="text-center">Bulan</th>
    	                    <th rowspan="2" class="text-center">Gaji Pokok</th>
    	                    <th colspan="4" class="text-center">Ringkasan Kehadiran</th>
    	                    <th colspan="4" class="text-center">Potongan</th>
    	                    <th rowspan="2" class="text-center">Bonus</th>
    	                    <th rowspan="2" class="text-center">Total</th>

    	                </tr>
    	                <tr>
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
    			                    <td align="center">{{$d->tahun}}</td>
    			                    <td align="center">{{$d->nama_bulan}}</td>
    			                    <td align="right">{{$d->gaji_pokok}}</td>
    			                    <td align="center">{{$d->hari_kerja}}</td>
    			                    <td align="center">{{$d->hari_izin}}</td>
    			                    <td align="center">{{$d->hari_sakit}}</td>
    			                    <td align="center">{{$d->hari_cuti}}</td>
    			                    <td align="right">{{$d->bpjs_kesehatan}}</td>
    			                    <td align="right">{{$d->bpjs_tk}}</td>
    			                    <td align="right">{{$d->bpjs_jht}}</td>
    			                    <td align="right">{{$d->potongan_lain}}</td>
    			                    <td align="right">{{$d->bonus}}</td>
    			                    <td align="right">{{$d->total}}</td>
    		                    </tr>
    	                    	<?php $idx++; ?>
    	                    @endforeach
    	                </tbody>

    	            @endif
    	    	</table>
      	


        <hr style="height:1px; background-color: black;">

        <table class="table dt-responsive nowrap borderless" cellspacing="0" width="100%" >
	        <tr>
	            <td width="70%">
	              	
	            </td>
	            <td>
	              	<div>Denpasar, {{ date('d F Y') }}</div>
	              	<div>Mengetahui,</div>
	              	<div>
	                	HRD<br><br><br><br>

	                	<u>................................................................</u><br>
	                	NIK
	              	</div>
	            </td>
	        </tr>
        </table>
  	</div>
</body>
</html>
