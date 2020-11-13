<?php $page = "Report";
      $page2 = "PKWT" ?>
@extends('sidebar')

@section('content')

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-8 col-8">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page2}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-4">
              <div class="dropdown float-right">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if($page2 == 'Driver')
                      Purchase order
                    @else
                      PKWT
                    @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/report/driver')}}">Pucrchase order</a>
                    <a class="dropdown-item" href="{{url('/backend/report/pkwt')}}">PKWT</a>
                  </div>
                </div>
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
                <div class="row">
                  <div class="col-md-9">
                    <div class="dropdown">
                      <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$driver}}
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('/backend/report/pkwt')}}">All</a>
                        @foreach($ss as $s)
                          <a class="dropdown-item" href="{{url('/backend/report/pkwt/'.$s->NamaDriver)}}">{{$s->NamaDriver}}</a>
                        @endforeach
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <a href="{{url('/backend/export/pkwt')}}" class="btn btn-success float-right pull-right">
                      <i class="fa fa-file-excel"></i> &nbspExport to excel
                    </a>
                  </div>
                </div>
              </div>


                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                     <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col" rowspan="2">No</th>
                          <th scope="col" rowspan="2">Nama Driver</th>
                          <th scope="col" rowspan="2">nip</th>
                          <th scope="col" rowspan="2">nik</th>
                          <th scope="col" rowspan="2">Vendor</th>
                          <th scope="col" rowspan="2">Tanggal Masuk</th>
                          <th scope="col" colspan="2" class="bg-primary text-white">PKWT</th>
                          <th scope="col" rowspan="2">Durasi Jeda</th>
                          <th scope="col" rowspan="2">Periode Jeda</th>
                          <th scope="col" rowspan="2">Keterangan</th>
                        </tr>
                        <tr>
                        <th scope="col" class="bg-primary text-white">PKWT 1</th>
                        <th scope="col" class="bg-primary text-white">PKWT 2</th>
                      </tr>
                      </thead>
                      <tbody>
                            <?php $i=1; ?>
                            @foreach($r_pkwts as $pkwt)
                              @if($pkwt->active != '1')
                              <tr role="row" class="odd">
                                <td>{{$i}}</td>
                                <td>
                                    {{$pkwt->NamaDriver}}
                                </td>
                                <td>{{$pkwt->nip}}</td>
                                <td>{{$pkwt->nik}}</td>
                                <td>{{$pkwt->NamaVendor}}</td>
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
                                
                                <!-- <td>
                                  <a class="btn btn-success btn-sm" href="{{url('/backend/driver/pkwt1/edit/'.$pkwt->id)}}">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      
                                  </a>
                                  <a class="btn btn-danger btn-sm" href="{{url('/backend/pkwt/delete/'.$pkwt->id)}}">
                                      <i class="fas fa-trash">
                                      </i>
                                      
                                  </a>
                                </td> -->
                                  
                              </tr>
                              <?php $i++; ?>
                            @endif
                          @endforeach
                      </tbody>
                    </table>
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



@endsection

















