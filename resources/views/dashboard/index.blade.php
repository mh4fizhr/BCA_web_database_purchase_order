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


                <a href="{{url('/backend/export/database')}}" class="btn btn-success float-right pull-right">
                  <i class="fa fa-file-excel"></i> &nbspExport to excel
                </a>
              
            </div>
          </div>
          
          
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
                      <h3 class="mb-0 text-uppercase d-inline-block"><li class="ni ni-paper-diploma"></li> &nbspPurchase Order </h3>

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
                      <!-- <div class="dropdown float-right">
                        <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Status
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="{{url('/backend/dashboard')}}">All</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" id="active" href="{{url('/backend/po/filter/status/active')}}">Active</a>
                          <a class="dropdown-item" id="not_active" href="{{url('/backend/po/filter/status/notactive')}}">Not Active</a>
                        </div>
                      </div> -->
                      <div class="float-right">
                       <!--  <select class="form-control form-control-sm" id="status_active" style="width: 150px">
                            <option value="">Status : All</option>
                            <option value="active">Status : active</option>
                            <option value="outstanding">Status : outstanding</option>
                            <option value="not active">Status : non active</option>
                        </select> -->
                      </div>
                      <!-- <div class="form-group">
                          <select class="form-control status" id="exampleFormControlSelect1">
                            <option>Active</option>
                            <option>Non Active</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div> -->
                    </div>
                    <!-- <div class="col text-right">
                      <a href="/backend/po/table" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#filter" data-whatever="@getbootstrap"><i class="fas fa-filter"></i>&nbsp
                        Filter</a>
                    </div> -->
                  </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                      <div class=" table-hover  mb-3">
                        <table id="myTable" class="table table-responsive align-items-center table-flush text-center yajra-datatable" style="width:100%" nowrap>
                          <thead class="thead-light" style="height: 70px">
                            <tr>
                              <th scope="col" ><b>ID</b></th>
                              <th scope="col" ><b>No PO</b></th>
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
                              <!-- <tr>
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></th>
                                  <td></td>
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></th>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100%" /></th>
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100%" /></th>
                                  <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100%" /></th>
                              </tr> -->
                          </thead>
                          <tbody>
                          
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

    // $(document).ready(function() {
    //     // Setup - add a text input to each footer cell
    //     $('#myTable tfoot th').each( function () {
    //         var title = $('#myTable thead th').eq( $(this).index() ).text();
    //         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    //     } );
      
    //     // DataTable
    //     var table = $('#myTable').DataTable( {
    //         colReorder: true
    //     } );
          
    //     // Apply the filter
    //     $("#myTable tfoot input").on( 'keyup change', function () {
    //         table
    //             .column( $(this).parent().index()+':visible' )
    //             .search( this.value )
    //             .draw();
    //     });
    // } );

    // $(document).ready(function() {
    //     // Setup - add a text input to each footer cell
    //     $('#myTable thead tr').clone(true).appendTo( '#myTable thead' );
    //     $('#myTable thead tr:eq(1) th').each( function (i) {
    //         var title = $(this).text();
    //         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
     
    //         $( 'input', this ).on( 'keyup change', function () {
    //             if ( table.column(i).search() !== this.value ) {
    //                 table
    //                     .column(i)
    //                     .search( this.value )
    //                     .draw();
    //             }
    //         } );
    //     } );
     
    //     var table = $('#myTable').DataTable( {
    //         orderCellsTop: true,
    //         fixedHeader: true
    //     } );
    // } );

  </script>
    <!-- <script type="text/javascript">
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
    </script> -->
    <script type="text/javascript">
      $(function () {
        
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            // "ordering": false,
            "order": [[ 0, "desc" ]],
            language: {
                   paginate: {
                   next: '<i class="fas fa-angle-right">',
                   previous: '<i class="fas fa-angle-left">'  
                    }
                 },
            ajax: '{{ route('json_po') }}',
            columns:[
                {data:'id', name:'id', searchable:false},
                {data:'NoPo', name:'NoPo',className: 'text-left'},
                {data:'Sewa', name:'Sewa',className: 'text-left'},
                {data:'CP', name:'CP',className: 'text-left'},
                {data:'Mobil_id', name:'mobil.MerekMobil',className: 'text-left'},
                {data:'Nopol',  name:'Nopol',className: 'text-left'},
                {data:'Vendor_Driver',  name:'vendor.KodeVendor',className: 'text-left'},
                {data:'Cabang_id',  name:'cabang.NamaCabang',className: 'text-left'},
                {data:'Kota', name:'cabang.Kota',className: 'text-left'},
                {data:'Driver_id',  name:'driver.NamaDriver'},
                {data:'Nip',  name:'driver.nip'},
                {data:'UserPengguna',  name:'UserPengguna'},
                {data:'status_po',  name:'status_po'},
                {data:'created_at',  name:'created_at'},
                {data:'created_by',  name:'user.name'},
                {data:'lihat_detail',  name:'lihat_detail'},
            ],
        });

        // $('#status_po').change(function(){

        //     table.draw();

        // });

        $('.yajra-datatable thead td').each( function () {
            var title = $('.yajra-datatable thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="form-control form-control-sm" placeholder="'+title+'" style="min-width:100px" />' );
            // $(this).html( '<input type="text" placeholder="" style="width:100%" />' );
        } );

        // Apply the filter
        $(".yajra-datatable thead input[type='text']").on( 'keyup', function () {
            table
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
        });

        $(".yajra-datatable thead select").on( 'change', function () {
            table
                .column( $(this).parent().index()+':visible' )
                // .search( this.value )
                .search( this.value ? '^'+this.value+'$' : '', true, false)
                // .data().unique().sort().each( function ( d, j ) {
                //     select.append( '<option value="'+d+'">'+d+'</option>' )
                // })
                .draw();
        });

        $("#status_active").on( 'change', function () {
            table
                .column( 12 )
                .search( this.value )
                // .data().unique().sort().each( function ( d, j ) {
                //     select.append( '<option value="'+d+'">'+d+'</option>' )
                // })
                .draw();
        });
        
      });
    </script>

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






    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Browser market shares in January, 2018'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Chrome',
                y: 61.41,
                sliced: true,
                selected: true
            }, {
                name: 'Internet Explorer',
                y: 11.84
            }, {
                name: 'Firefox',
                y: 10.85
            }, {
                name: 'Edge',
                y: 4.67
            }, {
                name: 'Safari',
                y: 4.18
            }, {
                name: 'Other',
                y: 7.05
            }]
        }]
    });

    </script>
    <script>
    // $(document).ready(function(){
     
    //  fetch_data();
     
    //  function fetch_data(nopoID = '')
    //  {
    //   $('#product_table').DataTable({
    //    processing: true,
    //    serverSide: true,
    //    ajax:{
    //        url: "/backend/nopol/filter/ajax",
    //        data:{"_token": "{{ csrf_token() }}",nopol:nopolID},
    //    },
    //    columns:[
    //             {
    //                 data:'NoPo',
    //                 name:'NoPo'
    //             },
    //             {
    //                 data:'Sewa',
    //                 name:'Sewa'
    //             },
    //             {
    //                 data:'CP',
    //                 name:'CP'
    //             },
    //             {
    //                 data:'Mobil_id',
    //                 name:'Mobil_id'
    //             },
    //             {
    //                 data:'Nopol',
    //                 name:'Nopol'
    //             },
    //             {
    //                 data:'Vendor_Driver',
    //                 name:'Vendor_Driver'
    //             },
    //             {
    //                 data:'Cabang_id',
    //                 name:'Cabang_id'
    //             },
    //             {
    //                 data:'Kota',
    //                 name:'Cabang_id'
    //             },
    //             {
    //                 data:'Driver_id',
    //                 name:'Driver_id'
    //             },
    //             {
    //                 data:'MulaiSewa',
    //                 name:'MulaiSewa'
    //             },
    //             {
    //                 data:'Tgl_bastk',
    //                 name:'Tgl_bastd'
    //             },
    //             {
    //                 data:'Tgl_relokasi',
    //                 name:'Efisien_relokasi'
    //             },
    //             {
    //                 data:'Tgl_cutoff',
    //                 name:'Tgl_cutoff'
    //             },
    //             {
    //                 data:'SelesaiSewa',
    //                 name:'SelesaiSewa'
    //             },
    //             {
    //                 data:'HargaSewaMobil',
    //                 name:'HargaSewaMobil'
    //             },
    //             {
    //                 data:'HargaSewaDriver2019',
    //                 name:'HargaSewaDriver2019'
    //             },
    //             {
    //                 data:'NoRegister',
    //                 name:'NoRegister'
    //             }
    //         ]
    //   });
    //  }
     
    //  $('#nopol_filter').change(function(){
    //   var nopol = $('#nopol_filter').val();
     
    //   $('#product_table').DataTable().destroy();
     
    //   fetch_data(nopol);
    //  });

    // });


    

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