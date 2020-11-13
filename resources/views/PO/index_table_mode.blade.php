<?php 
$page = "DPO"; 
$name = "dpo";
App\tampungan_relokasi::truncate();
App\tampungan_perubahan::truncate();
App\tampungan_pengurangan::truncate();
App\tampungan_pengurangan_driver::truncate();
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
            <div class="col-lg-2 col-7">
              <h1 class=" text-white d-inline-block mb-0">PO Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-10 col-5 text-right">
              <div class="float-right pull-right">
                 
                @if(auth::user()->status != 'admin' && auth::user()->status != 'operasional')
                  <a href="{{url('/backend/po/form_add')}}" class="btn btn-success  mr-2 ml-2 mt-2" ><i class="fas fa-file-invoice"></i>&nbsp Tambah PO </a>

                  

                  <a href="{{url('/backend/po/relokasi')}}" class="btn btn-info  mr-2 ml-2 mt-2" ><i class="fas fa-file-export"></i> &nbspRelokasi </a>

                  <a href="{{url('/backend/po/pengurangan')}}" class="btn btn-danger  mr-2 ml-2 mt-2" ><i class="fas fa-file-download"></i> &nbspPengurangan</a>

                  <a href="{{url('/backend/po/perubahan')}}" class="btn btn-warning  mr-2 ml-2 mt-2" ><i class="fas fa-window-restore"></i> &nbspPerubahan</a>
                  
                @endif

                @if(auth::user()->status == 'operasional')
                <a href="{{url('/backend/po/form_add')}}" class="btn btn-success  mr-2 ml-2 mt-2" ><i class="fas fa-file-invoice"></i>&nbsp Tambah PO </a>
                @endif

              </div>
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
                <div class="row">
                  <div class="col-md-9">
                      <!-- <div class="dropdown">
                        <a href="{{url('/backend/po/table')}}" class="btn btn-default dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                            <i class="ni ni-paper-diploma"></i> &nbsp 
                            @if($kategori == 1)
                            Penambahan
                            @elseif($kategori == 2)
                            Relokasi
                            @elseif($kategori == 3)
                            Pengurangan
                            @else
                              @if(auth::user()->status == 'pengada')

                                PO - on process

                              @elseif(auth::user()->status == 'operasional')

                                PO - from BPD

                              @endif
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">

                            <li>
                                <a class="dropdown-item <?php if($kategori == 0) echo('bg-primary text-white') ?>" href="{{url('/backend/po/table')}}">
                                  <i class="ni ni-paper-diploma"></i> 
                                  @if(auth::user()->status == 'pengada')

                                    PO - on process

                                  @elseif(auth::user()->status == 'operasional')

                                    PO - from BPD

                                  @endif
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php if($kategori == 1) echo('bg-primary text-white') ?>" href="{{url('/backend/po/table/1')}}">
                                  <i class="fas fa-plus"></i> Penambahan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php if($kategori == 2) echo('bg-primary text-white') ?>" href="{{url('/backend/po/table/2')}}">                                  
                                  <i class="fas fa-share"></i> Relokasi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?php if($kategori == 3) echo('bg-primary text-white') ?>" href="{{url('/backend/po/table/3')}}">
                                  <i class="fas fa-minus"></i> Pengurangan
                                </a>
                            </li>
                        </ul>
                      </div> -->
                      <?php $user_status = ''; ?>
                      @if(auth::user()->status == 'pengada' || auth::user()->status == 'blk')

                        <?php $user_status = 'PO - on process'; ?>

                      @elseif(auth::user()->status == 'operasional')

                        <?php $user_status = 'PO - from BPD'; ?>

                      @endif
                      
                      <a href="{{url('/backend/po/table')}}" class="btn <?php echo ($kategori == 0)?'btn-primary':'btn-secondary';?>">
                        <span class="<?php echo ($kategori == 0)?'text-white':'text-black';?>"><i class="fas fa-file-invoice"></i> &nbsp{{$user_status}}</span>
                          @if(auth::user()->status == 'pengada')

                            <?php $count_po = 0; ?>
                            @foreach($pos as $po)
                              @if($po->status == '0' || $po->status == '5')
                                <?php $count_po++; ?>
                              @endif
                            @endforeach
                            @if($count_po != 0)
                              <span class="badge badge-md badge-circle badge-floating badge-danger border-white">
                                {{$count_po}}
                              </span>
                            @endif

                          @elseif(auth::user()->status == 'operasional')

                            <?php $count_po = 0; ?>
                            @foreach($pos as $po)
                              @if($po->status == 0 || $po->status == 2)
                                <?php $count_po++; ?>
                              @endif
                            @endforeach
                            @if($count_po != 0)
                              <span class="badge badge-md badge-circle badge-floating badge-danger border-white">
                                {{$count_po}}
                              </span>
                            @endif
                            

                          @endif
                      </a>
                      @if(auth::user()->status != 'blk2')
                      <a href="{{url('/backend/po/table/2')}}" class="btn <?php echo ($kategori == 2)?'btn-primary':'btn-secondary';?>">
                        <span class="<?php echo ($kategori == 2)?'text-white':'text-black';?>"><i class="fas fa-file-export"></i> &nbspRelokasi</span>
                        
                          <?php $count_relokasi = 0; ?>
                          
                          @foreach($pos as $po)

                          <?php $status_approve_relokasi = '';?>
                          <?php $id_approve_relokasi = '';?>
                            @foreach($table_template_relokasis as $table_template_relokasi) 
                              @if($po->id == $table_template_relokasi->po_id)
                                <?php $status_approve_relokasi = $table_template_relokasi->template->status ?>
                                <?php $id_approve_relokasi = $table_template_relokasi->template->id ?>
                              @endif
                            @endforeach

                            @if($po->status == 1 && $po->SelesaiSewa >= $currentDateTime )
                              @if(($status_approve_relokasi == '' && $id_approve_relokasi != '')  || ($status_approve_relokasi == '1' && $po->Efisien_relokasi != '' && $po->Efisien_relokasi >= $currentDateTime))
                                <?php $count_relokasi++; ?>
                              @endif
                            @endif
                          @endforeach
                          @if($count_relokasi != 0)
                            <span class="badge badge-md badge-circle badge-floating badge-danger border-white">
                              {{$count_relokasi}}
                            </span>
                          @endif
                      </a>
                      <a href="{{url('/backend/po/table/3')}}" class="btn <?php echo ($kategori == 3)?'btn-primary':'btn-secondary';?>">
                        <span class="<?php echo ($kategori == 3)?'text-white':'text-black';?>"><i class="fas fa-file-download"></i> &nbspPengurangan</span>
                          <?php $count_pengurangan = 0; ?>
                          @foreach($pos as $po)

                          <?php $status_approve_pengurangan = '';?>
                            @foreach($table_template_pengurangans as $table_template_pengurangan) 
                              @if($po->id == $table_template_pengurangan->po_id)
                                
                                    <?php $status_approve_pengurangan = $table_template_pengurangan->template->status ?>
                                  
                              @endif
                            @endforeach

                            @if($po->status == 1  &&  $po->Sewa_sementara == 'null')
                              @if($status_approve_pengurangan == '' || ($status_approve_pengurangan == '1' && $po->Tgl_cutoff != '' && $po->Tgl_cutoff >= $currentDateTime))
                                <?php $count_pengurangan++; ?>
                              @endif
                            @endif
                          @endforeach
                          @if($count_pengurangan != 0)
                            <span class="badge badge-md badge-circle badge-floating badge-danger border-white">
                              {{$count_pengurangan}}
                            </span>
                          @endif
                      </a>
                      <a href="{{url('/backend/po/table/4')}}" class="btn <?php echo ($kategori == 4)?'btn-primary':'btn-secondary';?>">
                        <span class="<?php echo ($kategori == 4)?'text-white':'text-black';?>"><i class="fas fa-window-restore"></i> &nbspPerubahan</span>
                          <?php $count_perubahan = 0; ?>
                          @foreach($pengurangans as $pengurangan)
                            @foreach($pos as $po)

                              <?php $status_approve_perubahan = '';?>
                                @foreach($table_template_perubahans as $table_template_perubahan) 
                                  @if($po->id == $table_template_perubahan->po_id)
                                    
                                        <?php $status_approve_perubahan = $table_template_perubahan->template->status ?>
                                      
                                  @endif
                                @endforeach
                                @if($po->status == 1 && $pengurangan->Po_id == $po->id)
                                  @if($status_approve_perubahan == '' || ($status_approve_perubahan == '1' && $pengurangan->tgl_efektif >= $currentDate))
                                    <?php $count_perubahan++; ?>
                                  @endif
                                @endif
                            @endforeach
                          @endforeach
                          @if($count_perubahan != 0)
                            <span class="badge badge-md badge-circle badge-floating badge-danger border-white">
                              {{$count_perubahan}}
                            </span>
                          @endif
                      </a>
                      @endif
                      <!-- <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true" style="font-size: 12px">
                        @if(auth::user()->status == 'pengada')

                          PO - on process

                        @elseif(auth::user()->status == 'operasional')

                          PO - from BPD

                        @endif
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false" style="font-size: 12px">Penambahan</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false" style="font-size: 12px">Pengurangan</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false" style="font-size: 12px">Relokasi</a>
                      </li> -->
                  </div>
                  @if(auth::user()->status != 'blk')
                  <div class="col-md-3 text-right">
                    <a href="{{url('/backend/po/table/5')}}" class="btn <?php echo ($kategori == 5)?'btn-primary':'btn-dark';?>">
                      <span class="<?php echo ($kategori == 5)?'text-white':'text-black';?>"><i class="fas fa-tasks"></i> &nbspConfirm database PO</span>
                        <?php 
                          $count_po = 0; 
                          $count_po = App\tpo::where('status',7)->count();
                        ?>
                        
                        @if($count_po != 0)
                          <span class="badge badge-md badge-circle badge-floating badge-danger border-white">
                            {{$count_po}}
                          </span>
                        @endif
                    </a>
                  </div>
                  @endif
                </div>
              </div>
              <div class="tab-content" id="myTabContent">
                <!-- Projects table -->
                @if($kategori == 1)
                
                  @include('PO.table.penambahan')
                
                @elseif($kategori == 2)
                
                  @include('PO.table.relokasi')
                
                @elseif($kategori == 3)
                
                  @include('PO.table.pengurangan')

                @elseif($kategori == 4)
                
                  @include('PO.table.perubahan')
                
                @elseif($kategori == 5)
                
                  @include('PO.table.database')
                
                @else
                
                  @if(auth::user()->status == 'pengada' || auth::user()->status == 'blk')

                    @include('PO.table.table_pengada')

                  @elseif(auth::user()->status == 'operasional')

                    @include('PO.table.table_operasional')

                  @else

                    @include('PO.table.table_admin');

                  @endif
                
                @endif

                
                
                
                
                
                
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
  
                     
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@include('PO.add');

@endsection






