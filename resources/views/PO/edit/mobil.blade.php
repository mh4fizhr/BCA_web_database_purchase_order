<?php 
$page = "Dashboard";
?>
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

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">Merek & type</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Merek & type</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
            <form action="{{url('/backend/po/type/edit/proses/'.$po->id)}}" method="post" role="form" id="dynamic_form">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form edit Merek & type</h3>
                  </div>
                  <!-- Card body -->
                  <div class="card-body">
                    <!-- Form groups used in grid -->


                    <div id="tambuh">
                    <!-- <hr> -->
                    <div class="row" id="tambuh">
                      <div class="col-md-12">
                        <div class="row">

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Nopo :</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <input class="form-control" type="text" name="nopo" id="nopol" value="">
                                </div>
                          </div>                       

                          <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Merek & Type :</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" id="type2" name="mobil_id" required>
                                    @foreach($mobils as $mobil)
                                      @if($mobil->active != '1')
                                        <option value="{{$mobil->id}}" {{ $po->Mobil_id == $mobil->id ? 'selected' : '' }}>{{$mobil->MerekMobil}}&nbsp{{$mobil->Type}}&nbsp- {{$mobil->Tahun}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                          </div>       

                          <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->      

                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tanggal Efektif :</label>
                            </div>
                          </div>
                          <div class="col-md-10">
                            <div class="form-group">
                              <input class="form-control date" type="text" name="tgl_efektif" id="tgl_efektif" placeholder="mm / dd / yyyy" required>
                            </div>
                          </div>  

                          <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->   

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Biaya Sewa :</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control" id="harga_mobil" type="text" value="0" >
                                    <div class="input-group-append">
                                      <input type="hidden" id="harga_mobil_hidden" name="hargasewamobil" value="0">
                                      <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
                                    </div>
                                  </div>
                                </div>
                          </div>          
                         
                          <input type="hidden" name="po_id" value="{{$po->id}}">

                      </div>

                  </div>
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


<script>

$(document).ready(function() {
    
      $('#km').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});

      $('#km').on('keyup',function() {
        $('#toggle').val('no');
        var x = document.getElementById("km").value;
        var z = x.replace(/\./g, "");
        var qty = parseInt(z);
        $('#km_hidden').val(qty);
        var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#km').val(hasil);
      });
      $('#km').on('input',function() {
        $('#toggle').val('no');
        var x = document.getElementById("km").value;
        var z = x.replace(/\./g, "");
        var qty = parseInt(z);
        $('#km_hidden').val(qty);
        var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#km').val(hasil);
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
});


  

</script>


@endsection









