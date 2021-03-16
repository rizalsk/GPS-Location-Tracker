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
						<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Buat Permohonan</button>
						
						<div class="clearfix"></div>
					</div>
				</div>
				@if( Auth::user()->level == 'hrd' || Auth::user()->level == 'developer' )

				@endif
				
			</div>

			<div class="x_content">
				<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nik</th>
							<th>Nama</th>
							<th>Permohonan</th>
							<th>Tgl Pengajuan</th>
							<th>Mulai Tgl</th>
							<th>Sampai Tgl</th>
							<th>Foto</th>
							<th>Keterangan</th>
							<th>Status</th>
							@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
							<th width="20%">Aksi</th>
							@endif
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						@foreach($data as $d)
						<tr style="color:white;background: @if( $d->status == 'diterima') green @elseif( $d->status == 'ditolak')red @else yellow;color:black; @endif " >
							<td>{{ $no++ }}</td>
							<td>{{ str_pad( $d->pegawai->nik, 4, '0', STR_PAD_LEFT) }}</td>
							<td>{{ $d->pegawai->nama }}</td>
							<td>{{ $d->jenis }}</td>
							<td>{{ $d->tgl_pengajuan }}</td>
							<td>{{ $d->mulai_tgl }}</td>
							<td>{{ $d->sampai_tgl }}</td>
							<td>
								<a href="javascript:void(0)" onclick="">
									<img src="{{ asset( is_null($d->foto) ? 'img/noimage.png': 'img/permohonan/'.$d->foto) }}" style="width: auto; height: 20vh">
								</a>
							</td>
							<td>{{ $d->keterangan }}</td>
							<td>{{ $d->status }}</td>
							@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
							<td>
								@if($d->status == 'menunggu')
								<a class="btn btn-xs btn-warning" href="/permohonan/status/diterima/{{ $d->id }}"><i class="fa fa-pencil-square-o"></i> Terima</a>

								<a class="btn btn-xs btn-danger" href="/permohonan/status/ditolak/{{ $d->id }}"><i class="fa fa-pencil-square-o"></i> Tolak</a>
								@endif

								<!-- <a href="/permohonan/delete/{{ $d->id }}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?');" data-popup="tooltip" data-original-title="Hapus Data"><i class="fa fa-trash"></i> Hapus</a> -->
								
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

@include('permohonan.add')

@include('permohonan.update')

@endsection