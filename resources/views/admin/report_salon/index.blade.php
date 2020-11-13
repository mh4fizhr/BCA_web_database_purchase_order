<?php 
$page = "db_report"; 
$page2 = "Report salon"; 
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
                    <form action="{{url('backend/admin/report_salon/delete')}}" method="post" role="form">
                        {{ csrf_field() }}
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
                        @foreach($report_salons as $report_salon)
                        @if($report_salon->active != '1')
                          <tr role="row" class="odd">
                        @else
                          <tr role="row" class="odd bg-danger text-white">
                        @endif
                              <td>{{$i}}</td>
                              <td>{{$report_salon->periode}}</td>
                              <td>{{$report_salon->Nopo}}</td>
                              <td>{{$report_salon->Sewa}}</td>
                              <td>{{$report_salon->CP}}</td>
                              <td>{{$report_salon->MerekMobil}} - {{$report_salon->Type}}</td>
                              <td>{{$report_salon->Nopol}}</td>
                              <td>{{$report_salon->NamaVendor}}</td>
                              <td>{{$report_salon->KodeCabang}} - {{$report_salon->NamaCabang}}</td>
                              <td>{{$report_salon->Kota}}</td>
                              <td>{{$report_salon->NamaDriver}}</td>
                              <td>{{$report_salon->nip}}</td>
                              <td>
                                    @if($report_salon->Salon1 != '')
                                      {{ date('d-M-Y', strtotime($report_salon->Salon1))}}
                                    @else
                                      
                                    @endif
                              </td>
                              <td >
                                    @if($report_salon->Salon2 != '')
                                      {{ date('d-M-Y', strtotime($report_salon->Salon2))}}
                                    @else
                                      
                                    @endif
                              </td>
                              <td >
                                    @if($report_salon->Salon1 != null && $report_salon->Salon2 != null)
                                    <span class="badge badge-sm badge-success">Complete</span>
                                    @else
                                    <span class="badge badge-sm badge-warning">Un Complete</span>
                                    @endif
                              </td>

                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="report_salon[]" id="customCheck{{$i}}" value="{{$report_salon->id}}">
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

















