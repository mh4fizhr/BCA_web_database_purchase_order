<?php $page = "db_po"; ?>
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
<!--               <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                <li class="nav-item">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page ?></button>
                </li>
              </ul> -->
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-database"></li> &nbspDatabase PO</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/mobil/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/mobil/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
                <form action="{{url('/backend/admin/po/delete')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <div class="">
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
                              <th scope="col" width="10px">
                                <button class="btn btn-icon btn-sm btn-dark mr-2" type="submit">
                                  <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete permanent</span>
                                </button>
                              </th>
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
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                              </tr>
                          </thead>
                          <tbody>
                             <?php 
                            $i = 1;
                          ?>
                          @foreach($pos as $po)
                          
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
                                    @if(auth::user()->status == 'operasional' || auth::user()->status == 'admin')

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

                                <td>

                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="po[]" id="customCheck{{$i}}" value="{{$po->id}}">
                                        <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                      </div>

                                  </td>

                                <?php $i++; ?>
                          </tr>
                          @endforeach
                          </tbody>
      <!--                     <tfoot>
                                      <tr>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                      </tr>
                                  </tfoot> -->
                         </table>
                  </div> 
                  </form>     
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

















