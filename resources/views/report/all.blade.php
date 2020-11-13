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
                
              </div>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col" style="min-width: 10%">No</th>
                          <th scope="col" class="bg-primary text-white" style="min-width: 30%">Kategori</th>
                          <th scope="col" style="min-width: 30%">Export</th>
                          <th scope="col" style="min-width: 30%">Import</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row" class="odd text-center">
                          <td>1</td>
                          <td>Database</td>
                          
                          <td>
                            <a href="{{url('/backend/export/database')}}" class="btn btn-success ">
                                <i class="fa fa-file-excel"></i> &nbspExport to excel : {{$po}} rows 
                            </a>
                          </td>
                          <td></td>
                        </tr>
                        <tr role="row" class="odd text-center">
                          <td>2</td>
                          <td>Salon</td>
                          
                          <td>
                            <a href="{{url('/backend/export/salon')}}" class="btn btn-success ">
                                <i class="fa fa-file-excel"></i> &nbspExport to excel : {{$salon}} rows
                            </a>
                          </td>
                          <td>
                            <form method="post" action="{{url('/backend/po/import_excel/salon')}}" enctype="multipart/form-data">
                              {{ csrf_field() }}
                                <input type="file" name="file" class="ml-5 mt-4 mb-4">
                                <button type="submit" class="btn btn-white ml-auto">Submit</button>
                            </form>
                          </td>
                        </tr>
                        <tr role="row" class="odd text-center">
                          <td>3</td>
                          <td>Service</td>
                          
                          <td>
                            <a href="{{url('/backend/export/service')}}" class="btn btn-success ">
                                <i class="fa fa-file-excel"></i> &nbspExport to excel : {{$service}} rows
                            </a>
                          </td>
                          <td>
                            <form method="post" action="{{url('/backend/po/import_excel/service')}}" enctype="multipart/form-data">
                              {{ csrf_field() }}
                                <input type="file" name="file" class="ml-5 mt-4 mb-4">
                                <button type="submit" class="btn btn-white ml-auto">Submit</button>
                            </form>
                          </td>
                        </tr>
                        <tr role="row" class="odd text-center">
                          <td>4</td>
                          <td>MCU</td>
                          
                          <td>
                            <a href="{{url('/backend/export/mcu')}}" class="btn btn-success ">
                                <i class="fa fa-file-excel"></i> &nbspExport to excel : {{$mcu}} rows
                            </a>
                          </td>
                          <td>
                            <form method="post" action="{{url('/backend/po/import_excel/mcu')}}" enctype="multipart/form-data">
                              {{ csrf_field() }}
                                <input type="file" name="file" class="ml-5 mt-4 mb-4">
                                <button type="submit" class="btn btn-white ml-auto">Submit</button>
                            </form>
                          </td>
                        </tr>
                        <!-- <tr role="row" class="odd text-center">
                          <td>5</td>
                          <td>Driver</td>
                          <td>
                            <a href="{{url('/backend/export/driver')}}" class="btn btn-success ">
                                <i class="fa fa-file-excel"></i> &nbspExport to excel : {{$driver}} rows
                            </a>
                          </td>
                          <td>
                            <form method="post" action="{{url('/backend/po/import_excel/driver')}}" enctype="multipart/form-data">
                              {{ csrf_field() }}
                                <input type="file" name="file" class="ml-5 mt-4 mb-4">
                                <button type="submit" class="btn btn-white ml-auto">Submit</button>
                            </form>
                          </td>
                        </tr> -->
                        <tr role="row" class="odd text-center">
                          <td>5</td>
                          <td>Pkwt</td>
                          
                          <td>
                            <a href="{{url('/backend/export/pkwt')}}" class="btn btn-success ">
                                <i class="fa fa-file-excel"></i> &nbspExport to excel : {{$pkwt}} rows
                            </a>
                          </td>
                          <td>
                            <form method="post" action="{{url('/backend/po/import_excel/pkwt')}}" enctype="multipart/form-data">
                              {{ csrf_field() }}
                                <input type="file" name="file" class="ml-5 mt-4 mb-4">
                                <button type="submit" class="btn btn-white ml-auto">Submit</button>
                            </form>
                          </td>
                        </tr>
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

















