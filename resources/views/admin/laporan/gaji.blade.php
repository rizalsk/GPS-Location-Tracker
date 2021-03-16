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
		        <div class="row">
		        	
		        	<div class="col-md-6">
		        		<button class="btn btn-success pull-left" onclick="print()"><i class="fa fa-print"></i></button>
		        	</div>
			        <div class="col-md-6 col-lg-6 pull-right">
	        	        <form action="/gaji/create" method="get" enctype="multipart/form-data" class="form-inline" autocomplete="off">
	        		        {{ csrf_field() }}
				            <select class="form-control" name="bulan" >
				            	<option value="">-- pilih bulan --</option>
				              	@foreach( $yearMonth['month'] as $m => $v )
				                	<option value="{{ $v['value'] }}" @if( $v['value'] == Date('m') ) 'selected' @endif >{{ $v['name'] }}</option>
				              	@endforeach
				            </select>
				            <select class="form-control" name="tahun" >
				            	<option value="">-- pilih bulan --</option>
				            	@foreach( $yearMonth['year'] as $m => $v )
				              		<option value="{{ $v }}" @if( $v == Date('Y') ) 'selected' @endif >{{ $v }}</option>
				            	@endforeach
				            </select>
			            	<button type="submit" class="btn btn-primary" style="margin-bottom: 0">Cari Data</button>
			            </form>
			        </div>
		        </div>
		        
			        
		        
		    </div>

		    <div class="x_content col-md-12"  >
		        <div style="">
		            <div style="overflow-x: scroll; overflow-y: hidden;">
			            <table class="table table-striped table-responsive table-bordered nowrap " cellspacing="0" >
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
		            </div>
		        </div>
		    </div>
	    </div>
	</div>
</div>

<!-- Large modal -->

<div class="modal fade bs-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header bg-info">
      		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      		    <h4 class="modal-title text-center" id="gridSystemModalLabel">LAPORAN GAJI</h4>
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
	function print(){
		
		$('#frame-slip').attr('src', '/laporan/gaji/print');
		$('.bs-modal-lg').modal('show');
	}

	$('.bs-modal-lg').on('hidden.bs.modal', function () {
	    $('#frame-slip').html('');
	    $('#frame-slip').attr('src', 'about:blank');
	});
</script>
@endpush