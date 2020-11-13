<?php 
$page = "db_driver"; 
$page2 = "PKWT"; 
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
              <!-- <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                <li class="nav-item">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add {{$page2}}</button>
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-database"></li> &nbspDatabase {{$page2}}</h3>
                <!-- <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/mobil/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/mobil/deactive')}}">Deactive</a>
                  </div>
                </div> -->
              </div>
              

                  <div class="table-responsive">
                  <form action="{{url('backend/admin/pkwt/delete')}}" method="post" role="form">
                        {{ csrf_field() }}
                  <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
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
                        <th scope="col" rowspan="2" width="10px">
                          <button class="btn btn-icon btn-sm btn-dark mr-2" type="submit">
                            <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete permanent</span>
                          </button>
                        </th>
                      </tr>
                      <tr>
                        <th scope="col">PKWT 1</th>
                        <th scope="col">PKWT 2</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                      @foreach($pkwts as $pkwt)
                        @if($pkwt->active != '1')
                          <tr role="row" class="odd">
                        @else
                          <tr role="row" class="odd bg-danger text-white">
                        @endif
                          <td>{{$i}}</td>
                          <td>
                              @foreach($drivers as $driver)
                                @if($pkwt->driver_id == $driver->id)
                                  {{$driver->NamaDriver}}
                                @endif
                              @endforeach
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
                          </td>
                          <td>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" name="pkwt[]" id="customCheck{{$i}}" value="{{$pkwt->id}}">
                              <label class="custom-control-label" for="customCheck{{$i}}"></label>
                            </div>
                          </td>                  
                        </tr>
                        <?php $i++; ?>
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


@endsection

















