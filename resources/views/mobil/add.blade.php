<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo $page ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="container pl-5 pr-5">
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-edit mr-2"></i>Single</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-file mr-2"></i>Multiple</a>
                </li>
            </ul>
        </div>

        <br>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <form action="{{url('/backend/mobil/create')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <h4 class="text-center" id="error_mobil"></h4>
                    <div class="row form-group">
                      <div class="col-md-8">
                        <label for="exampleInputtext1">Kode Mobil</label>
                        <input type="text" name="kodemobil" class="form-control" id="kodemobil" placeholder="Enter code">
                        
                      </div>
                      <div class="col-md-4">
                        <label for="exampleInputtext1">Merek Mobil</label>
                        <input type="text" name="merekmobil" class="form-control" id="merekmobil" placeholder="Enter brand">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-6">
                          <label for="exampleInputtext1">Type Mobil</label>
                          <input type="text" name="type" class="form-control" id="typemobil" placeholder="Enter brand">
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputtext1">Tahun Mobil</label>
                          <select class="form-control" name="tahun" id="tahun">
                            @foreach($tahuns as $tahun)
                              @if($tahun->active != '1')
                                <option value="{{$tahun->Tahun}}">{{$tahun->Tahun}}</option>
                              @endif
                            @endforeach
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

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <form method="post" action="{{url('/backend/mobil/import_excel')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                <div class="modal-body">
                  
                    <div class="py-3 text-center">
                        <i class="fas fa-file-excel" style="font-size: 70px"></i>
                        <h4 class="heading mt-4">Download excel template in here</h4>
                        <a href="{{asset('file/template_mobil.xlsx')}}" class="btn btn-sm btn-primary btn-round btn-icon">
                          <span class="btn-inner--text"><i class="fas fa-file-excel"></i> &nbspmobil.xlsx</span>
                        </a>
                        <hr> 
                        <p>Please insert file.xls in here</p>
                        <!-- <div class="dropzone dropzone-single ml-5 mr-5" data-toggle="dropzone" data-dropzone-url="http://">
                            <div class="fallback">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="dropzoneBasicUpload">
                                    <label class="custom-file-label" for="dropzoneBasicUpload">Choose file</label>
                                </div>
                            </div>

                            <div class="dz-preview dz-preview-single">
                                <div class="dz-preview-cover">
                                    <img class="dz-preview-img" src="..." alt="..." data-dz-thumbnail>
                                </div>
                            </div>
                        </div> -->


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
            </div>
        </div>

      </div>

    </div>
  </div>
</div>