<?php 
$page = "db_report"; 
$page2 = "Report database"; 
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
                <!-- <li class="nav-item">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add {{$page2}}</button>
                </li> -->
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
                
              </div>
              

                  <div class="table-responsive">
                    <form action="{{url('backend/admin/report_database/delete')}}" method="post" role="form">
                        {{ csrf_field() }}
                  <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
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
                        <th scope="col"><b>No register</b></th>
                        <th scope="col" width="10px">
                          <button class="btn btn-icon btn-sm btn-dark mr-2" type="submit">
                            <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete permanent</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $i = 1;
                        ?>
                        @foreach($report_databases as $report_database)
                        @if($report_database->active != '1')
                          <tr role="row" class="odd">
                        @else
                          <tr role="row" class="odd bg-danger text-white">
                        @endif
                          <td>{{$i}}</td>
                              <td>{{$report_database->po_id}}</td>
                              <td>{{$report_database->Nopo}}</td>
                              <td>{{$report_database->Sewa}}</td>
                              <td>{{$report_database->CP}}</td>
                              <td>{{$report_database->KodeCabang}}</td>
                              <td>{{$report_database->NamaCabang}}</td>
                              <td>{{$report_database->InisialCabang}}</td>
                              <td>{{$report_database->StatusCabang}}</td>
                              <td>{{$report_database->CabangUtama}}</td>
                              <td>{{$report_database->KWL}}</td>
                              <td>{{$report_database->Kota}}</td>
                              <td>{{$report_database->MerekMobil}} {{$report_database->Type}}</td>
                              <td>{{$report_database->Tahun}}</td>
                              <td>{{$report_database->Nopol}}</td>
                              <td>{{$report_database->NamaVendor}}</td>
                              <td>{{$report_database->NamaDriver}}</td>
                              <td>{{$report_database->nip}}</td>
                              <td>{{$report_database->nik}}</td>
                              <td>
                                @if($report_database->MulaiSewa != '')
                                  {{ date('d-M-Y', strtotime($report_database->MulaiSewa))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($report_database->Tgl_bastk != '')
                                  {{ date('d-M-Y', strtotime($report_database->Tgl_bastk))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($report_database->Tgl_bastd != '')
                                  {{ date('d-M-Y', strtotime($report_database->Tgl_bastd))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($report_database->Tgl_relokasi != '')
                                  {{ date('d-M-Y', strtotime($report_database->Tgl_relokasi))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($report_database->Tgl_cutoff != '')
                                  {{ date('d-M-Y', strtotime($report_database->Tgl_cutoff))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>
                                @if($report_database->SelesaiSewa != '')
                                  {{ date('d-M-Y', strtotime($report_database->SelesaiSewa))}}
                                @else
                                  -
                                @endif
                              </td>

                              <td>@currency($report_database->Hargasewamobil)</td>
                              <td>@currency($report_database->Hargasewadriver)</td>
                              <td>@currency($report_database->Hargasewamobildriver)</td>
                              <td>{{$report_database->No_register}}</td>

                          <td>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="report_database[]" id="customCheck{{$i}}" value="{{$report_database->id}}">
                                <label class="custom-control-label" for="customCheck{{$i}}"></label>
                              </div>
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



@endsection

















