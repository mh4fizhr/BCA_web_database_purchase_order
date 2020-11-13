<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo $page2 ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="container pl-5 pr-5">
     
        
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <form action="{{url('/backend/cp/add')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <!-- <p class="text-center text-danger">*Masukkan data <?php echo $page2 ?> sesuai petunjuk yang ada di form</p>
                    <br> -->
                    <h4 class="text-center" id="error_kota"></h4>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Jenis</label>
                        <input type="text" class="form-control" id="jenis" placeholder="CP" disabled="">
                        <input type="hidden" name="jenis" value="CP">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Coverage area</label>
<!--                         <select class="form-control" id="kota" name="kota" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                          <option value="">Pilih kota</option>
                          @foreach($kotas as $kota)
                            @if($kota->active != '1')
                              <option value="{{$kota->Kota}}">{{$kota->Kota}}</option>
                            @endif
                          @endforeach
                        </select> -->
                        <input type="text" class="form-control" id="kota" name="kota" placeholder="" >
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

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

          
        </div>
      </div>

    </div>
  </div>
</div>