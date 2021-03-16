@extends('layouts.master')
@push('style')
<style type="text/css">
	p {
	    margin: 0;
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
    //dd($yearMonth);
@endphp
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<div class="row">
					<div class="col-md-12 clearfix">
						
						<h2>{{ $title }}</h2>
					</div>
				</div>
				@if( auth()->user()->level == 'pegawai' )
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-xs btn-primary " data-toggle="modal" data-target="#tambah" @if( count($data) > 0 || !$exist ) disabled @endif ><i class="fa fa-plus"></i> Buat Laporan</button>
						<div class="clearfix"></div>
					</div>
				</div>
				@endif
				
			</div>

			<div class="x_content">
				@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )				
					<table border="0" cellspacing="5" cellpadding="5" style="margin-bottom: 5px">
					    <tbody>
					        <tr>
					            <td>Bulan:</td>
					            <td>
					            	<select class="form-control" id="bulan" >
					            		<option >semua</option>
					            	  	@foreach( $yearMonth['month'] as $m => $v )
					            	    	<option value="{{ $v['value'] }}" @if(date('m') ==  $v['value'] ) selected @endif>{{ $v['name'] }}</option>
					            	  	@endforeach
					            	</select>
					            
	        					</td>
					            <td>Tahun:</td>
					            <td>
					            	<select class="form-control" id="tahun" >
					            		<option >semua</option>
				            			@foreach( $yearMonth['year'] as $m => $v )
				            		  		<option value="{{ $v }}" @if(date('Y') ==  $v ) selected @endif>{{ $v }}</option>
				            			@endforeach
					            	</select>
					            </td>
					        </tr> 
					    </tbody>
					</table>
				@endif
				<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>

						<tr>
							<th width="20" align="center">No.</th>
							<th width="40">NIK</th>
							<th>Nama</th>
							<th>Tanggal</th>
							<th>Month</th>
							<th>Year</th>
							<th>Keterangan</th>

							@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
							<th width="20%">Aksi</th>
							@endif
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						@foreach($data as $d)
						<tr >
							<td align="center">{{ $no++ }}</td>
							<td>{{ str_pad( $d->nik, 4, '0', STR_PAD_LEFT) }}</td>
							<td>{{ $d->nama }}</td>
							<td>{{ $d->tanggal }}</td>
							<td>{{ $d->bulan }}</td>
							<td>{{ $d->tahun }}</td>
							<td style="font-size: .9rem">{!! $d->keterangan !!}</td>
							@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
							<td>
								<a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#update{{ $d->id }}"><i class="fa fa-pencil-square-o"></i> Edit</a>
								<a href="/report/delete/{{ $d->id }}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?');" data-popup="tooltip" data-original-title="Hapus Data"><i class="fa fa-trash"></i> Hapus</a>
								
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
@include('report.add')

@include('report.update')

@push('script')
<script type="text/javascript">
	var notificationsWrapper   = $('.dropdown-notifications');
	var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
	var notificationsCountElem = notificationsToggle.find('i[data-count]');
	var notificationsCount     = parseInt(notificationsCountElem.data('count'));
	var notifications          = notificationsWrapper.find('ul.dropdown-menu');

	if (notificationsCount <= 0) {
	  	notificationsWrapper.hide();
	}

	// Enable pusher logging - don't include this in production
	//Pusher.logToConsole = true;

	var pusher = new Pusher('aee67d2e86ec5101423e', {
	  	encrypted: true
	});

	// Subscribe to the channel we specified in our Laravel Event
	var channel = pusher.subscribe('my-channel');

	// Bind a function to a Event (the full Laravel class)
	channel.bind('my-event', function(data) {
	    console.log('my-event', data);
	    console.log(data);
	    var existingNotifications = notifications.html();
	    var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
	    var newNotificationHtml = `
		    <li class="notification active">
		        <div class="media">
		            <div class="media-left">
		              <div class="media-object">
		                  <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
		              </div>
		            </div>
		            <div class="media-body">
		                <strong class="notification-title">`+data.message+`</strong>
		                <!--p class="notification-desc">Extra description can go here</p-->
		                <div class="notification-meta">
		                  <small class="timestamp">about a minute ago</small>
		                </div>
		            </div>
		        </div>
		    </li>
	    `;
	    notifications.html(newNotificationHtml + existingNotifications);

	    notificationsCount += 1;
	    notificationsCountElem.attr('data-count', notificationsCount);
	    notificationsWrapper.find('.notif-count').text(notificationsCount);
	    notificationsWrapper.show();
	    location.reload();
	});

	$('#datatable').DataTable( {
		"order": [[ 3, "desc" ]],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false
            },
            {
                "targets": [ 4 ],
                "visible": false,
                //"searchable": false
            },
            {
                "targets": [ 5 ],
                "visible": false
            }
        ]
    } );
    @if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
	    $.fn.dataTable.ext.search.push(
	        function( settings, data, dataIndex ) {

	            var bulan = parseInt( $('#bulan').val(), 10 );
	            var clm = parseInt( data[4] ) || 0; // use data for the age column

	            if ( 
		    		( isNaN( bulan ) ) ||
		    	    ( bulan == clm && isNaN( bulan ) ) 
		    	    || (bulan == clm)
	           	){
	            	return true;
	            }
	            return false;
	        }
	    );
	    $.fn.dataTable.ext.search.push(
	        function( settings, data, dataIndex ) {
	            var tahun = parseInt( $('#tahun').val(), 10 );
	            var clm = parseInt( data[5] ) || 0; // use data for the age column
		 
		        if ( 
		        	( isNaN( tahun ) ) ||
		            ( tahun == clm && isNaN( tahun ) ) 
		            || (tahun == clm)
		        ){
		            return true;
		        }
	            return false;
	        }
	    );
	    $(document).ready(function(){
		    
		    var table = $('#datatable').DataTable();
		    $('#bulan, #tahun').on('change' ,function() {
	            table.draw();
	        } );
    	    $('#bulan, #tahun').trigger('change');
	   	});
	@endif

</script>
@endpush


@endsection