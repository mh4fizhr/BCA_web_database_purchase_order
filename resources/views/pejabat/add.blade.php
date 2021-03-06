<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo $page2 ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="container pl-5 pr-5">
        

        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <form action="{{url('/backend/pejabat/add')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <!-- <p class="text-center text-danger">*Masukkan data <?php echo $page2 ?> sesuai petunjuk yang ada di form</p>
                    <br> -->
                    <!-- <h4 class="text-center" id="error_pejabat"></h4> -->
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Nama Pejabat</label>
                        <input type="text" name="pejabat" class="form-control" id="pejabat" placeholder="" required>
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col-md-6">
                        <label for="exampleInputtext1">Jabatan</label>
                        <select class="form-control" id="jabatan" name="jabatan">
                          @foreach($jabatans as $jabatan)
                            @if($jabatan->active != '1')
                              <option value="{{$jabatan->jabatan}}">{{$jabatan->jabatan}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputtext1">Unit kerja</label>
                        <select class="form-control" id="unitkerja" name="unitkerja">
                          @foreach($unitkerjas as $unitkerja)
                            @if($unitkerja->active != '1')
                              <option value="{{$unitkerja->unitkerja}}">{{$unitkerja->unitkerja}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </form>
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        </div>
      </div>

    </div>
  </div>
</div>