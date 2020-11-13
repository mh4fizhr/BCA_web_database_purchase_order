<?php 
$page = "Perubahan"; 
$name = "perubahan"; 
?>
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
                
              </div>
              <div class="">
                <!-- Projects table -->
                <div class="">
                  <form action="{{url('/backend/po/form_perubahan_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col"><b>No</b></th>
                        <th scope="col"><b>No PO</b></th>
                        <th scope="col" class="bg-warning text-white"><b>Jenis Sewa</b></th>
                        <th scope="col"><b>CP/D</b></th>
                        <th scope="col"><b>Nopol</b></th>
                        <th scope="col" class="bg-warning text-white"><b>Vendor</b></th>
                        <th scope="col"><b>Cabang</b></th>
                        <th scope="col"><b>Kota</b></th>
                        <th scope="col"><b>Driver</b></th>
                        <th scope="col"><b>Vendor driver</b></th>
                        <th scope="col"><b>Mulai Sewa</b></th>                       
                        <th scope="col"><b>Selesai Sewa</b></th>
                        <th scope="col" class="bg-warning text-white"><b>Data pairing baru</b></th>
                        <th scope="col" class="bg-warning text-white"><b>Tgl efektif</b></th>
                        <th scope="col" style="min-width: 100%">
                          <input type="submit" class="btn btn-warning btn-sm text-white" value="perubahan">
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
                      @if($po->status == 1 && ($po->SelesaiSewa <= $currentDateTime || ($po->Tgl_cutoff != '' && $po->Tgl_cutoff >= $currentDateTime)))
                      @elseif($po->tgl_efektif_perubahan != '' && $po->tgl_efektif_perubahan >= $currentDate)
                      @elseif($po->status == '0' || $po->status == '5')
                      @elseif($po->Sewa_sementara == 'Driver' || $po->Sewa_sementara == 'Mobil' || $po->Sewa_sementara == 'null')
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
                          @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
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
                        <td>
                          {{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}
                        </td>
                        <td> 
                          {{$po->cabang->Kota}}
                        </td>

                        <td>
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
                        </td>

                        <td>
                          {{$po->MulaiSewa->format('d-M-Y')}}
                        </td>
                        <td>
                          {{$po->SelesaiSewa->format('d-M-Y')}}
                        </td>

                        <td>
                          @if($po->tgl_efektif_perubahan <= $currentDate && $po->tgl_efektif_perubahan != '' && $po->Sewa_sementara != 'null')
                            -
                          @else
                            @if($po->data_pairing_baru == '')
                              -
                            @else
                              {{$po->data_pairing_baru}}
                            @endif
                          @endif
                        </td>

                        <td>
                          @if($po->tgl_efektif_perubahan <= $currentDate && $po->tgl_efektif_perubahan != '' && $po->Sewa_sementara != 'null')
                            -
                          @else
                            @if($po->tgl_efektif_perubahan == '')
                              -
                            @else
                              {{ date('d-M-Y', strtotime($po->tgl_efektif_perubahan))}}
                            @endif
                          @endif
                          
                        </td>
                        
                        <td>
                          
                          @if($po->tgl_efektif_perubahan != '' && $po->tgl_efektif_perubahan >= $currentDate)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1{{$i}}" value="{{$po->id}}" disabled="">
                                <label class="custom-control-label" for="customCheck1{{$i}}"></label>
                              </div>
                          @else
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck1{{$i}}" value="{{$po->id}}">
                              <label class="custom-control-label" for="customCheck1{{$i}}"></label>
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






