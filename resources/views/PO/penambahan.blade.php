<?php $page = "Penambahan"; ?>
@extends('sidebar')

@section('content')



<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} Table</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
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
                <div class="table-responsive">
                  <table class="table  align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col"><b>No</b></th>
                        <th scope="col"><b>No PO</b></th>
                        <th scope="col"><b>Jenis Sewa</b></th>
                        <th scope="col"><b>Action</b></th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                      $i = 1;
                    ?>
                    @foreach($pos as $po)
                    <tr role="row" class="odd ">
                      <td>{{$i}}</td>
                      <td>
                        @foreach($nopos as $nopo)
                          @if($po->NoPo == $nopo->id)
                            {{$nopo->NoPo}}
                          @endif
                        @endforeach</td>
                      <td>{{$po->Sewa}}</td>
                      <td>
                        <a class="btn btn-success btn-sm" href="/backend/po/show/{{ $po->id }}">
                            <i class="fas fa-plus"></i> Penambahan
                        </a>
                      </td>

                      <?php $i++; ?>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
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






