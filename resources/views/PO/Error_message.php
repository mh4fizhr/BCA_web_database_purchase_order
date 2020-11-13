<?php $page = "PO"; ?>
@extends('navbar')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<div class="content-wrapper" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Table <?php echo $page ?></h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    @foreach($errors->all() as $message)
      <div>{{ $message }}</div>
    @endforeach

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card mr-3 ml-3">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-4 col-md-8">
                  <div id="example1_filter" class="dataTables_filter">
                    <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Tambah <?php echo $page ?></button> 
                  </div>
                </div>
                <div class="col-sm-4 col-md-4">
                  <div id="example1_filter" class="dataTables_filter mt-2 pull-right float-right">
                    <form class="form-inline" method="GET" action="">
                      <label>Search :&nbsp 
                        <input class="form-control mr-sm-2" type="search" name="cari" id="myInput" placeholder="Search" aria-label="Search" style="width: 240px">
                      </label>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead class="bg-dark">
                <tr role="row" class="text-center">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Jenis Sewa</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">CP/D</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Nama Cabang</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Kota</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Sewa</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Merek & type mobil</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Nama Driver</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Nama Vendor</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Detail</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="0" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                </tr>
                </thead>
                <tbody class="">
                    <?php 
                      $i = 1;
                    ?>
                    @foreach($pos as $po)
                    <tr role="row" class="odd">
                      <td>{{$i}}</td>
                      <td>{{$po->JenisSewa}}</td>
                      <td>{{$po->CP}}</td>
                      <td>
                        @foreach($cabangs as$cabang)
                          @if($po->Cabang_id == $cabang->id)
                            {{$cabang->NamaCabang}}
                          @endif
                        @endforeach
                      </td>
                      <td> 
                        @foreach($umps as $ump)
                          @if($po->Ump_id == $ump->id)
                            {{$ump->Kota}}
                          @endif
                        @endforeach
                      </td>
                      <td>{{$po->Sewa}}</td>
                      <td>
                        @foreach($mobils as $mobil)
                          @if($po->Mobil_id == $mobil->id)
                            {{$mobil->MerekMobil}}
                          @endif
                        @endforeach
                      </td>
                      <td>
                        @foreach($drivers as $driver)
                          @if($po->Driver_id == $driver->id)
                            {{$driver->NamaDriver}}
                          @endif
                        @endforeach
                      </td>
                      <td>
                        @foreach($vendors as $vendor)
                          @if($po->Vendor_Driver == $vendor->id)
                            {{$vendor->NamaVendor}}
                          @endif
                        @endforeach
                      </td>
                      <td>
                          <a class="btn btn-outline-success btn-sm text-center" href="/backend/po/edit/{{ $po->id }}">
                              <i class="fas fa-edit"></i>
                              </i>
                              Lihat Detail
                          </a>
                      </td>
                      <td class="project-actions text-center">
                          <a class="btn btn-primary btn-sm" href="/backend/po/show/{{ $po->id }}">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="/backend/po/edit/{{ $po->id }}" data-toggle="modal" data-target="#modalcabang">
                              <i class="fas fa-pencil-alt" >
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                      <?php $i++; ?>
                    </tr>
                    @endforeach
                
                
              </tbody>
              </table>
            </div>
          </div>
          <div class="row ">
            <div class="col-sm-12 col-md-5">
              <?php $j = 0 ?>
              @foreach($pos as $po)
              <?php $j++ ?>
              @endforeach
              <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 of {{$j}} entries
              </div>
              
            </div>
            <div>
            <div class="col-sm-12 col-md-7 ">
              {{ $pos->links() }}
              <!-- <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                <ul class="pagination">
                  <li class="paginate_button page-item previous disabled" id="example2_previous">
                    <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                  </li>
                  <li class="paginate_button page-item active">
                    <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                  </li>
                  <li class="paginate_button page-item ">
                    <a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                  </li>
                  <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                  </li>
                </ul>
              </div> -->
            </div>
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
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function () {
$('#dtHorizontalExample').DataTable({
"scrollX": true
});
$('.dataTables_length').addClass('bs-select');
});

</script>

<style type="text/css">
  .dtHorizontalExampleWrapper {
  max-width: 600px;
  margin: 0 auto;
  }
  #dtHorizontalExample th, td {
  white-space: nowrap;
  }

  table.dataTable thead .sorting:after,
  table.dataTable thead .sorting:before,
  table.dataTable thead .sorting_asc:after,
  table.dataTable thead .sorting_asc:before,
  table.dataTable thead .sorting_asc_disabled:after,
  table.dataTable thead .sorting_asc_disabled:before,
  table.dataTable thead .sorting_desc:after,
  table.dataTable thead .sorting_desc:before,
  table.dataTable thead .sorting_desc_disabled:after,
  table.dataTable thead .sorting_desc_disabled:before {
  bottom: .5em;
  }
</style>

@include('po.add')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('js/contoh.js')}}"></script>

@endsection










