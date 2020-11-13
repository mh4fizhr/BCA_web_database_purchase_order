<?php $page = "Dashboard"; ?>
<?php $kota_ump = ''; ?>
<?php $vendor_ump = ''; ?>
@extends('sidebar')

@section('content')

<?php
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentDate = date('m/d/Y');
    $cutoff_mobil = '';
    $cutoff_driver = '';
?>

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} Table</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail PO</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="{{url('/backend/dashboard')}}" type="button" class="btn btn-default btn-sm">Back to Database</a>
            </div>
          </div>
          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card-wrapper">
            <!-- Custom form validation -->
            <div class="card ">
              <!-- Card header -->
              <div class="card-header text-center">
                <h3 class="mb-0 display-2">PURCHASE ORDER</h3>
              </div>
              <!-- Card body -->
              <div class="card-body">
                <!-- Form groups used in grid -->
                <div class="row">
                  <div class="col-md-8">
                    <div class="row">
                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                      <div class="col-md-3">
                        <label class="form-control-label ml-3 " for="example3cols1Input">No PO </label>
                      </div>
                      <div class="col-md-9 mb-4">
                        <form action="/backend/po/status/{{ $po->id }}" method="post">
                          {{ csrf_field() }}
                          <span>:

                             <span class="h4 font-weight-bold mb-0">{{$po->Nopo_permanent}}</span>
                            <!-- @foreach($nopos as $nopo)
                              @if($po->NoPo == $nopo->id)
                                {{$nopo->NoPo}}
                              @endif
                            @endforeach -->
                          </span>&nbsp 


                          @if($po->status == 0 & isset($po->Nopol,$po->Tgl_bastk,$po->Tgl_bastd,$po->HargaSewaMobil,$po->HargaSewaDriver2019))
                          <button type="submit" class="btn btn-success btn-sm">
                              <i class="ni ni-check-bold">
                              </i>
                              <input type="hidden" name="status" value="1">
                              Send to database
                          </button>
                           @endif

                           @if(auth::user()->status == 'admin')
                           <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-times"></i>&nbsp Delete PO</a>
                           @endif
                        </form>
                      </div>

                      

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                      <div class="col-md-3">
                        <label class="form-control-label ml-3" for="example3cols1Input">Jenis Sewa</label>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <span>:
                            @if($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara != 'null')
                              <span class="h4 font-weight-bold mb-0">{{$po->Sewa_sementara}}</span>
                            @elseif($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '' && $po->Sewa_sementara == 'null')
                              <span class="h4 font-weight-bold mb-0">{{$po->Sewa}}</span> <b><span class="text-danger">( Cutoff )</span></b>
                            @else
                              <span class="h4 font-weight-bold mb-0">{{$po->Sewa}}</span>
                            @endif
                          </span>
                        </div>
                      </div>                      

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                      <div class="col-md-3">
                        <label class="form-control-label ml-3" for="example3cols1Input">Merek & Type</label>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">: 
                            @if(!isset($po->Mobil_id) || $po->Mobil_id == 'null')

                              <span class="h4 font-weight-bold mb-0">Tanpa Unit </span>
                            
                            @else

                            @foreach($mobils as $mobil)
                              @if($po->Mobil_id == $mobil->id)
                                <span class="h4 font-weight-bold mb-0">{{$mobil->MerekMobil}} {{$mobil->Type}} </span>
                                &nbsp
                                <a class="btn btn-success btn-sm" href="{{url('/backend/po/type/edit/'.$po->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <span>
                                <?php $tanggal_sekarang = date('m/d/Y');?>
                                
                                <?php $tgl_efektif = '' ?>
                                @foreach($historymobils2 as $historymobil)
                                  @if($po->Mobil_id == $historymobil->mobil_id)
                                    @if($historymobil->Nopo != null)
                                      <?php $tgl_efektif = $historymobil->tgl_efektif ?> <!-- date('d-M-Y', strtotime($historymobil->tgl_efektif)) -->
                                    @endif
                                  @endif
                                @endforeach
                                @if($tgl_efektif == '')
                                @elseif($tgl_efektif >= $currentDate)
                                  <span class="h4 font-weight-bold mb-0">Efektif :</span> {{date('d-M-Y', strtotime($tgl_efektif))}}
                                @else
                                @endif
                              @endif
                            @endforeach
                            
                            @endif
                            
         
                        </div>
                      </div> 


                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                      <div class="col-md-3">
                        <label class="form-control-label ml-3" for="example3cols1Input">Nopol</label>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">: 

                          @if($po->Nopol == 'null' || $po->Nopol == '')

                            <span class="h4 font-weight-bold mb-0">Tanpa Unit</span> 
                          
                          @else

                            <span class="h4 font-weight-bold mb-0">{{$po->Nopol}}</span>
                            &nbsp
                            <a class="btn btn-success btn-sm" href="{{url('/backend/po/nopol/edit/'.$po->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                            </a>

                          @endif
         
                        </div>
                      </div>

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label ml-3" for="example3cols1Input">Driver</label>
                        </div>
                      </div>
                      
                      <div class="col-md-9">
                        <form action="{{url('/backend/po/delete/driver')}}" method="post">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <span>: 
                            @if($po->Driver_id == '')
                                @if(isset($history_driver))
                                  @if($history_driver->tgl_selesai > $currentDate)
                                    @foreach($drivers as $driver)
                                      @if($history_driver->Driver_id == $driver->id)
                                        <input type="hidden" name="driver_id" value="{{$driver->id}}">
                                        <span class="h4 font-weight-bold mb-0">{{$driver->NamaDriver}}</span> 
                                        &nbsp<!-- <button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-times"></i>&nbsp Delete Driver</button> -->
                                        (cut off : {{ date('d-M-Y', strtotime($history_driver->tgl_selesai))}}) <a href="{{url('/backend/driver/edit/cutoff/'.$po->id.'/'.$driver->id)}}" class="=btn btn-warning btn-sm"><i class="fas fa-edit"></i> ubah cutoff</a>
                                      @endif
                                    @endforeach
                                  @else
                                  <span class="h4 font-weight-bold mb-0">-</span>
                                  @endif
                                @else
                                <span class="h4 font-weight-bold mb-0">-</span>
                                @endif
                            @else
                              @foreach($drivers as $driver)
                                @if($po->Driver_id == $driver->id)
                                  <input type="hidden" name="driver_id" value="{{$driver->id}}">
                                  <span class="h4 font-weight-bold mb-0">{{$driver->NamaDriver}}</span> 
                                  &nbsp<button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-times"></i>&nbsp Delete Driver</button>
                                @endif
                              @endforeach
                            @endif

                            </span>                       
                        </div>
                        <input type="hidden" name="po_id" value="{{$po->id}}">
                        </form> 
                      </div> 
                      
                      
                      

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                      <div class="col-md-3 mt--1">
                        <div class="form-group">
                          <label class="form-control-label ml-3" for="example3cols1Input">CP/D</label>
                        </div>
                      </div>
                      <div class="col-md-9 mt--1">
                        <div class="form-group">
                          <span>: 
                            @if($po->CP == 'D')
                            <span class="h4 font-weight-bold mb-0">D - Dedicated</span>
                            @else
                            <span class="h4 font-weight-bold mb-0">{{$po->CP}}</span>
                            @endif
                          </span>

                        </div>
                      </div>   

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                      <div class="col-md-3 mt--1">
                        <div class="form-group">
                          <label class="form-control-label ml-3" for="example3cols1Input">Tahun</label>
                        </div>
                      </div>
                      <div class="col-md-9 mt--1">
                        <div class="form-group">
                          <span>:
                            @if(!isset($po->Mobil_id) || $po->Mobil_id == 'null')

                              <span class="h4 font-weight-bold mb-0"> - </span>
                            
                            @else

                              @foreach($mobils as $mobil)
                                @if($po->Mobil_id == $mobil->id)
                                  <span class="h4 font-weight-bold mb-0">{{ date('Y', strtotime($mobil->updated_at))}} </span>
                                @endif
                              @endforeach

                            @endif
                                
                          </span>

                        </div>
                      </div>   

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                      @if(auth::user()->status == 'pengada' || auth::user()->status == 'admin')
                      <div class="col-md-3 mt--1">
                        <div class="form-group">
                          <label class="form-control-label ml-3" for="example3cols1Input">Action</label>
                        </div>
                      </div>
                      <?php 
                        $approve_relokasi = '';
                        $approve_pengurangan = ''; 
                        $approve_perubahan = '';
                      ?>
                      @foreach($approves as $approve)
                        @if($approve->po_id == $po->id && $approve->kategori == 'relokasi')
                          <?php $approve_relokasi = 'waiting'; ?>
                        @endif

                        @if($approve->po_id == $po->id && $approve->kategori == 'pengurangan')
                          <?php $approve_pengurangan = 'waiting'; ?>
                        @endif

                        @if($approve->po_id == $po->id && $approve->kategori == 'perubahan')
                          <?php $approve_perubahan = 'waiting'; ?>
                        @endif
                      @endforeach
                      <div class="col-md-9 mt--1">
                        <div class="form-group">
                          <span>: 
                            @if($po->Sewa_sementara == "null")

                            <a href="{{url('/backend/po/form_relokasi/'.$po->id)}}" class="btn btn-icon btn-sm btn-info ml-1 disabled">
                              <span class="btn-inner--icon"><i class="fas fa-share"></i></span>
                              <span class="btn-inner--text">Relokasi</span>
                            </a>

                            <a class="btn btn-warning btn-sm disabled" href="{{url('/backend/po/form_pengurangan/'.$po->id)}}">
                                <span class="btn-inner--icon"><i class="fas fa-minus"></i></span>
                                <span class="btn-inner--text"> Pengurangan</span>
                            </a>

                            <a class="btn btn-warning btn-icon btn-sm disabled" href="{{url('/backend/po/form_perubahan/'.$po->id)}}">
                                <span class="btn-inner--icon"><i class="fas fa-window-restore"></i></span>
                                <span class="btn-inner--text">Perubahan</span>
                            </a>

                            @else


                              @if($po->status == 1 && $po->SelesaiSewa >= $currentDateTime && $po->Efisien_relokasi != '' && $po->Efisien_relokasi >= $currentDateTime)

                              <div class="dropdown">
                                <a href="#" class="btn btn-info btn-sm dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                                    <i class="fas fa-file-export"></i>&nbsp Relokasi
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                     @foreach($table_template_relokasis as  $table_template_relokasi) 
                                      @if($po->id == $table_template_relokasi->po_id)
                                        @foreach($template_relokasis as $template_relokasi)
                                          @if($template_relokasi->id == $table_template_relokasi->template_id)
                                            @if($table_template_relokasi->tgl_efektif >= $currentDate)
                                              <li>
                                                  <a class="dropdown-item" href="{{url('/backend/po/update/edit_relokasi/'.$template_relokasi->id.'/'.$table_template_relokasi->id)}}">
                                                    <i class="fas fa-pencil-alt"></i> Edit relokasi
                                                  </a>
                                              </li>
                                              <li>
                                                  <a class="dropdown-item" href="{{url('/backend/po/delete/edit_relokasi/'.$po->id.'/'.$template_relokasi->id.'/'.$table_template_relokasi->id)}}">
                                                    <i class="fas fa-times"></i> Cancel relokasi
                                                  </a>
                                              </li>
                                            @endif
                                          @endif
                                        @endforeach
                                      @endif
                                    @endforeach
                                </ul>
                              </div>
                              @else
                                <a href="{{url('/backend/po/form_relokasi/'.$po->id)}}" class="btn btn-sm btn-icon btn-info">
                                  <span class="btn-inner--icon"><i class="fas fa-file-export"></i></span>
                                  <span class="btn-inner--text">Relokasi</span>
                                </a>
                              @endif

                              <!-- ~~~~~~~~~~~~~~~~~ pengurangan ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              @if($po->status == 1 && $po->SelesaiSewa >= $currentDateTime && $po->Tgl_cutoff != '' && $po->Tgl_cutoff >= $currentDateTime && $po->Sewa_sementara == 'null')

                              <div class="dropdown">
                                <a href="#" class="btn btn-danger btn-sm dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                                    <i class="fas fa-file-download"></i>&nbsp Pengurangan
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                     @foreach($table_template_pengurangans as $table_template_pengurangan) 
                                       @if($po->id == $table_template_pengurangan->po_id)
                                         @foreach($template_pengurangans as $template_pengurangan)
                                           @if($template_pengurangan->id == $table_template_pengurangan->template_id)
                                             @if($table_template_pengurangan->tgl_efektif >= $currentDate)
                                              <li>
                                                  <a class="dropdown-item" href="{{url('/backend/po/update/edit_pengurangan/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}">
                                                    <i class="fas fa-pencil-alt"></i> Edit pengurangan
                                                  </a>
                                              </li>
                                              <li>
                                                  <a class="dropdown-item" href="{{url('/backend/po/delete/edit_pengurangan/'.$po->id.'/'.$template_pengurangan->id.'/'.$table_template_pengurangan->id)}}">
                                                    <i class="fas fa-times"></i> Cancel pengurangan
                                                  </a>
                                              </li>
                                              @endif
                                            @endif
                                          @endforeach
                                        @endif
                                      @endforeach
                                    
                                </ul>
                              </div>
                              @else
                                @if($po->Sewa_sementara == 'Driver')
                                <a class="btn btn-danger btn-icon btn-sm" href="{{url('/backend/po/form_pengurangan_damira/'.$po->id)}}">
                                    <span class="btn-inner--icon"><i class="fas fa-file-download"></i></span>
                                    <span class="btn-inner--text">Pengurangan</span>
                                </a>
                                @else
                                <a class="btn btn-danger btn-icon btn-sm" href="{{url('/backend/po/form_pengurangan/'.$po->id)}}">
                                    <span class="btn-inner--icon"><i class="fas fa-file-download"></i></span>
                                    <span class="btn-inner--text">Pengurangan</span>
                                </a>
                                @endif
                              @endif

                              
                              <!-- ~~~~~~~~~~~~~~~~~ pengurangan ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                              @if($po->status == 1 && $po->SelesaiSewa >= $currentDateTime && $po->tgl_efektif_perubahan != '' && $po->tgl_efektif_perubahan >= $currentDate)

                              <div class="dropdown">
                                <a href="#" class="btn btn-warning btn-sm dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                                    <i class="fas fa-file-download"></i>&nbsp Perubahan
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                     @foreach($table_template_perubahans as $table_template_perubahan) 
                                       @if($po->id == $table_template_perubahan->po_id)
                                         @foreach($template_perubahans as $template_perubahan)
                                           @if($template_perubahan->id == $table_template_perubahan->template_id)
                                             @if($table_template_perubahan->tgl_efektif >= $currentDate)
                                              <li>
                                                  <a class="dropdown-item" href="{{url('/backend/po/update/edit_perubahan/'.$template_perubahan->id.'/'.$table_template_perubahan->id)}}">
                                                    <i class="fas fa-pencil-alt"></i> Edit perubahan
                                                  </a>
                                              </li>
                                              <li>
                                                  <a class="dropdown-item" href="{{url('/backend/po/delete/edit_perubahan/'.$po->id.'/'.$template_perubahan->id.'/'.$table_template_perubahan->id)}}">
                                                    <i class="fas fa-times"></i> Cancel perubahan
                                                  </a>
                                              </li>
                                              @endif
                                            @endif
                                          @endforeach
                                        @endif
                                      @endforeach
                                    
                                </ul>
                              </div>
                              @else
                                @if($po->Sewa_sementara == 'Mobil+Driver')
                                <a class="btn btn-warning btn-icon btn-sm" href="{{url('/backend/po/form_perubahan/'.$po->id)}}">
                                    <span class="btn-inner--icon"><i class="fas fa-window-restore"></i></span>
                                    <span class="btn-inner--text">Perubahan</span>
                                </a>
                                @else
                                <a class="btn btn-warning btn-icon btn-sm disabled" href="{{url('/backend/po/form_perubahan/'.$po->id)}}">
                                    <span class="btn-inner--icon"><i class="fas fa-window-restore"></i></span>
                                    <span class="btn-inner--text">Perubahan</span>
                                </a>
                                @endif
                              @endif      
                             

                            @endif
                          </span>
                        </div>
                      </div>  
                      @endif 

                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                    </div>
                  </div>








                  <div class="col-md-4">
                    <div class="row">
                      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label ml-3" for="example3cols1Input">Cabang </label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span>: 
                              @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')

                                
                                  <span class="h5 font-weight-bold mb-0" data-toggle="tooltip" data-placement="top" title="Click to detail">
                                    <a href="#" style="color: black" data-toggle="modal" data-target="#cabang">{{$po->cabang_relokasi->KodeCabang}} - {{$po->cabang_relokasi->NamaCabang}}</a>
                                  </span>
                                

                              @else

                                
                                  <span class="h5 font-weight-bold mb-0" data-toggle="tooltip" data-placement="top" title="Click to detail">
                                    <a href="#" style="color: black" data-toggle="modal" data-target="#cabang">{{$po->cabang->KodeCabang}} - {{$po->cabang->NamaCabang}}</a>
                                  </span>
                                  

                              @endif

                            </span>
                          </div>
                        </div> 

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ --> 

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label ml-3" for="example3cols1Input">Kota</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span>: 
                              @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')

                                @foreach($cabangs as $cabang)
                                  @if($po->Cabang_relokasi == $cabang->id)
                                  <span class="h5 font-weight-bold mb-0" data-toggle="tooltip" data-placement="top" title="Click to detail">
                                    <a href="#" style="color: black" data-toggle="modal" data-target="#cabang">{{$po->cabang_relokasi->Kota}}</a>
                                  </span>

                                  <?php $kota_ump = $cabang->Kota ?>

                                  @endif
                                @endforeach

                              @else

                                @foreach($cabangs as $cabang)
                                  @if($po->Cabang_id == $cabang->id)
                                  <span class="h5 font-weight-bold mb-0" data-toggle="tooltip" data-placement="top" title="Click to detail">
                                    <a href="#" style="color: black" data-toggle="modal" data-target="#cabang">{{$po->cabang->Kota}}</a>
                                  </span>

                                  <?php $kota_ump = $cabang->Kota ?>

                                  @endif
                                @endforeach

                              @endif
                            </span>
                          </div>
                        </div>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label ml-3" for="example3cols1Input">No Register</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span>: {{$po->NoRegister}}</span>
                          </div>
                        </div> 

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->  

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label ml-3" for="example3cols1Input">Vendor</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span>: 
                              @foreach($vendors as $vendor)
                                @if($po->Vendor_Driver == $vendor->id)
                                  <span class="h5 font-weight-bold mb-0" data-toggle="tooltip" data-placement="top" title="Click to detail"><a href="#" style="color: black" data-toggle="modal" data-target="#vendor">{{$vendor->NamaVendor}}</a></span>
                                  <?php $vendor_ump = $vendor->NamaVendor; ?>
                                @endif
                              @endforeach
                            </span>
                          </div>
                        </div>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->  

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label ml-3" for="example3cols1Input">Status</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            : 
                            @if(($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '') || ($po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != ''))
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
                          </div>
                        </div>  

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->  

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-control-label ml-3" for="example3cols1Input">User pengguna</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            : 
                            <i class="fas fa-user"></i> 
                            &nbsp
                            @if($po->UserPengguna == '')
                              - - -
                            @else
                              {{$po->UserPengguna}}
                            @endif
                            &nbsp
                            <a class="btn btn-success btn-sm" href="{{url('/backend/po/userpengguna/edit/'.$po->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                            </a>
                          </div>
                        </div>  

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->  

                        <div class="col-md-12">
                          <div class="form-group">
                            <a href="#" data-toggle="modal" data-target="#timeline" class="btn btn-icon btn-primary ml-3">
                              <span class="btn-inner--icon"><i class="ni ni-calendar-grid-58"></i></span>
                              <span class="btn-inner--text">History Activity</span>
                            </a>
                            <!-- <a href="{{url('/backend/po/show/pdf/'.$po->id)}}" class="btn btn-success"><i class="fas fa-file-pdf"></i> &nbspView PO</a> -->
                          </div>
                        </div> 

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->  

                    </div>
                  </div>
                </div>
                

                
                <!-- <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-control-label ml-3" for="example3cols1Input">Tanggal</label>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <span>: {{$po->MulaiSewa->format('d-M-Y')}}</span>
                    </div>
                  </div>         
                </div> -->
                
                <hr>
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-borderless table-flush text-center" id="myTable">
                    <thead class="bg-default text-white">
                      <tr>
                        <th scope="col">Mulai Sewa</th>
                        <th scope="col">Tgl Bastk</th>
                        <th scope="col">Tgl Bastd</th>
                        <th scope="col">Tgl Relokasi</th>
                        <th scope="col">Tgl Cut Off</th>
                        <th scope="col">Selesai Sewa</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr role="row" class="odd">
                          <td><!-- <a href="#" class="po_tgl" 
                            data-name="mulaisewa" 
                            data-type="date" 
                            data-pk="{{$po->id}}" 
                            data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                            data-title="Masukkan tanggal Mulai Sewa" style="color:black"> -->
                            @if($po->MulaiSewa != '')
                              {{ date('d-M-Y', strtotime($po->MulaiSewa))}}
                            @else
                              
                            @endif
                          </a>
                          </td>
                          <td><!-- <a href="#" class="po_tgl" 
                            data-name="tgl_bastk" 
                            data-type="date" 
                            data-pk="{{$po->id}}" 
                            data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                            data-title="Masukkan tanggal bastk" style="color:black"> -->
                            @if($po->Tgl_bastk != '')
                              {{ date('d-M-Y', strtotime($po->Tgl_bastk))}}
                            @else
                              
                            @endif

                          </td>
                          <td><!-- <a href="#" class="po_tgl" 
                            data-name="tgl_bastd" 
                            data-type="date" 
                            data-pk="{{$po->id}}" 
                            data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                            data-title="Masukkan tanggal bastd" style="color:black"> -->
                            @if($po->Tgl_bastd != '')
                              {{ date('d-M-Y', strtotime($po->Tgl_bastd))}}
                            @else
                              
                            @endif
                          </td>
                          <td><!-- <a href="#" class="po_tgl" 
                            data-name="tgl_bastd" 
                            data-type="date" 
                            data-pk="{{$po->id}}" 
                            data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                            data-title="Masukkan tanggal bastd" style="color:black"> -->
                            @if($po->Efisien_relokasi != '')
                              {{ date('d-M-Y', strtotime($po->Efisien_relokasi))}}
                            @else
                              
                            @endif
                          </td>
                          <td><!-- <a href="#" class="po_tgl" 
                            data-name="tgl_cutoff" 
                            data-type="date" 
                            data-pk="{{$po->id}}" 
                            data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                            data-title="Masukkan tanggal Cut Off" style="color:black"> -->
                            @if($po->Tgl_cutoff != '')
                              {{ date('d-M-Y', strtotime($po->Tgl_cutoff))}}
                            @else
                              
                            @endif
                          </td>
                          <td><!-- <a href="#" class="po_tgl" 
                            data-name="selesaisewa" 
                            data-type="date" 
                            data-pk="{{$po->id}}" 
                            data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                            data-title="Masukkan tanggal selesai sewa" style="color:black"> -->
                            @if($po->SelesaiSewa != '')
                              {{ date('d-M-Y', strtotime($po->SelesaiSewa))}}
                            @else
                              
                            @endif
                          </td>
                        </tr>
                        @if($po->MulaiSewa2 != '' && $po->SelesaiSewa != '')
                        <tr role="row" class="odd">
                          <td><!-- <a href="#" class="po_tgl" 
                            data-name="mulaisewa" 
                            data-type="date" 
                            data-pk="{{$po->id}}" 
                            data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                            data-title="Masukkan tanggal Mulai Sewa" style="color:black"> -->
                            {{ date('d-M-Y', strtotime($po->MulaiSewa2))}} 
                          </td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><!-- <a href="#" class="po_tgl" 
                            data-name="selesaisewa" 
                            data-type="date" 
                            data-pk="{{$po->id}}" 
                            data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                            data-title="Masukkan tanggal selesai sewa" style="color:black"> -->
                            {{ date('d-M-Y', strtotime($po->SelesaiSewa2))}} 
                          </td>
                        </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
                <hr>
                <hr>
                <div class="row">
                  <div class="col-5">
                    <div class="table-responsive">
                      <table class="table align-items-center table-flush text-left " id="myTable">
                        <thead class="bg-default text-white">
                          <tr>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr role="row" class="odd">
                              <td>Harga Sewa Mobil</td>
                              <td><!-- <a href="#" class="tglpo" 
                                data-name="hargasewamobil" 
                                data-type="number" 
                                data-pk="{{$po->id}}" 
                                data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                                data-title="Masukkan Nominal Harga sewa mobil" style="color: black"> -->

                               <!--  @if($po->Efisien_relokasi <= $currentDateTime && $po->Tgl_cutoff)
                                  @currency($po->Hargasewamobil_pengurangan)</a>
                                  <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                                @else
                                  @currency($po->HargaSewaMobil)</a>
                                  <?php $harga_mobil = $po->HargaSewaMobil ?>
                                @endif -->

                                @if($po->Sewa_sementara == 'Mobil+Driver' || $po->Sewa_sementara == 'Mobil')
                                  @if($po->Efisien_relokasi <= $currentDateTime)
                                    @currency($po->Hargasewamobil_pengurangan)</a>
                                    <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                                  @else
                                    @currency($po->HargaSewaMobil)</a>
                                    <?php $harga_mobil = $po->HargaSewaMobil ?>
                                  @endif
                                @elseif($po->Sewa_sementara == 'null' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                                  @if($po->Efisien_relokasi <= $currentDateTime)
                                    @currency($po->Hargasewamobil_pengurangan)</a>
                                    <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                                  @else
                                    @currency($po->HargaSewaMobil)</a>
                                    <?php $harga_mobil = $po->HargaSewaMobil ?>
                                  @endif
                                @elseif($po->Sewa_sementara == 'Driver' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                                  @if($po->Efisien_relokasi <= $currentDateTime)
                                    @currency($po->Hargasewamobil_pengurangan)</a>
                                    <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                                  @else
                                    @currency($po->HargaSewaMobil)</a>
                                    <?php $harga_mobil = $po->HargaSewaMobil ?>
                                  @endif
                                @else
                                  @if($po->Efisien_relokasi <= $currentDateTime)
                                    @currency($po->Hargasewamobil_pengurangan)</a>
                                    <?php $harga_mobil = $po->Hargasewamobil_pengurangan ?>
                                  @else
                                    @currency($po->HargaSewaMobil)</a>
                                    <?php $harga_mobil = $po->HargaSewaMobil ?>
                                  @endif

                                  @if($harga_mobil == '0')
                                  @else
                                    <span class="text-danger">(CUT OFF)</span>
                                    <?php $cutoff_mobil = 'yes' ?>
                                  @endif
                                  
                                  
                                @endif

                              </td>
                            </tr>
                            @if(isset($po->bbm))
                            <tr role="row" class="odd">
                              <td>BBM (Liter)</td>
                              <td>

                                  
                                    {{$po->bbm}} Liter ({{$po->jenis_bbm}})
                                  

                                  @if($cutoff_mobil == 'yes')
                                    <span class="text-danger">(CUT OFF)</span>
                                  @endif
                                  
                                  
                               

                              </td>
                            </tr>
                            @endif
                            <tr>
                              <td>Harga Sewa Driver (include) - PPN 10%</td>
                              <td><!-- <a href="#" class="tglpo" 
                                data-name="hargasewadriver2019" 
                                data-type="number" 
                                data-pk="{{$po->id}}" 
                                data-url="/api/backend/po/tgl/update/{{$po->id}}" 
                                data-title="Masukkan Nominal Harga sewa driver" style="color: black"> -->
                                @if($po->Sewa_sementara == 'Mobil+Driver' || $po->Sewa_sementara == 'Driver')
                                  @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '' || $po->Tgl_cutoff <= $currentDateTime && $po->Tgl_cutoff != '')
                                    @currency($po->Hargasewadriver_relokasi)</a>
                                    <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                                  @else
                                    @currency($po->HargaSewaDriver2019)</a>
                                    <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                                  @endif
                                @elseif($po->Sewa_sementara == 'null' && $po->Sewa == 'Mobil' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                                  @currency(0)
                                  <?php $harga_driver = 0;  ?>
                                @elseif($po->Sewa_sementara == 'null' && $po->Sewa == 'Driver' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                                  @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')
                                    @currency($po->Hargasewadriver_relokasi)</a>
                                    <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                                  @else
                                    @currency($po->HargaSewaDriver2019)</a>
                                    <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                                  @endif
                                @elseif($po->Sewa_sementara == 'null' && $po->Sewa == 'Mobil+Driver' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                                  @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')
                                    @currency($po->Hargasewadriver_relokasi)</a>
                                    <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                                  @else
                                    @currency($po->HargaSewaDriver2019)</a>
                                    <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                                  @endif
                                @elseif($po->Sewa_sementara == 'Mobil' && $po->Tgl_cutoff >= $currentDateTime && $po->Tgl_cutoff != '')
                                  @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')
                                    @currency($po->Hargasewadriver_relokasi)</a>
                                    <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                                  @else
                                    @currency($po->HargaSewaDriver2019)</a>
                                    <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                                  @endif
                                @else
                                  
                                  
                                  @if($po->Efisien_relokasi <= $currentDateTime && $po->Efisien_relokasi != '')
                                    @currency($po->Hargasewadriver_relokasi)</a>
                                    <?php $harga_driver = $po->Hargasewadriver_relokasi ?>
                                  @else
                                    @currency($po->HargaSewaDriver2019)</a>
                                    <?php $harga_driver = $po->HargaSewaDriver2019 ?>
                                  @endif

                                  @if($harga_driver == '0')
                                  @else
                                    <span class="text-danger">(CUT OFF)</span>
                                    <?php $cutoff_driver = 'yes' ?>
                                  @endif
                                  
                                @endif

                              <!--   @if($po->Tgl_cutoff <= $currentDateTime)
                                  - 1
                                @elseif($po->Tgl_cutoff >= $currentDateTime)
                                  - 2
                                @endif -->

                              </td>
                              <td>
                            </tr>
                            <tr style="background-color: red; color: white"> 
                              <td>Harga Sewa Driver (eksclude) - PPN 10%</td>
                              <td>
                                @if($po->Sewa_sementara == 'Mobil+Driver' || $po->Sewa_sementara == 'Driver')
                                  @foreach($harga_umps as $harga_ump)
                                    @if($harga_ump->Kota_id == $kota_ump && $harga_ump->Vendor_id == $vendor_ump && $harga_ump->activated == 1)
                                      @currency($harga_ump->Harga_eksclude)
                                    @endif
                                  @endforeach
                                @elseif($harga_driver == 0)
                                  @currency(0)
                                @else
                                  @foreach($harga_umps as $harga_ump)
                                    @if($harga_ump->Kota_id == $kota_ump && $harga_ump->Vendor_id == $vendor_ump && $harga_ump->activated == 1)
                                      @currency($harga_ump->Harga_eksclude) 
                                    @endif
                                  @endforeach
                                @endif

                                @if($cutoff_driver == 'yes')
                                  <span class="text-white">(CUT OFF)</span>
                                @endif
                              </td>
                            </tr>
                            <tr style="background-color: yellow">
                              <td>Harga Sewa Mobil + Driver (include)</td>
                              <td>
                                <?php $hsmd = $harga_mobil + $harga_driver ?>
                                @currency($hsmd)

                                @if($cutoff_mobil == 'yes' && $cutoff_driver == 'yes')
                                  <span class="text-danger">(CUT OFF)</span>
                                @endif
                              </td>
                            </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center table-flush text-center" id="myTable">
                        <thead class="bg-default text-white">
                          <tr>
                            <th scope="col">Service</th>
                            <th scope="col">Salon</th>
                            <th scope="col">MCU & Seragam</th>
                            <th scope="col">Relokasi</th>
                            <th scope="col">Jenis Sewa</th>
                            <th scope="col">Mobil</th>
                            <th scope="col">Driver</th>
                            <th scope="col">Detail Cabang</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr role="row" class="odd">                              

                                <td>
                                  
                                  <a href="{{url('/backend/po/service/'.$po->id)}}" class="btn btn-sm btn-dark"><i class="ni ni-settings"></i>&nbsp Detail Service</a>
          
                                </td>

                                <td>
                                  
                                  <a href="{{url('/backend/po/salon/'.$po->id)}}" class="btn btn-sm btn-dark"><i class="ni ni-settings"></i>&nbsp Detail Salon </a>
                                  
                                </td>

                                <td>
                                  
                                    <a href="{{url('/backend/po/mcu/'.$po->id)}}" class="btn btn-sm btn-dark"><i class="ni ni-settings"></i>&nbsp Detail MCU & Seragam</a>
                                  
                                </td>

                              

                                <!-- <form action="/backend/po/service/add/{{ $po->id }}" method="post">
                                {{ csrf_field() }}
                                  <td>
                                    <input type="hidden" name="po_id" value="{{$po->id}}">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp service  </button>
                                  </td>
                                  <td>
                                    <input type="hidden" name="po_id" value="{{$po->id}}">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp MCU </button>
                                  </td>
                                </form>
 -->
                              


                              <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#relokasi"><i class="fas fa-clock"></i>&nbsp History Relokasi</a>
                              </td>
                              <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#pengurangan"><i class="fas fa-clock"></i>&nbsp History Sewa</a>
                              </td>
                              <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#type"><i class="fas fa-clock"></i>&nbsp History Mobil</a>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#nopol"><i class="fas fa-clock"></i>&nbsp History Nopol</a>
                              </td>

                              <td>

                                    
                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#history_driver"><i class="fas fa-user-tie"></i>&nbsp History Driver</a>
                                    
                                  
                              </td>
                              <td>
                                <a href="#" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#cabang"><i class="fas fa-building"></i>&nbsp Detail Cabang</a>
                              </td>                             
                            </tr>
                        </tbody>
                      </table>
                  </div>

                </div>
                
              </div>
            </div>

            


            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-danger">
                    Apakah anda yakin ingin menghapus data {{$page}} ini. Jika data sudah dihapus tidak dapat dikembalikan lagi.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-danger" href="{{url('/backend/po/delete/'.$po->id)}}">
                        <i class="fas fa-trash"></i> &nbspDelete PO
                    </a>
                  </div>
                </div>
              </div>
            </div>


@include('PO.modal.modal_kota')
@include('PO.modal.modal_mobil')
@include('PO.modal.modal_driver')
@include('PO.modal.modal_history_driver')
@include('PO.modal.modal_vendor')
@include('PO.modal.modal_pengurangan')
@include('PO.modal.modal_cabang_detail')
@include('PO.modal.modal_history_mobil')
@include('PO.modal.modal_history_nopol')
@include('PO.modal.modal_cabang')
@include('PO.modal.modal_timeline')

@endsection
             
        