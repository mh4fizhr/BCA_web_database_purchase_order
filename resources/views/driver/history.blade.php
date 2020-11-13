<?php $page = "Driver"; ?>
@extends('sidebar')

@section('content')

<div class="header bg-primary pb-7">
      <div class="container-fluid">
        <div class="header-body pt-5">
          <div class="row align-items-center pl-4 pb-6">
            <div class="col-lg-9 col-7">
              <h2 class="text-white d-inline-block mb-0">History Driver &nbsp : &nbsp {{$drivers->NamaDriver}}</h2>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-3">

                            

                <a href="javascript:history.back()" type="button" class="btn btn-default float-right pull-right mt-2 mr-4">Back</a>
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
    <div class="container-fluid mt--9">
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card m-4 pb-4">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                  <thead class="">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">PO</th>
                      <th scope="col">Nopol</th>
                      <th scope="col">Sewa</th>
                      <th scope="col" class="bg-info text-white">Tanggal mulai</th>
                      <th scope="col" class="bg-info text-white">Tanggal selesai</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; ?>
                    @foreach($historys as $history)
                      @if($history->Driver_id == $drivers->id)
                      <tr role="row" class="odd">
                        <td>{{$i}}</td>
                        @foreach($pos as $po)
                          @if($history->Po_id == $po->id)
                            <td>
                              {{$po->Nopo_permanent}}
                            </td>
                            <td>
                              {{$po->Nopol}}
                            </td>
                            <td>
                              {{$po->Sewa}}
                            </td>
                          @endif
                        @endforeach
                        
                        <td>
                          {{ date('d-M-Y', strtotime($history->tgl_mulai))}}
                        </td>
                        <td>
                          {{ date('d-M-Y', strtotime($history->tgl_selesai))}}
                        </td>
                        <td>
                          <a class="btn btn-danger btn-sm" href="{{url('/backend/driver/history/delete/'.$history->id)}}">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    @endif
                  @endforeach
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

@endsection
















