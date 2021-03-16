@foreach($data as $d)
<div class="modal fade" id="update{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Permohonan</h4>
      </div>
      <div class="modal-body">
        <form action="/sliders/update/{{ $d->id }}" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-sm-3 control-label">Gambar</label>

            <div class="col-sm-9">

              <img class="profile_img" src="{{ asset('img/permohonan/'.$d->foto) }}" style="width: 100%; height: 100%" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Gambar Baru *)</label>

            <div class="col-sm-9">
              <input type="file" name="image" class="form-control" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach