<?php $page = "Dashboard"; ?>
@extends('sidebar')

@section('content')


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
            <form action="{{url('/backend/po/edit_dashboard/proses/'.$po->id)}}" method="post" role="form" id="dynamic_form">
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
                          <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No PO </label>
                                </div>
                          </div>
                          <div class="col-md-9">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" class="form-control" value="{{$po->NoPo}}" name="nopo" id="example3cols2Input">
                                </div>
                          </div>
                          <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No Register </label>
                                </div>
                          </div>
                          <div class="col-md-9">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" class="form-control" value="{{$po->NoRegister}}" name="noregister" id="example3cols2Input">
                                </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Cabang & Kota</label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <select class="form-control select2" id="cabang" name="cabang_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                                @foreach($cabangs as $cabang)
                                  @if($po->Cabang_id == $cabang->id)
                                    <option value="{{$cabang->id}}">{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}</option>
                                  @endif
                                @endforeach

                                <?php $ckota = "" ?>
                                @foreach($cabangs as $cabang)
                                <option value="{{ $cabang->id }}" {{ $cabang->id == $po->Cabang_id ? 'selected' : '' }}>{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}</option>
                                <?php $ckota = $cabang->Kota ?>
                                @endforeach

                              </select>
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
                          </div>
                          <div class="col-md-5">
                            <div class="form-group" id="mobil">
                              <input type="text" class="form-control" name="nopol" id="example3cols2Input" placeholder="Ada No.Polisi (BOP)" disabled>
                            </div>
                          </div>


                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">CP/D </label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <select class="form-control" name="CP">
                                <option value="CP" {{ $po->CP == 'CP' ? 'selected' : '' }}>CP - Carpooling</option>
                                <option value="D" {{ $po->CP == 'D' ? 'selected' : '' }}>D - Dedicated</option>
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
                                      <select class="form-control select2" name="type">
                                        @foreach($mobils as $mobil)
                                          @if($po->Type == $mobil->MerekMobil)
                                            <option value="{{$mobil->MerekMobil}}">{{$mobil->MerekMobil}}</option>
                                          @endif
                                        @endforeach

                                        @foreach($mobils as $mobil)
                                        <option value="{{$mobil->MerekMobil}}">{{$mobil->MerekMobil}}</option>
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
                              <select class="form-control select2" name="vendor_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ...">
                                @foreach($vendors as $vendor)

                                    <option value="{{$vendor->id}}" {{ $po->Vendor_Mobil == $vendor->id ? 'selected' : '' }}>{{$vendor->NamaVendor}}</option>
          
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

                          @if($po->Sewa == 'Mobil')

                            <div class="col-md-6 ">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastk </label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <!-- <input class="form-control" type="date" value="{{$po->Tgl_bastk}}" name="mulaisewa" id="example-date-input"> -->
                                    <input class="form-control date" type="text" name="tgl_bastk" id="tgl_bastk" value="{{$po->Tgl_bastk}}" placeholder="mm / dd / yyyy" autocomplete="off">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastd </label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <!-- <input class="form-control" type="date" value="{{$po->Tgl_bastd}}" name="selesaisewa" id="example-date-input" disabled> -->
                                    <input class="form-control date" type="text" name="tgl_bastd" id="tgl_bastd" value="{{$po->Tgl_bastd}}" placeholder="mm / dd / yyyy" autocomplete="off" disabled>
                                  </div>
                                </div>
                              </div>
                            </div>

                          @elseif($po->Sewa == 'Driver')

                            <div class="col-md-6 ">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastk </label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <!-- <input class="form-control" type="date" value="{{$po->Tgl_bastk}}" name="mulaisewa" id="example-date-input" disabled> -->
                                    <input class="form-control date" type="text" name="tgl_bastk" id="tgl_bastk" value="{{$po->Tgl_bastk}}" placeholder="mm / dd / yyyy" autocomplete="off" disabled>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastd </label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <!-- <input class="form-control" type="date" value="{{$po->Tgl_bastd}}" name="selesaisewa" id="example-date-input"> -->
                                    <input class="form-control date" type="text" name="tgl_bastd" id="tgl_bastd" value="{{$po->Tgl_bastd}}" placeholder="mm / dd / yyyy" autocomplete="off">
                                  </div>
                                </div>
                              </div>
                            </div>

                          @else

                            <div class="col-md-6 ">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastk </label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <!-- <input class="form-control" type="date" value="{{$po->Tgl_bastk}}" name="mulaisewa" id="example-date-input"> -->
                                    <input class="form-control date" type="text" name="tgl_bastk" id="tgl_bastk" value="{{$po->Tgl_bastk}}" placeholder="mm / dd / yyyy" autocomplete="off">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastd </label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <!-- <input class="form-control" type="date" value="{{$po->Tgl_bastd}}" name="selesaisewa" id="example-date-input"> -->
                                    <input class="form-control date" type="text" name="tgl_bastd" id="tgl_bastd" value="{{$po->Tgl_bastd}}" placeholder="mm / dd / yyyy" autocomplete="off">
                                  </div>
                                </div>
                              </div>
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
                                <input class="form-control" id="harga_mobil_disabled" value="{{$po->HargaSewaMobil}}" name="hargasewamobil" value="0" type="text" disabled="">
                                <input class="form-control" id="harga_mobil" value="{{$po->HargaSewaMobil}}" name="hargasewamobil"  type="text" value="0">
                                <div class="input-group-append">
                                  <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
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
                                <input class="form-control" id="harga_driver_disabled" value="{{$po->HargaSewaDriver2019}}" name="hargasewadriver" value="0" type="text" disabled="">
                                <input class="form-control" id="harga_driver" value="{{$po->HargaSewaDriver2019}}" name="hargasewadriver" type="text" value="0">
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

                          <input type="hidden" name="user_pengguna" value="{{auth::user()->id}}">                          

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






