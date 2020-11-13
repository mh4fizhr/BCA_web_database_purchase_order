<?php 
$page = "UMP"; 
$page2 = "ump"; 
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
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/backend/ump/harga_ump">{{$page}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$page2}}</li>
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
            <form action="{{url('/backend/ump/harga_ump/edit/proses/'.$harga_ump->id)}}" method="post" role="form" id="dynamic_form">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form edit {{$page2}}</h3>
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
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tahun</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" name="tahun_id" data-toggle="select"  required>
                  
                                    @foreach($tahuns as $tahun)
                                      @if($tahun->active != '1')
                                      <option value="{{$tahun->Tahun}}" {{ $harga_ump->Tahun_id == $tahun->Tahun ? 'selected' : '' }}>{{$tahun->Tahun}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                          </div>                       
                          
                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">vendor</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" name="vendor_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    <option value="">Pilih Vendor</option>
                                    @foreach($vendors as $vendor)
                                      @if($vendor->active != '1')
                                        <option value="{{$vendor->KodeVendor}}" {{ $harga_ump->Vendor_id == $vendor->KodeVendor ? 'selected' : '' }}>{{$vendor->KodeVendor}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                          </div>  


                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">kota</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" name="kota_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    @foreach($kotas as $kota)
                                      @if($kota->active != '1')
                                        <option value="{{$kota->Kota}}" {{ $harga_ump->Kota_id == $kota->Kota ? 'selected' : '' }}>{{$kota->Kota}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                          </div>  


                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Jkk</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" name="jkk_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    @foreach($jkks as $jkk)
                                      @if($jkk->active != '1')
                                        <option value="{{$jkk->jkk}}" {{ $harga_ump->Jkk_id == $jkk->jkk ? 'selected' : '' }}>{{$jkk->jkk}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                          </div>  


                        </div>

                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga Include </label>
                            </div>
                          </div>
                          <div class="col-md-10">
                            <div class="form-group">
                              <input type="text" class="form-control" name="harga_include" value="{{$harga_ump->Harga_include}}" id="Harga_include" required>
                              <input type="hidden" name="harga_include_hidden" id="Harga_include_hidden">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga Eksclude </label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <input type="text" class="form-control" name="harga_eksclude" value="{{$harga_ump->Harga_eksclude}}" id="Harga_eksclude" required>
                              <input type="hidden" name="harga_eksclude_hidden" id="Harga_eksclude_hidden">
                            </div>
                          </div>
                          <div class="col-md-1">
                            <div class="form-group">
                              <label class="form-control-label ml-3 mt-3" for="example3cols1Input">/ </label>
                            </div>
                          </div>

                          @if($harga_ump->toggle == 'no')

                            <div class="col-md-1">
                              
                                <label class="custom-toggle mt-2">
                                  <input id="no" type="checkbox">
                                  <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                  <input type="hidden" id="toggle" name="toggle" value="">
                                </label>                            
                              
                            </div>


                            <div class="col-md-2">
                              <div class="form-group" id="number">
                                <!-- <input type="number" class="form-control" name="pembagi" id="numbers" step="0.01" value="1.1" required> -->
                              </div>
                            </div>

                            <script type="text/javascript">
                              var pembagi = 0;
                              var a = 0
                              $("#no").click(function(){
                                if(a == 0){
                                  $('#Harga_include').val('');
                                  $('#Harga_eksclude').val('');
                                  // $("#numbers").prop('disabled', false);
                                  $('#number').append('<input type="number" class="form-control" name="pembagi" id="numbers" step="0.01" value="1.1" required>');
                                  a++;

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

                                }else{

                                  $('#Harga_include').val('');
                                  $('#Harga_eksclude').val('');
                                  // $("#numbers").prop('disabled', true);
                                  $('#number').empty();
                                  // $('#toggle').val('yes');
                                  a--;

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

                                }
                              });
                            </script>

                          @else

                            <div class="col-md-1">
                              
                                <label class="custom-toggle mt-2">
                                  <input id="yes" type="checkbox" checked>
                                  <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                  <input type="hidden" id="toggle" name="toggle" value="">
                                </label>                            
                              
                            </div>


                            <div class="col-md-2">
                              <div class="form-group" id="number">
                                <input type="number" class="form-control" name="pembagi" id="numbers" step="0.01" value="1.1" required>
                              </div>
                            </div>

                            <script type="text/javascript">
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
                            </script>

                          @endif

                        </div>

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

      var x = document.getElementById("Harga_include").value;
      var z = x.replace(/\./g, ".");
      var qty = parseInt(z);
      $('#Harga_include_hidden').val(qty);

      var x = document.getElementById("Harga_eksclude").value;
      var z = x.replace(/\./g, ".");
      var qty = parseInt(z);
      $('#Harga_eksclude_hidden').val(qty);

  });

  

  $('#Harga_include, #numbers').on('keyup',function() {
    var x = document.getElementById("Harga_include").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#Harga_include_hidden').val(qty);
    var price = parseFloat($('#numbers').val());
    var total = qty / price ? qty / price : 0;
    total = total.toFixed(2);
    $('#Harga_eksclude_hidden').val(total);
    var hasil = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "");
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
    var hasil = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "");
    $('#Harga_eksclude').val(hasil);
  });

  $('#Harga_eksclude').on('keyup',function() {
    $('#toggle').val('no');
    var x = document.getElementById("Harga_eksclude").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#Harga_eksclude_hidden').val(qty);
    var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "");
    $('#Harga_eksclude').val(hasil);
  });

  $('#Harga_eksclude').on('keyup',function() {
    $('#toggle').val('no');
    var x = document.getElementById("Harga_eksclude").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#Harga_eksclude_hidden').val(qty);
    var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "");
    $('#Harga_eksclude').val(hasil);
  });

  $(document).ready(function() {

      $('#Harga_include').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});
    
      $('#Harga_eksclude').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});

  });


 
  

</script>



@endsection









