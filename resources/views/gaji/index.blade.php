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
				@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
					<div class="row">
						<div class="col-md-12">
							<a class="btn btn-xs btn-success" href="/gaji/create" ><i class="fa fa-plus"></i> Proses Penggajian</a>
							
							<div class="clearfix"></div>
						</div>
					</div>
				@endif
				
			</div>

			<div class="x_content">
				<table id="datatable" class="table table-responsive table-striped table-bordered nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th rowspan="2">No.</th>
							<th rowspan="2">NIK</th>
							<th rowspan="2">Nama</th>
							<th colspan="2">Periode</th>
							<th rowspan="2">Gaji Pokok</th>
							<th colspan="4">Ringkasan Kehadiran</th>
							<th colspan="4">Potongan</th>
							<th rowspan="2">Bonus</th>
							<th rowspan="2">Total</th>
							<th rowspan="2">Keterangan</th>
							@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
							<th rowspan="2" width="20%">Aksi</th>
							@endif
						</tr>
						<tr>
							<th>Tahun</th>
							<th>Bulan</th>
							<th>Hr Kerja</th>
							<th>Hr Izin</th>
							<th>Hr Sakit</th>
							<th>Hr Cuti</th>
							<th>BPJS Kes.</th>
							<th>BPJS TK.</th>
							<th>BPJS JHT.</th>
							<th>Pot. Lain</th>							
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						@foreach($data as $d)
						<tr  >
							<td>{{ $no++ }}</td>
							<td>{{ str_pad( $d->nik, 4, '0', STR_PAD_LEFT) }}</td>
							<td>{{ $d->nama_pegawai }}</td>
							<td>{{ $d->tahun }}</td>
							<td>{{ $d->bulan }}</td>
							<td>{{ $d->gaji_pokok }}</td>
							<td>{{ $d->hari_kerja }}</td>
							<td>{{ $d->hari_izin }}</td>
							<td>{{ $d->hari_sakit }}</td>
							<td>{{ $d->hari_cuti }}</td>
							<td>{{ $d->bpjs_kesehatan }}</td>
							<td>{{ $d->bpjs_tk }}</td>
							<td>{{ $d->bpjs_jht }}</td>
							<td>{{ $d->potongan_lain }}</td>
							<td>{{ $d->bonus }}</td>
							<td>{{ $d->total }}</td>
							<td>{{ $d->keterangan }}</td>
							
							<td>
								<a onclick="openSlip('{{ $d->id }}')" class="btn btn-xs btn-success"><i class="fa fa-print" ></i> Slip</a>

								@if( auth()->user()->level == 'hrd' || auth()->user()->level == 'developer' )
									<a href="/gaji/edit/{{ $d->id }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o"></i> Edit</a>
									<a href="/gaji/delete/{{ $d->id }}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda ingin menghapus data ini?');" data-popup="tooltip" data-original-title="Hapus Data"><i class="fa fa-trash"></i> Hapus</a>
								@endif

							</td>
							
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<!-- Large modal -->

<div class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header bg-info">
      		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      		    <h4 class="modal-title text-center" id="gridSystemModalLabel">Slip Gaji</h4>
      		</div>
      		<div class="modal-body p-0">
      			<div class="embed-responsive embed-responsive-16by9">
      			    <iframe id="frame-slip" class="embed-responsive-item" src="about:blank">
      			    	
      			    </iframe>
      			</div>
      		</div>
    	</div>
  	</div>
</div>

@endsection

@push('script')

<script type="text/javascript">
	function openSlip(id){
		
		$('#frame-slip').attr('src', '/gaji/slip/'+id);
		$('.bs-example-modal-lg').modal('show');
	}

	$('.bs-example-modal-lg').on('hidden.bs.modal', function () {
	    $('#frame-slip').html('');
	    $('#frame-slip').attr('src', 'about:blank');
	});
</script>
@endpush