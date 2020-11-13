<?php 
$page = "Relokasi"; 
$name = "relokasi"; 
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
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-5 col-5 text-right">
              
              <!-- <a href="/backend/po/form_add" class="btn btn-success float-right pull-right" ><i class="fas fa-plus"></i> Add <?php echo $page ?></a> -->
                <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                  <!-- <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true" style="font-size: 11px">Single Relokasi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false" style="font-size: 11px">Multiple Relokasi</a>
                  </li> -->
                  <li class="nav-item text-right">
                    <a href="{{url('/backend/po/table')}}" type="button" class="btn btn-default">Back</a>
                  </li>
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
            <div class="card pb-4 pt--8">
              <div class="card-header border-0">
                
              </div>
              <div class="tab-content" id="myTabContent">


                <div class="tab-pane fade show active " id="tabs-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  <form action="{{url('/backend/po/form_relokasi')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <div class="">
                      <!-- <p><label><input type="checkbox" class="checkAll" id="checkAll"/> Check all</label></p> -->
                      <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="myTable" style="width: 100%">
                        <thead class="">
                          <tr>
                            <th scope="col" rowspan="2"><b>No</b></th>
                            <th scope="col" colspan="3" style="min-width: 30%" class="bg-yellow text-white"><b>Cabang Lama</b></th>
                            <th scope="col" colspan="4" style="min-width: 30%" class="bg-info text-white"><b>Cabang Baru</b></th>               
                            <th scope="col" rowspan="2" style="min-width: 10%"><b>Sewa</b></th>   
                            <th scope="col" rowspan="2" style="min-width: 20%"><b>No.Pol</b></th>  
                            <th scope="col" class="bg-primary text-white" rowspan="2" style="min-width: 10%"><b>Vendor</b></th>
                            <th scope="col" rowspan="2" style="min-width: 10%">
                              <input type="submit" class="btn btn-primary btn-sm text-white" value="Relokasi">
                            </th>
                          </tr>
                          <tr>
                            <th scope="col" class="bg-yellow text-white"><b>No PO</b></th>
                            <th scope="col" class="bg-yellow text-white"><b>Cabang</b></th>
                            <th scope="col" class="bg-yellow text-white"><b>Kota</b></th>
                            <th scope="col" class="bg-info text-white"><b>No PO</b></th>
                            <th scope="col" class="bg-info text-white"><b>Cabang</b></th>
                            <th scope="col" class="bg-info text-white"><b>Kota</b></th>
                            <th scope="col" class="bg-info text-white"><b>Efektif</b></th>
                          </tr>
                        </thead>
                        <thead>
                            <tr>
                                <td></td>
                                <th><input type="text" class="form-control form-control-sm" placeholder="No Po" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="cabang lama" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="Kota" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="No Po" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="cabang baru" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="kota" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="efektif" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="sewa" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="No.polisi" style="min-width:100px" /></th>
                                <th><input type="text" class="form-control form-control-sm" placeholder="Vendor" style="min-width:100px" /></th>
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
                          @if($po->status == 1 && ($po->SelesaiSewa <= $currentDateTime || ($po->Tgl_cutoff != '' && $po->Tgl_cutoff <= $currentDateTime && $po->Sewa_sementara == 'null')))
                          @elseif($po->status == '0' || $po->status == '5')
                          @elseif($po->Efisien_relokasi >= $currentDateTime)
                          @else
                          <tr role="row" class="odd ">
                            <td>{{$i}}</td>
                            <td>{{$po->Nopo_permanent}}</td>
                            <!-- <td>
                              @foreach($nopos as $nopo)
                                @if($po->NoPo == $nopo->id)
                                  {{$nopo->NoPo}}
                                @endif
                              @endforeach
                            </td> -->
                            
                              <td>{{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}</td>
                              <td>{{$po->cabang->Kota}}</td>
                              
                            
                            @if($po->Cabang_relokasi == '')
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            @else
                                  
                                

                                    <td>{{$po->cabang_relokasi->KodeCabang}} - {{$po->cabang_relokasi->NamaCabang}}</td>
                                    <td>{{$po->cabang_relokasi->Kota}}</td>

                                  
                            @endif
                            <td>
                              @if($po->Efisien_relokasi == '')
                                -
                              @else
                                {{$po->Efisien_relokasi->format('d-M-Y')}}
                              @endif
                            </td>

                            <td>
                              {{$po->Sewa_sementara}}
                            </td>
                            
                            <td> 
                              {{$po->Nopol}}
                            </td>

                            <td>
                              @foreach($vendors as $vendor)
                                @if($po->Vendor_Driver == $vendor->id)
                                  {{$vendor->KodeVendor}}
                                @endif
                              @endforeach
                            </td>

                            <td>
                            
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck1{{$i}}" value="{{$po->id}}">
                                  <label class="custom-control-label" for="customCheck1{{$i}}"></label>
                                </div>
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
                    </div>
                </div>
              </form>
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






