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
			<div class="x_title">
				<div class="row">
					<div class="col-md-12 clearfix">
						
						<h2>{{ $title }}</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<a class="btn btn-xs btn-success" href="/absensi/create" ><i class="fa fa-fax"></i> Absen</a>
						
						<div class="clearfix"></div>
						@if ($message = Session::get('full_absen'))
							<div class="alert alert-info alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button> 
								<strong>{{ $message }}</strong>
							</div>
						@endif
					</div>
				</div>
				
			</div>

			<div class="x_content">
				<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nik</th>
							<th>Nama</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Jam Masuk</th>
							<th>Jam Pulang</th>
							<th>Jarak</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Kantor</th>
							@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
							<th width="20%">Aksi</th>
							@endif
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						@foreach($data as $d)
						<tr  >
							<td>{{ $no++ }}</td>
							<td>{{ str_pad( $d->pegawai->nik , 4, '0', STR_PAD_LEFT) }}</td>
							<td>{{ $d->pegawai->nama }}</td>
							<td>{{ $d->tanggal }}</td>
							<td>{{ $d->status }}</td>
							<td>{{ $d->jam_masuk }}</td>
							<td>{{ $d->jam_pulang }}</td>
							<td>{{ ( $d->jarak ) }} Meter</td>
							<td>{{ $d->latitude }}</td>
							<td>{{ $d->longitude }}</td>
							<td>{{ $d->kantor->nama }}</td>
							
							@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
							<td>

								<a href="/absensi/edit/{{ $d->id }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o"></i> Edit</a>
								<a href="/absensi/delete/{{ $d->id }}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?');" data-popup="tooltip" data-original-title="Hapus Data"><i class="fa fa-trash"></i> Hapus</a>

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

@endsection