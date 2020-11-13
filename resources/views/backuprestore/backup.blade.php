<?php $page = "Backup"; ?>
@extends('sidebar')

@section('content')

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} Table</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-5">

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
          <div class="col-6">
            <div class="card card-pricing bg-gradient-success border-0 text-center mb-4">
              <div class="card-header bg-transparent">
                <h4 class="text-uppercase ls-1 text-white py-3 mb-0">Backup</h4>
              </div>
              <div class="card-body px-lg-7">
                <div class="display-2 text-white"><li class="ni ni-paper-diploma"></li></div>
                <span class=" text-white">Purchase Order</span>
                <ul class="list-unstyled my-4">
                  <li>
                    <div class="d-flex align-items-center">
                      <div>
                        <div class="icon icon-xs icon-shape bg-white shadow rounded-circle">
                          <i class="fas fa-check"></i>
                        </div>
                      </div>
                      <div>
                        <span class="pl-2 text-sm text-white">Complete documentation</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center">
                      <div>
                        <div class="icon icon-xs icon-shape bg-white shadow rounded-circle">
                          <i class="fas fa-check"></i>
                        </div>
                      </div>
                      <div>
                        <span class="pl-2 text-sm text-white">Working materials in Sketch</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center">
                      <div>
                        <div class="icon icon-xs icon-shape bg-white shadow rounded-circle">
                          <i class="fas fa-check"></i>
                        </div>
                      </div>
                      <div>
                        <span class="pl-2 text-sm text-white">2GB cloud storage</span>
                      </div>
                    </div>
                  </li>
                </ul>
                <a href="/backend/backup/export/po" class="btn btn-icon btn-primary mb-3"><i class="fas fa-download"></i> Backup</a>
              </div>
              <div class="card-footer bg-transparent">
                <a href="#!" class=" text-white">Request a demo</a>
              </div>
            </div>
          </div>




          <div class="col-6">
            <div class="card card-pricing border-0 text-center mb-4">
              <div class="card-header bg-transparent">
                <h4 class="text-uppercase ls-1 text-primary py-3 mb-0">Backup</h4>
              </div>
              <div class="card-body px-lg-7">
                <div class="display-2"><li class="fas fa-building"></li></div>
                <span class="">Cabang</span>
                <ul class="list-unstyled my-4">
                  <li>
                    <div class="d-flex align-items-center">
                      <div>
                        <div class="icon icon-xs icon-shape bg-gradient-primary text-white shadow rounded-circle">
                          <i class="fas fa-check"></i>
                        </div>
                      </div>
                      <div>
                        <span class="pl-2 text-sm">Table Kota</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center">
                      <div>
                        <div class="icon icon-xs icon-shape bg-gradient-primary text-white shadow rounded-circle">
                          <i class="fas fa-check"></i>
                        </div>
                      </div>
                      <div>
                        <span class="pl-2 text-sm">Table Cabang</span>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center">
                      <div>
                        <div class="icon icon-xs icon-shape bg-gradient-primary text-white shadow rounded-circle">
                          <i class="fas fa-check"></i>
                        </div>
                      </div>
                      <div>
                        <span class="pl-2 text-sm">2GB cloud storage</span>
                      </div>
                    </div>
                  </li>
                </ul>
                <a href="/backend/backup/export/cabang" class="btn btn-icon btn-primary mb-3"><i class="fas fa-download"></i> Backup</a>
              </div>
              <div class="card-footer">
                <a href="#!" class=" text-muted">Request a demo</a>
              </div>
            </div>
          </div>




          <div class="col-12">
            <div class="card pb-4">

              <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="tabs-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                  <div class="card-header border-0">
                    <div class="row align-items-center">
                      <div class="col">
                        <h3 class="mb-0 text-uppercase d-inline-block"><li class="ni ni-paper-diploma"></li> &nbspBackup data </h3>
                        <div class="dropdown float-right">
                        <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Tahun
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="/backend/dashboard">All</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="/backend/po/filter/status/active">2019</a>
                          <a class="dropdown-item" href="/backend/po/filter/status/notactive">2020</a>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <form action="{{url('/backend/mobil/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush table-hover text-center" id="">
                      <thead class="thead-light" style="height: 60px">
                        <tr>
                          <th scope="col"><b>Purchase Order</b></th>
                          <th scope="col"><b>Driver</b></th>
                          <th scope="col"><b>Cabang</b></th>
                          <th scope="col"><b>Mobil</b></th>
                          <th scope="col"><b>UMP</b></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>

                          <td>
                            <a href="/backend/backup/export/po" class="btn btn-icon btn-sm btn-primary mr-2"><i class="fas fa-download"></i> Backup</a>
                          </td>

                          <td>
                            <button class="btn btn-icon btn-sm btn-primary mr-2" type="submit">
                              <span class="btn-inner--icon"><i class="fas fa-download"></i> Backup</span>
                            </button>
                          </td>

                          <td>
                            <a href="/backend/backup/export/cabang" class="btn btn-icon btn-sm btn-primary mr-2"><i class="fas fa-download"></i> Backup</a>
                          </td>

                          <td>
                            <button class="btn btn-icon btn-sm btn-primary mr-2" type="submit">
                              <span class="btn-inner--icon"><i class="fas fa-download"></i> Backup</span>
                            </button>
                          </td>

                          <td>
                            <button class="btn btn-icon btn-sm btn-primary mr-2" type="submit">
                              <span class="btn-inner--icon"><i class="fas fa-download"></i> Backup</span>
                            </button>
                          </td>

                        </tr>
                      </tbody>
                    </table>
                  </div>
                </form>
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



<script>
$(document).ready(function(){

  $('#mySelect').on('change', function (e) {
    var $optionSelected = $("option:selected", this);
    $optionSelected.tab('show')
  });
  
});
   
</script>


@endsection

















