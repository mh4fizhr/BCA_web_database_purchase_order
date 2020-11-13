<?php $page = "Report";
      $page2 = "Service" ?>
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
                        <a class="dropdown-item" href="{{url('/backend/report/service')}}">All</a>
                        @foreach($ss as $s)
                          <a class="dropdown-item" href="{{url('/backend/report/service/'.$s->periode)}}">{{$s->periode}}</a>
                        @endforeach
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <!-- <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true" style="font-size: 11px">Active</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false" style="font-size: 11px">Deactive</a>
                      </li>
                    </ul> -->
                    <a href="{{url('/backend/export/service')}}" class="btn btn-success float-right pull-right">
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
                          <th scope="col" class="bg-primary text-white">Tanggal Service</th>
                          <th scope="col" class="bg-primary text-white">KM (Rp)</th>
                          <th scope="col" class="bg-primary text-white">Keterangan</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                            @foreach($r_services as $service)
                            @if($service->active != '1')
                            <tr role="row" class="odd">
                              <td>{{$i}}</td>
                              <td>{{$service->periode}}</td>
                              <td>{{$service->Nopo}}</td>
                              <td>{{$service->Sewa}}</td>
                              <td>{{$service->CP}}</td>
                              <td>{{$service->MerekMobil}} - {{$service->Type}}</td>
                              <td>{{$service->Nopol}}</td>
                              <td>{{$service->NamaVendor}}</td>
                              <td>{{$service->KodeCabang}} - {{$service->NamaCabang}}</td>
                              <td>{{$service->Kota}}</td>
                              <td>{{$service->NamaDriver}}</td>
                              <td>{{$service->nip}}</td>
                              <td >
                                    @if($service->TglService != '')
                                      {{ date('d-M-Y', strtotime($service->TglService))}}
                                    @else
                                      
                                    @endif
                              </td>
                              <td >
                                    @if($service->km == '')
                                    @else
                                      @currency($service->km)
                                    @endif 
                              </td>
                              <td >
                                    {{$service->Keterangan}}
                              </td>
                              <td>
                                <a class="btn btn-success btn-sm" href="{{url('/backend/report/service/edit/'.$service->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    
                                </a>
                                <!-- <a class="btn btn-danger btn-sm" href="{{url('/backend/report/service/delete_report/'.$service->id)}}">
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


                <div class="tab-pane fade " id="tabs-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <!-- <div class="table-responsive">
                    
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Periode</th>
                          <th scope="col">No PO</th>
                          <th scope="col">Tanggal Service</th>
                          <th scope="col">KM (Rp)</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                          @foreach($services as $service)
                          @if($service->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td >
                                {{$service->periode}}
                            </td>
                            <td>
                                @foreach($pos as $po)
                                  @if($service->po_id == $po->id)
                                    {{$po->NoPo}}
                                  @endif
                                @endforeach
                            </td>   
                            <td >
                                  @if($service->TglService != '')
                                    {{ date('d-M-Y', strtotime($service->TglService))}}
                                  @else
                                    
                                  @endif
                            </td>
                            <td >
                                  @if($service->km == '')
                                  @else
                                    @currency($service->km)
                                  @endif 
                            </td>
                            <td >
                                  {{$service->Keterangan}}
                            </td>
                            <td><a class="btn btn-info btn-sm" href="{{url('/backend/report/service/delete/'.$service->id)}}">
                                  <i class="fas fa-undo">
                                  </i>
                                  Restore
                              </a></td>
                          </tr>
                          <?php $i++; ?>
                          @endif
                          @endforeach
                      </tbody>
                    </table>
                  </div> -->
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

















