<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah addendum <?php echo $page ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container pl-5 pr-5">
        <!-- <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-edit mr-2"></i>Single</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-file mr-2"></i>Multiple</a>
                </li>
            </ul>
        </div> -->

        <br>
     
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <form action="{{url('/backend/pks/add')}}" method="post" role="form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <h4 class="text-center" id="error_pks"></h4>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Vendor</label>
                        <select class="form-control" id="vendor" name="vendor">
                          <option value="">-- pilih vendor --</option>
                          @foreach($vendors as $vendor)
                            @if($vendor->active != '1')
                            <option value="{{$vendor->NamaVendor}}">{{$vendor->NamaVendor}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-5">
                        <label for="exampleInputtext1">No pks</label>
                        <input type="text" name="no_pks" class="form-control" id="exampleInputtext1" placeholder="Enter code" required>
                      </div>
                      <div class="col-md-7">
                        <label for="exampleInputtext1">Tgl pks</label>
                        <input class="form-control date" type="text" name="tgl_pks" id="selesaisewa" placeholder="mm / dd / yyyy" required>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Nama kontrak pks</label>
                        <input type="text" name="nama_kontrak_pks" class="form-control" id="exampleInputtext1" placeholder="Enter kontrak name" required>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label for="exampleInputtext1">addendum pks</label>
                      <select class="form-control" name="addendum_id">
                        <option></option>
                        @foreach($addendums as $addendum)
                          @if($addendum->active != '1')
                          <option value="{{$addendum->id}}">{{$addendum->no_addendum}} - {{$addendum->nama_kontrak_addendum}} - {{ date('d M Y', strtotime($addendum->tgl_addendum))}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div> -->

                    <!-- <div class="form-group">
                      <label for="exampleInputtext1">addendum pks</label>
                      <select class="form-control" id="addendum_id" name="addendum_id">
                        <option value=""></option>
                      </select>
                    </div> -->

                    <div class="form-group">
                      <label for="exampleInputtext1">Keterangan</label>
                      <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <label for="exampleInputtext1">File <span class="text-warning text-sm">(maximum size : 6 mb)</span></label>
                    <div class="card text-center" style="box-shadow: 0 0 0;border: thin;border-style: dashed;">
                      <div class="card-body">
                        <input type="file" name="file" class="ml-5 mt-4 mb-4">
                      </div>
                    </div>
                  <!-- /.card-body -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-success">Submit</button>
                  </div>
                </form>
            </div>

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <!-- <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <form method="post" action="{{url('/backend/vendor/import_excel')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                <div class="modal-body">
                  
                    <div class="py-3 text-center">
                        <i class="fas fa-file-excel" style="font-size: 70px"></i>
                        <h4 class="heading mt-4">Download excel template in here</h4>
                        <a href="{{asset('file/template_vendor.xlsx')}}" class="btn btn-sm btn-primary btn-round btn-icon">
                          <span class="btn-inner--text"><i class="fas fa-file-excel"></i> &nbspVendor.xlsx</span>
                        </a>
                        <hr> 
                        <p>Please insert file.xls in here</p>
                        
                        <div class="card" style="box-shadow: 0 0 0;border: thin;border-style: dashed;">
                          <div class="card-body">
                            <input type="file" name="file" class="ml-5 mt-4 mb-4">
                          </div>
                        </div>

                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    
                </div>
                </form>
            </div> -->
        </div>
    </div>
  </div>
</div>