<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo $page ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="{{url('/backend/ump/create')}}" method="post" role="form">
          {{ csrf_field() }}
          <div class="card-body">
            <p class="text-center text-danger">*Masukkan data <?php echo $page ?> sesuai petunjuk yang ada di form</p>
            <br>

            <div class="form-group">
                <label for="exampleInputtext1">Nama kota</label>
                <input type="text" name="kota" class="form-control" id="exampleInputtext1" placeholder="jakarta">
            </div>
            <div class="row form-group">
              <div class="col-md-6">
                <label for="exampleInputtext1">Daerah</label>
                <select class="form-control" name="daerah1">
                  <option value="Jabodetabek">Jabodetabek</option>
                  <option value="Non Jabodetabek">Non Jabodetabek</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="exampleInputtext1">Provinsi</label>
                <select class="form-control" name="daerah2">
                  <option value="JawaBarat">Jawa Barat</option>
                  <option value="JawaTimur">Jawa Timur</option>
                  <option value="JawaTengah">Jawa Tengah</option>
                  <option value="LuarJawa">Luar Jawa</option>
                </select>
              </div>
            </div>              
            <div class="form-group">
                <label for="exampleInputtext1">UMP</label>
                <input type="text" name="ump" class="form-control" id="exampleInputtext1" placeholder="Rp 5.000.000">
            </div>
          <!-- /.card-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>