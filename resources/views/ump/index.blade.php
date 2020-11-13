<?php $page = "UMP"; ?>
@extends('sidebar')

@section('content')

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-5">
              <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true" style="font-size: 11px">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false" style="font-size: 11px">Deactive</a>
                </li>
                <li class="nav-item">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page2 ?></button>
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
            <div class="card pb-4">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" rowspan="2">No</th>
                      <th scope="col" rowspan="2">Kota</th>
                      <th scope="col" rowspan="2">Daerah</th>
                      <th scope="col" rowspan="2">Provinsi</th>
                      <th scope="col" colspan="9">UMP</th>
                     
                      @if(auth::user()->status == 'admin')
                      <th scope="col" rowspan="2">Action</th>
                      @endif
                    </tr>
                    <tr>
                      <th scope="col">ASSA</th>
                      <th scope="col">TUNAS</th>
                      <th scope="col">TRAC</th>
                      <th scope="col">MPM</th>
                      <th scope="col">SRIKANDI</th>
                      <th scope="col">INDORENT</th>
                      <th scope="col">HIBA</th>
                      <th scope="col">UNIVERSAL</th>
                      <th scope="col">BLUE BIRD</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 1;
              
                    ?>
                    @foreach($umps as $ump)
                    <tr role="row" class="odd">
                      <td>{{$i}}</td>

                      <td class="text-left"><a href="" class="ump text-left" 
                              data-name="kota" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Kota" style="color: #525f7f">
                              {{$ump->Kota}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="daerah1" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Daerah" style="color: #525f7f">
                              {{$ump->Daerah1}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="daerah2" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Daerah" style="color: #525f7f">
                              {{$ump->Daerah2}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="ASSA" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump ASSA" style="color: #525f7f">
                              {{$ump->ASSA}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="TUNAS" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump TUNAS" style="color: #525f7f">
                              {{$ump->TUNAS}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="TRAC" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump TRAC" style="color: #525f7f">
                              {{$ump->TRAC}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="MPM" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump MPM" style="color: #525f7f">
                              {{$ump->MPM}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="SRIKANDI" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump SRIKANDI" style="color: #525f7f">
                              {{$ump->SRIKANDI}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="INDORENT" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump INDORENT" style="color: #525f7f">
                              {{$ump->INDORENT}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="HIBA" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump HIBA" style="color: #525f7f">
                              {{$ump->HIBA}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="UNIVERSAL" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump UNIVERSAL" style="color: #525f7f">
                              {{$ump->UNIVERSAL}}</a>
                      </td>
                      <td><a href="" class="ump" 
                              data-name="BLUE_BIRD" 
                              data-type="text" 
                              data-pk="{{$ump->id}}" 
                              data-url="/api/backend/ump/update/{{$ump->id}}" 
                              data-title="Masukkan Jumlah ump BLUE_BIRD" style="color: #525f7f">
                              {{$ump->BLUE_BIRD}}</a>
                      </td>
                      @if(auth::user()->status == 'admin')
                      <td class="project-actions text-center">
                          <!-- <a class="btn btn-info btn-sm" href="#">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a> -->
                          
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                      @endif
                      <?php $i++; ?>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
</script>

@include('ump.add')

@endsection













