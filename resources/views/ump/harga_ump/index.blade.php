<?php 
$page = "UMP"; 
$page2 = "ump"; 
?>

@extends('sidebar')

@section('content')






<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page2}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-5">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page2 ?></button>

            </div>
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
                    <div class="row align-items-center">
                      <div class="col-lg-9">
                        @if($s == 'active')
                        <div class="dropdown">
                          <form action="{{url('/backend/ump/harga_ump/activate')}}" method="post" role="form">
                            {{ csrf_field() }}
                            <a href="#" class="btn btn-default dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                                 @if($year == "all")
                                  All
                                 @else
                                  {{$year->Tahun}}
                                 @endif
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                              <li>
                                  <a class="dropdown-item" href="{{url('/backend/ump/harga_ump/all')}}">
                                    All
                                  </a>
                              </li>

                            @foreach($tahun_drops as $tahun_drop)
                              @if($tahun_drop->active != '1')
                                <li>
                                    <a class="dropdown-item" href="{{url('/backend/ump/harga_ump/tahun/'.$tahun_drop->Tahun)}}">
                                      {{$tahun_drop->Tahun}}
                                      @if($tahun_drop->activated == '1')
                                        <span class="badge badge-sm badge-danger">active</pan>
                                      @endif
                                    </a>
                                </li>
                              @endif
                            @endforeach

                            </ul>
                            @if($year == "all")
                             
                            @else
                              <?php $check = 0 ?>
                              @foreach($years as $y)
                                @if($y->activated != '')
                                  <?php $check++; ?>
                                @endif
                              @endforeach

                              @if($year->activated == '1')
                                <input type="hidden" name="tahun_id_non_activate" value="{{$year->Tahun}}">
                                <button type="submit" class="btn btn-outline-default">Non Activate</button>
                              @elseif($check == 0)
                                <input type="hidden" name="tahun_id" value="{{$year->Tahun}}">
                                <button type="submit" class="btn btn-outline-default">Activate</button>
                              @else
                                <button type="button" class="btn btn-outline-danger disabled">Activate</button>
                                
                              @endif
                            @endif
                              
                          </form>
                        </div>
                        @else
                          
                        @endif
                      </div>
                      <div class="col-lg-3">
                        <!-- <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                          <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true" style="font-size: 11px">Active</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false" style="font-size: 11px">Deactive</a>
                          </li>
                        </ul> -->
                        <div class="dropdown float-right">
                          <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              @if($s == 'active')
                                Active
                              @else
                                Deactive
                              @endif
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{url('/backend/ump/harga_ump')}}">Active</a>
                            <a class="dropdown-item" href="{{url('/backend/ump/harga_ump/deactive')}}">Deactive</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  @if($s == 'active') 
                  <form action="{{url('/backend/ump/harga_ump/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <div class="">
                    <!-- Projects table -->
                    

                      
                        <div class="table-responsive ">
                        <table class="table align-items-center table-flush table-hover text-center mydatatable">
                          <thead class="thead-light" style="height: 70px;">
                            <tr>
                              <th scope="col"><b>No</b></th>
                              <th scope="col" style="min-width: 10%"><b>Kota</b></th>
                              <th scope="col" style="min-width: 10%"><b>Tahun</b></th>
                              <th scope="col" style="min-width: 10%"><b>% JKK</b></th>
                              <th scope="col" style="min-width: 10%"><b>Vendor</b></th>
                              <th scope="col" style="min-width: 20%" style="min-width: 100%"><b>Harga Include</b></th>
                              <th scope="col" style="min-width: 20%"><b>Harga Eksclude</b></th>
                              <th scope="col" style="min-width: 20%" class="bg-yellow text-white"><b>created at</b></th>
                              <th scope="col" style="min-width: 20%" class="bg-yellow text-white"><b>created by</b></th>
                              <th scope="col" style="min-width: 20%" class="bg-yellow text-white"><b>updated at</b></th>
                              <th scope="col" style="min-width: 20%" class="bg-yellow text-white"><b>upadted by</b></th>
                              <!-- <th scope="col"><b>Created at</b></th> -->
                              <th scope="col" style="min-width: 10%"><b>Action</b></th>
                              <th scope="col" style="min-width: 10%">
                                <button class="btn btn-icon btn-sm btn-danger mr-2" type="submit">
                                  <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete</span>
                                </button>
                              </th>
                            </tr>

                          </thead>
                          <thead>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
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
                              @foreach($harga_umps as $harga_ump)
                              @if($harga_ump->active != '1')
                              <tr role="row" class="odd">
                                <td>{{$i}}</td>
                                  <td>  
                                      {{$harga_ump->Kota_id}}
                                  </td>
                                  <td>  
                                      {{$harga_ump->Tahun_id}} 
                                  </td>
                                  <td>       
                                      {{$harga_ump->Jkk_id}} %
                                  </td>
                                  <td>     
                                      {{$harga_ump->Vendor_id}}
                                  </td>
                                  <td>
                                    @currency($harga_ump->Harga_include)
                                  </td>
                                  <td>
                                    @currency($harga_ump->Harga_eksclude)
                                  </td>
                                  <td>
                                    @if($harga_ump->created_at != '')
                                      {{ date('d-M-Y', strtotime($harga_ump->created_at))}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                  <td>
                                    @if($harga_ump->created_by != '')
                                      {{$harga_ump->created_by}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                  <td>
                                    @if($harga_ump->updated_by != '')
                                      {{ date('d-M-Y', strtotime($harga_ump->updated_at))}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                  <td>
                                    @if($harga_ump->updated_by != '')
                                      {{$harga_ump->updated_by}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                  <td class="project-actions text-center">
                                      <!-- <a class="btn btn-primary btn-sm" href="#">
                                          <i class="fas fa-folder">
                                          </i>
                                          View
                                      </a> -->
                                      <a class="btn btn-success btn-sm" href="{{url('/backend/ump/harga_ump/edit/'.$harga_ump->id)}}">
                                          <i class="fas fa-pencil-alt">
                                          </i>
                                          
                                      </a>
                                      <!-- <a class="btn btn-danger btn-sm" href="/backend/ump/harga_ump/delete/{{$harga_ump->id}}">
                                          <i class="fas fa-trash">
                                          </i>
                                          
                                      </a> -->
                                  </td>
                                  <td>

                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$harga_ump->id}}">
                                        <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                      </div>

                                  </td>
                                <?php $i++; ?>
                              </tr>
                              @endif
                              @endforeach
                          </tbody>
                        </table>
                        </div>
                        <?php $i = 1; ?>
                        @foreach($harga_umps as $harga_ump)
                            @if($harga_ump->active != '1')
                              <div class="delete_checkbox{{$harga_ump->id}}"></div> 
                              <?php $i = $harga_ump->id; ?>                    
                            @endif
                        @endforeach
                    
                    </form>
                    @else
                        <form action="{{url('/backend/ump/harga_ump/delete_multiple')}}" method="post" role="form">
                          {{ csrf_field() }}
                          <div class="table-responsive ">
                        <table class="table  align-items-center table-flush table-hover text-center mydatatable">
                          <thead class="thead-light" style="height: 70px">
                            <tr>
                              <th scope="col" style="min-width: 10%"><b>No</b></th>
                              <th scope="col" style="min-width: 10%"><b>Kota</b></th>
                              <th scope="col" style="min-width: 10%"><b>Tahun</b></th>
                              <th scope="col" style="min-width: 10%"><b>% JKK</b></th>
                              <th scope="col" style="min-width: 20%"><b>Vendor</b></th>
                              <th scope="col" style="min-width: 20%"><b>Harga Include</b></th>
                              <th scope="col" style="min-width: 20%"><b>Harga Eksclude</b></th>
                              <th scope="col" style="min-width: 20%" class="bg-yellow text-white"><b>created at</b></th>
                              <th scope="col" style="min-width: 20%" class="bg-yellow text-white"><b>created by</b></th>
                              <th scope="col" style="min-width: 20%" class="bg-yellow text-white"><b>updated at</b></th>
                              <th scope="col" style="min-width: 20%" class="bg-yellow text-white"><b>upadted by</b></th>
                              <th scope="col" style="min-width: 10%">
                                <button class="btn btn-icon btn-sm btn-info mr-2" type="submit">
                                  <span class="btn-inner--icon"><i class="fas fa-trash"></i> restore</span>
                                </button>
                              </th>
                            </tr>

                          </thead>
                          <thead>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <th>
                                    @include('button_delete.index')
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php 
                                $i = 1;
                              ?>
                              @foreach($harga_umps as $harga_ump)
                              @if($harga_ump->active == '1')
                              <tr role="row" class="odd">
                                <td>{{$i}}</td>
                                  <td>  
                                      {{$harga_ump->Kota_id}}
                                  </td>
                                  <td>  
                                      {{$harga_ump->Tahun_id}} 
                                  </td>
                                  <td>       
                                      {{$harga_ump->Jkk_id}} %
                                  </td>
                                  <td>     
                                      {{$harga_ump->Vendor_id}}
                                  </td>
                                  <td>
                                    @currency($harga_ump->Harga_include)
                                  </td>
                                  <td>
                                    @currency($harga_ump->Harga_eksclude)
                                  </td>
                                   <td>
                                    @if($harga_ump->created_at != '')
                                      {{ date('d-M-Y', strtotime($harga_ump->created_at))}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                  <td>
                                    @if($harga_ump->created_by != '')
                                      {{$harga_ump->created_by}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                  <td>
                                    @if($harga_ump->updated_by != '')
                                      {{ date('d-M-Y', strtotime($harga_ump->updated_at))}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                  <td>
                                    @if($harga_ump->updated_by != '')
                                      {{$harga_ump->updated_by}}
                                    @else
                                      -
                                    @endif
                                  </td>
                                  <td>

                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$harga_ump->id}}">
                                        <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                      </div>

                                  </td>

                                <?php $i++; ?>
                              </tr>
                              @endif
                              @endforeach
                          </tbody>
                        </table>
                        </div>
                        <?php $i = 1; ?>
                        @foreach($harga_umps as $harga_ump)
                            @if($harga_ump->active == '1')
                              <div class="delete_checkbox{{$harga_ump->id}}"></div> 
                              <?php $i = $harga_ump->id; ?>                    
                            @endif
                        @endforeach
                      </form>
                      
                      @endif
                    </div>

                    
                  </div>
                </div>
              

                  

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

  $('#submit').attr('disabled', 'disabled');

  $("#kota").change(function () {
    var error_jkk = '';
    var tahun = $('#tahun').val();
    var vendor = $('#vendor').val();
    var kota = $(this).val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('harga_ump_available.check') }}",
        method:"POST",
        data:{tahun:tahun,vendor:vendor,kota:kota, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_harga_ump').html('<label class="text-success">*harga_ump belum tersedia</label>');
            $('#harga_ump').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_harga_ump').html('<label class="text-danger">*harga_ump sudah ada</label>');
            $('#harga_ump').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  });

  $("#vendor").change(function () {
    var error_jkk = '';
    var tahun = $('#tahun').val();
    var vendor = $(this).val();
    var kota = $('#kota').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('harga_ump_available.check') }}",
        method:"POST",
        data:{tahun:tahun,vendor:vendor,kota:kota, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_harga_ump').html('<label class="text-success">*harga_ump belum tersedia</label>');
            $('#harga_ump').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_harga_ump').html('<label class="text-danger">*harga_ump sudah ada</label>');
            $('#harga_ump').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  });


  $("#tahun").change(function () {
    var error_jkk = '';
    var tahun = $(this).val();
    var vendor = $('#vendor').val();
    var kota = $('#kota').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('harga_ump_available.check') }}",
        method:"POST",
        data:{tahun:tahun,vendor:vendor,kota:kota, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_harga_ump').html('<label class="text-success">*harga_ump belum tersedia</label>');
            $('#harga_ump').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_harga_ump').html('<label class="text-danger">*harga_ump sudah ada</label>');
            $('#harga_ump').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  });

});
</script>

@include('ump.harga_ump.add')

@endsection

















