<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Sliders</h4>
      </div>
      <div class="modal-body">
        <form action="/sliders/add" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-sm-2 control-label">Gambar</label>
            <div class="col-sm-10">
              <input type="file" name="image" class="form-control" required="">
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