<?php
$page = "pks"; 
$page2 = "pks"; 
?>
@extends('sidebar')

@section('content')

<!-- <?php
                              if (strlen($addendum->nama_kontrak_addendum) < 20) {
                                echo substr($addendum->nama_kontrak_addendum,0,20).'...';
                              }else{
                                $cut_text = substr($addendum->nama_kontrak_addendum, 0, 30);
                                if ($addendum->nama_kontrak_addendum{30 - 1} != ' ') { // jika huruf ke 50 (50 - 1 karena index dimulai dari 0) buka  spasi
                                  $new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
                                  $cut_text = substr($addendum->nama_kontrak_addendum, 0, $new_pos);
                                }
                                echo $cut_text . '...';
                              }
                              ?> -->
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
                  <a href="{{url('/backend/pks/create')}}" class="btn btn-success float-right pull-right pl-5 pr-5" ><i class="fas fa-plus"></i> Add <?php echo $page2 ?></a>
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-file-powerpoint"></li> &nbspDatabase pks</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/pks/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/pks/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')
                <div class="">
                    <form action="{{url('/backend/pks/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <!-- Projects table -->
                    <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" style="min-width: 10%" class="bg-success text-white">Vendor</th>
                          <th scope="col" style="min-width: 10%">No pks</th>
                          <th scope="col" style="min-width: 10%">Tgl pks</th>
                          <th scope="col" style="min-width: 10%">Nama kontrak pks</th>
                          <th scope="col" style="min-width: 20%">Deskripsi</th>
                          <th scope="col" style="min-width: 30%">File</th>
                          <th scope="col" style="min-width: 10%">Action</th>
                          <th scope="col" style="min-width: 10%" class="bg-warning text-white">addendum</th>
                          <th scope="col" style="min-width: 10%" class="bg-warning text-white">jml addendum</th>
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
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                              <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
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
                          @foreach($pkss as $pks)
                          @if($pks->active != '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td>{{$pks->vendor}}</td>
                            <td>{{$pks->no_pks}}</td>
                            <td>
                              {{ date('d-M-Y', strtotime($pks->tgl_pks))}}
                            </td>
                            <td>{{$pks->nama_kontrak_pks}}</td>
                            <td>{{$pks->deskripsi}}</td>
                            <!-- <td><a href="{{asset('file/pks/'.$pks->file)}}" target="_blank">{{$pks->file}}</a></td> -->
                            <td><a href="{{asset('laravel/public/file/pks/'.$pks->file)}}" target="_blank">{{$pks->file}}</a></td>
                            <td class="project-actions text-center">
                                
                                <a class="btn btn-success btn-sm" href="{{url('/backend/pks/edit/'.$pks->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>   
                                </a>
                                
                            </td>
                            @if($pks->addendum_id == '')
                              <td>
                                <a class="btn btn-warning btn-sm" href="{{url('/backend/pks/index_pks_addendum/'.$pks->id)}}">
                                    <i class="fas fa-file-contract"></i> &nbsp Addendum
                                </a>
                              </td>
                            @else
                              @foreach($addendums as $addendum)
                                @if($pks->addendum_id == $addendum->id)
                                  <td><!-- {{$addendum->no_addendum}} -->
                                    <a class="btn btn-warning btn-sm" href="{{url('/backend/pks/index_pks_addendum/'.$pks->id)}}">
                                        <i class="fas fa-file-contract"></i> &nbsp Addendum
                                    </a>
                                  </td>
                                @endif
                              @endforeach
                            @endif
                            <td>
                              <?php $jml_addendum = App\addendum::where('pks_id',$pks->id)->count(); ?>
                              {{$jml_addendum}}
                            </td>
                            
                            <td>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$pks->id}}">
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
                    @foreach(App\pks::all()->sortBy('id') as $pks)
                        @if($pks->active != '1')
                          <div class="delete_checkbox{{$pks->id}}"></div> 
                          <?php $i = $pks->id; ?>                    
                        @endif
                    @endforeach
                     </form>
                </div>
              @else
                <div class="">
                  <!-- Projects table -->
                  <form action="{{url('/backend/pks/delete_multiple')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light" style="height: 70px">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col" style="min-width: 10%">Vendor</th>
                        <th scope="col" style="min-width: 10%">No pks</th>
                        <th scope="col" style="min-width: 10%">Tgl pks</th>
                        <th scope="col" style="min-width: 10%">Nama kontrak pks</th>
                        <th scope="col" style="min-width: 10%">No addendum</th>
                        <th scope="col" style="min-width: 20%">Deskripsi</th>
                        <th scope="col" style="min-width: 30%">File</th>
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
                          @foreach($pkss as $pks)
                          @if($pks->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td>{{$pks->vendor}}</td>
                            <td>{{$pks->no_pks}}</td>
                            <td>{{ date('d-M-Y', strtotime($pks->tgl_pks))}}</td>
                            <td>{{$pks->nama_kontrak_pks}}</td>
                            @if($pks->addendum_id == '')
                              <td></td>
                            @else
                              @foreach($addendums as $addendum)
                                @if($pks->addendum_id == $addendum->id)
                                  <td>{{$addendum->no_addendum}}</td>
                                @endif
                              @endforeach
                            @endif
                            <td>{{$pks->deskripsi}}</td>
                            <!-- <td><a href="{{asset('file/pks/'.$pks->file)}}">{{$pks->file}}</a></td> -->
                            <td><a href="{{asset('laravel/public/file/pks/'.$pks->file)}}" target="_blank">{{$pks->file}}</a></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$pks->id}}">
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
                  @foreach(App\pks::all()->sortBy('id') as $pks)
                      @if($pks->active == '1')
                        <div class="delete_checkbox{{$pks->id}}"></div> 
                        <?php $i = $pks->id; ?>                    
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


  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


$(document).ready(function(){

      // Department Change
      $('#vendor').change(function(){

         // Department id
         var value = $(this).val();
         var _token = $('input[name="_token"]').val();

         // Empty the dropdown
         $('#addendum_id').find('option').not(':first').remove();

         // AJAX request 
         $.ajax({
           url:"{{ route('vendor_addendum.check') }}",
           method:"POST",
           data:{value:value, _token:_token},
           success: function(data) {
               $('#addendum_id').html(data.html);
           }
        });
      });

    });
</script>




@endsection










