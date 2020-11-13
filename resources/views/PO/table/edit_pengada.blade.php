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

        if($('#CPD').val() == "CP"){
          $(".input_bbm").show().find(':input').attr('required', true);
        }else{
          $(".input_bbm").hide().find(':input').attr('required', false);
        }

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

        if ($("#sewa").val() == "Mobil") {
            $("#harga_driver").prop('disabled', true);
            $("#harga_driver_hidden").prop('disabled', true);

            $("#harga_driver_hidden").val('0');
            $("#harga_driver_eksclude_disabled").val('0');

            $("#harga_driver_eksclude_disabled").hide('0');
            $("#harga_driver_eksclude_disabled2").show('0');
        }else if($("#sewa").val() == "Driver"){
            $("#type").prop('disabled', true);
            $("#harga_mobil_disabled").show();
            $("#harga_driver_disabled").hide();
            $("#harga_mobil").hide();
            $("#harga_mobil_hidden").prop('disabled', true);
            $("#harga_driver").show();

            $("#harga_driver").prop('disabled', true);
            $("#harga_driver_hidden").prop('disabled', false);

            $("#harga_driver_eksclude_disabled").val('0');

            $("#harga_driver_eksclude_disabled").show('0');
            $("#harga_driver_eksclude_disabled2").hide('0');
        }

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
                // $("#nopol_null").append('<input type="hidden" name="nopol[]" value="null">');
                $('#harga_driver').val('0');
                $("#cabang").val("").change();
                $("#harga_driver").prop('disabled', false);
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
                $("#harga_driver").prop('disabled', false);
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

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
              <h1 class=" text-white d-inline-block mb-0">Edit PO</h1>
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
            <form action="{{url('/backend/po/edit_pengada/proses/'.$po->id)}}" method="post" role="form" id="dynamic_form">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form Purchase Order</h3>
                  </div>
                  <!-- Card body -->
                  <div class="card-body">
                    <!-- Form groups used in grid -->

                    <div id="tambuh">
                    <!-- <hr> -->
                    <div class="row" id="tambuh">
                      <div class="col-md-12">
                        <div class="row">
                          <!-- <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">User Pengguna :</label>
                                </div>
                                <div id="nopo_ajax"></div>
                          </div>
                          <div class="col-md-9">
                                <div class="form-group">
                                  
                                  <input type="text" id="user_pengguna" class="form-control" name="user_pengguna" value="{{$po->UserPengguna}}" id="example3cols2Input" required>
                                </div>
                          </div> -->

                          <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No PO </label>
                                </div>
                          </div>
                          <div class="col-md-9">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" class="form-control" value="{{$po->NoPo}}" name="nopo" id="example3cols2Input"">
                                </div>
                          </div>
                          

                          <div class="col-md-3">
                            <div class="form-group" id="contoh_tambahan">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Jenis Sewa </label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <select class="form-control" id="sewa" disabled>
                                <option value="Mobil+Driver" {{ $po->Sewa == 'Mobil+Driver' ? 'selected' : '' }}>Mobil + Driver</option>
                                <option value="Mobil" {{ $po->Sewa == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                                <option value="Driver" {{ $po->Sewa == 'Driver' ? 'selected' : '' }}>Driver</option>
                              </select>
                            </div>
                            <input type="hidden" name="sewa" value="{{$po->Sewa}}">
                          </div>
                          <div class="col-md-5" >
                            <div class="form-group">

                              <select class="form-control" name="nopol" id="nopol" disabled>
                                <option value="null">Tanpa Unit</option>
                                @foreach($pos as $poss)
                                  
                                  @if($poss->Sewa_sementara == "Mobil" && $poss->status == "1")
                                    @if($poss->Tgl_cutoff <= $currentDateTime)
                                      <option value="{{$poss->Nopol}}">{{$poss->Nopol}}</option>
                                    @else
                                    @endif
                                  @endif
                                @endforeach
                              </select>
                              
                              <!-- <input type="text" id="mobil" class="form-control" name="nopol[]" id="example3cols2Input" placeholder="Ada No.Polisi (BOP)" disabled> -->
                              <div id="nopol_null">
                                <!-- <input type="hidden" name="nopol[]" value="null"> -->
                              </div>
                            </div>
                          </div>


                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">CP/D </label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <select class="form-control" id="CPD">
                                <option value="CP" {{ $po->CP == 'CP' ? 'selected' : '' }}>CP - Carpooling</option>
                                <option value="D" {{ $po->CP == 'D' ? 'selected' : '' }}>D - Dedicated</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              @if($po->CP == 'D')
                                <input type="hidden" id="D" name="CP" value="D">
                                <select class="form-control select2" id="CP" name="CP" disabled required>
                              @else
                                <input type="hidden" id="D" name="CP" value="D" disabled>
                                <select class="form-control select2" id="CP" name="CP" required>
                              @endif
                                <!-- <option value="{{$po->CP}}">{{$po->CP}}</option> -->
                                <option value="">Pilih carpooling</option>
                                @foreach($cps as $cp)
                                  @if($cp->active != '1')
                                  <!-- <option value="{{$cp->jenis}} - {{$cp->kota}}">{{$cp->jenis}} - {{$cp->kota}}</option> -->
                                  <?php $CP = $cp->jenis.' - '.$cp->kota ?>
                                  <option value="{{$cp->jenis}} - {{$cp->kota}}" {{ $CP == $po->CP ? 'selected' : '' }}>{{$cp->jenis}} - {{$cp->kota}}</option>
                                  @endif
                                @endforeach
                              </select>
                              
                            </div>
                          </div>




                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-3">
                                    <div class="form-group">
                                      <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Type/Unit </label>
                                    </div>
                              </div>
                              <div class="col-md-9">
                                    <div class="form-group">
                                      <select class="form-control select2" id="type" name="type" required>
                                        <option value=""></option>
                                        @foreach($mobils as $mobil)
                                          @if($mobil->active != '1')
                                            <option value="{{$mobil->id}}" {{ $po->Mobil_id == $mobil->id ? 'selected' : '' }}>{{$mobil->MerekMobil}}&nbsp{{$mobil->Type}}&nbsp- {{$mobil->Tahun}}</option>
                                          @endif
                                        @endforeach

                                      </select>
<!--                                       <input type="text" class="form-control" id="type" name="type[]" id="example3cols2Input" placeholder="" value="null">
                                      <input type="text" class="form-control" id="type_disabled" name="type[]" id="example3cols2Input" placeholder="" value="null" disabled=""> -->
                                    </div>
                              </div>
                            </div> 
                          </div>
                          
                          </div>
                        </div>


                        


                      <div class="col-md-12">
                        <div class="row">                   
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Vendor </label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <select class="form-control select2" id="vendor" name="vendor_id" required>
                                @foreach($vendors as $vendor)
                                  @if($vendor->active != '1')
                                    <option value="{{$vendor->id}}" {{ $po->Vendor_Mobil == $vendor->id ? 'selected' : '' }}>{{$vendor->KodeVendor}}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Cabang & Kota</label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <select class="form-control select2" id="cabang" name="cabang_id" required>
                               <option value=""></option>

                                <?php $ckota = "" ?>
                                @foreach($cabangs as $cabang)
                                  @if($cabang->active != '1')
                                    <option value="{{ $cabang->id }}" {{ $cabang->id == $po->Cabang_id ? 'selected' : '' }}>{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}</option>
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
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Mulai Sewa </label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input class="form-control date" type="text" value="{{$po->MulaiSewa->format('m/d/Y')}}" name="mulaisewa" id="example-date-input">
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Selesai Sewa </label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input class="form-control date" type="text" value="{{$po->SelesaiSewa->format('m/d/Y')}}" name="selesaisewa" id="example-date-input">
                                </div>
                              </div>
                            </div>
                          </div>

                          @if($po->MulaiSewa2 != '')
                            <div class="col-md-6 ">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Mulai Sewa 2 </label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input class="form-control date" type="text" value="{{$po->MulaiSewa2->format('m/d/Y')}}" name="mulaisewa2" id="example-date-input">
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <div class="col-md-6">
                              
                            </div>
                          @endif
                          

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga S.Mobil</label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" id="harga_mobil_disabled" value="{{$po->HargaSewaMobil}}" name="hargasewamobil" type="text" disabled="">

                                <input class="form-control" id="harga_mobil" value="{{$po->HargaSewaMobil}}" name="hargasewamobil"  type="text" >
                                <div class="input-group-append">
                                  @if($po->Sewa == 'Driver')
                                  @else
                                    <input type="hidden" id="harga_driver_hidden" name="hargasewadriver" value="{{$po->HargaSewaDriver2019}}">
                                  @endif
                                  <input type="hidden" id="harga_mobil_hidden" name="hargasewamobil" value="{{$po->HargaSewaMobil}}">
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

                                    <input class="form-control" type="text" name="bbm" value="{{$po->bbm}}" id="bbm" placeholder="" required>
                          
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
                                        <option value="{{$bbm->jenis_bbm}}" {{ $bbm->jenis_bbm == $po->jenis_bbm ? 'selected' : '' }}>{{$bbm->jenis_bbm}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                  
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga S.Driver</label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp</span>
                                </div>
                                <input class="form-control" id="harga_driver_disabled" value="0"  name="hargasewadriver" value="0" type="text" disabled="">
                                

                                @if($po->Sewa == 'Mobil')
                                  <input class="form-control" value="0" type="text" value="0" disabled>
                                @else
                                  <input class="form-control" id="harga_driver" value="{{$po->HargaSewaDriver2019}}" type="text" value="0" disabled>
                                  <input type="hidden" id="harga_driver_hiddenn" name="hargasewadriver" value="{{$po->HargaSewaDriver2019}}">
                                @endif
                                
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

                          <!-- <input type="hidden" name="user_pengguna" value="{{auth::user()->id}}">    -->                       

                        </div>
                    </div>
   
                  </div>
                </div>
                <div class="tempat_tambah">
                  
                </div>
                </div>

                <div class="card-footer">
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



<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

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

  $('#cabang').on('change', function(e) {

                    e.preventDefault();

                    var kota = $(this).val();

                    var vendor = $('#vendor').val();

                    $.ajax({

                         type:'POST',

                         url:'{{ route('kota_ajax') }}',

                         dataType:"json",

                         data:{"_token": "{{ csrf_token() }}",kota:kota, vendor:vendor},

                         success:function(data){

                            $('#harga_driver_ajax_empty').empty();

                              $('#harga_driver_hidden').val('0');
                                $('#harga_driver').val('0');
                                $('#harga_driver_eksclude_disabled').val('0');

                              $.each(data, function(key, value) {

                                // $('#harga_driver').val(value.Harga_include);

                                $('#harga_driver_hiddenn').val(value.Harga_include);
                                var hasil = value.Harga_include.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                $('#harga_driver').val(hasil);
                                
                                var hasil_eksclude = value.Harga_eksclude.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                $('#harga_driver_eksclude_disabled').val(hasil_eksclude);


                              });

                         }

                    });

              });

});

// $(document).ready(function(){
//   var count = 1;


//   function dynamic_field(number)
//   {
//     var html = '<div class="row">'

//     html += '<p>asfasdad</p>';

//     if(number > 1)
//     {
//       html += '<button type="submit" id="tombol_remove" class="btn btn-danger pl-5 pr-5 pull-right float-right">Remove</button></div>';
//       $('#tombol_remove').append(html)
//     }else{

//     }
//   }

//   $('.add').click(function(){
//     count++;
//     dynamic_field(count);
//     $('#dynamic_field').append('<p>ketambah nih</p><br>')  
//   });

//   $(document).on('click', '#tombol_remove', function(){
//     count--;
//     dynamic_field(count);
//   });

//   $(#dynamic_field).on('submit', function(event){
//     event.preventDefault();
//     $.ajax({
//       url:'{{url("/backend/po/create")}}',
//       method:'post',
//       data:$(this).serialize(),
//       dataType:'json',
//       beforeSend:function(){
//         $('#save').attr('disabled','disabled');
//       },
//       success:function(data)
//       {
//         if (data.error) 
//         {
//           var error_html = '';
//           for(var count = 0;count < data.error.length; count++)
//           {
//             error_html += '<p>'+data.error[count]+'<p>';
//           }
//           $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
//         }
//         else
//         {
//           dynamic_field(1);
//           $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
//         }
//         $('#save').attr('disabled', false);
//       }
//     })
//   });

//   });
</script>


@endsection






