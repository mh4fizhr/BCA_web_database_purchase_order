<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  
  <title>BCA - Pengadaan Mobil</title>
  <!-- Favicon -->
  <link rel="icon" href="{{asset('/dist/img/BCA-logo.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  
  <!-- Page plugins -->
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/animate.css/animate.min.css')}}">

  <link rel="stylesheet" href="{{asset('dist/argon/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/select2/dist/css/select2.min.css')}}">
  <!--   <link rel="stylesheet" href="{{asset('dist/argon/vendor/sweetalert2/dist/sweetalert2.min.css')}}"> -->

  




  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{asset('dist/argon/css/argon.css?v=1.2.0')}}" type="text/css">
  <!-- <link href="{{asset('dist/bootstrap4-editable/css/bootstrap-editable.css')}}" rel="stylesheet"> -->
<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/@fortawesome/fontawesome-free/font-awesome.min.css')}}">

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body class="g-sidenav-show g-sidenav-pinned">
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  d-flex  align-items-center">
              <a class="navbar-brand" href="{{url('/backend/dashboard')}}">
                <img src="{{asset('dist/argon/img/BCA-logo4.png')}}"
                     alt="AdminLTE Logo"
                     class="brand-image elevation-2"
                     style="opacity: .9">
                <span class="brand-text h3 text-primary"></b></span>
              </a>
            
            </div>
      
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->

          <hr class="my-3 mt--3">
          @if(auth::user()->status != 'admin')
          <!-- Heading -->
<!--           <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">View Area</span>
          </h6> -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{url('/backend/dashboard')}}" class="nav-link <?php if($page == "Dashboard" || $page == "Service" || $page == "mcu") echo "active";?>" >
                  <i class="fas fa-tv nav-icon"></i>
                  <span>Database</span>
              </a>
            </li>

            @if(auth::user()->status != 'operasional2')
            <li class="nav-item">
              <a href="{{url('/backend/po/table')}}" class="nav-link <?php if($page == "DPO" || $page == "Penambahan" || $page == "Pengurangan" || $page == "Relokasi" || $page == "Perubahan") echo "active";?>" >
                  <i class="ni ni-paper-diploma nav-icon"></i>
                  <span>Purchase Order - 
                    @if(auth::user()->status == 'pengada')
                      BPD
                    @elseif(auth::user()->status == 'operasional')
                      BOP
                    @elseif(auth::user()->status == 'blk')
                      BLK
                    @endif
                  </span>
              </a>
            </li>
            @endif

            @if(auth::user()->status == 'pengada' || auth::user()->status == 'operasional')
            <li class="nav-item">
              <a href="{{url('/backend/driver')}}" class="nav-link <?php if($page == "Driver") echo "active";?>" >
                  <i class="fa fa-user-tie nav-icon"></i>
                  <span >Driver</span>
              </a>
            </li>
            @endif

          </ul>

            @if(auth::user()->status == 'pengada' || auth::user()->status == 'operasional')
              <hr class="my-3">
              <!-- Heading -->
              <h6 class="navbar-heading p-0 text-muted">
                <span class="docs-normal">Database</span>
              </h6>

              <ul class="navbar-nav">

                <li class="nav-item">
                  <a href="{{url('/backend/cabang')}}" class="nav-link <?php if($page == "Cabang") echo "active";?>" >
                      <i class="fa fa-building nav-icon"></i>
                      <span>Cabang</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link <?php if($page == "Mobil") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms7" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "Mobil") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms7">
                    <i class="fas fa-car"></i>
                    <span class="nav-link-text">Mobil</span>
                  </a>
                  <div class="collapse <?php if($page == "Mobil") echo 'show'; ?>" id="navbar-forms7" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a href="{{url('/backend/mobil')}}" class="nav-link">
                          <i class="fas fa-car-side nav-icon"></i>
                          <span>Merek & type mobil</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/mobil2/tahun')}}" class="nav-link">
                          <i class="fas fa-calendar nav-icon"></i>
                          <span>Tahun mobil</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/bbm')}}" class="nav-link">
                          <i class="fas fa-gas-pump nav-icon"></i>
                          <span>BBM</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="nav-item">
                  <a href="{{url('/backend/cp')}}" class="nav-link <?php if($page == "Carpooling") echo "active";?>" >
                      <i class="fa fa-map-marker-alt nav-icon"></i>
                      <span>Carpooling</span>
                  </a>
                </li>

                <li class="nav-item">

                  <a class="nav-link <?php if($page == "UMP") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "UMP") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms">
                    <i class="ni ni-single-copy-04 "></i>
                    <span class="nav-link-text">UMP</span>
                  </a>
                  <div class="collapse <?php if($page == "UMP") echo 'show'; ?>" id="navbar-forms" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a href="{{url('/backend/ump/harga_ump')}}" class="nav-link">
                          <i class="fas fa-money-bill-wave nav-icon"></i>
                          <span>Harga ump</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/ump/jkk')}}" class="nav-link ">
                          <i class="fas fa-percent nav-icon"></i>
                          <span>Jkk</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/ump/kota')}}" class="nav-link">
                          <i class="fas fa-map-marker-alt nav-icon"></i>
                          <span>Kota</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/ump/tahun')}}" class="nav-link ">
                          <i class="fas fa-calendar nav-icon"></i>
                          <span>Tahun</span>
                        </a>
                      </li>
                      <!-- <li class="nav-item">
                        <a href="{{url('/backend/vendor')}}" class="nav-link">
                          <i class="ni ni-building nav-icon"></i>
                          <span>Vendor</span>
                        </a>
                      </li> -->
                    </ul>
                  </div>
                </li>

                <li class="nav-item">
                  <a href="{{url('/backend/vendor')}}" class="nav-link <?php if($page == "Vendor") echo "active";?>" >
                      <i class="ni ni-building nav-icon"></i>
                          <span>Vendor</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link <?php if($page == "Pejabat") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms17" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "Pejabat") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms17">
                    <i class="fas fa-briefcase"></i>
                    <span class="nav-link-text">Pejabat</span>
                  </a>
                  <div class="collapse <?php if($page == "Pejabat") echo 'show'; ?>" id="navbar-forms17" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a href="{{url('/backend/pejabat')}}" class="nav-link">
                          <i class="fas fa-user-tie nav-icon"></i>
                          <span>Pejabat</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/pejabat/jabatan')}}" class="nav-link">
                          <i class="fas fa-award nav-icon"></i>
                          <span>Jabatan</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/pejabat/unitkerja')}}" class="nav-link">
                          <i class="fas fa-map-pin"></i>
                          <span>Unit kerja</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="nav-item">
                  <a href="{{url('/backend/addendum')}}" class="nav-link <?php if($page == "pks") echo "active";?>" >
                      <i class="fas fa-file-contract nav-icon"></i>
                          <span>PKS / addendum</span>
                  </a>
                </li>

                <!-- <li class="nav-item">
                  <a class="nav-link <?php if($page == "pks") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms29" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "pks") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms29">
                    <i class="fas fa-file-powerpoint"></i>
                    <span class="nav-link-text">PKS</span>
                  </a>
                  <div class="collapse <?php if($page == "pks") echo 'show'; ?>" id="navbar-forms29" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a href="{{url('/backend/pks')}}" class="nav-link">
                          <i class="fas fa-file-contract nav-icon"></i>
                          <span>PKS</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/addendum')}}" class="nav-link">
                          <i class="fas fa-file-contract nav-icon"></i>
                          <span>Addendum</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li> -->

              </ul>

              <hr class="my-3">
              <!-- Heading -->
              <h6 class="navbar-heading p-0 text-muted">
                <span class="docs-normal">Surat</span>
              </h6>
              <?php 
              $template_relokasi = App\template_relokasi::where('status',null)->count();
              $template_pengurangan = App\template_pengurangan::where('status',null)->count(); 
              $template_perubahan  = App\template_perubahan::where('status',null)->count();
              $total = $template_relokasi+$template_pengurangan+$template_perubahan;
              ?>
              <ul class="navbar-nav">

                <li class="nav-item">
                  <a class="nav-link <?php if($page == "Surat") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms92" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "Surat") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms92">
                    <i class="fas fa-file-signature"></i>
                    <span class="nav-link-text">Surat</span>
                    @if($total != 0)
                    &nbsp&nbsp<span class="badge badge-sm badge-floating badge-warning border-white">{{$total}}</span>
                    @endif
                  </a>
                  <div class="collapse <?php if($page == "Surat") echo 'show'; ?>" id="navbar-forms92" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a href="{{url('/backend/surat/relokasi')}}" class="nav-link">
                          <i class="fas fa-file-contract nav-icon"></i>
                          <span>Surat relokasi</span>
                          @if($template_relokasi != 0)
                          &nbsp&nbsp<span class="badge badge-sm badge-floating badge-danger border-white">{{$template_relokasi}}</span>
                          @endif
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/surat/pengurangan')}}" class="nav-link">
                          <i class="fas fa-file-contract nav-icon"></i>
                          <span>Surat cut off</span>
                          @if($template_pengurangan != 0)
                          &nbsp&nbsp<span class="badge badge-sm badge-floating badge-danger border-white">{{$template_pengurangan}}</span>
                          @endif
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/surat/perubahan')}}" class="nav-link">
                          <i class="fas fa-file-contract"></i>
                          <span>Surat perubahan data pairing</span>
                          @if($template_perubahan != 0)
                          &nbsp&nbsp<span class="badge badge-sm badge-floating badge-danger border-white">{{$template_perubahan}}</span>
                          @endif
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

              </ul>

              <hr class="my-3">
              <!-- Heading -->
              <h6 class="navbar-heading p-0 text-muted">
                <span class="docs-normal">Report database</span>
              </h6>

              <ul class="navbar-nav">
                

                <li class="nav-item">
                  <a href="{{url('/backend/report/all')}}" class="nav-link <?php if($page == "Report") echo "active";?>" >
                      <i class="fa fa-file-archive nav-icon"></i>
                      <span>Report</span>
                  </a>
                </li>

              </ul>
            @endif

            @if(auth::user()->status == 'blk')

            <hr class="my-3">
              <!-- Heading -->
              <h6 class="navbar-heading p-0 text-muted">
                <span class="docs-normal">Surat</span>
              </h6>

              <ul class="navbar-nav">

                <li class="nav-item">
                  <a class="nav-link <?php if($page == "Surat") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms92" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "Surat") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms92">
                    <i class="fas fa-file-signature"></i>
                    <span class="nav-link-text">Surat</span>
                  </a>
                  <div class="collapse <?php if($page == "Surat") echo 'show'; ?>" id="navbar-forms92" style="">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a href="{{url('/backend/surat/relokasi')}}" class="nav-link">
                          <i class="fas fa-file-contract nav-icon"></i>
                          <span>Surat relokasi</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/surat/pengurangan')}}" class="nav-link">
                          <i class="fas fa-file-contract nav-icon"></i>
                          <span>Surat cut off</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('/backend/surat/perubahan')}}" class="nav-link">
                          <i class="fas fa-file-contract"></i>
                          <span>Surat perubahan data pairing</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

              </ul>
              @endif

            
          <!-- <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Data Area</span>
          </h6>

          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link <?php if($page == "Backup") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms3" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "Backup") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms3">
                <i class="fas fa-cogs "></i>
                <span class="nav-link-text">Backup Restore data</span>
              </a>
              <div class="collapse <?php if($page == "Backup") echo 'show'; ?>" id="navbar-forms3" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/backend/backup" class="nav-link">
                      <i class="fas fa-download nav-icon"></i>
                      <span>Backup</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/backend/restore" class="nav-link">
                      <i class="fas fa-upload nav-icon"></i>
                      <span>Restore</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul> -->
          @endif
          @if(auth::user()->status == 'admin')
          
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Super Admin</span>
          </h6>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{url('/backend/dashboard')}}" class="nav-link <?php if($page == "Dashboard" || $page == "Service" || $page == "mcu") echo "active";?>" >
                  <i class="fas fa-database nav-icon"></i>
                  <span>DB Purchase Order</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($page == "db_driver") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms3" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "db_driver") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms3">
                <i class="fas fa-database"></i>
                <span class="nav-link-text">DB Driver</span>
              </a>
              <div class="collapse <?php if($page == "db_driver") echo 'show'; ?>" id="navbar-forms3" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/driver')}}" class="nav-link">
                      <i class="fas fa-user-tie nav-icon"></i>
                      <span>Driver</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/pkwt')}}" class="nav-link">
                      <i class="fas fa-calendar nav-icon"></i>
                      <span>PKWT</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/driver')}}" class="nav-link">
                      <i class="fas fa-clock nav-icon"></i>
                      <span>History</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a href="{{url('/backend/admin/cp')}}" class="nav-link <?php if($page == "db_cp") echo "active";?>" >
                  <i class="fa fa-database nav-icon"></i>
                  <span>Carpooling</span>
              </a>
            </li>

<!-- 
            <li class="nav-item">
              <a href="{{url('/backend/admin/driver')}}" class="nav-link <?php if($page == "db_driver") echo "active";?>" >
                  <i class="fas fa-database nav-icon"></i>
                  <span>DB Driver</span>
              </a>
            </li> -->

            <li class="nav-item">
              <a href="{{url('/backend/admin/cabang')}}" class="nav-link <?php if($page == "db_cabang") echo "active";?>" >
                  <i class="fas fa-database nav-icon"></i>
                  <span>DB Cabang</span>
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link <?php if($page == "db_mobil") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms14" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "db_mobil") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms14">
                <i class="fas fa-database"></i>
                <span class="nav-link-text">DB Mobil</span>
              </a>
              <div class="collapse <?php if($page == "db_mobil") echo 'show'; ?>" id="navbar-forms14" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/mobil')}}" class="nav-link">
                      <i class="fas fa-user-tie nav-icon"></i>
                      <span>Type & merek mobil</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/tahun_mobil')}}" class="nav-link">
                      <i class="fas fa-calendar nav-icon"></i>
                      <span>Tahun mobil</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/bbm')}}" class="nav-link">
                      <i class="fas fa-gas-pump nav-icon"></i>
                      <span>BBM</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($page == "db_pejabat") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms11" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "db_pejabat") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms11">
                <i class="fas fa-database"></i>
                <span class="nav-link-text">DB pejabat</span>
              </a>
              <div class="collapse <?php if($page == "db_pejabat") echo 'show'; ?>" id="navbar-forms11" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/pejabat')}}" class="nav-link">
                      <i class="fas fa-user-tie nav-icon"></i>
                      <span>Pejabat</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/jabatan')}}" class="nav-link">
                      <i class="fas fa-award nav-icon"></i>
                      <span>Jabatan</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/unitkerja')}}" class="nav-link">
                      <i class="fas fa-gas-pump nav-icon"></i>
                      <span>Unit kerja</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($page == "db_pks") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms19" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "db_pks") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms19">
                <i class="fas fa-database"></i>
                <span class="nav-link-text">DB pks</span>
              </a>
              <div class="collapse <?php if($page == "db_pks") echo 'show'; ?>" id="navbar-forms19" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/pks')}}" class="nav-link">
                      <i class="fas fa-file-powerpoint nav-icon"></i>
                      <span>PKS</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/addendum')}}" class="nav-link">
                      <i class="fas fa-file-contract nav-icon"></i>
                      <span>Addendum</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($page == "db_hargaump") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms4" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "db_hargaump") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms4">
                <i class="fas fa-database"></i>
                <span class="nav-link-text">DB UMP</span>
              </a>
              <div class="collapse <?php if($page == "db_hargaump") echo 'show'; ?>" id="navbar-forms4" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/harga_ump')}}" class="nav-link">
                      <i class="fas fa-money-bill-wave nav-icon"></i>
                      <span>Harga Ump</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/jkk')}}" class="nav-link">
                      <i class="fas fa-percent nav-icon"></i>
                      <span>Jkk</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/kota')}}" class="nav-link">
                      <i class="fas fa-map-marker-alt nav-icon"></i>
                      <span>Kota</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/tahun')}}" class="nav-link">
                      <i class="fas fa-calendar nav-icon"></i>
                      <span>Tahun</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/vendor')}}" class="nav-link">
                      <i class="ni ni-building nav-icon"></i>
                      <span>Vendor</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($page == "db_surat") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms22" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "db_surat") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms22">
                <i class="fas fa-database"></i>
                <span class="nav-link-text">DB surat</span>
              </a>
              <div class="collapse <?php if($page == "db_surat") echo 'show'; ?>" id="navbar-forms22" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/surat/relokasi')}}" class="nav-link">
                      <i class="fas fa-file-export nav-icon"></i>
                      <span>Surat relokasi</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/surat/pengurangan')}}" class="nav-link">
                      <i class="fas fa-file-download nav-icon"></i>
                      <span>Surat cutoff</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/surat/perubahan')}}" class="nav-link">
                      <i class="fas fa-window-restore nav-icon"></i>
                      <span>Surat perubahan</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php if($page == "db_report") echo 'active'; else echo 'collapsed'; ?>" href="#navbar-forms41" data-toggle="collapse" role="button" aria-expanded="<?php if($page == "db_report") echo 'true'; else echo 'false'; ?>" aria-controls="navbar-forms41">
                <i class="fas fa-database"></i>
                <span class="nav-link-text">DB Report</span>
              </a>
              <div class="collapse <?php if($page == "db_report") echo 'show'; ?>" id="navbar-forms41" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/report_database')}}" class="nav-link">
                      <i class="fas fa-database nav-icon"></i>
                      <span>Database</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/report_service')}}" class="nav-link">
                      <i class="fas fa-tools nav-icon"></i>
                      <span>Service</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/report_salon')}}" class="nav-link">
                      <i class="fas fa-car nav-icon"></i>
                      <span>Salon</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/report_mcu')}}" class="nav-link">
                      <i class="fas fa-tshirt nav-icon"></i>
                      <span>Seragam & MCU</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/backend/admin/report_driver')}}" class="nav-link">
                      <i class="fas fa-user-tie nav-icon"></i>
                      <span>Driver</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

             <li class="nav-item">
              <a href="{{url('/backend/admin/user')}}" class="nav-link <?php if($page == "User") echo "active";?>">
                  <i class="ni ni-circle-08 nav-icon"></i>
                  <span>User <b></b></span>
              </a>
            </li>

          </ul>
          @endif






          <!-- <hr class="my-3">

          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">On Maintanance</span>
          </h6>

          <ul class="navbar-nav">

            <li class="nav-item">
              <a href="{{url('/backend/service')}}" class="nav-link <?php if($page == "Service") echo "active";?>">
                  <i class="ni ni-settings text-info nav-icon"></i>
                  <span>Service <b>(on maintanace)</b></span>
              </a>
            </li>
          </ul> -->
          <!-- Divider -->
          <!-- <hr class="my-3">
  
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Documentation</span>
          </h6>
    
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">Getting started</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">
                <i class="ni ni-palette"></i>
                <span class="nav-link-text">Foundation</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html" target="_blank">
                <i class="ni ni-ui-04"></i>
                <span class="nav-link-text">Components</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                <i class="ni ni-chart-pie-35"></i>
                <span class="nav-link-text">Plugins</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active active-pro" href="upgrade.html">
                <i class="ni ni-send text-dark"></i>
                <span class="nav-link-text">Upgrade to PRO</span>
              </a>
            </li>
          </ul> -->
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  




  @include('navbar')
  
  @yield('content')

  @include('footer')
  
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8"></div>
    <div class="col-md-2"></div>
  </div>