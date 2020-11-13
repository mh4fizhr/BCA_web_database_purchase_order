<?php 
$page = "Pengurangan"; 
$name = "pengurangan"; 
?>
@extends('sidebar')

@section('content')

<?php 
date_default_timezone_set('Asia/Jakarta');
$currentDateTime = date('Y-m-d H:i:s');
$currentDate = date('m/d/Y');
use App\approve;

?>


<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{url('/backend/po/table')}}" type="button" class="btn btn-default">Back</a>
              <!-- <a href="/backend/po/form_add" class="btn btn-success float-right pull-right" ><i class="fas fa-plus"></i> Add <?php echo $page ?></a> -->
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
            <div class="card pb-4 pt--8">
              <div class="card-header border-0">
                
                <a href="{{url('/backend/po/pengurangan')}}" class="btn btn-primary">Cutoff</a>
                <a href="{{url('/backend/po/pengurangan_damira')}}" class="btn btn-secondary">Cutoff driver tanpa unit</a>
              </div>
              <div class="">
                <!-- Projects table -->
                <div class="">
                  <form action="{{url('/backend/po/form_pengurangan_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col"><b>No</b></th>
                        <th scope="col"><b>No PO</b></th>
                        <th scope="col" class="bg-danger text-white"><b>Jenis Sewa</b></th>
                        <th scope="col"><b>CP/D</b></th>
                        <th scope="col"><b>Nopol</b></th>
                        <th scope="col" class="bg-danger text-white"><b>Vendor</b></th>
                        <th scope="col"><b>Cabang</b></th>
                        <th scope="col"><b>Kota</b></th>
                        <th scope="col"><b>Driver</b></th>
                        <th scope="col"><b>Vendor driver</b></th>
                        <th scope="col"><b>Mulai Sewa</b></th>                       
                        <th scope="col"><b>Selesai Sewa</b></th>
                        <th scope="col" class="bg-danger text-white"><b>Pengurangan</b></th>
                        <th scope="col" class="bg-danger text-white"><b>Cut Off</b></th>
                        <th scope="col" style="min-width: 100%">
                          <input type="submit" class="btn btn-danger btn-sm text-white" value="pengurangan">
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
                            <td></td>
                            <td></td>
                            <th>
                              @include('button_delete.index')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php 
                        $i = 1;
                      ?>
                      @foreach($pos as $po)
                      <?php 
                          if (approve::where('po_id', $po->id)->where('approve', 'waiting bop')->exists()) {
                              $status_approve = 'waiting bop';
                          }elseif (approve::where('po_id', $po->id)->where('approve', 'waiting')->exists()) {
                              $status_approve = 'waiting';
                          }else{
                              $status_approve = 'null';
                          }
                      ?>
                      @if($po->status == 1 && ($po->SelesaiSewa <= $currentDateTime || ($po->Tgl_cutoff != '' && $po->Tgl_cutoff >= $currentDateTime)))
                      @elseif($po->status == '0' || $po->status == '5')
                      @elseif($po->Sewa_sementara == 'Driver' || $po->Sewa_sementara == 'null')
                      @else
                      <tr role="row" class="odd ">
                        <td>{{$i}}</td>
                        <td>{{$po->Nopo_permanent}}
                        </td>
                        <!-- <td>
                          @foreach($nopos as $nopo)
                            @if($po->NoPo == $nopo->id)
                              {{$nopo->NoPo}}
                            @endif
                          @endforeach
                        </td> -->
                        <td>
                          @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null' && $status_approve == 'null')
                          
                            {{$po->Sewa_sementara}}
                          @else
                            {{$po->Sewa}}
                          @endif
                        </td>
                        <td>{{$po->CP}}</td>
                        <td>

                            @if($po->Nopol == 'null')
                              Tanpa Unit
                            @elseif($po->Nopol == '')
                              Tanpa Unit
                            @else
                              {{$po->Nopol}}
                            @endif
 
                          </td>
                        <td>
                          @foreach($vendors as $vendor)
                            @if($po->Vendor_Driver == $vendor->id)
                              {{$vendor->KodeVendor}}
                            @endif
                          @endforeach
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
                                  <td>{{$driver->vendor_id}}</td> 
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
                              <td>{{$driver->vendor_id}}</td> 
                            @endif
                          @endforeach
                        @endif

                        <!-- <td>
                          @if($po->Driver_id != null)
                            @foreach($drivers as $driver)
                              @if($po->Driver_id == $driver->id)
                                {{$driver->NamaDriver}}
                              @else
                              @endif
                            @endforeach
                          @else
                            -
                          @endif
                        </td>

                        <td>
                          @if($po->Driver_id != null)
                            @foreach($drivers as $driver)
                              @if($po->Driver_id == $driver->id)
                                {{$driver->vendor_id}}
                              @else
                              @endif
                            @endforeach
                          @else
                            -
                          @endif
                        </td> -->

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                        <td>
                          {{$po->MulaiSewa->format('d-M-Y')}}
                        </td>
                        <td>
                          {{$po->SelesaiSewa->format('d-M-Y')}}
                        </td>

                        <td>
                          @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                            -
                          @else
                            @if($po->Pengurangan == '')
                              -
                            @else
                              {{$po->Pengurangan}}
                            @endif
                          @endif
                        </td>

                        <td>
                          @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                            -
                          @else
                            @if($po->Tgl_cutoff == '')
                              -
                            @else
                              {{$po->Tgl_cutoff->format('d-M-Y')}}
                            @endif
                          @endif
                        </td>
                        
                        <td>
                          @if($po->Sewa_sementara == "null")
<!--                           <a class="btn btn-warning btn-sm disabled" href="{{url('/backend/po/form_pengurangan/'.$po->id)}}">
                              Pengurangan
                          </a> -->
                          <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$po->id}}" disabled="">
                                <label class="custom-control-label" for="customCheck{{$i}}"></label>
                              </div>
                          @else
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$po->id}}">
                                <label class="custom-control-label" for="customCheck{{$i}}"></label>
                              </div>
                          @endif
                        </td>

                        <?php $i++; ?>
                      </tr>
                      @endif
                      @endforeach
                       
                    </tbody>
                  </table>
                  <?php $i = 1; ?>
                  @foreach(App\tpo::all()->sortBy('id') as $po)
                      @if($po->status == '1')
                        <div class="delete_checkbox{{$po->id}}"></div> 
                        <?php $i = $po->id; ?>                    
                      @endif
                  @endforeach
                </form>
                </div>
                
              </div>
              
            <!-- /.card -->
            
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

@include('PO.add');

@endsection






