<?php 
$page = "Mobil"; 
$page2 = "BBM"; 
?>

@extends('sidebar')

@section('content')

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page2}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-5">
              <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-gas-pump"></li> &nbspDatabase bbm</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/bbm/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/bbm/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')     
                <div class="">
                  <form action="{{url('/backend/bbm/delete_multiple')}}" method="post" role="form">
                  {{ csrf_field() }}
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                    <thead class="thead-light" style="height: 70px">
                      <tr>
                        <th scope="col" style="width: 10px">No</th>
                        <th scope="col">Jenis BBM</th>
                        <th scope="col" style="width: 20px">Action</th>
                        <th scope="col" width="10px">
                          <button class="btn btn-icon btn-sm btn-danger mr-2" type="submit">
                            <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete</span>
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
                              @include('button_delete.index')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $i = 1;
                        ?>
                        @foreach($bbms as $bbm)
                        @if($bbm->active != '1')
                        <tr role="row" class="odd">
                          <td>{{$i}}</td>
                            <td>
                                    {{$bbm->jenis_bbm}}
                            </td>
                            <td class="project-actions text-center">
                                <!-- <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a> -->
                                <a class="btn btn-success btn-sm" href="{{url('/backend/bbm/edit/'.$bbm->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    
                                </a>

                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" name="bbm[]" id="customCheck{{$i}}" value="{{$bbm->id}}">
                                  <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                </div>

                            </td>
                          <?php $i++; ?>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                  </table>
                  </form>
                </div>
              @else
                <div class="">
                    <!-- Projects table -->
                    <form action="{{url('/backend/bbm/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col" style="width: 10px">No</th>
                          <th scope="col">Jenis BBM</th>
                          <th scope="col" width="10px">
                            <button class="btn btn-icon btn-sm btn-info mr-2" type="submit">
                              <span class="btn-inner--icon"><i class="fas fa-trash"></i> restore</span>
                            </button>
                          </th>
                        </tr>
                      </thead>
                      <thead>
                          <tr>
                              <td></td>
                              <td></td>
                              <th>
                                @include('button_delete.index')
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $i = 1;
                          ?>
                          @foreach($bbms as $bbm)
                          @if($bbm->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                              <td>
                                      {{$bbm->jenis_bbm}}
                              </td>
                              <td class="project-actions text-center">

                      

                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="bbm[]" id="customCheck1{{$i}}" value="{{$bbm->id}}">
                                        <label class="custom-control-label" for="customCheck1{{$i}}"></label>
                                      </div>

         

                              </td>
                            <?php $i++; ?>
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                    </table>
                    </form>
                </div>
              @endif

              



              
              
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

  $("#bbm").keyup(function(){
    var error_bbm = '';
    var bbm = $('#bbm').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('bbm_available.check') }}",
        method:"POST",
        data:{bbm:bbm, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_bbm').html('<label class="text-success">*bbm belum tersedia</label>');
            $('#bbm').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_bbm').html('<label class="text-danger">*bbm sudah ada</label>');
            $('#bbm').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#bbm").blur(function(){
    var error_bbm = '';
    var bbm = $('#bbm').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('bbm_available.check') }}",
        method:"POST",
        data:{bbm:bbm, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_bbm').html('<label class="text-success">*bbm belum tersedia</label>');
            $('#bbm').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_bbm').html('<label class="text-danger">*bbm sudah ada</label>');
            $('#bbm').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#bbm").bind('click keyup',function(){
    var error_bbm = '';
    var bbm = $('#bbm').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('bbm_available.check') }}",
        method:"POST",
        data:{bbm:bbm, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_bbm').html('<label class="text-success">*bbm belum tersedia</label>');
            $('#bbm').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_bbm').html('<label class="text-danger">*bbm sudah ada</label>');
            $('#bbm').addClass('has-error');
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

@include('mobil.bbm.add')

@endsection

















