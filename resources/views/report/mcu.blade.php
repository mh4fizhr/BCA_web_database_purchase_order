<?php $page = "Report";
      $page2 = "MCU" ?>
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
                        {{$tahun}}
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('/backend/report/salon')}}">All</a>
                        @foreach($ss as $s)
                          <a class="dropdown-item" href="{{url('/backend/report/salon/'.$s->periode)}}">{{$s->periode}}</a>
                        @endforeach
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <a href="{{url('/backend/export/mcu')}}" class="btn btn-success float-right pull-right">
                      <i class="fa fa-file-excel"></i> &nbspExport to excel
                    </a>
                  </div>
                </div>
              </div>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" class="bg-primary text-white">Periode</th>
                          <th scope="col"><b>No PO</b></th>
                          <th scope="col"><b>Jenis Sewa</b></th>
                          <th scope="col"><b>CP/D</b></th>
                          <th scope="col"><b>Merek & Type</b></th>
                          <th scope="col"><b>Nopol</b></th>
                          <th scope="col"><b>Vendor</b></th>
                          <th scope="col"><b>Cabang</b></th>
                          <th scope="col"><b>Kota</b></th>
                          <th scope="col"><b>Nama Driver</b></th>
                          <th scope="col"><b>NIP</b></th>                          
                          <th scope="col" class="bg-primary text-white">Medical Check Up</th>
                          <th scope="col" class="bg-primary text-white">Seragam 3 Set</th>
                          <th scope="col" class="bg-primary text-white">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                          @foreach($r_mcus as $mcu)
                          @if($mcu->active != '1')
                        <tr role="row" class="odd text-center">
                          <td>{{$i}}</td>
                          <td>{{$mcu->periode}}</td>
                          <td>{{$mcu->Nopo}}</td>
                          <td>{{$mcu->Sewa}}</td>
                          <td>{{$mcu->CP}}</td>
                          <td>{{$mcu->MerekMobil}} - {{$mcu->Type}}</td>
                          <td>{{$mcu->Nopol}}</td>
                          <td>{{$mcu->NamaVendor}}</td>
                          <td>{{$mcu->KodeCabang}} - {{$mcu->NamaCabang}}</td>
                          <td>{{$mcu->Kota}}</td>
                          <td>{{$mcu->NamaDriver}}</td>
                          <td>{{$mcu->nip}}</td>
                          <td >
                              @if($mcu->mcu != '')
                                {{ date('d-M-Y', strtotime($mcu->mcu))}}
                              @else
                                
                              @endif
                          </td>
                          <td >                                
                              @if($mcu->Seragam != '')
                                {{ date('d-M-Y', strtotime($mcu->Seragam))}}
                              @else
                                
                              @endif
                          </td>
                          <td >
                                @if($mcu->mcu != null && $mcu->Seragam != null)
                                <span class="badge badge-sm badge-success">Complete</span>
                                @else
                                <span class="badge badge-sm badge-warning">Un Complete</span>
                                @endif
                                
                          </td>
                          <td>
                            <a class="btn btn-success btn-sm" href="{{url('/backend/report/mcu/edit/'.$mcu->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </a>
                            <!-- <a class="btn btn-danger btn-sm" href="{{url('/backend/report/mcu/delete/'.$mcu->id)}}">
                                <i class="fas fa-trash">
                                </i>
                                
                            </a> -->
                          </td>
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

















