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
                <form action="{{url('/backend/ump/harga_ump/add')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <div class="card-body">
                    <!-- <p class="text-center text-danger">*Masukkan data <?php echo $page2 ?> sesuai petunjuk yang ada di form</p> -->
                    <div class="text-center">
                      <span id="error_harga_ump"></span>
                    </div>
                    

                    <div class="row">                   
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tahun </label>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <select class="form-control" id="tahun" name="tahun_id" data-toggle="select"  required>
                            <option value="">Pilih Tahun</option>
                            @foreach($tahuns as $tahun)
                              @if($tahun->active != '1')
                                <option value="{{$tahun->Tahun}}">{{$tahun->Tahun}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">                   
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Vendor </label>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <select class="form-control" id="vendor" name="vendor_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">Pilih Vendor</option>
                            @foreach($vendors as $vendor)
                              @if($vendor->active != '1')
                                <option value="{{$vendor->KodeVendor}}">{{$vendor->KodeVendor}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">                   
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label ml-3 mt-3" for="example3cols1Input">kota </label>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <select class="form-control" id="kota" name="kota_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">Pilih kota</option>
                            @foreach($kotas as $kota)
                              @if($kota->active != '1')
                                <option value="{{$kota->Kota}}">{{$kota->Kota}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">                   
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label ml-3 mt-3" for="example3cols1Input">jkk </label>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <select class="form-control " name="jkk_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">Pilih jkk</option>
                            @foreach($jkks as $jkk)
                              @if($jkk->active != '1')
                                <option value="{{$jkk->jkk}}">{{$jkk->jkk}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga Include </label>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <input type="text" class="form-control" name="harga_include" onkeyup="myFunction()" id="Harga_include"  data-a-dec="," data-a-sep="." required>
                          <input type="hidden" name="harga_include_hidden" id="Harga_include_hidden">
                          <!-- data-a-sign="Rp. " -->
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga Eksclude </label>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <input type="text" class="form-control" name="harga_eksclude"  id="Harga_eksclude" required>
                          <input type="hidden" name="harga_eksclude_hidden" id="Harga_eksclude_hidden">
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                          <label class="form-control-label ml-3 mt-3" for="example3cols1Input">/ </label>
                        </div>
                      </div>

                      <div class="col-md-1">
                        <label class="custom-toggle" style="margin-top: 12px">
                            <input id="yes" type="checkbox" checked>
                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                            <input type="hidden" id="toggle" name="toggle" value="">
                        </label>
                      </div>


                      <div class="col-md-2">
                        <div class="form-group"  id="number">
                          <input type="number" class="form-control" name="pembagi" id="numbers" step="0.01" value="1.1" required>
                        </div>
                      </div>
                    </div>
        <!-- <p>My name is: <span id="demo"></span></p> -->
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
                <form method="post" action="{{url('/backend/hargaump/import_excel')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                <div class="modal-body">
                  
                    <div class="py-3 text-center">
                        <i class="fas fa-file-excel" style="font-size: 70px"></i>
                        <h4 class="heading mt-4">Download excel template in Here</h4> 
                          <a href="{{asset('file/template_ump.xlsx')}}" class="btn btn-sm btn-primary btn-round btn-icon">
                            <span class="btn-inner--text"><i class="fas fa-file-excel"></i> &nbspump.xlsx</span>
                          </a>
                         <!-- <a href="{{asset('file/template_cabang.xlsx')}}">Here</a></h4> -->
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


<script type="text/javascript">


  $('#Harga_include, #numbers').on('keyup',function() {
    var x = document.getElementById("Harga_include").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#Harga_include_hidden').val(qty);
    var price = parseFloat($('#numbers').val());
    var total = qty / price ? qty / price : 0;
    total = total.toFixed(2);
    $('#Harga_eksclude_hidden').val(total);
    var hasil = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $('#Harga_eksclude').val(hasil);
  });

  $('#Harga_include, #numbers').on('input',function() {
    var x = document.getElementById("Harga_include").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#Harga_include_hidden').val(qty);
    var price = parseFloat($('#numbers').val());
    var total = qty / price ? qty / price : 0;
    total = total.toFixed(2);
    $('#Harga_eksclude_hidden').val(total);
    var hasil = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $('#Harga_eksclude').val(hasil);
  });


  var pembagi = 0;
  var a = 0
  $("#yes").click(function(){
    if(a == 0){
      $('#Harga_include').val('');
      $('#Harga_eksclude').val('');
      // $("#numbers").prop('disabled', true);
      $('#number').empty();
      // $('#toggle').val('yes');
      a++;

      $('#Harga_eksclude').on('keyup',function() {
        $('#toggle').val('no');
        var x = document.getElementById("Harga_eksclude").value;
        var z = x.replace(/\./g, "");
        var qty = parseInt(z);
        $('#Harga_eksclude_hidden').val(qty);
        var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#Harga_eksclude').val(hasil);
      });
      $('#Harga_eksclude').on('input',function() {
        $('#toggle').val('no');
        var x = document.getElementById("Harga_eksclude").value;
        var z = x.replace(/\./g, "");
        var qty = parseInt(z);
        $('#Harga_eksclude_hidden').val(qty);
        var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#Harga_eksclude').val(hasil);
      });
      $('#toggle').val('no');

    }else{

      $('#Harga_include').val('');
      $('#Harga_eksclude').val('');
      // $("#numbers").prop('disabled', false);
      $('#number').append('<input type="number" class="form-control" name="pembagi" id="numbers" step="0.01" value="1.1" required>');
      a--;

      $('#Harga_include, #numbers').on('keyup',function() {
        $('#toggle').val('');
        var x = document.getElementById("Harga_include").value;
        var z = x.replace(/\./g, "");
        var qty = parseInt(z);
        $('#Harga_include_hidden').val(qty);
        var price = parseFloat($('#numbers').val());
        var total = qty / price ? qty / price : 0;
        total = total.toFixed(2);
        $('#Harga_eksclude_hidden').val(total);
        var hasil = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#Harga_eksclude').val(hasil);
      });

      $('#Harga_include, #numbers').on('input',function() {
        $('#toggle').val('');
        var x = document.getElementById("Harga_include").value;
        var z = x.replace(/\./g, "");
        var qty = parseInt(z);
        $('#Harga_include_hidden').val(qty);
        var price = parseFloat($('#numbers').val());
        var total = qty / price ? qty / price : 0;
        total = total.toFixed(2);
        $('#Harga_eksclude_hidden').val(total);
        var hasil = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#Harga_eksclude').val(hasil);
      });

      $('#toggle').val('');
    }
  });

  $(document).ready(function() {

      $('#Harga_include').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});
    
      $('#Harga_eksclude').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});

  });

  

</script>