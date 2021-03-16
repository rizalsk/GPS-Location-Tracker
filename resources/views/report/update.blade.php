@foreach($data as $d)
	<div class="modal fade" id="update{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
			        </button>
			        <h4 class="modal-title" id="myModalLabel">Edit Report</h4>
			    </div>
			    <div class="modal-body">
			        <form action="/report/update/{{ $d->id }}" method="post" enctype="multipart/form-data" class="form-horizontal">
			          	{{ csrf_field() }}
  				        <div class="form-group">
  				            <label class="control-label col-md-2 col-sm-2 col-xs-6">NIK</label>

  				            <div class="col-md-4 col-sm-4 col-xs-6">
  				              	<input type="hidden" name="id_absensi" value="{{ $d->id_absensi }}" class="form-control">
  				              	<input type="text" name="nik" value="{{ str_pad( $d->nik, 4, '0', STR_PAD_LEFT) }}" class="form-control" disabled>
  				            </div>

  				            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama</label>
  				            <div class="col-md-4 col-sm-4 col-xs-6">
  				              	<input type="text" name="nama" class="form-control" value="{{ $d->nama }}" disabled>
  				            </div>
  				        </div> 
  				        <div class="form-group">
  				            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tanggal</label>
  				            <div class="col-md-4 col-sm-4 col-xs-6">
  				              	<input type="text" name="tanggal" class="form-control" value="{{ $d->tanggal }}" disabled>
  				            </div>
  				        </div> 

  				        <div class="form-group">
  				            <label class="control-label col-md-2 col-sm-2 col-xs-6">Keterangan</label>
  				            <div class="col-md-10 col-sm-10 col-xs-6">
  				              	<textarea id="keterangan-{{$d->id}}" name="keterangan" class="form-control keterangan" placeholder="Keterangan" rows="3">{!! $d->keterangan !!}</textarea>
  				            </div>
  				        </div>

  				        <div class="modal-footer">
  				            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
  				            <button type="submit" class="btn btn-primary">Simpan</button>
  				        </div>
			        </form>
			    </div>
		    </div>
		</div>
	</div>
@endforeach
@push('script')
<script type="text/javascript"> 
	@foreach($data as $d)
		var konten{{$d->id}} = document.getElementById("keterangan-{{$d->id}}");
	  	CKEDITOR.replace( konten{{$d->id}},{
	  	language:'en-gb'
		});
	@endforeach 
</script>

@endpush
