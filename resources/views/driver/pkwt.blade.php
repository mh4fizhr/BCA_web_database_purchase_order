<?php $page = "Driver"; ?>
@extends('sidebar')

@section('content')

<div class="header bg-primary pb-7">
      <div class="container-fluid">
        <div class="header-body pt-5">
          <div class="row align-items-center pl-4 pb-6">
            <div class="col-lg-6 col-7">
              <h6 class="display-3 text-white d-inline-block mb-0">{{$page}} Table</h6>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                <li class="nav-item">
                  <form action="{{url('/backend/driver/pkwt/create/'.$drivers->id)}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="driver_id" value="{{$drivers->id}}">
                    @if($tm == '0')
                      <input type="hidden" name="tanggalmasuk" value="">
                    @else
                      <input type="hidden" name="tanggalmasuk" value="{{$pkwt_tgl_masuk->TanggalMasuk}}">
                    @endif
                    <a href="{{url('/backend/driver')}}" type="button" class="btn btn-default float-right pull-right mr-4">Back</a>
                    <button type="submit" class="btn btn-success  float-right pull-right mr-4"><i class="fas fa-plus"></i> Add PKWT</button>
                  </form>
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
    <div class="container-fluid mt--9">
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card m-4 pb-4">
              <div class="card-header border-0">
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-user-tie"></li> &nbspDatabase PKWT</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/driver/pkwt/'.$drivers->id.'/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/driver/pkwt/'.$drivers->id.'/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable" style="width: 100%">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col" rowspan="2">No</th>
                        <th scope="col" rowspan="2">Nama Driver</th>
                        <th scope="col" rowspan="2">Tanggal Masuk</th>
                        <th scope="col" colspan="2">PKWT</th>
                        <th scope="col" rowspan="2">Durasi Jeda</th>
                        <th scope="col" rowspan="2">Periode Jeda</th>
                        <th scope="col" rowspan="2">Keterangan</th>
                        <th scope="col" rowspan="2">Action</th>
                      </tr>
                      <tr>
                        <th scope="col">PKWT 1</th>
                        <th scope="col">PKWT 2</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                      @foreach($pkwts as $pkwt)
                        @if($pkwt->driver_id == $drivers->id && $pkwt->active != '1')
                        <tr role="row" class="odd">
                          <td>{{$i}}</td>
                          <td>
                              {{$pkwt->driver->NamaDriver}}
                          </td>
                          <td>
                              @if($pkwt->TanggalMasuk == '')
                              @else
                                {{ date('d-M-Y', strtotime($pkwt->TanggalMasuk))}} 
                              @endif
                                
                          </td>
                          <td>
                              @if($pkwt->pkwt1_start == '')
                              @else
                                {{ date('d-M-Y', strtotime($pkwt->pkwt1_start))}}
                              @endif

                                 &nbsp <span class="text-blue"> s/d </span> &nbsp

                              @if($pkwt->pkwt1_end == '')
                              @else
                                {{ date('d-M-Y', strtotime($pkwt->pkwt1_end))}} 
                              @endif
                          </td>
                          <td>
                                @if($pkwt->pkwt2_start == '')
                              @else
                                {{ date('d-M-Y', strtotime($pkwt->pkwt2_start))}}
                              @endif

                                 &nbsp <span class="text-blue"> s/d </span> &nbsp

                              @if($pkwt->pkwt2_end == '')
                              @else
                                {{ date('d-M-Y', strtotime($pkwt->pkwt2_end))}} 
                              @endif
                          </td>
                          <td>
                                {{$pkwt->DurasiJeda}}
                          </td>
                          <td>
                              @if($pkwt->PeriodeJeda_start == '')
                              @else
                                {{ date('d-M-Y', strtotime($pkwt->PeriodeJeda_start))}}
                              @endif

                                 &nbsp <span class="text-blue"> s/d </span> &nbsp

                              @if($pkwt->PeriodeJeda_end == '')
                              @else
                                {{ date('d-M-Y', strtotime($pkwt->PeriodeJeda_end))}} 
                              @endif                                  
                                 
                          </td>
                          <td>
                                {{$pkwt->Keterangan}}
                          </td>
                          
                          <td>
                            <a class="btn btn-success btn-sm" href="{{url('/backend/driver/pkwt1/edit/'.$pkwt->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </a>
                            <a class="btn btn-danger btn-sm" href="{{url('/backend/pkwt/delete/'.$pkwt->id)}}">
                                <i class="fas fa-trash">
                                </i>
                                
                            </a>
                          </td>
                            
                        </tr>
                        <?php $i++; ?>
                      @endif
                    @endforeach
                  </table>
                </div>
              @else
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable" style="width: 100%">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" rowspan="2">No</th>
                          <th scope="col" rowspan="2">Nama Driver</th>
                          <th scope="col" rowspan="2">Tanggal Masuk</th>
                          <th scope="col" colspan="2">PKWT</th>
                          <th scope="col" rowspan="2">Durasi Jeda</th>
                          <th scope="col" rowspan="2">Periode Jeda</th>
                          <th scope="col" rowspan="2">Keterangan</th>
                          
                          <th scope="col" rowspan="2">Action</th>
                     
                        </tr>
                        <tr>
                          <th scope="col">PKWT 1</th>
                          <th scope="col">PKWT 2</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; ?>
                        @foreach($pkwts as $pkwt)
                          @if($pkwt->driver_id == $drivers->id && $pkwt->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td>
                                {{$pkwt->driver->NamaDriver}}
                            </td>
                            <td>
                                @if($pkwt->TanggalMasuk == '')
                                @else
                                  {{ date('d-M-Y', strtotime($pkwt->TanggalMasuk))}} 
                                @endif
                                  
                            </td>
                            <td>
                                @if($pkwt->pkwt1_start == '')
                                @else
                                  {{ date('d-M-Y', strtotime($pkwt->pkwt1_start))}}
                                @endif

                                   &nbsp <span class="text-blue"> s/d </span> &nbsp

                                @if($pkwt->pkwt1_end == '')
                                @else
                                  {{ date('d-M-Y', strtotime($pkwt->pkwt1_end))}} 
                                @endif
                            </td>
                            <td>
                                  @if($pkwt->pkwt2_start == '')
                                @else
                                  {{ date('d-M-Y', strtotime($pkwt->pkwt2_start))}}
                                @endif

                                   &nbsp <span class="text-blue"> s/d </span> &nbsp

                                @if($pkwt->pkwt2_end == '')
                                @else
                                  {{ date('d-M-Y', strtotime($pkwt->pkwt2_end))}} 
                                @endif
                            </td>
                            <td>
                                  {{$pkwt->DurasiJeda}}
                            </td>
                            <td>
                                @if($pkwt->PeriodeJeda_start == '')
                                @else
                                  {{ date('d-M-Y', strtotime($pkwt->PeriodeJeda_start))}}
                                @endif

                                   &nbsp <span class="text-blue"> s/d </span> &nbsp

                                @if($pkwt->PeriodeJeda_end == '')
                                @else
                                  {{ date('d-M-Y', strtotime($pkwt->PeriodeJeda_end))}} 
                                @endif                                  
                                   
                            </td>
                            <td>
                                  {{$pkwt->Keterangan}}
                            </td>
                            
                            <td><a class="btn btn-info btn-sm" href="{{url('/backend/pkwt/delete/'.$pkwt->id)}}">
                                  <i class="fas fa-undo">
                                  </i>
                                  Restore
                              </a></td>
                              
                          </tr>
                          <?php $i++; ?>
                        @endif
                      @endforeach
                    </table>
                </div>
              @endif

              


              
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

@endsection
















