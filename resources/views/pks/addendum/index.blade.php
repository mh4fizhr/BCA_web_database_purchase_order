<?php
$page = "pks"; 
$page2 = "PKS / addendum"; 
?>
@extends('sidebar')

@section('content')


<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page2}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                <li class="nav-item">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page2 ?></button>
                  <!-- <a href="{{url('/backend/pks/create')}}" class="btn btn-success float-right pull-right pl-5 pr-5" ><i class="fas fa-plus"></i> Add <?php echo $page2 ?></a> -->
                </li>
              </ul>
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
            <div class="card pb-4">
              <div class="card-header border-0">
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-file-alt"></li> &nbspDatabase Addendum</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/addendum/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/addendum/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')
                <div class="table-responsive">
                    <form action="{{url('/backend/addendum/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <!-- Projects table -->
                    <table class="table  align-items-center table-flush table-hover text-center mydatatable" id="myTable" style="width: 100%">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" rowspan="2">No</th>
                          <th scope="col" rowspan="2">Vendor</th>
                          <th scope="col" colspan="5" class="bg-info text-white"><b>PKS / addendum</b></th>
                          <th scope="col" rowspan="2" style="min-width: 5%">Action</th>
                          <th scope="col" rowspan="2" style="min-width: 5%">
                            <button class="btn btn-icon btn-sm btn-danger mr-2" type="submit">
                              <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete</span>
                            </button>
                          </th>
                        </tr>
                        <tr>
                          <th scope="col" class="bg-info text-white" >No. </th>
                          <th scope="col" class="bg-info text-white" >Tanggal </th>
                          <th scope="col" class="bg-info text-white" >Nama kontrak </th>
                          <th scope="col" class="bg-info text-white" >Deskripsi </th>
                          <th scope="col" class="bg-info text-white" >File </th>
                        </tr>
                      </thead>
                      <thead>
                          <tr>
                              <td></td>
                              <th>
                                <select class="form-control form-control-sm" style="min-width:100px">
                                    <option value="">All</option>
                                    @foreach($vendor_uniques as $vendor_unique)
                                      @foreach($vendors as $vendor)
                                        @if($vendor_unique->vendor == $vendor->KodeVendor)
                                          <option value="{{$vendor->KodeVendor}}">{{$vendor->KodeVendor}}</option>
                                        @endif
                                      @endforeach
                                    @endforeach
                                </select>
                              </th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="No." style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="Tanggal" style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="Nama Kontrak" style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="Deskripsi" style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="File" style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                              <th>
                                @include('button_delete.index')
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $i = 1;
                          ?>
                          @foreach($addendums as $addendum)
                          @if($addendum->active != '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td class="text-left">{{$addendum->vendor}}</td>
                            <td class="text-left">{{$addendum->no_addendum}}</td>
                            <td class="text-left">{{ date('d-M-Y', strtotime($addendum->tgl_addendum))}}</td>
                            <td class="text-left"><?php echo substr($addendum->nama_kontrak_addendum,0,20); ?></td>
                            <td class="text-left">{{$addendum->deskripsi}}</td>
                            
                            <!-- <td><a href="{{asset('file/addendum/'.$addendum->file)}}">{{$addendum->file}}</a></td> -->
                            <td class="text-left"><a href="{{asset('laravel/public/file/addendum/'.$addendum->file)}}">{{$addendum->file}}</a></td>

                            <td class="project-actions text-center">
                                <!-- <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a> -->
                                <a class="btn btn-success btn-sm" href="{{url('/backend/addendum/edit/'.$addendum->id)}}">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      
                                  </a>
                                <!-- <a class="btn btn-danger btn-sm" href="/backend/addendum/delete/{{$addendum->id}}">
                                    <i class="fas fa-trash">
                                    </i>
                                </a> -->
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$addendum->id}}">
                                  <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                </div>
                            </td>
                            <?php $i++; ?>
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                    </table>
                    <?php $i = 1; ?>
                    @foreach(App\addendum::all()->sortBy('id') as $addendum)
                        @if($addendum->active != '1')
                          <div class="delete_checkbox{{$addendum->id}}"></div> 
                          <?php $i = $addendum->id; ?>                    
                        @endif
                    @endforeach
                     </form>
                </div>
              @else
                <div class="table-responsive">
                  <!-- Projects table -->
                  <form action="{{url('/backend/addendum/delete_multiple')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <table class="table  align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light">
                        <tr>
                          <th scope="col" rowspan="2">No</th>
                          <th scope="col" rowspan="2">Vendor</th>
                          <th scope="col" colspan="5" class="bg-info text-white"><b>PKS / addendum</b></th>
                          <th scope="col" rowspan="2">
                          <button class="btn btn-icon btn-sm btn-info mr-2" type="submit">
                            <span class="btn-inner--icon"><i class="fas fa-trash"></i> restore</span>
                          </button>
                        </th>
                        </tr>
                        <tr>
                          <th scope="col" class="bg-info text-white" >No. </th>
                          <th scope="col" class="bg-info text-white" >Tanggal </th>
                          <th scope="col" class="bg-info text-white" >Nama kontrak </th>
                          <th scope="col" class="bg-info text-white" >Deskripsi </th>
                          <th scope="col" class="bg-info text-white" >File </th>
                        </tr>
                      </thead>
                      <thead>
                          <tr>
                              <td></td>
                              <th>
                                <select class="form-control form-control-sm" style="min-width:100px">
                                    <option value="">All</option>
                                    @foreach($vendor_uniques as $vendor_unique)
                                      @foreach($vendors as $vendor)
                                        @if($vendor_unique->vendor == $vendor->KodeVendor)
                                          <option value="{{$vendor->KodeVendor}}">{{$vendor->KodeVendor}}</option>
                                        @endif
                                      @endforeach
                                    @endforeach
                                </select>
                              </th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="No." style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="Tanggal" style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="Nama Kontrak" style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="Deskripsi" style="min-width:100px" /></th>
                              <th><input type="text" class="form-control form-control-sm" placeholder="File" style="min-width:100px" /></th>
                              <th>
                                @include('button_delete.index')
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $i = 1;
                          ?>
                          @foreach($addendums as $addendum)
                          @if($addendum->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td>{{$addendum->vendor}}</td>
                            <td>{{$addendum->no_addendum}}</td>
                            <td>{{ date('d-M-Y', strtotime($addendum->tgl_addendum))}}</td>
                            <td><?php echo substr($addendum->nama_kontrak_addendum,0,20); ?></td>
                            <td>{{$addendum->deskripsi}}</td>
                            
                            <!-- <td><a href="{{asset('file/addendum/'.$addendum->file)}}">{{$addendum->file}}</a></td> -->
                            <td><a href="{{asset('laravel/public/file/addendum/'.$addendum->file)}}">{{$addendum->file}}</a></td>

                            <td>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$addendum->id}}">
                                  <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                </div>
                            </td>
                            <?php $i++; ?>
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                    </table>
                  @foreach(App\addendum::all()->sortBy('id') as $addendum)
                      @if($addendum->active == '1')
                        <div class="delete_checkbox{{$addendum->id}}"></div> 
                        <?php $i = $addendum->id; ?>                    
                      @endif
                  @endforeach
                  </form>
                </div>
              @endif              
              
            </div>
            
          </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
    <!-- /.content -->
    </div>



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

              url: '{{url("/backend/addendum/ajax")}}'+"/"+nopolID,

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

@include('pks/addendum/add')


@endsection










