<?php $page = "Report";
      $page2 = "Salon" ?>
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
                    <a href="{{url('/backend/export/salon')}}" class="btn btn-success float-right pull-right">
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
                          <th scope="col" class="bg-primary text-white">Salon 1</th>
                          <th scope="col" class="bg-primary text-white">Salon 2</th>
                          <th scope="col" class="bg-primary text-white">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                            @foreach($r_salons as $salon)
                            @if($salon->active != '1')
                            <tr role="row" class="odd">
                              <td>{{$i}}</td>
                              <td>{{$salon->periode}}</td>
                              <td>{{$salon->Nopo}}</td>
                              <td>{{$salon->Sewa}}</td>
                              <td>{{$salon->CP}}</td>
                              <td>{{$salon->MerekMobil}} - {{$salon->Type}}</td>
                              <td>{{$salon->Nopol}}</td>
                              <td>{{$salon->NamaVendor}}</td>
                              <td>{{$salon->KodeCabang}} - {{$salon->NamaCabang}}</td>
                              <td>{{$salon->Kota}}</td>
                              <td>{{$salon->NamaDriver}}</td>
                              <td>{{$salon->nip}}</td>
                              <td>
                                    @if($salon->Salon1 != '')
                                      {{ date('d-M-Y', strtotime($salon->Salon1))}}
                                    @else
                                      
                                    @endif
                              </td>
                              <td >
                                    @if($salon->Salon2 != '')
                                      {{ date('d-M-Y', strtotime($salon->Salon2))}}
                                    @else
                                      
                                    @endif
                              </td>
                              <td >
                                    @if($salon->Salon1 != null && $salon->Salon2 != null)
                                    <span class="badge badge-sm badge-success">Complete</span>
                                    @else
                                    <span class="badge badge-sm badge-warning">Un Complete</span>
                                    @endif
                              </td>
                              <td>
                                <a class="btn btn-success btn-sm" href="{{url('/backend/report/salon/edit/'.$salon->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    
                                </a>
                                <!-- <a class="btn btn-danger btn-sm" href="{{url('/backend/report/salon/delete_report/'.$salon->id)}}">
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

















