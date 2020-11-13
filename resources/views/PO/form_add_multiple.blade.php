<?php $page = "Penambahan"; ?>
@extends('sidebar')

@section('content')


@foreach($errors->all() as $message)
      <div>{{ $message }}</div>
    @endforeach


@if(session('errors'))
  @foreach($errors as $error)
    <li>{{$error}}</li>
  @endforeach
@endif

@if(session('success'))
  {{session('success')}}
@endif

<?php $nopol_id = '' ?>
<!--   <script src="{{asset('dist/argon/vendor/jquery/dist/jquery.min.js')}}"></script> -->

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} PO</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$page}} PO</li>
                </ol>
              </nav>
            </div>

            <!-- <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div> -->
          </div>
          <!-- Card stats -->

        </div>
      </div>
    </div>
    <div class="container-fluid mt--6">
      <section class="content">
        <div class="row">
          <div class="col-12">

            

            <form action="{{url('/backend/po/create/multiple')}}" method="post" role="form" id="dynamic_form">
              {{ csrf_field() }}

              <div class="card pb-4 pt--8">
                <div class="card-header border-0">
                  <div class="row">
                    <div class="col-6">
                      <h3 class="mb-0">Multiple Insert PO</h3>

                    </div>
                    <div class="col-6 text-right">
                      <a href="javascript:history.back()" class="btn btn-sm btn-dark btn-round btn-icon" data-toggle="tooltip" data-original-title="back">
                        <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-inner--text">Back</span>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-1">
                          <div class="form-group">
                            <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No PO </label>
                          </div>
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="myNumber" name="nopo" class="form-control" id="example3cols2Input" required>            
                    </div>

                    <div class="col-md-1">
                          <div class="form-group text-center">
                            <label class="form-control-label mt-3" for="example3cols1Input">QTY </label>
                          </div>
                    </div>
                    
                    <div class="col-md-3">
                      <!-- <div class="form-group" style="width: 200px">
                        <select class="form-control" id="qty" name="qty">
                          <option value="qty">QTY</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>  -->
                      <input class="form-control" placeholder="QTY" type="text" id="txtNoOfRec"  />
                    </div>
                    <div class="col-md-4">
                      <input type="button" class="btn btn-danger" value="Create" id="btnNoOfRec" />
                    </div>
                  </div>
                  
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-1">
                          <div class="form-group">
                            <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Vendor </label>
                          </div>
                    </div>
                    <div class="col-md-3">     
                        <select class="form-control select2" id="vendors" name="vendor_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                          <option value=""></option>
                          @foreach($vendors as $vendor)
                            @if($vendor->active != 1)
                            <option value="{{$vendor->id}}">{{$vendor->KodeVendor}}</option>
                            @endif
                          @endforeach
                        </select>
                    </div>
                    
                  </div>                 
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-1">
                          <div class="form-group">
                            <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Sewa </label>
                          </div>
                    </div>
                    <div class="col-md-3">     
                        <input class="form-control date" id="ms" type="text" id="example-date-input" placeholder="mm / dd / yyyy">
                    </div>

                    <div class="col-md-1">
                          <div class="form-group text-center">
                            <label class="form-control-label mt-3" for="example3cols1Input">s/d </label>
                          </div>
                    </div>
                    <div class="col-md-3">     
                        <input class="form-control date" id="ss" type="text" id="example-date-input" placeholder="mm / dd / yyyy">
                    </div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-info pl-4 pr-4" onclick="myFunction()">Set</button>
                    </div>
                  </div>                 
                </div>

                <div class="mt-3">
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover " id="myTable">
                      <thead class="">
                        <tr>
                          <th scope="col"><b>Jenis Sewa</b></th>
                          <th scope="col"><b>Nopol</b></th>
                          <th scope="col"><b>CP/D</b></th>
                          <th></th>
                          <th scope="col"><b>Type/Unit</b></th>
                          <th scope="col"><b>Cabang</b></th>
                          <th scope="col"><b>Mulai Sewa</b></th>                       
                          <th scope="col"><b>Selesai Sewa</b></th>
                          <th scope="col"><b>Harga Sewa Mobil(Rp)</b></th>
                          <th scope="col"><b>Harga Sewa Driver</b></th>
                          <th scope="col"><b>BBM (liter)</b></th>
                          <th scope="col"><b>Jenis BBM</b></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php for ($i=1; $i <= 10; $i++) { ?>

                        <tr id="ke-{{$i}}">
                          <td>
                            <div  style="width: 200px">
                              <select class="form-control" id="sewa{{$i}}" name="sewa[]">
                                <option value=""></option>
                                <option value="Mobil+Driver">Mobil + Driver</option>
                                <option value="Mobil">Mobil</option>
                                <option value="Driver">Driver</option>
                              </select>
                            </div>
                          </td>
                          
                          <td>
                            <div style="width: 200px" id="po_nopol{{$i}}">
                              <!-- <select class="form-control" name="nopol[]" id="nopol{{$i}}" disabled>
                                <option value="null">Tanpa Unit</option>
                                @foreach($pos as $po)
                                  @if($po->Sewa_sementara == "Mobil" && $po->status == "1")
                                    <option value="{{$po->Nopol}}">{{$po->Nopol}}</option>
                                    <?php $nopol_id = $po->Nopol ?>
                                  @endif
                                @endforeach
                              </select> -->


                              <select class="form-control select2" name="nopol[]" id="nopol{{$i}}" disabled>
                                <option value="null">Tanpa Unit</option>
                                @foreach($pos as $po)
                                  @if($po->Sewa_sementara == "Mobil" && $po->status == "1")
                                    <option value="{{$po->Nopol}}">{{$po->Nopol}}</option>
                                    <?php $nopol_id = $po->Nopol ?>
                                  @endif
                                @endforeach
                              </select>

                              <div >
                                <input id="nopol_null{{$i}}" type="hidden" name="nopol[]" value="" disabled>
                              </div>

                            </div>
                            <div id="taro">
                              
                            </div>
                          </td>
                          <!-- <td id="driver{{$i}}">
                            <span class="badge badge-lg badge-danger">Tidak Ada Nopol</span>
                            <div id="nopol{{$i}}">

                            </div>
                          </td>

                          <td id="mobil{{$i}}">
                            <div  style="width: 100px">
                              <span id="mobil{{$i}}" class="badge badge-lg badge-success">Ada Nopol</span>
                            </div>
                          </td> -->
                          
                          <td>
                            <div  style="width: 100px">
                              <select class="form-control" id="CPD{{$i}}">
                                <option value=""></option>
                                <option value="CP">CP</option>
                                <option value="D">D</option>
                              </select>
                            </div>  
                          </td>

                          <td>
                            <div  style="width: 200px">
                              <select class="form-control select2" id="CP{{$i}}" name="CP[]" disabled required>
                                <!-- <option value="null">Tanpa Unit</option> -->
                                <option value="">Pilih carpooling</option>
                                @foreach($cps as $cp)
                                  @if($cp->active != '1')
                                  <option value="{{$cp->jenis}} - {{$cp->kota}}">{{$cp->jenis}} - {{$cp->kota}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <input type="hidden" id="D{{$i}}" name="CP[]" value="D" disabled>
                            </div>  
                          </td>


                          <td>
                            <div style="width: 300px">
                              <div >
                              <select class="form-control select2" id="type{{$i}}" name="mobil_id[]">
                                <option value="null">Tanpa Unit</option>
                                @foreach($mobils as $mobil)
                                  @if($mobil->active != '1')
                                  <option value="{{$mobil->id}}">{{$mobil->MerekMobil}}&nbsp{{$mobil->Type}}&nbsp- {{$mobil->Tahun}}</option>
                                  @endif
                                @endforeach
                              </select>
                              </div>


                              <!-- <input type="text" class="form-control" id="type{{$i}}" name="type[]" id="example3cols2Input" placeholder="" value="null">
                              <input type="text" class="form-control" id="type_disabled{{$i}}" name="type[]" id="example3cols2Input" placeholder="" value="null" disabled=""> -->
                            </div>
                          </td>

                          <td>
                            <div  style="width: 400px">
                              <select class="form-control cabang select2" id="cabang{{$i}}" name="cabang_id[]" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                                <option value="unknown"></option>
                                <?php $ckota = "" ?>
                                @foreach($cabangs as $cabang)
                                @if($cabang->active != '1')
                                <option value="{{$cabang->id}}">{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}</option>
                                @endif
                                <?php $ckota = $cabang->Kota ?>
                                @endforeach
                              </select>
                            </div>
                          </td>


                          <td>
                            <div  style="width: 200px">
                              <input class="form-control date" id="ms{{$i}}" type="text" name="mulaisewa[]" id="example-date-input" placeholder="mm / dd / yyyy" >
                            </div>
                          </td>

                          <td>
                            <div  style="width: 200px">
                              <input class="form-control date" id="ss{{$i}}" type="text" name="selesaisewa[]" id="example-date-input" placeholder="mm / dd / yyyy" >
                            </div>
                          </td>

                          <td>
                            <div  style="width: 200px">
                              <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" id="harga_mobil_disabled{{$i}}" name="hargasewamobil[]" value="0" type="text" disabled="">

                                <input class="form-control harga_driver" id="harga_mobil{{$i}}"  type="text" value="0">
                                <input type="hidden" id="harga_mobil_hidden{{$i}}" name="hargasewamobil[]" value="0">
                                <div class="input-group-append">
                                  <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
                                </div>
                              </div>
                            </div>
                          </td>

                          <td>
                            <div  style="width: 200px">
                              <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" id="harga_driver_disabled{{$i}}"  name="hargasewadriver[]" value="0" type="text" disabled="">
                                
                                <!-- <input class="form-control harga_driver{{$i}}" id="harga_driver{{$i}}"  name="hargasewadriver[]" type="text" value="0"> -->

                                <input class="form-control harga_driver{{$i}}" id="harga_driver{{$i}}" type="text" value="0">
                                <div id="harga_driver_aja">
                                  <input type="hidden" id="harga_driver_hidden{{$i}}" name="hargasewadriver[]" value="0">
                                </div>
                                <div class="input-group-append">
                                  <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
                                </div>
                              </div>
                            </div>
                            <p class="text-center" id="notif_harga{{$i}}">Processing....</p>
                          </td>

                          <td>
                            <div style="width: 200px" class="input_bbm{{$i}}">
                                <div class="input-group input-group-merge">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"></span>
                                  </div>

                                  <input class="form-control" type="text" name="bbm[]" id="bbm{{$i}}" placeholder="" >
                              
                                  <div class="input-group-append">
                                    <span class="input-group-text"><small class="font-weight-bold">Liter</small></span>
                                  </div>
                                </div>
                              </div>
                          </td>

                          <td>
                            <div style="width: 200px" class="input_bbm{{$i}}">
                                <select class="form-control select2" id="jenis_bbm{{$i}}" name="jenis_bbm[]" >
                                  <option value=""></option>
                                  @foreach($bbms as $bbm)
                                    @if($bbm->active != '1')
                                      <option value="{{$bbm->jenis_bbm}}">{{$bbm->jenis_bbm}}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>
                          </td>

                        </tr>

                        <input type="hidden" name="po_multiple_start[]" value="{{$i}}">
                        
                      <?php } ?>
                        
                      <input type="hidden" id="po_multiple_end" name="po_multiple_end" value="">


                      </tbody>
                    </table>
                  </div>
                  
                </div>  
                <div class="card-footer">
                  <div class="form-group float-right pull-right mb-0">
                        <button type="submit" id="save" class="btn btn-success pl-5 pr-5">Submit</button>
                        <div id="demo">
                          
                        </div>
                      </div>
                </div>           
              </div>

            </form>
            

          </div>
        </div>
      </div>
    </section>




    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Insert your file</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{url('/backend/po/import_excel')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="modal-body">
              
                <div class="py-3 text-center">
                    <i class="fas fa-file-excel" style="font-size: 70px"></i>
                    <h4 class="heading mt-4">Download excel template in - <a href="{{asset('file/template.xlsx')}}">Here</a></h4>
                    
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
                    <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="customFileLang" lang="en">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>


                </div>
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-white " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-white ml-auto">Submit</button>
                
            </div>
            </form>

            
            
        </div>
    </div>





<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>


<script type="text/javascript">

$('#ss').on('change',function() {
  // alert($('#selesaisewa').val());
  if ($('#ms').val() > $('#ss').val()) {
    alert('Tgl selesai sewa tidak valid');
    $('#ss').val('');
  }
});

    var i=0;
    
    while ( ++i <= 10 ) {

       (function(i){

            $('#ss'+i).on('change',function() {
              // alert($('#selesaisewa').val());
              if ($('#ms'+i).val() > $('#ss'+i).val()) {
                alert('Tgl selesai sewa tidak valid');
                $('#ss'+i).val('');
              }
            });

            $('#CPD'+i).on('change', function() {
                if ($(this).val() == "CP") {
                  $("#CP"+i).prop('disabled', false);
                  $("#D"+i).prop('disabled', true);
                  $(".input_bbm"+i).show();
                  $("#bbm"+i).prop('required', true);
                  $("#jenis_bbm"+i).prop('required', true);
                }else{
                  $("#CP"+i).prop('disabled', true);
                  $("#D"+i).prop('disabled', false);
                  $("#CP"+i).val("").change();
                  $(".input_bbm"+i).hide();
                  $("#bbm"+i).prop('required', false);
                  $("#jenis_bbm"+i).prop('required', false);
                }
            });

        
            $("#sewa"+i).change(function () {
                if ($(this).val() == "Mobil") {
                    $("#mobil"+i).show();
                    $("#driver"+i).hide();
                    $("#type"+i).prop('disabled', false);
                    $("#harga_driver_disabled"+i).show();
                    $("#harga_mobil_disabled"+i).hide();
                    $("#harga_driver"+i).hide();
                    $("#harga_mobil"+i).show();
                    $("#cabang"+i).val("unknown").change();
                    $('#harga_driver'+i).val('0');
                    $("#harga_driver"+i).prop('disabled', true);
                    $("#nopol"+i).val('null');
                    $("#nopol"+i).prop('disabled', true);
                    $("#nopol_null"+i).prop('disabled', false);
                    // $("#harga_driver_hidden"+i).prop('disabled', true);
                    $("#harga_driver_hidden"+i).val('0');
                    $("#harga_driver_aja"+i).empty();

                    $("#CPD"+i).val("").change();

                    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                    $("#type"+i).prop('required', false);
                    $("#cabang"+i).prop('required', false);
                    $("#ms"+i).prop('required', false);
                    $("#ss"+i).prop('required', false);
                    $("#type"+i).prop('required', false);

                    $("#CPD"+i).prop('required', true);
                    $("#type"+i).prop('required', true);
                    $("#cabang"+i).prop('required', true);
                    $("#ms"+i).prop('required', true);
                    $("#ss"+i).prop('required', true);

                } else if($(this).val() == "Driver") {
                    $("#mobil"+i).hide();
                    $("#driver"+i).show();
                    $("#type"+i).prop('disabled', true);
                    $("#harga_mobil_disabled"+i).show();
                    $("#harga_driver_disabled"+i).hide();
                    $("#harga_mobil"+i).hide();
                    $("#harga_driver"+i).show();
                    $("#cabang"+i).val("unknown").change();
                    $("#nopol"+i).val('null');
                    $("#nopol"+i).prop('disabled', false);
                    $("#nopol_null"+i).prop('disabled', true);
                    $('#harga_driver'+i).val('0');
                    
                    $("#harga_driver"+i).prop('disabled', true);
                    $("#harga_driver_hidden"+i).prop('disabled', false);
                    $("#harga_driver_hidden"+i).val('0');
                    $("#harga_driver_aja"+i).empty();
                    $("#harga_driver_aja"+i).append('<input type="hidden" id="harga_driver_hidden{{$i}}" name="hargasewadriver[]" value="0">');

                    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                    $("#type"+i).prop('required', false);
                    $("#cabang"+i).prop('required', false);
                    $("#type"+i).prop('required', false);
                    $("#ms"+i).prop('required', false);
                    $("#ss"+i).prop('required', false);

                    $("#CPD"+i).prop('required', true);
                    $("#cabang"+i).prop('required', true);
                    $("#ms"+i).prop('required', true);
                    $("#ss"+i).prop('required', true);
                    
                    $("#CPD"+i).val("").change();

                } else if($(this).val() == "Mobil+Driver"){
                    $("#mobil"+i).show();
                    $("#driver"+i).hide();
                    $("#type"+i).prop('disabled', false);
                    $("#harga_mobil_disabled"+i).hide();
                    $("#harga_driver_disabled"+i).hide();
                    $("#harga_mobil"+i).show();
                    $("#cabang"+i).val("unknown").change();
                    $("#harga_driver"+i).show();
                    $('#harga_driver'+i).val('0');
                    $("#nopol"+i).val('null');
                    $("#nopol"+i).prop('disabled', true);
                    $("#nopol_null"+i).prop('disabled', false);
                    $("#harga_driver"+i).prop('disabled', true);
                    $("#harga_driver_hidden"+i).prop('disabled', false);
                    $("#harga_driver_hidden"+i).val('0');
                    $("#harga_driver_aja"+i).empty();
                    $("#harga_driver_aja"+i).append('<input type="hidden" id="harga_driver_hidden{{$i}}" name="hargasewadriver[]" value="0">');
                    
                    $("#CPD"+i).val("").change();

                    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                    $("#type"+i).prop('required', false);
                    $("#cabang"+i).prop('required', false);
                    $("#type"+i).prop('required', false);
                    $("#ms"+i).prop('required', false);
                    $("#ss"+i).prop('required', false);

                    $("#CPD"+i).prop('required', true);
                    $("#type"+i).prop('required', true);
                    $("#cabang"+i).prop('required', true);
                    $("#ms"+i).prop('required', true);
                    $("#ss"+i).prop('required', true);
                }else{
                    $("#type"+i).prop('required', false);
                    $("#cabang"+i).prop('required', false);
                    $("#type"+i).prop('required', false);
                    $("#ms"+i).prop('required', false);
                    $("#ss"+i).prop('required', false);
                }
          });
       })(i);
    }

    function myFunction() {
        var ms = document.getElementById("ms");
        var ss = document.getElementById("ss");

        for (var i = 1; i <= 10; i++) {
          $('#ms'+i).val(ms.value);
          $('#ss'+i).val(ss.value);
        }
    }


    $(function () {
        
        $("#ke-2").hide();
        $("#ke-3").hide();
        $("#ke-4").hide();
        $("#ke-5").hide();
        $("#ke-6").hide();
        $("#ke-7").hide();
        $("#ke-8").hide();
        $("#ke-9").hide();
        $("#ke-10").hide();

        for (var i = 1; i <= 10; i++) {
          $("#mobil"+i).show();
          $("#driver"+i).hide();
          $("#type_disabled"+i).hide();
          $("#harga_mobil_disabled"+i).hide();
          $("#harga_driver_disabled"+i).hide();
          $("#nopol"+i).prop('disabled', true);
          $("#nopol_null"+i).prop('disabled', false);
          $("#notif_harga"+i).hide();
          $(".input_bbm").hide();
        }

      load();


      function load() {
          //alert("Working...");
          $("#txtNoOfRec").focus();

          $("#btnNoOfRec").click(function () {
              $("#AddControll").empty();
              var NoOfRec = $("#txtNoOfRec").val();
              document.getElementById("po_multiple_end").value = NoOfRec;
              //alert("" + NoOfRec);

              // if (NoOfRec == 0) {
              //     createControll(NoOfRec);
              // }

              if (NoOfRec == 0) {
                  $("#ke-2").hide();
                  $("#ke-3").hide();
                  $("#ke-4").hide();
                  $("#ke-5").hide();
                  $("#ke-6").hide();
                  $("#ke-7").hide();
                  $("#ke-8").hide();
                  $("#ke-9").hide();
                  $("#ke-10").hide();

              } else if(NoOfRec == 1) {
                  $("#ke-2").hide();
                  $("#ke-3").hide();
                  $("#ke-4").hide();
                  $("#ke-5").hide();
                  $("#ke-6").hide();
                  $("#ke-7").hide();
                  $("#ke-8").hide();
                  $("#ke-9").hide();
                  $("#ke-10").hide()

              } else if(NoOfRec == 2) {
                  $("#ke-2").show();
                  $("#ke-3").hide();
                  $("#ke-4").hide();
                  $("#ke-5").hide();
                  $("#ke-6").hide();
                  $("#ke-7").hide();
                  $("#ke-8").hide();
                  $("#ke-9").hide();
                  $("#ke-10").hide()

              } else if(NoOfRec == 3) {
                  $("#ke-2").show();
                  $("#ke-3").show();
                  $("#ke-4").hide();
                  $("#ke-5").hide();
                  $("#ke-6").hide();
                  $("#ke-7").hide();
                  $("#ke-8").hide();
                  $("#ke-9").hide();
                  $("#ke-10").hide()

              } else if(NoOfRec == 4) {
                  $("#ke-2").show();
                  $("#ke-3").show();
                  $("#ke-4").show();
                  $("#ke-5").hide();
                  $("#ke-6").hide();
                  $("#ke-7").hide();
                  $("#ke-8").hide();
                  $("#ke-9").hide();
                  $("#ke-10").hide()

              } else if(NoOfRec == 5) {
                  $("#ke-2").show();
                  $("#ke-3").show();
                  $("#ke-4").show();
                  $("#ke-5").show();
                  $("#ke-6").hide();
                  $("#ke-7").hide();
                  $("#ke-8").hide();
                  $("#ke-9").hide();
                  $("#ke-10").hide()

              } else if(NoOfRec == 6) {
                  $("#ke-2").show();
                  $("#ke-3").show();
                  $("#ke-4").show();
                  $("#ke-5").show();
                  $("#ke-6").show();
                  $("#ke-7").hide();
                  $("#ke-8").hide();
                  $("#ke-9").hide();
                  $("#ke-10").hide()

              } else if(NoOfRec == 7) {
                  $("#ke-2").show();
                  $("#ke-3").show();
                  $("#ke-4").show();
                  $("#ke-5").show();
                  $("#ke-6").show();
                  $("#ke-7").show();
                  $("#ke-8").hide();
                  $("#ke-9").hide();
                  $("#ke-10").hide()

              } else if(NoOfRec == 8) {
                  $("#ke-2").show();
                  $("#ke-3").show();
                  $("#ke-4").show();
                  $("#ke-5").show();
                  $("#ke-6").show();
                  $("#ke-7").show();
                  $("#ke-8").show();
                  $("#ke-9").hide();
                  $("#ke-10").hide()

              } else if(NoOfRec == 9) {
                  $("#ke-2").show();
                  $("#ke-3").show();
                  $("#ke-4").show();
                  $("#ke-5").show();
                  $("#ke-6").show();
                  $("#ke-7").show();
                  $("#ke-8").show();
                  $("#ke-9").show();
                  $("#ke-10").hide()

              } else if(NoOfRec == 10) {
                  $("#ke-2").show();
                  $("#ke-3").show();
                  $("#ke-4").show();
                  $("#ke-5").show();
                  $("#ke-6").show();
                  $("#ke-7").show();
                  $("#ke-8").show();
                  $("#ke-9").show();
                  $("#ke-10").show()

              }
          });    
      }

      //   $("#qty").change(function () {
      //       if ($(this).val() == "qty") {
      //           $("#ke-2").hide();
      //           $("#ke-3").hide();
      //           $("#ke-4").hide();
      //           $("#ke-5").hide();

      //       } else if($(this).val() == "1") {
      //           $("#ke-2").hide();
      //           $("#ke-3").hide();
      //           $("#ke-4").hide();
      //           $("#ke-5").hide();

      //       } else if($(this).val() == "2") {
      //           $("#ke-2").show();
      //           $("#ke-3").hide();
      //           $("#ke-4").hide();
      //           $("#ke-5").hide();

      //       } else if($(this).val() == "3") {
      //           $("#ke-2").show();
      //           $("#ke-3").show();
      //           $("#ke-4").hide();
      //           $("#ke-5").hide();

      //       } else if($(this).val() == "4") {
      //           $("#ke-2").show();
      //           $("#ke-3").show();
      //           $("#ke-4").show();
      //           $("#ke-5").hide();

      //       } else if($(this).val() == "5") {
      //           $("#ke-2").show();
      //           $("#ke-3").show();
      //           $("#ke-4").show();
      //           $("#ke-5").show();

      //       }
      // });
        
    });

    var i=0;
    
    while ( ++i < 10 ) {

       (function(i){
            
            $('#cabang'+i).on('change', function(e) {

                      e.preventDefault();

                      var kota = $(this).val();

                      var vendor = $('#vendors').val();

                      $.ajax({

                           type:'POST',

                           url:'{{ route('kota_ajax') }}',

                           dataType:"json",

                           data:{"_token": "{{ csrf_token() }}",kota:kota, vendor:vendor},

                           beforeSend: function() {
                              $('#notif_harga'+i).fadeIn();
                            },
                            complete: function() {
                              $('#notif_harga'+i).fadeOut();
                            },
                            success: function() {
                              $('#notif_harga'+i).fadeOut();
                            },

                           success:function(data){

                              $('#harga_driver_hidden'+i).val('0');
                              $('#harga_driver'+i).val('0');

                                $.each(data, function(key, value) {

                                  $('#harga_driver_hidden'+i).val(value.Harga_include);
                                  var hasil = value.Harga_include.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                  $('#harga_driver'+i).val(hasil);

                                });

                           }

                      });

                });


                $('#vendors').on('change', function(e) {

                      e.preventDefault();

                      var kota = $('#cabang'+i).val();

                      var vendor = $(this).val();

                      $.ajax({

                           type:'POST',

                           url:'{{ route('kota_ajax') }}',

                           dataType:"json",

                           data:{"_token": "{{ csrf_token() }}",kota:kota, vendor:vendor},

                           beforeSend: function() {
                              $('#notif_harga'+i).fadeIn();
                            },
                            complete: function() {
                              $('#notif_harga'+i).fadeOut();
                            },
                            success: function() {
                              $('#notif_harga'+i).fadeOut();
                            },

                           success:function(data){

                              $('#harga_driver_hidden'+i).val('0');
                              $('#harga_driver'+i).val('0');

                                $.each(data, function(key, value) {

                                  $('#harga_driver_hidden'+i).val(value.Harga_include);
                                  var hasil = value.Harga_include.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                  $('#harga_driver'+i).val(hasil);

                                });

                           }

                      });

                });          
          
          // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

              $('#nopol'+i).on('change', function() {

                var nopolID = $(this).val();

                  if(nopolID) {

                      $.ajax({

                          url: '/pengadaanmobil/backend/nopol/ajax/'+nopolID,

                          type: "GET",

                          dataType: "json",

                          success:function(data) {


                            for(j=1;j<=10;j++){
                              if (i != j) {
                                if (nopolID == 'null') {
                                  
                                }else if(nopolID == $('#nopol'+j).val()){
                                  // $("#nopol"+j+" option[value='"+nopolID+"']").remove();
                                  alert('Nopol sudah digunakan, Tolong pilih yang lain');
                                  $('#save').attr('disabled', 'disabled');
                                }else{

                                }
                              }
                            }

                            j=1
                            while(i != j && nopolID != $('#nopol'+j).val()){
                              $('#save').attr('disabled', false);
                              j++;
                            }


                              $('#harga_driver_ajax_empty').empty();


                              $.each(data, function(key, value) {

                                // var year = date.getFullYear(value.MulaiSewa);

                                //   var month = (1 + date.getMonth()).toString();
                                //   month = month.length > 1 ? month : '0' + month;

                                //   var day = date.getDate().toString();
                                //   day = day.length > 1 ? day : '0' + day;

                                //   var tanggal = month + '/' + day + '/' + year;

                                const dateTime = value.MulaiSewa;
                                const parts = dateTime.split(/[- T]/);
                                const mulaisewa = `${parts[1]}/${parts[2]}/${parts[0]} `;
                                
                                const dateTime1 = value.SelesaiSewa;
                                const parts1 = dateTime1.split(/[- T]/);
                                const selesaisewa = `${parts1[1]}/${parts1[2]}/${parts1[0]} `;


                                if (value.CP == 'D') {
                                  $('#CPD'+i).val('D').change();
                                }else{
                                  $('#CPD'+i).val('CP').change();
                                  $('#CP'+i).val(value.CP).change();
                                }

                                $('#cabang'+i).val(value.Cabang_id).change();

                                $('#vendor'+i).val(value.Vendor_Driver).change();

                                $('#ms'+i).val(mulaisewa);

                                $('#ss'+i).val(selesaisewa);

                                $('#bbm'+i).val(value.bbm);

                                $('#jenis_bbm'+i).val(value.jenis_bbm).change();

                                $('#harga_driver'+i).val(value.HargaSewaDriver2019);


                              });


                          }

                      });

                  }else{

                      $('#harga_driver_ajax').empty();

                  }

              });


              // $('#nopol'+i).on('change', function() {

              //   var nopolID = $(this).val();

              //   var vendor = $('#vendors').val();

              //   var k = 0;

              //   var _token = $('input[name="_token"]').val();

              //     if(nopolID) {

              //         $.ajax({
              //             // url: "{{ route('po_multiple_nopol.check') }}?nopol=" + $(this).val(),
              //             // method: 'GET',
              //             url: "{{ route('po_multiple_nopol.check') }}",
              //             method:"POST",
              //             data:{nopol:nopolID, _token:_token,vendor_driver:vendor},
              //             success: function(data) {

              //               $('#nopol'+i).html(data.html);

              //               for(j=1;j<=10;j++){
              //                 if (i != j) {
              //                   if (nopolID == 'null') {
                                  
              //                   }else if(nopolID == $('#nopol'+j).val()){
              //                     // $("#nopol"+j+" option[value='"+nopolID+"']").remove();
              //                     alert('Nopol sudah digunakan, Tolong pilih yang lain');
              //                     $('#save').attr('disabled', 'disabled');
              //                   }else{

              //                   }
              //                 }
              //               }

              //               j=1
              //               while(i != j && nopolID != $('#nopol'+j).val()){
              //                 $('#save').attr('disabled', false);
              //                 j++;
              //               }

              //             }

              //         });

              //     }else{

              //     }

              // });

              $('#vendors').change(function(){

                 // Department id

                 var nopolID = $('#nopol'+i).val();
                 var value = $(this).val();
                 var _token = $('input[name="_token"]').val();

                 // Empty the dropdown
                 $('#nopol'+i).find('option').not(':first').remove();

                 // AJAX request 
                 $.ajax({
                   url:"{{ route('vendor_multiple_add.check') }}",
                   method:"POST",
                   data:{value:value, _token:_token},
                   success: function(data) {
                       $('#nopol'+i).html(data.html);

                       for(j=1;j<=10;j++){
                         if (i != j) {
                           if (nopolID == 'null') {
                             
                           }else if(nopolID == $('#nopol'+j).val()){
                             // $("#nopol"+j+" option[value='"+nopolID+"']").remove();
                             alert('Nopol sudah digunakan, Tolong pilih yang lain');
                             $('#save').attr('disabled', 'disabled');
                           }else{

                           }
                         }
                       }

                       j=1
                       while(i != j && nopolID != $('#nopol'+j).val()){
                         $('#save').attr('disabled', false);
                         j++;
                       }
                   }
                });
              });

              

              $(document).ready(function() {

                $('#harga_mobil'+i).autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});
                
                $('#harga_driver'+i).autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});

                $('#harga_mobil'+i).on('keyup',function() {
                  $('#toggle').val('no');
                  var x = document.getElementById("harga_mobil"+i).value;
                  var z = x.replace(/\./g, "");
                  var qty = parseInt(z);
                  $('#harga_mobil_hidden'+i).val(qty);
                  var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  $('#harga_mobil'+i).val(hasil);
                });
                $('#harga_mobil'+i).on('input',function() {
                  $('#toggle').val('no');
                  var x = document.getElementById("harga_mobil"+i).value;
                  var z = x.replace(/\./g, "");
                  var qty = parseInt(z);
                  $('#harga_mobil_hidden'+i).val(qty);
                  var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  $('#harga_mobil'+i).val(hasil);
                });

                $('#harga_driver'+i).on('keyup',function() {
                  $('#toggle').val('no');
                  var x = document.getElementById("harga_driver"+i).value;
                  var z = x.replace(/\./g, "");
                  var qty = parseInt(z);
                  $('#harga_driver_hidden'+i).val(qty);
                  var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  $('#harga_driver'+i).val(hasil);
                });
                $('#harga_driver'+i).on('input',function() {
                  $('#toggle').val('no');
                  var x = document.getElementById("harga_driver"+i).value;
                  var z = x.replace(/\./g, "");
                  var qty = parseInt(z);
                  $('#harga_driver_hidden'+i).val(qty);
                  var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  $('#harga_driver'+i).val(hasil);
                });

              });
 
       })(i);
    }



</script>


@endsection






