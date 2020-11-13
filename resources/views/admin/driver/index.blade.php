<?php 
$page = "db_driver"; 
$page2 = "Driver"; 
?>
@extends('sidebar')

@section('content')

<?php
    $currentDateTime = date('Y-m-d H:i:s');
?>

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
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
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add {{$page2}}</button>
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-database"></li> &nbspDatabase {{$page2}}</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                        <?php $status = ''; ?>
                      @elseif($s == 'deactive')
                        Deactive
                        <?php $status = 1; ?>
                      @else
                        All
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/admin/driver')}}">All</a>
                    <a class="dropdown-item" href="{{url('/backend/admin/driver/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/admin/driver/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              

                  <div class="table-responsive">
                    <form action="{{url('backend/admin/driver/delete')}}" method="post" role="form">
                        {{ csrf_field() }}
                  <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light" style="height: 70px">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Driver</th>
                        <th scope="col">Nama Vendor</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Action</th>
                        <th scope="col" width="10px">
                          <button class="btn btn-icon btn-sm btn-dark mr-2" type="submit">
                            <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete permanent</span>
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
                            <th>
                              <select class="form-control form-control-sm" style="min-width:100px">
                                  <option value="">All</option>
                                  <option value="active">Active</option>
                                  <option value="non active">Non Active</option>
                              </select>
                            </th>
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
                      <?php 
                          $i = 1;
                        ?>
                        @foreach($drivers as $driver)
                        @if($driver->active != '1')
                          <tr role="row" class="odd">
                        @else
                          <tr role="row" class="odd bg-danger text-white">
                        @endif
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

                            @if($status == 'Active')
                              <span class="badge badge-lg badge-default">{{$status}}</span>
                            @else
                              <span class="badge badge-lg badge-dark text-white">{{$status}}</span>
                            @endif
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
                          </td>

                          <td>
                              @if($driver->Po_id == '')
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="driver[]" id="customCheck{{$i}}" value="{{$driver->id}}">
                                <label class="custom-control-label" for="customCheck{{$i}}"></label>
                              </div>
                              @else
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="driver[]" id="customCheck{{$i}}" value="{{$driver->id}}" disabled>
                                <label class="custom-control-label" for="customCheck{{$i}}"></label>
                              </div>
                              @endif
                          </td>
                  
                          <?php $i++; ?>
                        </tr>
                        
                        @endforeach
                    </tbody>
                  </table>
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

            

</script>

@include('driver.add');

@endsection

















