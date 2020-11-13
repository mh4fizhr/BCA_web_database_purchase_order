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

                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filter"><i class="fas fa-search"></i>
                  &nbspFilter database
                </button>
                <!-- <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <i class="ni ni-calendar-grid-58"></i>&nbspFilter date : <span class="text-primary"></span>
                </a> -->
                
                <a href="{{url('/backend/export/database')}}" class="btn btn-success float-right pull-right">
                  <i class="fa fa-file-excel"></i> &nbspExport to excel
                </a>
            </div>
          </div>
          <!-- include('dashboard.filter_date') -->
          
        

          
        </div>
      </div>
    </div>


    <div class="container-fluid mt--6">
      
      <div class="content">
        <div class="row">
            <div class="col-xl-12">


              <!-- <div class="accordion" id="accordionExample">
                  <div class="card">
                      <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h5 class="mb-0"><i class="fas fa-chart-bar"></i> &nbspVendor Chart</h5>
                      </div>
                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">
                            <div id="chart"></div>
                          </div>
                      </div>
                </div>
                  
              </div> -->


              
              <div class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0  d-inline-block"><li class="ni ni-paper-diploma"></li> &nbspPurchase Order (Max filter : 2000 rows) </h3>


                      
                      <div class="float-right">
                        <select class="form-control form-control-sm" id="status_active" style="width: 150px">
                            <option value="">Status : All</option>
                            <option value="active">Status : active</option>
                            <option value="outstanding">Status : outstanding</option>
                            <option value="not active">Status : non active</option>
                        </select>
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
                      <div class=" table-hover mb-3">
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
                              <th scope="col"><b>Created by</b></th>
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
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                                    <td></td>
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                              </tr>
                          </thead>
                          <tbody>
                             <?php 
                            $i = 1;
                            $status_approve = 'null';
                            use App\approve;
                          ?>
                          @foreach($pos as $po)
                          <?php 
                          if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                              $status_approve = 'waiting bop';
                          }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting2')->exists()) {
                              $status_approve = 'waiting2';
                          }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                              $status_approve = 'waiting';
                          }else{
                              $status_approve = 'null';
                          }
                          ?>
                          @if($po->status == 7)
                          @elseif($po->status == 5 && $po->Nopol != null)
                          <tr role="row" class="odd <?php if ($status_approve == 'waiting' || $status_approve == 'waiting bop') echo "bg-warning text-white" ?>">
                            <td>{{$i}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>{{$po->Nopo_permanent}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  @if($status_approve == 'waiting bop' || $status_approve == 'waiting2')
                                    Mobil
                                  @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null')
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
                                    {{$po->mobil->MerekMobil}} {{$po->mobil->Type}}
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
                                  
                                      {{$po->vendor->KodeVendor}}
                                   
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                @if(empty($po->Cabang_relokasi))

                                  <td>
                                    
                                    {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                                  </td>
                                  <td> 
                                    
                                    {{$po->cabang->Kota}}
                                  </td>

                                @else

                                  @if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null')

                                    <td>
                                      
                                      {{$po->cabang_relokasi->KodeCabang}} - {{$po->cabang_relokasi->NamaCabang}}
                                    </td>
                                    <td> 
                                      
                                      {{$po->cabang_relokasi->Kota}}
                                    </td>

                                  @else

                                    <td>
                                      
                                      {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                                    </td>
                                    <td> 
                                      
                                      {{$po->cabang->Kota}}
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

                                @if($status_approve == 'waiting' || $status_approve == 'waiting bop' || $status_approve == 'waiting bop')
                                  <td>
                                    <span class="badge badge-sm badge-secondary">outstanding</span>
                                  </td>
                                @else
                                  <?php
                                     $tgl_selesai_sewa = date('m/d/Y', strtotime($po->SelesaiSewa));
                                  ?>
                                  <td>
                                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $status_approve == 'null')
                                      @if(($po->Sewa_sementara == 'null' || $po->SelesaiSewa < $currentDateTime) && $status_approve == 'null')
                                        <span class="badge badge-sm badge-danger">Not Active</span>
                                      @else
                                        <span class="badge badge-sm badge-success">Active</span>
                                      @endif
                                    @elseif($po->SelesaiSewa < $currentDateTime && $status_approve == 'null')
                                      <span class="badge badge-sm badge-danger">Not Active</span>
                                    @else
                                      <span class="badge badge-sm badge-success">Active</span>
                                    @endif
                                  </td>
                                @endif
                                

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{date('m/d/Y', strtotime($po->created_at))}}
                              </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{$po->user->name}}
                              </td>


                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                    @if(auth::user()->status == 'admin')

                                    <a class="btn btn-success btn-sm" href="{{url('/backend/po/edit_pengada/'.$po->id)}}" >
                                        <i class="fas fa-pencil-alt" >
                                        </i> Edit
                                        
                                    </a>

                                    @endif
                                    <!-- <a class="btn btn-info btn-sm view_po" href="#" id="{{$po->id}}" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
                                        <i class="fas fa-file">
                                        </i>
                                        &nbspView
                                    </a> -->

                                    <a class="btn btn-warning btn-sm" href="{{url('/backend/po/show/'.$po->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Lihat detail
                                    </a>
                                </td>

                                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <?php $i++; ?>
                          </tr>
                          @elseif($po->status != 0 && $po->status != 5 && $statuss == 'all')
                          <tr role="row" class="odd <?php if ($status_approve == 'waiting') echo "bg-warning text-white" ?> ">
                            <td>{{$i}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>{{$po->Nopo_permanent}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  @if($status_approve == 'waiting bop' || $status_approve == 'waiting2')
                                    Mobil
                                  @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null')
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
                                    
                                    {{$po->mobil->MerekMobil}} {{$po->mobil->Type}}
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
                                  {{$po->vendor->KodeVendor}}
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                @if(empty($po->Cabang_relokasi))

                                  <td>
                                    
                                    {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                                  </td>
                                  <td> 
                                    
                                    {{$po->cabang->Kota}}
                                  </td>

                                @else

                                  @if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null')

                                    <td>
                                      
                                      {{$po->cabang_relokasi->KodeCabang}} - {{$po->cabang_relokasi->NamaCabang}}
                                    </td>
                                    <td> 
                                      
                                      {{$po->cabang_relokasi->Kota}}
                                    </td>

                                  @else

                                    <td>
                                      
                                      {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                                    </td>
                                    <td> 
                                      
                                      {{$po->cabang->Kota}}
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

                                @if($status_approve == 'waiting' || $status_approve == 'waiting bop')
                                  <td>
                                    <span class="badge badge-sm badge-secondary">outstanding</span>
                                  </td>
                                @else
                                  <?php
                                     $tgl_selesai_sewa = date('m/d/Y', strtotime($po->SelesaiSewa));
                                  ?>
                                  <td>
                                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $status_approve == 'null')
                                      @if(($po->Sewa_sementara == 'null' || $po->SelesaiSewa < $currentDateTime) && $status_approve == 'null')
                                        <span class="badge badge-sm badge-danger">Not Active</span>
                                      @else
                                        <span class="badge badge-sm badge-success">Active</span>
                                      @endif
                                    @elseif($po->SelesaiSewa < $currentDateTime && $status_approve == 'null')
                                      <span class="badge badge-sm badge-danger">Not Active</span>
                                    @else
                                      <span class="badge badge-sm badge-success">Active</span>
                                    @endif
                                  </td>
                                @endif
                                

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{date('m/d/Y', strtotime($po->created_at))}}
                              </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{$po->user->name}}
                              </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                    @if(auth::user()->status == 'admin')

                                    <a class="btn btn-success btn-sm" href="{{url('/backend/po/edit_pengada/'.$po->id)}}" >
                                        <i class="fas fa-pencil-alt" >
                                        </i> Edit
                                        
                                    </a>

                                    @endif
                                    <!-- <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page ?></button> -->
                                    <!-- <a class="btn btn-info btn-sm view_po" href="#" id="{{$po->id}}" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
                                        <i class="fas fa-file">
                                        </i>
                                        &nbspView
                                    </a> -->

                                    <a class="btn btn-warning btn-sm" href="{{url('/backend/po/show/'.$po->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Lihat detail
                                    </a>
                                </td>

                                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <?php $i++; ?>
                          </tr>

                          @elseif($po->status == 1 && $statuss == 'active' && $po->SelesaiSewa >= $currentDateTime && ($po->Efisien_relokasi >= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != ''))
                          <tr role="row" class="odd <?php if ($status_approve == 'waiting') echo "bg-warning text-white" ?>">
                            <td>{{$i}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>{{$po->Nopo_permanent}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  @if($status_approve == 'waiting bop' || $status_approve == 'waiting2')
                                    Mobil
                                  @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null')
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
                                    {{$po->mobil->MerekMobil}} {{$po->mobil->Type}}

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
                                  {{$po->vendor->KodeVendor}}
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                @if(empty($po->Cabang_relokasi))

                                  <td>
                                    
                                    {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                                  </td>
                                  <td> 
                                    
                                    {{$po->cabang->Kota}}
                                  </td>

                                @else

                                  @if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null')

                                    <td>
                                      
                                      {{$po->cabang_relokasi->KodeCabang}} - {{$po->cabang_relokasi->NamaCabang}}
                                    </td>
                                    <td> 
                                      
                                      {{$po->cabang_relokasi->Kota}}
                                    </td>

                                  @else

                                    <td>
                                      
                                      {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                                    </td>
                                    <td> 
                                      
                                      {{$po->cabang->Kota}}
                                    </td>

                                    @endif
                                  
                                @endif

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                
                                  @if($po->Driver_id == '')
                                    <td> - </td>
                                    <td> - </td>
                                  @else
                                    @foreach($drivers as $driver)
                                      @if($po->Driver_id == $driver->id)
                                        <td>{{$driver->NamaDriver}}</td>
                                        <td>{{$driver->nip}}</td> 
                                      @endif
                                    @endforeach
                                  @endif
                           
                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{$po->UserPengguna}}
                              </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                @if($status_approve == 'waiting' || $status_approve == 'waiting bop')
                                  <td>
                                    <span class="badge badge-sm badge-secondary">outstanding</span>
                                  </td>
                                @else
                                  <?php
                                     $tgl_selesai_sewa = date('m/d/Y', strtotime($po->SelesaiSewa));
                                  ?>
                                  <td>
                                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $status_approve == 'null')
                                      @if(($po->Sewa_sementara == 'null' || $po->SelesaiSewa < $currentDateTime) && $status_approve == 'null')
                                        <span class="badge badge-sm badge-danger">Not Active</span>
                                      @else
                                        <span class="badge badge-sm badge-success">Active</span>
                                      @endif
                                    @elseif($po->SelesaiSewa < $currentDateTime && $status_approve == 'null')
                                      <span class="badge badge-sm badge-danger">Not Active</span>
                                    @else
                                      <span class="badge badge-sm badge-success">Active</span>
                                    @endif
                                  </td>
                                @endif
                                

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  {{date('m/d/Y', strtotime($po->created_at))}}
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{$po->user->name}}
                              </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                    @if(auth::user()->status == 'admin')

                                    <a class="btn btn-success btn-sm" href="{{url('/backend/po/edit_pengada/'.$po->id)}}" >
                                        <i class="fas fa-pencil-alt" >
                                        </i> Edit
                                        
                                    </a>

                                    @endif

                                    <!-- <a class="btn btn-info btn-sm view_po" href="#" id="{{$po->id}}" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
                                        <i class="fas fa-file">
                                        </i>
                                        &nbspView
                                    </a> -->


                                    <a class="btn btn-warning btn-sm" href="{{url('/backend/po/show/'.$po->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Lihat detail
                                    </a>
                                </td>

                                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <?php $i++; ?>
                          </tr>










                          @elseif($po->status == 1 && $statuss == 'notactive' && $po->SelesaiSewa <= $currentDateTime && ($po->Efisien_relokasi <= $currentDateTime || $po->Tgl_cutoff <= $currentDateTime))
                          <tr role="row" class="odd <?php if ($status_approve == 'waiting') echo "bg-warning text-white" ?>">
                            <td>{{$i}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>{{$po->Nopo_permanent}}</td>

                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  @if($status_approve == 'waiting bop' || $status_approve == 'waiting2')
                                    Mobil
                                  @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null')
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
                                    {{$po->mobil->MerekMobil}} {{$po->mobil->Type}}
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
                                  {{$po->vendor->KodeVendor}}
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                @if(empty($po->Cabang_relokasi))

                                  <td>
                                    
                                    {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                                  </td>
                                  <td> 
                                    
                                    {{$po->cabang->Kota}}
                                  </td>

                                @else

                                  @if($po->Efisien_relokasi <= $currentDateTime && $status_approve == 'null')

                                    <td>
                                      
                                      {{$po->cabang_relokasi->KodeCabang}} - {{$po->cabang_relokasi->NamaCabang}}
                                    </td>
                                    <td> 
                                      
                                      {{$po->cabang_relokasi->Kota}}
                                    </td>

                                  @else

                                    <td>
                                      
                                      {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                                    </td>
                                    <td> 
                                      
                                      {{$po->cabang->Kota}}
                                    </td>

                                    @endif
                                  
                                @endif

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                
                                  @if($po->Driver_id == '')
                                    <td> - </td>
                                    <td> - </td>
                                  @else
                                    @foreach($drivers as $driver)
                                      @if($po->Driver_id == $driver->id)
                                        <td>{{$driver->NamaDriver}}</td>
                                        <td>{{$driver->nip}}</td> 
                                      @endif
                                    @endforeach
                                  @endif
                           
                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{$po->UserPengguna}}
                              </td>

                             <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                @if($status_approve == 'waiting' || $status_approve == 'waiting bop')
                                  <td>
                                    <span class="badge badge-sm badge-secondary">outstanding</span>
                                  </td>
                                @else
                                  <?php
                                     $tgl_selesai_sewa = date('m/d/Y', strtotime($po->SelesaiSewa));
                                  ?>
                                  <td>
                                    @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $status_approve == 'null')
                                      @if(($po->Sewa_sementara == 'null' || $po->SelesaiSewa < $currentDateTime) && $status_approve == 'null')
                                        <span class="badge badge-sm badge-danger">Not Active</span>
                                      @else
                                        <span class="badge badge-sm badge-success">Active</span>
                                      @endif
                                    @elseif($po->SelesaiSewa < $currentDateTime && $status_approve == 'null')
                                      <span class="badge badge-sm badge-danger">Not Active</span>
                                    @else
                                      <span class="badge badge-sm badge-success">Active</span>
                                    @endif
                                  </td>
                                @endif
                                

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                  {{date('m/d/Y', strtotime($po->created_at))}}
                                </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              <td>
                                {{$po->user->name}}
                              </td>

                              <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                                <td>
                                    @if(auth::user()->status == 'admin')

                                    <a class="btn btn-success btn-sm" href="{{url('/backend/po/edit_pengada/'.$po->id)}}" >
                                        <i class="fas fa-pencil-alt" >
                                        </i> Edit
                                        
                                    </a>

                                    @endif
                                    <!-- <a class="btn btn-info btn-sm view_po" href="#" id="{{$po->id}}" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
                                        <i class="fas fa-file">
                                        </i>
                                        &nbspView
                                    </a> -->

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

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
         var tdate = new Date();
         var dd = tdate.getDate(); //yields day
         var month = new Array();
         month[0] = "January";
         month[1] = "February";
         month[2] = "March";
         month[3] = "April";
         month[4] = "May";
         month[5] = "June";
         month[6] = "July";
         month[7] = "August";
         month[8] = "September";
         month[9] = "October";
         month[10] = "November";
         month[11] = "December";
         var MM = month[tdate.getMonth()]; //yields month
         var yyyy = tdate.getFullYear(); //yields year
         var currentDate= dd + " - " +( MM) + " - " + yyyy;

    Highcharts.chart('chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah sewa/vendor - <b><b>'+{{$po_count}}+'</b></b> PO'
        },
        subtitle: {
            text: "Tanggal : "+currentDate
        },
        xAxis: {
            categories: {!!json_encode($categori_vendors)!!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table><br>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Mobil+Driver',
            data: {!!json_encode($data_md)!!}

        }, {
            name: 'Mobil',
            data: {!!json_encode($data_m)!!}

        }, {
            name: 'Driver',
            data: {!!json_encode($data_d)!!}

        }]
    });

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
@include('dashboard.view_table')
@include('dashboard.filter');


@endsection


