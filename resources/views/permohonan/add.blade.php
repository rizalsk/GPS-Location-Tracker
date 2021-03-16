<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Form Permohonan</h4>
      </div>
      <div class="modal-body">
        <form action="/permohonan/store" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">NIK</label>

            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="hidden" name="id_pegawai" value="{{ auth()->user()->id }}" class="form-control">
              <input type="text" name="nik" value="{{ str_pad( auth()->user()->nik, 4, '0', STR_PAD_LEFT) }}" class="form-control" disabled>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Nama</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="nama" class="form-control" value="{{ auth()->user()->nama }}" disabled>
            </div>
          </div> 
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Tgl Pengajuan</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" name="tgl_pengajuan" class="form-control" value="{{ $tgl }}" readonly>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Jenis</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <select name="jenis" required class="form-control">
                <option disabled>pilih jenis</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="cuti">Cuti</option>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Mulai Tgl</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-mulai_tgl'>
                  <input type='text' name="mulai_tgl" class="form-control" required/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-6">Sampai Tgl</label>
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class='input-group' id='dt-sampai_tgl'>
                  <input type='text' name="sampai_tgl" class="form-control" required/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-6">Keterangan</label>
            <div class="col-md-10 col-sm-10 col-xs-6">
              <textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="3"></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3">
              <div class="" style="height:100px">
                <img id="img-permohonan" src="{{ asset('img/noimage.png') }}" class="img-responsive mx-auto" alt="..." style="height:100px;margin:auto">
                
              </div>
              <input type="file" name="foto" id="foto" class="form-control border" onchange="function showPict(e){
                    var file = e.target.files[0];
                    var fileReader = new FileReader();
                    fileReader.onload = function(e) { 
                        $('#img-permohonan').attr('src',fileReader.result )
                    };
                    fileReader.readAsDataURL(file);
                } showPict(event)">
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
        $('#dt-mulai_tgl, #dt-sampai_tgl').datetimepicker({
          format: 'YYYY-MM-DD', 
        });
    });
</script>

@endpush