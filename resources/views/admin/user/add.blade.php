<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="container pl-5 pr-5">
        
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <form action="{{url('/backend/admin/user/add')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <h4 class="text-center" id="error_jkk"></h4>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Username</label>
                        <input type="text" name="name" class="form-control" id="jkk" placeholder="" required>
                      </div>
                    </div>
                    <h4 class="text-center" id="error_jkk"></h4>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">E-mail</label>
                        <input type="text" name="email" class="form-control" id="jkk" placeholder="@gmail.com" required>
                      </div>
                    </div>
                    <h4 class="text-center" id="error_jkk"></h4>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Password</label>
                        <input type="password" name="password" class="form-control" id="jkk" placeholder="" required>
                      </div>
                    </div>
                    <h4 class="text-center" id="error_jkk"></h4>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Status</label>
                        <select class="form-control " name="status" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                          <option value="">Pilih status</option>
                          <option value="pengada">BPD</option>
                          <option value="operasional">BOP</option>
                          <option value="blk">BLK</option>
                          <option value="operasional2">BOP2</option>
                        </select>
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
  </div>
</div>