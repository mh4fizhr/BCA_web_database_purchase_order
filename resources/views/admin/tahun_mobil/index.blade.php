<?php 
$page = "db_mobil"; 
$page2 = "Tahun mobil"; 
?>
@extends('sidebar')

@section('content')

<?php
    $currentDateTime = date('Y-m-d H:i:s');
?>

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
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
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add {{$page2}}</button>
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-database"></li> &nbspDatabase {{$page2}}</h3>
                <!-- <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/mobil/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/mobil/deactive')}}">Deactive</a>
                  </div>
                </div> -->
              </div>
              
                <div class="table-responsive">
                  <form action="{{url('/backend/admin/tahun_mobil/delete')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light" style="height: 70px">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">tahun</th>
                        <th scope="col">Action</th>
                        <th scope="col" width="10px">
                          <button class="btn btn-icon btn-sm btn-dark mr-2" type="submit">
                            <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete permanent</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                    <thead>
                      <tr>
                        <td></td>
                        <td></td>
                        <th><input type="text" class="form-control form-control-sm" placeholder="" disabled style="min-width:100px" /></td>
                        <th>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input checkAll" id="checkAll">
                            <label class="custom-control-label" for="checkAll"></label>
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $i = 1;
                        ?>
                        @foreach($tahuns as $tahun)
                        @if($tahun->active != '1')
                            <tr role="row" class="odd">
                          @else
                            <tr role="row" class="odd bg-danger text-white">
                          @endif
                          <td>{{$i}}</td>
                            <td>
                                    {{$tahun->Tahun}}
                            </td>
                            <td class="project-actions text-center">
                                <!-- <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a> -->
                                <a class="btn btn-success btn-sm" href="{{url('/backend/mobil/tahun/edit/'.$tahun->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    
                                </a>
                                <!-- <a class="btn btn-danger btn-sm" href="/backend/ump/tahun/delete/{{$tahun->id}}">
                                    <i class="fas fa-trash">
                                    </i>
                                    
                                </a> -->
                            </td>
                            <td>

                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" name="tahun[]" id="customCheck{{$i}}" value="{{$tahun->id}}">
                                  <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                </div>

                            </td>
                          <?php $i++; ?>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  </form>
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

  $('#submit').attr('disabled', 'disabled');

  $("#tahun").keyup(function(){
    var error_tahun = '';
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('tahun_mobil_available.check') }}",
        method:"POST",
        data:{tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_tahun').html('<label class="text-success">*tahun belum tersedia</label>');
            $('#tahun').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_tahun').html('<label class="text-danger">*tahun sudah ada</label>');
            $('#tahun').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#tahun").blur(function(){
    var error_tahun = '';
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('tahun_mobil_available.check') }}",
        method:"POST",
        data:{tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_tahun').html('<label class="text-success">*tahun belum tersedia</label>');
            $('#tahun').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_tahun').html('<label class="text-danger">*tahun sudah ada</label>');
            $('#tahun').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#tahun").bind('click keyup',function(){
    var error_tahun = '';
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('tahun_mobil_available.check') }}",
        method:"POST",
        data:{tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_tahun').html('<label class="text-success">*tahun belum tersedia</label>');
            $('#tahun').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_tahun').html('<label class="text-danger">*tahun sudah ada</label>');
            $('#tahun').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>



@include('mobil.tahun.add')

@endsection

















