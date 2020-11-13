<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo $page2 ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('/backend/bbm/add')}}" method="post" role="form">
          {{ csrf_field() }}
          <div class="card-body">
            <h4 class="text-center" id="error_bbm"></h4>
            <div class="row form-group">
              <div class="col-md-12">
                <label for="exampleInputtext1">Jenis BBM</label>
                <input type="text" name="jenis_bbm" class="form-control" id="bbm" placeholder="" required>
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