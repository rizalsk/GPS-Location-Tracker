<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
		        </button>
		        <h4 class="modal-title" id="myModalLabel">Form Report</h4>
		    </div>
		    <div class="modal-body">
		        <form action="/report/store" method="post" enctype="multipart/form-data" class="form-horizontal">
			        {{ csrf_field() }}
			        <div class="form-group">
			            <label class="control-label col-md-2 col-sm-2 col-xs-6">NIK</label>

			            <div class="col-md-4 col-sm-4 col-xs-6">
			              	<input type="hidden" name="id_absensi" value="{{ $exist ? $absensi->id : 0 }}" class="form-control">
			              	<input type="text" name="nik" value="{{ str_pad( auth()->user()->nik, 4, '0', STR_PAD_LEFT) }}" class="form-control" disabled>
			            </div>

			            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama</label>
			            <div class="col-md-4 col-sm-4 col-xs-6">
			              	<input type="text" name="nama" class="form-control" value="{{ auth()->user()->nama }}" disabled>
			            </div>
			        </div> 
			        <div class="form-group">
			            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tanggal</label>
			            <div class="col-md-4 col-sm-4 col-xs-6">
			              	<input type="text" name="tanggal" class="form-control" value="{{ $exist ? $absensi->tanggal : 0 }}" disabled>
			            </div>
			        </div> 

			        <div class="form-group">
			            <label class="control-label col-md-2 col-sm-2 col-xs-6">Keterangan</label>
			            <div class="col-md-10 col-sm-10 col-xs-6">
			              	<textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" rows="3"></textarea>
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
@push('script')
<script type="text/javascript">
    $(function () {
        /*$('#dt-mulai_tgl, #dt-sampai_tgl').datetimepicker({
          format: 'YYYY-MM-DD', 
        });
        */
    }); 
	
  	var ket1 = document.getElementById("keterangan");
    	CKEDITOR.replace(ket1,{
    	language:'en-gb'
  	});
   	

  	CKEDITOR.config.allowedContent = true;
</script>

@endpush