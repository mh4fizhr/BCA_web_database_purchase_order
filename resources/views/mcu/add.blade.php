<div class="modal fade" id="service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah MCU</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/backend/po/mcu/add/'.$tpo->id)}}" method="post">
          {{ csrf_field() }}
          <div class="card-body">
            <p class="text-center text-danger">*Masukkan Periode</p>
            <br>
            <div class="row form-group">
              <div class="col-md-12">
                <label for="exampleInputtext1">Tahun</label>
                <input type="number" name="tahun" class="form-control" id="tahun" placeholder="yyyy" required>
                <input type="hidden" id="po_id" name="po_id" value="{{$tpo->id}}">
                <span id="error_tahun"></span>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" id="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>