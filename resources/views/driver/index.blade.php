<?php $page = "Driver"; ?>
@extends('sidebar')

@section('content')

<?php
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentDate = date('m/d/Y');
?>

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-5">
              <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                
                <li class="nav-item">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page ?></button>
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-user-tie"></li> &nbspDatabase Driver</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/driver')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/driver/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')
                <div class="" >

                  <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light" style="height: 70px">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Driver</th>
                        <th scope="col">Nama Vendor</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="bg-success text-white">No.Po</th>
                        <th scope="col" class="bg-success text-white">Nopol</th>
                        <th scope="col" class="bg-success text-white">History</th>
                        <th scope="col">PKWT</th>
                        <th scope="col">Created at</th>
                        <th scope="col" style="min-width: 100%">Action</th>
                      </tr>
                    </thead>
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>
                              <select class="form-control form-control-sm" id="status_active" style="width: 150px">
                                  <option value="">All</option>
                                  <option value="active">active</option>
                                  <option value="expired">expired</option>
                                  <option value="non active">non active</option>
                              </select>
                            </th>
                            <td></td>
                            <td></td>
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></th>
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></th>
                            <td></td>
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $i = 1;
                        ?>
                        @foreach($drivers as $driver)
                        @if($driver->active != '1')
                        <tr role="row" class="odd">
                          <td>{{$i}}</td>

                          <td>
                                  {{$driver->nik}}</a>
                          </td>
                          <td>
                                  {{$driver->nip}}</a>
                          </td>
                          <td>
                                  {{$driver->NamaDriver}}</a>
                          </td>

                          <td>
                                  {{$driver->vendor_id}}
                          </td>

                          <td>
                            
                            <?php $status = 'Non Active' ?>
                            @foreach($pkwts as $pkwt)
                              @if($driver->id == $pkwt->driver_id && $pkwt->active != '1')
                                @if($pkwt->PeriodeJeda_start >= $currentDateTime && $pkwt->PeriodeJeda_end <= $currentDateTime && $pkwt->TanggalMasuk != '')
                                  <?php $status = 'Non Active' ?>
                                @elseif($pkwt->TanggalMasuk == '')
                                  <?php $status = 'Non Active' ?>
                                @else
                                  <?php $status = 'Active' ?>
                                @endif
                              @endif
                            @endforeach

                            <?php 
                            if (App\pkwt::where('driver_id',$driver->id)->exists()) {

                              $driver_get = App\pkwt::where('driver_id',$driver->id)->where('active',null)->orwhere('active','')->orderBy('id', 'DESC')->first();
                              if ($driver_get->pkwt1_end != null && $driver_get->pkwt2_end != null && date('Y-m-d H:i:s', strtotime($driver_get->pkwt2_end)) <=  $currentDateTime) {
                                $status = 'Expired';
                              }elseif($driver_get->pkwt1_end != null && $driver_get->pkwt2_end == null && date('Y-m-d H:i:s', strtotime($driver_get->pkwt1_end))  <= $currentDateTime){
                                $status = 'Expired';
                              }else{

                              }
                            }
                            ?>

                            @if($status == 'Active')
                              <span class="badge badge-lg badge-default">{{$status}}</span>
                            @elseif($status == 'Expired')
                              <span class="badge badge-lg badge-warning">{{$status}}</span>
                            @else
                              <span class="badge badge-lg badge-dark text-white">{{$status}}</span>
                            @endif


                          </td>


                          <td>
                            

                            @if($driver->Po_id == '') 
                              <?php $connect = 'no' ?>
                              <?php $nopol_connect = '' ?>
                              @foreach($pos as $po)
                                @foreach($history_drivers as $history_driver)
                                  @if($history_driver->Driver_id == $driver->id && $history_driver->Po_id == $po->id)
                                    @if($history_driver->tgl_selesai > $currentDate)
                                      {{$po->NoPo}} 
                                      <a class="btn btn-warning btn-sm" href="{{url('/backend/po/show/'.$po->id)}}">
                                          <i class="fas fa-eye">
                                          </i>
                                          &nbspView
                                      </a>
                                      <?php $connect = 'yes' ?>
                                      <?php $nopol_connect = $po->Nopol; ?>
                                    @endif
                                  @endif
                                @endforeach
                              @endforeach

                              @if($connect == 'no')
                                <a class="btn btn-info btn-sm" href="{{url('/backend/driver/connect/'.$driver->id)}}">
                                    <i class="fas fa-check">
                                    </i>
                                    Connect to PO
                                </a>
                              @endif 

                            @else
                              @foreach($pos as $po)
                                @if($driver->Po_id == $po->id)
                                  {{$po->NoPo}} 
                                  <a class="btn btn-warning btn-sm" href="{{url('/backend/po/show/'.$po->id)}}">
                                      <i class="fas fa-eye">
                                      </i>
                                      &nbspView
                                  </a>
                                @endif
                              @endforeach
                              &nbsp

                            @endif
                          </td>

                          <td>
                            @if($driver->Po_id == '')
                              @if($connect == 'yes')
                                {{$nopol_connect}}
                              @else
                              -
                              @endif
                            @else
                              @foreach($pos as $po)
                                @if($driver->Po_id == $po->id)
                                  {{$po->Nopol}}
                                @endif
                              @endforeach
                            @endif
                          </td>

                          <td>
                            <a class="btn btn-outline-warning btn-sm" href="{{url('/backend/driver/history/'.$driver->id)}}">
                                  <i class="fas fa-clock"></i>
                                  History
                              </a>
                          </td>

                          <td class="text-center"><a class="btn btn-warning btn-sm" href="{{url('/backend/driver/pkwt/'.$driver->id)}}">
                                  <i class="fas fa-pencil-alt"></i>
                                  PKWT
                              </a>
                          </td>

                          <td>
                            @if($driver->created_at != '')
                              {{ date('l, d-M-Y', strtotime($driver->created_at))}}
                            @else
                              
                            @endif
                          </td>
                
                          <td class="project-actions text-center">

                              <a class="btn btn-success btn-sm" href="{{url('/backend/driver/edit/'.$driver->id)}}">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                  
                              </a>
                              @if($driver->Po_id == '')
                              <a class="btn btn-danger btn-sm" href="{{url('/backend/driver/delete/'.$driver->id)}}">
                                  <i class="fas fa-trash">
                                  </i>
                                  
                              </a>
                              @else
                              <a class="btn btn-danger btn-sm disabled" href="{{url('/backend/driver/delete/'.$driver->id)}}">
                                  <i class="fas fa-trash">
                                  </i>
                                  
                              </a>
                              @endif
                          </td>
                  
                          <?php $i++; ?>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="table-responsive">
                
                  <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light" style="height: 70px">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Driver</th>
                        <th scope="col">Nama Vendor</th>
                        <th scope="col" style="min-width: 50%">PKWT</th>
                        <th scope="col" style="min-width: 50%">Action</th>

                      </tr>
                    </thead>
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></th>
                            <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $i = 1;
                        ?>
                        @foreach($drivers as $driver)
                        @if($driver->active == '1')
                        <tr role="row" class="odd">
                          <td>{{$i}}</td>

                          <td>
                                  {{$driver->nik}}</a>
                          </td>
                          <td>
                                  {{$driver->nip}}</a>
                          </td>
                          <td>
                                  {{$driver->NamaDriver}}</a>
                          </td>

                          <td>
                            {{$driver->vendor_id}}
                          </td>

                          

                          <td class="text-center"><a class="btn btn-warning btn-sm" href="{{url('/backend/driver/pkwt/'.$driver->id)}}">
                                  <i class="fas fa-pencil-alt"></i>
                                  Lihat PKWT
                              </a>
                          </td>
                
                          <td class="project-actions text-center">
                              
                              <a class="btn btn-info btn-sm" href="{{url('/backend/driver/delete/'.$driver->id)}}">
                                  <i class="fas fa-undo">
                                  </i>
                                  Restore
                              </a>
                          </td>
                  
                          <?php $i++; ?>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                  </table>
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
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@include('driver.add');

@endsection

 






