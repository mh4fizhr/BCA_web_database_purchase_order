@if(auth::user()->status == 'admin')
  <?php 
    $page = "db_pks";
    $page2 = "Addendum";
  ?>
@else
  <?php 
    $page = "pks";
    $page2 = "Addendum";
  ?>
@endif
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
            <form action="{{url('/backend/addendum/edit/proses/'.$addendum->id)}}" method="post" role="form" id="dynamic_form" enctype="multipart/form-data">
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
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Vendor</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <select class="form-control" id="vendor" name="vendor">
                                    @foreach($vendors as $vendor)
                                      @if($vendor->active != '1')
                                        <option value="{{$vendor->KodeVendor}}" {{$vendor->KodeVendor == $addendum->vendor ? 'selected' : ''}}>{{$vendor->KodeVendor}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                          </div> 

                          <!-- <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">PKS</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  
                                  <select class="form-control" id="pks_id" name="pks_id">
                                    @foreach($pkss as $pks)
                                      @if($pks->active != '1')
                                        @if($addendum->vendor == $pks->vendor)

                                        
                                        <option value="{{$pks->id}}" {{$pks->id == $addendum->pks_id ? 'selected' : ''}}>{{$pks->no_pks}} &nbsp - &nbsp {{ date('d M Y', strtotime($pks->tgl_pks))}} &nbsp - &nbsp {{$pks->nama_kontrak_pks}}</option>
                                        @endif
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                          </div>  -->

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No. PKS/addendum</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" name="no_addendum" value="{{$addendum->no_addendum}}" class="form-control" id="exampleInputtext1" placeholder="Enter code" required="">
                                </div>
                          </div>                       
                          
                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl PKS/addendum</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input class="form-control date" type="text" name="tgl_addendum" value="{{$addendum->tgl_addendum}}" placeholder="mm / dd / yyyy" required>
                                </div>
                          </div> 

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Nama kontrak PKS/addendum</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" name="nama_kontrak_addendum" value="{{$addendum->nama_kontrak_addendum}}" class="form-control" id="exampleInputtext1" placeholder="Enter kontrak" required="">
                                </div>
                          </div> 

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Keterangan</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3">{{$addendum->deskripsi}}</textarea>
                                </div>
                          </div> 

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">File <span class="text-warning text-sm">(maximum size : 10 mb)</span></label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="card text-center" style="box-shadow: 0 0 0;border: thin;border-style: dashed;">
                                  <div class="card-body">
                                    <input type="file" name="file" class="ml-5 mt-4 mb-4">
                                  </div>
                                </div>
                          </div> 
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
  $(document).ready(function(){

      // Department Change
      $('#vendor').change(function(){

         // Department id
         var value = $(this).val();
         var _token = $('input[name="_token"]').val();

         // Empty the dropdown
         $('#pks_id').find('option').not(':first').remove();

         // AJAX request 
         $.ajax({
           url:"{{ route('vendor_pks.check') }}",
           method:"POST",
           data:{value:value, _token:_token},
           success: function(data) {
               $('#pks_id').html(data.html);
           }
        });
      });

    });

$(document).ready(function(){

  // $('#submit').attr('disabled', 'disabled');

  $("#addendum").keyup(function(){
    var error_addendum = '';
    var addendum = $('#addendum').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('addendum_available.check') }}",
        method:"POST",
        data:{addendum:addendum, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_addendum').html('<label class="text-success">*addendum belum tersedia</label>');
            $('#addendum').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_addendum').html('<label class="text-danger">*addendum sudah ada</label>');
            $('#addendum').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 


  $("#addendum").blur(function(){
    var error_addendum = '';
    var addendum = $('#addendum').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('addendum_available.check') }}",
        method:"POST",
        data:{addendum:addendum, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_addendum').html('<label class="text-success">*addendum belum tersedia</label>');
            $('#addendum').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_addendum').html('<label class="text-danger">*addendum sudah ada</label>');
            $('#addendum').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  });

  $('#pks_id').on('change', function() {

    var nopolID = $(this).val();

      if(nopolID) {

          $.ajax({

              url: '/backend/addendum/ajax/'+nopolID,

              type: "GET",

              dataType: "json",

              success:function(data) {

                  $('#tgl_pks').val('');

                  $('#nama_kontrak_pks').val('');

                  $.each(data, function(key, value) {

                    $('#tgl_pks').val(value.tgl_pks);

                    $('#nama_kontrak_pks').val(value.nama_kontrak_pks);


                  });


              }

          });

      }else{

          $('#harga_driver_ajax').empty();

      }

  });


 
});


</script>


@endsection









