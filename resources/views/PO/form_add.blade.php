<?php $page = "Penambahan"; ?>
@extends('sidebar')

@section('content')

<?php
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentDate = date('m/d/Y');
?>

<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script type="text/javascript">
  
    $(function () {
        $("#mobil").show();
        $("#driver").hide();
        $("#type_disabled").hide();
        $("#harga_mobil_disabled").hide();
        $("#harga_driver_disabled").hide();
        // $(".nopol").
        $("#nopol").prop('disabled', true);
        $("#harga_driver_eksclude_disabled2").hide('');
        $('#vendor').on('change', function() {
            $("#harga_driver").val('0');
            // $("#cabang").val("").change();
            $("#harga_driver_eksclude_disabled").val('0');
        });
        $(".input_bbm").hide().find(':input').attr('required', false);

        $('#CPD').on('change', function() {
            if ($(this).val() == "CP") {
              $("#CP").prop('disabled', false);
              $("#D").prop('disabled', true);
              $(".input_bbm").show().find(':input').attr('required', true);
              $(".input_bbm").find(':input').val("").change();
            }else{
              $("#CP").prop('disabled', true);
              $("#D").prop('disabled', false);
              $("#CP").val("").change();
              $(".input_bbm").hide().find(':input').attr('required', false);
              $(".input_bbm").find(':input').val("").change();
            }
        });

        $("#sewa").change(function () {
            if ($(this).val() == "Mobil") {
                $("#mobil").show();
                $("#driver").hide();
                $("#type").prop('disabled', false);
                $("#harga_driver_disabled").show();
                $("#harga_mobil_disabled").hide();
                $("#harga_driver").hide();
                $("#harga_mobil").show();
                $("#harga_mobil_hidden").prop('disabled', false);
                $("#cabang").val("").change();
                $('#harga_driver').val('0');
                $("#harga_driver").prop('disabled', true);
                $("#harga_driver_hidden").prop('disabled', true);
                $("#nopol").prop('disabled', true);
                $("#nopol_null").empty();

                $("#type").val("").change();
                $("#vendor").val("").change();
                $("#harga_mobil").val('0');
                $("#harga_mobil_hidden").val('0');
                $("#harga_driver").val('0');
                $("#harga_driver_hidden").val('0');
                $("#harga_driver_eksclude_disabled").val('0');

                $("#harga_driver_eksclude_disabled").hide('0');
                $("#harga_driver_eksclude_disabled2").show('0');

                $("#CPD").val("").change();
            } else if($(this).val() == "Driver") {
                $("#mobil").hide();
                $("#driver").hide();
                $("#type").prop('disabled', true);
                $("#harga_mobil_disabled").show();
                $("#harga_driver_disabled").hide();
                $("#harga_mobil").hide();
                $("#harga_mobil_hidden").prop('disabled', true);
                $("#harga_driver").show();
                $("#nopol").prop('disabled', false);
                // $("#nopol_null").append('<input type="hidden" name="nopol" value="null">');
                $('#harga_driver').val('0');
                $("#cabang").val("").change();
                $("#harga_driver").prop('disabled', true);
                $("#harga_driver_hidden").prop('disabled', false);


                $("#type").val("").change();
                $("#vendor").val("").change();
                $("#harga_mobil").val('0');
                $("#harga_mobil_hidden").val('0');
                $("#harga_driver").val('0');
                $("#harga_driver_hidden").val('0');
                $("#harga_driver_eksclude_disabled").val('0');

                $("#harga_driver_eksclude_disabled").show('0');
                $("#harga_driver_eksclude_disabled2").hide('0');

                $("#CPD").val("").change();
            } else{
                $("#mobil").show();
                $("#driver").show();
                $("#type").prop('disabled', false);
                $("#harga_mobil_disabled").hide();
                $("#harga_driver_disabled").hide();
                $("#harga_mobil").show();
                $("#harga_mobil_hidden").prop('disabled', false);
                $("#harga_driver").show();
                $("#nopol").prop('disabled', true);
                $("#nopol_null").empty();
                $("#cabang").val("").change();
                $('#harga_driver').val('0');
                $("#harga_driver").prop('disabled', true);
                $("#harga_driver_hidden").prop('disabled', false);

                $("#type").val("").change();
                $("#vendor").val("").change();
                $("#harga_mobil").val('0');
                $("#harga_mobil_hidden").val('0');
                $("#harga_driver").val('0');
                $("#harga_driver_hidden").val('0');
                $("#harga_driver_eksclude_disabled").val('0');

                $("#harga_driver_eksclude_disabled").show('0');
                $("#harga_driver_eksclude_disabled2").hide('0');

                $("#CPD").val("").change();
            }
      });    
    });

    // $(document).ready(function(){
    //     var i = 1;
    //     $('.add').click(function(){
    //       i++;
    //       $("#tambuh").clone().appendTo( ".tempat_tambah" );
    //     });
    // });
</script>


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
    @if(auth::user()->status != 'operasional')
    <div class="container-fluid mt--6">
      <section class="content">
        <div class="row">
          <div class="col-12">
            <form action="{{url('/backend/po/create')}}" method="post" role="form" id="dynamic_form">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form Purchase Order</h3>
                  </div>
                  <!-- Card body -->
                  <div class="card-body bg-secondary ">
                    <!-- Form groups used in grid -->
                    <div class="row mb-4 pl-4 pr-4">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Other Insert Option :</label>
                                    </div>
                              </div>
                              <div class="col-md-9">
                                    <div class="form-group">
                                      <a href="{{url('/backend/po/form_add_multiple')}}" id="tombol_add" class="btn btn-success pl-5 pr-5 add mb-2"><i class="fas fa-plus"></i> Multiple QTY </a>
                                      @if(auth::user()->status != 'blk')
                                      <button type="button" class="btn btn-warning mb-2" data-toggle="modal" data-target="#modal-notification">Input data Via file Excel </button>
                                      | &nbsp <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#modal-database">Input DATABASE Via file Excel </button>
                                      @endif
                                    </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <div id="tambuh">
                    <!-- <hr> -->
                    <div class="row pl-4 pr-4" id="tambuh">
                      <div class="col-md-12">
                        <div class="row">
                          

                          <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No PO  :</label>
                                </div>
                                <div id="nopo_ajax"></div>
                          </div>
                          <div class="col-md-9">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" id="nopo" class="form-control" name="nopo" id="example3cols2Input" required>
                                </div>
                          </div>
                          

                          <div class="col-md-3">
                            <div class="form-group" id="contoh_tambahan">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Jenis Sewa  :</label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <select class="form-control" id="sewa" name="sewa" required>
                                <option value=""></option>
                                <option value="Mobil+Driver">Mobil + Driver</option>
                                <option value="Mobil">Mobil</option>
                                <option value="Driver">Driver</option>
                              </select>
                            </div>
                          </div>
                          
                          <div class="col-md-5" >
                            <div class="form-group">

                              <select class="form-control select2" name="nopol" id="nopol" disabled>
                                <option value="null">Tanpa Unit</option>
                                @foreach($pos as $po)
                                  
                                  @if($po->Sewa_sementara == "Mobil" && $po->status == "1")
                                    @if($po->Tgl_cutoff <= $currentDateTime)
                                      <option value="{{$po->Nopol}}">{{$po->Nopol}}</option>
                                    @else
                                    @endif
                                  @endif
                                @endforeach
                              </select>
                              
                              <!-- <input type="text" id="mobil" class="form-control" name="nopol" id="example3cols2Input" placeholder="Ada No.Polisi (BOP)" disabled> -->
                              <div id="nopol_null">
                                <!-- <input type="hidden" name="nopol" value="null"> -->
                              </div>
                            </div>
                          </div>
                         


                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">CP/D  :</label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <select class="form-control" id="CPD" required>
                                <option value=""></option>
                                <option value="CP">CP - Carpooling</option>
                                <option value="D">D - Dedicated</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <select class="form-control select2" id="CP" name="CP" disabled required>
                                <!-- <option value="null">Tanpa Unit</option> -->
                                <option value="">Pilih carpooling</option>
                                @foreach($cps as $cp)
                                  @if($cp->active != '1')
                                  <option value="{{$cp->jenis}} - {{$cp->kota}}">{{$cp->jenis}} - {{$cp->kota}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <input type="hidden" id="D" name="CP" value="D" disabled>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Type/Unit  :</label>
                                    </div>
                              </div>
                              <div class="col-md-9">
                                    <div class="form-group">
                                      <select class="form-control select2" id="type" name="mobil_id" required>
                                        <!-- <option value="null">Tanpa Unit</option> -->
                                        <option value=""></option>
                                        @foreach($mobils as $mobil)
                                          @if($mobil->active != '1')
                                          <option value="{{$mobil->id}}">{{$mobil->MerekMobil}}&nbsp{{$mobil->Type}}&nbsp- {{$mobil->Tahun}}</option>
                                          @endif
                                        @endforeach
                                      </select>

                                    </div>
                              </div>
                            </div> 
                          </div>
                          
                          </div>
                        </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Vendor  :</label>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <select class="form-control select2" id="vendor" name="vendor_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value=""></option>
                            @foreach($vendors as $vendor)
                              @if($vendor->active != '1')
                                <option value="{{$vendor->id}}">{{$vendor->KodeVendor}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                      </div>
                      

                      <div class="col-md-12">
                        <div class="row">                   
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Cabang & Kota :</label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <select class="form-control cabang select2" id="cabang" name="cabang_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                <option value=""></option>
                                <?php $ckota = "" ?>
                                @foreach($cabangs as $cabang)
                                  @if($cabang->active != '1')
                                    <option value="{{$cabang->id}}">{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}</option>
                                  @endif
                                <?php $ckota = $cabang->Kota ?>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          

                          <div class="col-md-6 ">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Mulai Sewa  :</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input class="form-control date" type="text" name="mulaisewa" id="mulaisewa" placeholder="mm / dd / yyyy" autocomplete="off" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group text-right">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Selesai Sewa  :</label>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <input class="form-control date" type="text" name="selesaisewa" id="selesaisewa" placeholder="mm / dd / yyyy" autocomplete="off" required>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga S.Mobil (include) :</label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" id="harga_mobil_disabled" name="hargasewamobil" value="0" type="text" disabled="">
                                

                                <input class="form-control" id="harga_mobil" type="text" value="0" >
                                <div class="input-group-append">
                                  <input type="hidden" id="harga_mobil_hidden" name="hargasewamobil" value="0">

                                  <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
                                </div>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-6 input_bbm">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">BBM (liter) :</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">

                                  <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"></span>
                                    </div>

                                    <input class="form-control" type="text" name="bbm" id="bbm" placeholder="" required>
                          
                                    <div class="input-group-append">
                                      <span class="input-group-text"><small class="font-weight-bold">Liter</small></span>
                                    </div>
                                  </div>

                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-6 input_bbm">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group text-right">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Jenis BBM</label>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <select class="form-control select2" id="jenis_bbm" name="jenis_bbm" required>
                                    <option value=""></option>
                                    @foreach($bbms as $bbm)
                                      @if($bbm->active != '1')
                                        <option value="{{$bbm->jenis_bbm}}">{{$bbm->jenis_bbm}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                  
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga S.Driver (include) :</label>

                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <div class="input-group input-group-merge">
                                <div class="input-group-prepend" id="harga_driver_aja">
                                  <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" id="harga_driver_disabled"  name="hargasewadriver" value="0" type="text" disabled="">

                                  
                                <input class="form-control harga_driver" id="harga_driver" type="text" value="0" disabled>
                                <input type="hidden" id="harga_driver_hidden" name="hargasewadriver" value="0">


                                <div class="input-group-append">
                                  <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
                                </div>    

                              </div>
                            </div>
                          </div>


                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga S.Driver (Eksclude) :</label>

                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <div class="input-group input-group-merge">
                                <div class="input-group-prepend" id="harga_driver_aja">
                                  <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" id="harga_driver_eksclude_disabled" value="0" type="text" disabled="">
                                <input class="form-control" id="harga_driver_eksclude_disabled2" value="0" type="text" disabled="">
                                  
                                <div class="input-group-append">
                                  <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
                                </div>    

                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group" id="tombol_remove">
                                <!-- <button type="submit" class="btn btn-danger pl-5 pr-5 pull-right float-right">Remove </button> -->
                            </div>
                          </div>

                          <!-- <input type="hidden" name="user_pengguna" value="{{auth::user()->id}}">   -->                        

                        </div>
                    </div>
   
                  </div>
                </div>


                <input type="hidden" id="id_po" name="id" value="">

                <div class="card-footer bg-secondary">
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                      <div class="form-group float-right pull-right">
                        <a href="javascript:history.back()" type="button" class="btn btn-default">Back</a>
                        <button type="submit" id="save" class="btn btn-success pl-5 pr-5">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      </section>
    </div>
    @endif



    @if(auth::user()->status == 'operasional')
    <div class="container-fluid mt--6">
      <section class="content">
        <div class="row">
          <div class="col-12">
            <form action="{{url('/backend/po/create')}}" method="post" role="form" id="dynamic_form">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form Purchase Order</h3>
                  </div>
                  <!-- Card body -->
                  <div class="card-body bg-secondary ">
                    <!-- Form groups used in grid -->
                    <div class="row mb-4 pl-4 pr-4">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Other Insert Option :</label>
                                    </div>
                              </div>
                              <div class="col-md-9">
                                    <div class="form-group">
                                      <a href="{{url('/backend/po/form_add_multiple')}}" id="tombol_add" class="btn btn-success disabled pl-5 pr-5 add mb-2"><i class="fas fa-plus"></i> Multiple QTY </a>
                                      @if(auth::user()->status != 'blk')
                                      <a href="" class="btn btn-warning disabled mb-2" data-toggle="modal" data-target="#modal-notification">Input data Via file Excel </a>
                                      | &nbsp <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#modal-database">Input DATABASE Via file Excel </button>
                                      @endif
                                    </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
   
                  </div>
                  <div class="card-footer bg-secondary">
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                      <div class="form-group float-right pull-right">
                        <a href="javascript:history.back()" type="button" class="btn btn-default pr-5 pl-5">Back</a>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
            </form>
          </div>
        </div>
      
    </section>
    </div>
    @endif




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
                    <div class="card text-center text-dark" style="box-shadow: 0 0 0;border: thin;border-style: dashed;">
                      <div class="card-body">
                        <input type="file" name="file" class="ml-5 mt-4 mb-4">
                      </div>
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
  </div>
    
    @include('PO.input_database')


<script>

$(document).ready(function() {

      $('#harga_mobil').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});
    
      $('#harga_driver').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});

  });

$(document).ready(function(){
  $('#harga_mobil').on('keyup',function() {
    $('#toggle').val('no');
    var x = document.getElementById("harga_mobil").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#harga_mobil_hidden').val(qty);
    var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $('#harga_mobil').val(hasil);
  });
  $('#harga_mobil').on('input',function() {
    $('#toggle').val('no');
    var x = document.getElementById("harga_mobil").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#harga_mobil_hidden').val(qty);
    var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $('#harga_mobil').val(hasil);
  });

  $('#harga_driver').on('keyup',function() {
    $('#toggle').val('no');
    var x = document.getElementById("harga_driver").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#harga_driver_hidden').val(qty);
    var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $('#harga_driver').val(hasil);
  });
  $('#harga_driver').on('input',function() {
    $('#toggle').val('no');
    var x = document.getElementById("harga_driver").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#harga_driver_hidden').val(qty);
    var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $('#harga_driver').val(hasil);
  });
});

$('#selesaisewa').on('change',function() {
  // alert($('#selesaisewa').val());
  if ($('#mulaisewa').val() > $('#selesaisewa').val()) {
    alert('Tgl selesai sewa tidak valid');
    $('#selesaisewa').val('');
  }
});


$('#nopol').on('change', function() {

  var nopolID = $(this).val();

    if(nopolID) {

        $.ajax({

            // url: '/backend/nopol/ajax/'+nopolID,

            url: '/pengadaanmobil/backend/nopol/ajax/'+nopolID,

            type: "GET",

            dataType: "json",

            success:function(data) {


                $('#harga_driver_ajax_empty').empty();

                $.each(data, function(key, value) {

                  // var year = date.getFullYear(value.MulaiSewa);

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
                    $('#CPD').val('D').change();
                  }else{
                    $('#CPD').val('CP').change();
                    $('#CP').val(value.CP).change();
                  }

                  $('#vendor').val(value.Vendor_Driver).change();

                  $('#cabang').val(value.Cabang_id).change();

                  $('#type').val(value.Mobil_id).change();

                  // $('#mulaisewa').val(mulaisewa);

                  $('#selesaisewa').val(selesaisewa);

                  var hasil = value.HargaSewaMobil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                  $('#harga_mobil_disabled').val(hasil);

                  $('#harga_driver').val(value.HargaSewaDriver2019);

                  $('#bbm').val(value.bbm);

                  $('#jenis_bbm').val(value.jenis_bbm).change();

                  // $('#nopo').val(value.NoPo);

                  $('#id_po').val(value.id);


                });


            }

        });

    }else{

        $('#harga_driver_ajax').empty();

    }

});


</script>


@endsection






