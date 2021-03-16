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
				<h2>{{ $title }}</h2>
				<button class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Sliders</button>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No.</th>
							<th>Gambar</th>
							<th width="20%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						@foreach($sliders as $slider)
						<tr>
							<td>{{ $no++ }}</td>
							<td>
								<img src="{{ asset('img/sliders/'.$slider->image) }}" style="width: auto; height: 20vh">
							</td>
							<td>
								<a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#update{{ $slider->id }}"><i class="fa fa-pencil-square-o"></i> Edit</a>
								<a href="/sliders/delete/{{ $slider->id }}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?');" data-popup="tooltip" data-original-title="Hapus Data"><i class="fa fa-trash"></i> Hapus</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

@include('admin.sliders.add')

@include('admin.sliders.update') 

@endsection