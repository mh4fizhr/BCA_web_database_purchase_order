<?php $page = "Dashboard"; ?>
@extends('sidebar')

@section('content')

<?php
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentDate = date('m/d/Y');
?>

  <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-5 col-5">
              <h6 class="h1 text-white d-inline-block mb-0">Database</h6>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Database</a></li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-7 col-7 text-right">
              <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-calendar-alt"></i> &nbsp filter date range
              </a>
<!--               <a href="/backend/po" class="btn btn-sm btn-neutral m-2" data-toggle="tooltip" data-placement="top" title="Lihat">PO</a>
              <a href="/backend/cabang" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Lihat">Cabang</a>
              <a href="/backend/driver" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Lihat">Driver</a>
              <a href="/backend/mobil" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Lihat">Mobil</a>
              <a href="/backend/vendor" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Lihat">Vendor</a>
              <a href="/backend/ump" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Lihat">UMP</a>
              <a href="/backend/service" class="btn btn-sm btn-neutral disabled" data-toggle="tooltip" data-placement="top" title="Lihat">Service</a>
              <button type="button" class="btn btn-sm btn-secondary">
                <span>Unread messages</span>
                <span class="badge badge-dark text-white">24</span>
              </button> -->
              <!-- <div class="nav-wrapper">
                  <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item ">
                          <a class="nav-link mb-sm-3 mb-md-0 " id="tabs-icons-text-1-tab" href="/backend/driver" style="font-size: 12px"><i class="fas fa-user mr-2"></i>Driver &nbsp <span class="badge badge-primary">
                          <?php $d = 0 ?>
                          @foreach($drivers as $driver)
                          <?php $d++; ?>
                          @endforeach
                          {{$d}}
                          </span></a>
                      </li>
                      <li class="nav-item ">
                          <a class="nav-link mb-sm-3 mb-md-0 " id="tabs-icons-text-1-tab" href="/backend/mobil" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true" style="font-size: 12px"><i class="fa fa-car mr-2"></i>Mobil &nbsp <span class="badge badge-primary">
                          <?php $m = 0 ?>
                          @foreach($mobils as $mobil)
                          <?php $m++; ?>
                          @endforeach
                          {{$m}}</span></a>
                      </li>
                      <li class="nav-item ">
                          <a class="nav-link mb-sm-3 mb-md-0 " id="tabs-icons-text-1-tab" href="/backend/vendor" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true" style="font-size: 12px"><i class="ni ni-building mr-2"></i>Vendor &nbsp <span class="badge badge-primary">
                          <?php $v = 0 ?>
                          @foreach($vendors as $vendor)
                          <?php $v++; ?>
                          @endforeach
                          {{$v}}</span></a>
                      </li>
                      <li class="nav-item ">
                          <a class="nav-link mb-sm-3 mb-md-0 " id="tabs-icons-text-1-tab" href="/backend/cabang" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true" style="font-size: 12px"><i class="fa fa-building mr-2"></i>Cabang &nbsp <span class="badge badge-primary">
                          <?php $c = 0 ?>
                          @foreach($cabangs as $cabang)
                          <?php $c++; ?>
                          @endforeach
                          {{$c}}</span></a>
                      </li>
                  </ul>
              </div> -->
            </div>
          </div>
          @include('dashboard.filter_date')
          <!-- Card stats -->

          <!-- <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title  text-muted mb-0">Jumlah Driver</h5>
                      <?php $d = 0 ?>
                      @foreach($drivers as $driver)
                      <?php $d++; ?>
                      @endforeach
                      <span class="h2 font-weight-bold mb-0">{{$d}} Driver</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="fa fa-user"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <a href="/backend/driver" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Click to see">Lihat Table Driver</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title  text-muted mb-0">Jumlah Mobil</h5>
                      <?php $m = 0 ?>
                      @foreach($mobils as $mobil)
                      <?php $m++; ?>
                      @endforeach
                      <span class="h2 font-weight-bold mb-0">{{$m}} Mobil</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="fa fa-car"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <a href="/backend/mobil" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Click to see">Lihat Table Mobil</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-muted mb-0">Jumlah Vendor</h5>
                      <?php $v = 0 ?>
                      @foreach($vendors as $vendor)
                      <?php $v++; ?>
                      @endforeach
                      <span class="h2 font-weight-bold mb-0">{{$v}} Vendor</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-building"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <a href="/backend/vendor" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Click to see">Lihat Table vendor</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-muted mb-0">Jumlah Cabang</h5>
                      <?php $c = 0 ?>
                      @foreach($cabangs as $cabang)
                      <?php $c++; ?>
                      @endforeach
                      <span class="h2 font-weight-bold mb-0">{{$c}} Cabang</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fas fa-building"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <a href="/backend/cabang" class="btn btn-sm btn-neutral" data-toggle="tooltip" data-placement="top" title="Click to see">Lihat Table Cabang</a>
                  </p>
                </div>
              </div>
            </div>
          </div> -->


        </div>
      </div>
    </div>


    <div class="container-fluid mt--6">
      <div class="content">
        <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0 text-uppercase d-inline-block"><li class="ni ni-paper-diploma"></li> &nbspPurchase Order : Active</h3>

                      <!-- <div class="row">
                        <div class="col-md-5">
                          <ul class="nav nav-pills nav-fill flex-column flex-sm-row " id="tabs-text" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true" style="font-size: 11px">ALL</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false" style="font-size: 11px">Penambahan</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false" style="font-size: 11px">Pengurangan</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false" style="font-size: 11px">Relokasi</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-md-5"></div>
                        <div class="col-md-2"></div>
                      </div> -->
                      


                      <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                          <li class="breadcrumb-item">
                            <select class="form-control form-control-sm form-control-alternative" id="mylist" onchange="myFunction()" name="nopol_filter" style="width: 120px">
                              <option value="">All</option>
                              <option value="Tanpa Unit">Tanpa Unit</option>
                            </select>
                          </li>
                          <li>
                            <select class="form-control form-control-sm form-control-alternative ml-4" id="mylist2" onchange="myFunction2()" name="status" style="width: 120px">
                              <option value="">All</option>
                              <option value="active">Active</option>
                              <option value="Not Active">Not Active</option>
                            </select>
                          </li>
                        </ol>
                      </nav> -->
                      
                      <div class="dropdown float-right">
                        <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Status
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="{{url('/backend/dashboard')}}">All</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{url('/backend/po/filter/status/active')}}">Active</a>
                          <a class="dropdown-item" href="{{url('/backend/po/filter/status/notactive')}}">Not Active</a>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col text-right">
                      <a href="/backend/po/table" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#filter" data-whatever="@getbootstrap"><i class="fas fa-filter"></i>&nbsp
                        Filter</a>
                    </div> -->
                  </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                      <div class=" table-hover mb-5">
                        <table id="myTable" class="table table-responsive align-items-center table-flush text-center mydatatable">
                          <thead class="thead-light" style="height: 70px">
                            <tr>
                              <th scope="col"><b>No</b></th>
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
                              <th scope="col"><b>User pengguna</b></th>
      <!--                         <th scope="col"><b>Mulai Sewa</b></th>
                              <th scope="col"><b>Tgl Bastk</b></th>
                              <th scope="col"><b>Tgl Bastd</b></th>
                              <th scope="col"><b>Tgl Relokasi</b></th>
                              <th scope="col"><b>Tgl Cut Off</b></th>
                              <th scope="col"><b>Selesai Sewa</b></th>
                              <th scope="col"><b>Harga Sewa Mobil(Rp)</b></th>
                              <th scope="col"><b>Harga Sewa Driver 2019(Rp)</b></th>
                              <th scope="col"><b>Harga Sewa Mobil + Driver(Rp)</b></th>
                              <th scope="col"><b>No Register</b></th> -->
                              <th scope="col"><b>Status</b></th>
                              <th scope="col"><b>Created at</b></th>
                              <th scope="col" style="min-width: 100%"><b>Action</th>
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
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                              </tr>
                          </thead>
                          <tbody>
                             <?php 
                            $i = 1;
                          ?>
                          @foreach($pos as $po)
                          @if($po->status == '1' && ($po->SelesaiSewa <= $currentDateTime || ($po->Tgl_cutoff != '' && $po->Tgl_cutoff <= $currentDateTime && $po->Sewa_sementara == 'null')))
                          @elseif($po->status == '0' || $po->status == '5')
                          @else
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>{{$po->Nopo_permanent}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                                    {{$po->Sewa_sementara}}
                                  @else
                                    {{$po->Sewa}}
                                  @endif
                                </td>
                                

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->   
                                
                                <td>{{$po->CP}}</td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>

                                  @if($po->Mobil_id == 'null')
                                    Tanpa Unit
                                  @elseif($po->Mobil_id == '')
                                    Tanpa Unit
                                  @else
                                    @foreach($mobils as $mobil)
                                      @if($po->Mobil_id == $mobil->id)
                                        {{$mobil->MerekMobil}} {{$mobil->Type}} 
                                      @endif
                                    @endforeach
                                  @endif

                                  
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>

                                  @if($po->Nopol == 'null')
                                    Tanpa Unit
                                  @elseif($po->Nopol == '')
                                    Tanpa Unit
                                  @else
                                    {{$po->Nopol}}
                                  @endif
       
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  @foreach($vendors as $vendor)
                                    @if($po->Vendor_Driver == $vendor->id)
                                      {{$vendor->NamaVendor}}
                                    @endif
                                  @endforeach
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                @if(empty($po->Cabang_relokasi))

                                  <td>
                                    @foreach($cabangs as$cabang)
                                      @if($po->Cabang_id == $cabang->id)
                                        {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                                      @endif
                                    @endforeach
                                  </td>
                                  <td> 
                                    @foreach($cabangs as$cabang)
                                      @if($po->Cabang_id == $cabang->id)
                                        {{$cabang->Kota}}
                                      @endif
                                    @endforeach
                                  </td>

                                @else

                                  @if($po->Efisien_relokasi <= $currentDateTime)

                                    <td>
                                      @foreach($cabangs as $cabang)
                                        @if($po->Cabang_relokasi == $cabang->id)
                                          {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                                        @endif
                                      @endforeach
                                    </td>
                                    <td> 
                                      @foreach($cabangs as $cabang)
                                        @if($po->Cabang_relokasi == $cabang->id)
                                          {{$cabang->Kota}}
                                        @endif
                                      @endforeach
                                    </td>

                                  @else

                                    <td>
                                      @foreach($cabangs as$cabang)
                                        @if($po->Cabang_id == $cabang->id)
                                          {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                                        @endif
                                      @endforeach
                                    </td>
                                    <td> 
                                      @foreach($cabangs as$cabang)
                                        @if($po->Cabang_id == $cabang->id)
                                          {{$cabang->Kota}}
                                        @endif
                                      @endforeach
                                    </td>

                                    @endif
                                  
                                @endif

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                  @if($po->Driver_id == '') 
                                    <?php $connect = 'no' ?>
                                    <?php $nopol_connect = '' ?>
                                    @foreach($drivers as $driver)
                                      @foreach($history_drivers as $history_driver)
                                        @if($history_driver->Driver_id == $driver->id && $history_driver->Po_id == $po->id)
                                          @if($history_driver->tgl_selesai > $currentDate)
                                            <td>{{$driver->NamaDriver}}</td>
                                            <td>{{$driver->nip}}</td> 
                                            <?php $connect = 'yes' ?>
                                            
                                          @endif
                                        @endif
                                      @endforeach
                                    @endforeach

                                    @if($connect == 'no')
                                      <td> - </td>
                                      <td> - </td>
                                    @endif 
                                  @else
                                    @foreach($drivers as $driver)
                                      @if($po->Driver_id == $driver->id)
                                        <td>{{$driver->NamaDriver}}</td>
                                        <td>{{$driver->nip}}</td> 
                                      @endif
                                    @endforeach
                                  @endif

                                
                                  <!-- @if($po->Driver_id == '')
                                    <td> - </td>
                                    <td> - </td>
                                  @else
                                    @foreach($drivers as $driver)
                                      @if($po->Driver_id == $driver->id)
                                        <td>{{$driver->NamaDriver}}</td>
                                        <td>{{$driver->nip}}</td> 
                                      @endif
                                    @endforeach
                                  @endif -->
                           
                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{$po->UserPengguna}}
                              </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' )
                                    @if($po->Sewa_sementara == 'null' || $po->SelesaiSewa <= $currentDateTime)
                                      <span class="badge badge-sm badge-danger">Not Active</span>
                                    @else
                                      <span class="badge badge-sm badge-success">Active</span>
                                    @endif
                                  @elseif($po->SelesaiSewa <= $currentDateTime)
                                    <span class="badge badge-sm badge-danger">Not Active</span>
                                  @else
                                    <span class="badge badge-sm badge-success">Active</span>
                                  @endif
                                </td>

                                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{date('m/d/Y', strtotime($po->created_at))}}
                              </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                    @if(auth::user()->status == 'admin')

                                    <a class="btn btn-info btn-sm" href="{{url('/backend/po/edit_dashboard/'.$po->id)}}" >
                                        <i class="fas fa-pencil-alt" >
                                        </i>
                                        
                                    </a>

                                    @endif
                                    <a class="btn btn-warning btn-sm" href="{{url('/backend/po/show/'.$po->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Lihat detail
                                    </a>
                                </td>

                                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <?php $i++; ?>
                          </tr>

              
                 
                          @endif
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    
                </div>

                
              </div>
            </div>
<!--             <div class="col-xl-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-0 "><li class="fas fa-clock"></li> &nbspHISTORY (on maintanance)</h3>
                    </div>
                    <div class="col-4 text-right">
                      <a href="#!" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lihat activity terakhir">See all</a>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">User</th>
                        <th scope="col">Status</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">
                          Hafizh
                        </th>
                        <td>
                          Admin
                        </td>
                        <td>
                          <span class="badge badge-lg badge-success">Add Mobil</span>
                        </td>
                        <td>
                          2020-09-21 12:15:24
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Hafizh
                        </th>
                        <td>
                          Admin
                        </td>
                        <td>
                          <span class="badge badge-lg badge-primary">Edit Purchase Order</span>
                        </td>
                        <td>
                          2020-09-21 12:15:24
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          Hafizh
                        </th>
                        <td>
                          Admin
                        </td>
                        <td>
                          <span class="badge badge-lg badge-danger">delete Vendor</span>
                        </td>
                        <td>
                          2020-09-21 12:15:24
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-0 "><li class="ni ni-settings"></li> &nbspON COMING TABLE</h3>
                    </div>
                    <div class="col-4 text-right">
                      <a href="#!" class="btn btn-sm btn-primary disabled" data-toggle="tooltip" data-placement="top" title="lihat activity terakhir">See all</a>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Unknown</th>
                        <th scope="col">Unknown</th>
                        <th scope="col">Unknown</th>
                        <th scope="col">Unknown</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">
                          -
                        </th>
                        <td>
                          -
                        </td>
                        <td>
                          <span>-</span>
                        </td>
                        <td>
                          -
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          -
                        </th>
                        <td>
                          -
                        </td>
                        <td>
                          <span >-</span>
                        </td>
                        <td>
                          -
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          -
                        </th>
                        <td>
                          -
                        </td>
                        <td>
                          <span>-</span>
                        </td>
                        <td>
                          -
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div> -->
          </div>

      </div>
    </div>

    
    <script>
    // $(document).ready(function() {
    //     $('#myTable').DataTable({
    //         initComplete: function() {
    //             this.api().columns().every(function() {
    //                 var column = this;
    //                 $(column.header()).append("<br><br>")
    //                 var select = $('<select><option value=""></option></select>')
    //                     .appendTo($(column.header()))
    //                     .on('change', function() {
    //                         var val = $.fn.dataTable.util.escapeRegex(
    //                             $(this).val()
    //                         );
    //                         column
    //                             .search(val ? '^' + val + '$' : '', true, false)
    //                             .draw();
    //                     });
    //                 column.data().unique().sort().each(function(d, j) {
    //                     select.append('<option value="' + d + '">' + d + '</option>')
    //                 });
    //             });
    //         },"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    //         language: {
    //            paginate: {
    //            next: '<i class="fas fa-angle-right">',
    //            previous: '<i class="fas fa-angle-left">'  
    //             }
    //          }
    //     });
    // });

    // $(document).ready(function() {
    //     var table = $('#myTable').DataTable();
     
    //     $("#myTable tfoot th").each( function ( i ) {
    //         var select = $('<select><option value=""></option></select>')
    //             .appendTo( $(this).empty() )
    //             .on( 'change', function () {
    //                 table.column( i )
    //                     .search( $(this).val() )
    //                     .draw();
    //             } );
     
    //         table.column( i ).data().unique().sort().each( function ( d, j ) {
    //             select.append( '<option value="'+d+'">'+d+'</option>' )
    //         } );
    //     } );
    // } );
  </script>
    <script type="text/javascript">
      function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("mylist");
       
        // var e = document.getElementById("mylist");
        // input = e.options[e.selectedIndex].value;
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[4];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }       
        }
      }
      function myFunction2() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("mylist2");
       
        // var e = document.getElementById("mylist");
        // input = e.options[e.selectedIndex].value;
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[10];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }       
        }
      }
    </script>
    <script>
    $(document).ready(function(){
     
     fetch_data();
     
     function fetch_data(nopoID = '')
     {
      $('#product_table').DataTable({
       processing: true,
       serverSide: true,
       ajax:{
           url: "/backend/nopol/filter/ajax",
           data:{"_token": "{{ csrf_token() }}",nopol:nopolID},
       },
       columns:[
                {
                    data:'NoPo',
                    name:'NoPo'
                },
                {
                    data:'Sewa',
                    name:'Sewa'
                },
                {
                    data:'CP',
                    name:'CP'
                },
                {
                    data:'Mobil_id',
                    name:'Mobil_id'
                },
                {
                    data:'Nopol',
                    name:'Nopol'
                },
                {
                    data:'Vendor_Driver',
                    name:'Vendor_Driver'
                },
                {
                    data:'Cabang_id',
                    name:'Cabang_id'
                },
                {
                    data:'Kota',
                    name:'Cabang_id'
                },
                {
                    data:'Driver_id',
                    name:'Driver_id'
                },
                {
                    data:'MulaiSewa',
                    name:'MulaiSewa'
                },
                {
                    data:'Tgl_bastk',
                    name:'Tgl_bastd'
                },
                {
                    data:'Tgl_relokasi',
                    name:'Efisien_relokasi'
                },
                {
                    data:'Tgl_cutoff',
                    name:'Tgl_cutoff'
                },
                {
                    data:'SelesaiSewa',
                    name:'SelesaiSewa'
                },
                {
                    data:'HargaSewaMobil',
                    name:'HargaSewaMobil'
                },
                {
                    data:'HargaSewaDriver2019',
                    name:'HargaSewaDriver2019'
                },
                {
                    data:'NoRegister',
                    name:'NoRegister'
                }
            ]
      });
     }
     
     $('#nopol_filter').change(function(){
      var nopol = $('#nopol_filter').val();
     
      $('#product_table').DataTable().destroy();
     
      fetch_data(nopol);
     });

    });


    

    </script>





<!-- <script type="text/javascript">

$(document).ready(function(){

  $('#nopol_filter').on('change', function() {

    var nopolID = $(this).val();

      if(nopolID) {

          $.ajax({

              url: '/backend/nopol/filter/ajax',

              type: "POST",

              dataType: "json",

              data:{"_token": "{{ csrf_token() }}",nopol:nopolID},

              // success:function(data) {


              //     alert('success');


              // }

          });

      }else{

          $('#harga_driver_ajax').empty();

      }

  });

});

$(document).ready(function(){

    fill_datatable();

    function fill_datatable(nopolID = '')
    {
        var dataTable = $('#customer_data').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "/backend/nopol/filter/ajax",
                data:{"_token": "{{ csrf_token() }}",nopol:nopolID},
            },
            columns: [
                {
                    data:'NoPo',
                    name:'NoPo'
                },
                {
                    data:'Sewa',
                    name:'Sewa'
                },
                {
                    data:'CP',
                    name:'CP'
                },
                {
                    data:'Mobil_id',
                    name:'Mobil_id'
                },
                {
                    data:'Nopol',
                    name:'Nopol'
                },
                {
                    data:'Vendor_Driver',
                    name:'Vendor_Driver'
                },
                {
                    data:'Cabang_id',
                    name:'Cabang_id'
                },
                {
                    data:'Kota',
                    name:'Cabang_id'
                },
                {
                    data:'Driver_id',
                    name:'Driver_id'
                },
                {
                    data:'MulaiSewa',
                    name:'MulaiSewa'
                },
                {
                    data:'Tgl_bastk',
                    name:'Tgl_bastd'
                },
                {
                    data:'Tgl_relokasi',
                    name:'Efisien_relokasi'
                },
                {
                    data:'Tgl_cutoff',
                    name:'Tgl_cutoff'
                },
                {
                    data:'SelesaiSewa',
                    name:'SelesaiSewa'
                },
                {
                    data:'HargaSewaMobil',
                    name:'HargaSewaMobil'
                },
                {
                    data:'HargaSewaDriver2019',
                    name:'HargaSewaDriver2019'
                },
                {
                    data:'NoRegister',
                    name:'NoRegister'
                }
            ]
        });
    }



    // $('#filter').click(function(){
    //     var filter_gender = $('#filter_gender').val();
    //     var filter_country = $('#filter_country').val();

    //     if(filter_gender != '' &&  filter_gender != '')
    //     {
    //         $('#customer_data').DataTable().destroy();
    //         fill_datatable(filter_gender, filter_country);
    //     }
    //     else
    //     {
    //         alert('Select Both filter option');
    //     }
    // });


//     $('#reset').click(function(){
//         $('#filter_gender').val('');
//         $('#filter_country').val('');
//         $('#customer_data').DataTable().destroy();
//         fill_datatable();
//     });

// });

</script> -->
@include('dashboard.filter');

@endsection