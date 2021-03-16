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
				@if(count($data) == 0 )
				<div class="row">
					<div class="col-md-12">
						<a class="btn btn-xs btn-primary" href="/kantor/create" ><i class="fa fa-plus"></i> Tambah Kantor</a>
						
						<div class="clearfix"></div>
					</div>
				</div>
				@endif
			</div>

			<div class="x_content">
				<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Telp</th>
							<th>Radius</th>
							<th>Latitude</th>
							<th>Longtitude</th>
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
							<td>{{ $d->nama }}</td>
							<td>{{ $d->alamat }}</td>
							<td>{{ $d->telp }}</td>
							<td>{{ $d->radius }}</td>
							<td>{{ $d->latitude }}</td>
							<td>{{ $d->longtitude }}</td>
							@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
							<td>

								<a href="/kantor/edit/{{ $d->id }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o"></i> Edit</a>
								<a href="/kantor/delete/{{ $d->id }}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?');" data-popup="tooltip" data-original-title="Hapus Data"><i class="fa fa-trash"></i> Hapus</a>

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