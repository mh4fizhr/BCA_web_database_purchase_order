<?php $page = "Report";
      $page2 = "Database" ?>
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
                        {{$database}}
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('/backend/report/driver')}}">All</a>
                        @foreach($ss as $s)
                          <a class="dropdown-item" href="{{url('/backend/report/driver/'.$s->NamaDriver)}}">{{$s->NamaDriver}}</a>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <a href="{{url('/backend/export/database')}}" class="btn btn-success float-right pull-right">
                      <i class="fa fa-file-excel"></i> &nbspExport to excel
                    </a>
                  </div>
                </div>
              </div>


                  <div class="">
                    <!-- Projects table -->
                    <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                     <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col"><b>po id</b></th>
                          <th scope="col"><b>No. PO</b></th>
                          <th scope="col"><b>Jenis Sewa</b></th>
                          <th scope="col"><b>CP/D</b></th>
                          <th scope="col"><b>Kode Cabang</b></th>
                          <th scope="col"><b>Nama Cabang</b></th>
                          <th scope="col"><b>Inisial</b></th>
                          <th scope="col"><b>Status</b></th>
                          <th scope="col"><b>Cabut</b></th>
                          <th scope="col"><b>Kanwil</b></th>
                          <th scope="col"><b>Kota</b></th>
                          <th scope="col"><b>Merek & type</b></th>
                          <th scope="col"><b>Tahun</b></th>
                          <th scope="col"><b>Nopol</b></th>
                          <th scope="col"><b>Vendor</b></th>
                          <th scope="col"><b>Nama Driver</b></th>
                          <th scope="col"><b>NIK</b></th>
                          <th scope="col"><b>NIP</b></th>
                          <th scope="col"><b>Mulai Sewa</b></th>
                          <th scope="col"><b>Tgl bastk</b></th>
                          <th scope="col"><b>Tgl bastd</b></th>
                          <th scope="col"><b>Tgl relokasi</b></th>
                          <th scope="col"><b>Tgl cutoff</b></th>
                          <th scope="col"><b>Tgl selesai</b></th>
                          <th scope="col"><b>H.S.Mobil</b></th>
                          <th scope="col"><b>H.S.Driver</b></th>
                          <th scope="col"><b>H.S.Mobil + Driver</b></th>
                          <th scope="col"><b>User pengguna</b></th>
                          <th scope="col"><b>No register</b></th>
                          <!-- <th scope="col">Action</th> -->
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
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                            @foreach($r_databases as $database)
                            @if($database->active != '1')
                            <tr role="row" class="odd">
                              <td>{{$i}}</td>
                              <td>{{$database->po_id}}</td>
                              <td>{{$database->Nopo}}</td>
                              <td>{{$database->Sewa}}</td>
                              <td>{{$database->CP}}</td>
                              <td>{{$database->KodeCabang}}</td>
                              <td>{{$database->NamaCabang}}</td>
                              <td>{{$database->InisialCabang}}</td>
                              <td>{{$database->StatusCabang}}</td>
                              <td>{{$database->CabangUtama}}</td>
                              <td>{{$database->KWL}}</td>
                              <td>{{$database->Kota}}</td>
                              <td>{{$database->MerekMobil}} {{$database->Type}}</td>
                              <td>{{$database->Tahun}}</td>
                              <td>{{$database->Nopol}}</td>
                              <td>{{$database->NamaVendor}}</td>
                              <td>{{$database->NamaDriver}}</td>
                              <td>{{$database->nip}}</td>
                              <td>{{$database->nik}}</td>
                              <td>
                                @if($database->MulaiSewa != '')
                                  {{ date('d-M-Y', strtotime($database->MulaiSewa))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($database->Tgl_bastk != '')
                                  {{ date('d-M-Y', strtotime($database->Tgl_bastk))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($database->Tgl_bastd != '')
                                  {{ date('d-M-Y', strtotime($database->Tgl_bastd))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($database->Tgl_relokasi != '')
                                  {{ date('d-M-Y', strtotime($database->Tgl_relokasi))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($database->Tgl_cutoff != '')
                                  {{ date('d-M-Y', strtotime($database->Tgl_cutoff))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($database->SelesaiSewa != '')
                                  {{ date('d-M-Y', strtotime($database->SelesaiSewa))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>@currency($database->Hargasewamobil)</td>
                              <td>@currency($database->Hargasewadriver)</td>
                              <td>@currency($database->Hargasewamobildriver)</td>
                              <td>{{$database->UserPengguna}}</td>
                              <td>{{$database->No_register}}</td>

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



