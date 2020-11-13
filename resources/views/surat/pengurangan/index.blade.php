<?php 
$page = "Surat"; 
$page2 = "Surat pengurangan"; 
?>
<?php
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('d-m-Y');
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
              <!-- <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                <li class="nav-item">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page2 ?></button>
                </li>
              </ul> -->
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-file-word nav-icon"></li> &nbspDatabase Surat pengurangan</h3>
                <!-- <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        not approved
                      @else
                        approved
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/surat/pengurangan/status/active')}}">not approved</a>
                    <a class="dropdown-item" href="{{url('/backend/surat/pengurangan/status/deactive')}}">approved</a>
                  </div>
                </div> -->
              </div>
              
              @if($s == 'active')
                 <form action="{{url('/backend/surat/pengurangan/status')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table  align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" style="min-width: 20%">Vendor</th>
                          <th scope="col" style="min-width: 20%">No surat</th>
                          <th scope="col" style="min-width: 20%">Tgl surat</th>
                          <th scope="col" style="min-width: 20%">Action</th>
                          <th scope="col" style="min-width: 20%">Status</th>
                          <!-- <th scope="col" style="min-width: 10%">
                            <button class="btn btn-icon btn-sm btn-info mr-2" type="submit">
                              <span class="btn-inner--icon"><i class="fas fa-check"></i> Approve</span>
                            </button>
                          </th> -->
                        </tr>
                      </thead>
                      <thead>
                          <tr>
                              <td></td>
                              <th>
                                <select class="form-control form-control-sm" style="min-width: 100px">
                                    <option value="">All</option>
                                    @foreach($vendor_uniques as $vendor_unique)
                                      @foreach($vendors as $vendor)
                                        @if($vendor_unique->nama_vendor == $vendor->NamaVendor)
                                          <option value="{{$vendor->NamaVendor}}">{{$vendor->NamaVendor}}</option>
                                        @endif
                                      @endforeach
                                    @endforeach
                                </select>
                              </th>
                              <td></td>
                              <td></td>
                              <td></td>
                                <th>
                                  <select class="form-control form-control-sm" style="min-width: 100px">
                                    <option value="">All</option>
                                      <option value="Approve">Approve</option>
                                      <option value="Waiting Approval">Waiting Approval</option>
                                  </select>
                                </th>
                              <!-- <th>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input checkAll" id="checkAll">
                                  <label class="custom-control-label" for="checkAll"></label>
                                </div>
                              </th> -->
                          </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        @foreach($template_pengurangans as  $template_pengurangan)
                        
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$template_pengurangan->nama_vendor}}</td>
                          <td>
                            {{$template_pengurangan->no_surat}}
                            @if($currentDateTime == date('d-m-Y', strtotime($template_pengurangan->created_at)))
                               <sup class=""><span class="badge badge-warning">new</span></sup>
                            @endif
                          </td>
                          <td>{{$template_pengurangan->tgl_surat}}</td>
                          <td>
                            @if($template_pengurangan->status == '1' || $template_pengurangan->status == '2')
                            <a href="{{url('/backend/surat/pengurangan/'.$template_pengurangan->id)}}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> &nbspdownload</a>
                            @endif
                            <a href="{{url('/backend/surat/pengurangan/view/'.$template_pengurangan->id)}}" class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i> &nbspview</a>
                          </td>
                          <td>
                            @if($template_pengurangan->status == '1')
                              <span class="badge badge-default">Approve</span>
                            @else
                              <span class="badge badge-warning">Waiting approval</span>
                            @endif
                          </td>
                          <!-- <td>
                            @if($template_pengurangan->status == '1')
                              
                            @else
                              <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" name="status[]" id="customCheck{{$i}}" value="{{$template_pengurangan->id}}">
                                  <label class="custom-control-label" for="customCheck{{$i}}"></label>
                              </div>
                            @endif
                            
                          </td> -->
                        </tr>
                        <?php $i++;  ?>
                        
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </form>
              @else
                 <!-- <form action="{{url('/backend/surat/pengurangan/status')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <div class="table-responsive">
                    
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Vendor</th>
                          <th scope="col">No surat</th>
                          <th scope="col">Tgl surat</th>
                          <th scope="col">Action</th>
                          <th scope="col">
                            <button class="btn btn-icon btn-sm btn-danger mr-2" type="submit">
                              <span class="btn-inner--icon"><i class="fas fa-undo"></i> Restore</span>
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
                                        @if($vendor_unique->nama_vendor == $vendor->NamaVendor)
                                          <option value="{{$vendor->NamaVendor}}">{{$vendor->NamaVendor}}</option>
                                        @endif
                                      @endforeach
                                    @endforeach
                                </select>
                              </th>
                              <td></td>
                              <td></td>
                              <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                              <th>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input checkAll" id="checkAll">
                                  <label class="custom-control-label" for="checkAll"></label>
                                </div>
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        @foreach($template_pengurangans as  $template_pengurangan)
                        @if($template_pengurangan->status == '1')
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$template_pengurangan->nama_vendor}}</td>
                          <td>
                            {{$template_pengurangan->no_surat}}
                            @if($currentDateTime == date('d-m-Y', strtotime($template_pengurangan->created_at)))
                               <sup class=""><span class="badge badge-warning">new</span></sup>
                            @endif
                          </td>
                          <td>{{$template_pengurangan->tgl_surat}}</td>
                          <td>
                            <a href="{{url('/backend/surat/pengurangan/'.$template_pengurangan->id)}}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> &nbspdownload</a>
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="status[]" id="customCheck{{$i}}" value="{{$template_pengurangan->id}}">
                                <label class="custom-control-label" for="customCheck{{$i}}"></label>
                              </div>
                          </td>
                        </tr>
                        <?php $i++;  ?>
                        @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </form> -->
              @endif
             
                <!-- <div class="table-responsive">
                   
                    <form action="{{url('/backend/surat/pengurangan/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Carpooling - Kota</th>
                          <th scope="col" width="10px">
                            <button class="btn btn-icon btn-sm btn-info mr-2" type="submit">
                              <span class="btn-inner--icon"><i class="fas fa-trash"></i> restore</span>
                            </button>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div> -->
                </form>
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

  $("#kota").keyup(function(){
    var error_kota = '';
    var kota = $('#kota').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('cp_available.check') }}",
        method:"POST",
        data:{kota:kota, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_kota').html('<label class="text-success">*Carpooling belum tersedia</label>');
            $('#kota').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_kota').html('<label class="text-danger">*Carpooling sudah ada</label>');
            $('#kota').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  });

  $("#kota").blur(function(){
    var error_kota = '';
    var kota = $('#kota').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('cp_available.check') }}",
        method:"POST",
        data:{kota:kota, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_kota').html('<label class="text-success">*Carpooling belum tersedia</label>');
            $('#kota').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_kota').html('<label class="text-danger">*Carpooling sudah ada</label>');
            $('#kota').addClass('has-error');
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


@endsection

















