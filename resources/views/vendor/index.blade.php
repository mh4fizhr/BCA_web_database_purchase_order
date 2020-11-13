<?php
$page = "Vendor"; 
$page2 = "Vendor"; 
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="ni ni-building"></li> &nbspDatabase Vendor</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/vendor/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/vendor/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')
                <div class="">
                    <form action="{{url('/backend/ump/vendor/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <!-- Projects table -->
                    <div class="table-responsive">
                    <table class="table  align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" style="min-width: 10%">Kode Vendor</th>
                          <th scope="col" style="min-width: 10%">Nama Vendor</th>
                          <th scope="col" style="min-width: 10%">PIC vendor</th>
                          <th scope="col" style="min-width: 10%">No.HP</th>
                          <th scope="col" style="min-width: 10%">Pejabat</th>
                          <th scope="col" style="min-width: 10%">Jabatan</th>
                          <th scope="col" style="min-width: 20%">Alamat vendor</th>
                          <th scope="col" style="min-width: 10%">Action</th>
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
                          @foreach($vendors as $vendor)
                          @if($vendor->active != '1')
                          <tr role="row" class="odd ">
                            <td>{{$i}}</td>
                            <td class="text-left">{{$vendor->KodeVendor}}</td>
                            <td class="text-left">{{$vendor->NamaVendor}}</td>
                            <td class="text-left">{{$vendor->PICvendor}}</td>
                            <td class="text-left">{{$vendor->Nohpvendor}}</td>
                            <td class="text-left">{{$vendor->Pejabatvendor}}</td>
                            <td class="text-left">{{$vendor->Jabatanvendor}}</td>
                            <td class="text-left">
                              <?php
                              if (strlen($vendor->AlamatVendor) < 10) {
                                echo substr($vendor->AlamatVendor,0,20).'...';
                              }else{
                                $cut_text = substr($vendor->AlamatVendor, 0, 30);
                                if ($vendor->AlamatVendor{30 - 1} != ' ') { // jika huruf ke 50 (50 - 1 karena index dimulai dari 0) buka  spasi
                                  $new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
                                  $cut_text = substr($vendor->AlamatVendor, 0, $new_pos);
                                }
                                echo $cut_text . '...';
                              }
                              ?>
                            </td>
                            <td class="project-actions text-center">
                                <!-- <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a> -->
                                <a class="btn btn-success btn-sm" href="{{url('/backend/ump/vendor/edit/'.$vendor->id)}}">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      
                                  </a>
                                <!-- <a class="btn btn-danger btn-sm" href="/backend/vendor/delete/{{$vendor->id}}">
                                    <i class="fas fa-trash">
                                    </i>
                                </a> -->
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$vendor->id}}">
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
                    @foreach(App\Vendor::all()->sortBy('id') as $vendor)
                        @if($vendor->active != '1')
                          <div class="delete_checkbox{{$vendor->id}}"></div> 
                          <?php $i = $vendor->id; ?>                    
                        @endif
                    @endforeach
                     </form>
                </div>
              @else
                <div class="">
                  <!-- Projects table -->
                  <form action="{{url('/backend/ump/vendor/delete_multiple')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light" style="height: 70px">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col" style="min-width: 10%">Kode Vendor</th>
                        <th scope="col" style="min-width: 10%">Nama Vendor</th>
                        <th scope="col" style="min-width: 10%">PIC vendor</th>
                        <th scope="col" style="min-width: 10%">No.HP</th>
                        <th scope="col" style="min-width: 10%">Pejabat</th>
                        <th scope="col" style="min-width: 10%">Jabatan</th>
                        <th scope="col" style="min-width: 20%">Alamat vendor</th>
                        <th scope="col" style="min-width: 20%">
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
                              <th>
                                @include('button_delete.index')
                              </th>
                          </tr>
                      </thead>
                    <tbody>
                      <?php 
                          $i = 1;
                        ?>
                        @foreach($vendors as $vendor)
                        @if($vendor->active == '1')
                        <tr role="row" class="odd">
                          <td>{{$i}}</td>
                          <td class="text-left">{{$vendor->KodeVendor}}</td>
                          <td class="text-left">{{$vendor->NamaVendor}}</td>
                          <td class="text-left">{{$vendor->PICvendor}}</td>
                          <td class="text-left">{{$vendor->Nohpvendor}}</td>
                          <td class="text-left">{{$vendor->Pejabatvendor}}</td>
                          <td class="text-left">{{$vendor->Jabatanvendor}}</td>
                          <td class="text-left">
                            <?php
                            if (strlen($vendor->AlamatVendor) < 10) {
                              echo substr($vendor->AlamatVendor,0,20).'...';
                            }else{
                              $cut_text = substr($vendor->AlamatVendor, 0, 30);
                              if ($vendor->AlamatVendor{30 - 1} != ' ') { // jika huruf ke 50 (50 - 1 karena index dimulai dari 0) buka  spasi
                                $new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
                                $cut_text = substr($vendor->AlamatVendor, 0, $new_pos);
                              }
                              echo $cut_text . '...';
                            }
                            ?>
                            
                          </td>
                          <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$vendor->id}}">
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
                  @foreach(App\Vendor::all()->sortBy('id') as $vendor)
                        @if($vendor->active == '1')
                          <div class="delete_checkbox{{$vendor->id}}"></div>    
                        @endif
                        <?php $i = $vendor->id; ?>   
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

  $('#submit').attr('disabled', 'disabled');

  $("#vendor").keyup(function(){
    var error_vendor = '';
    var vendor = $('#vendor').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('vendor_available.check') }}",
        method:"POST",
        data:{vendor:vendor, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_vendor').html('<label class="text-success">*vendor belum tersedia</label>');
            $('#vendor').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_vendor').html('<label class="text-danger">*vendor sudah ada</label>');
            $('#vendor').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 


  $("#vendor").blur(function(){
    var error_vendor = '';
    var vendor = $('#vendor').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('vendor_available.check') }}",
        method:"POST",
        data:{vendor:vendor, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_vendor').html('<label class="text-success">*vendor belum tersedia</label>');
            $('#vendor').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_vendor').html('<label class="text-danger">*vendor sudah ada</label>');
            $('#vendor').addClass('has-error');
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
</script>

@include('vendor/add')


@endsection










