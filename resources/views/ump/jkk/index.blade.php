<?php 
$page = "UMP"; 
$page2 = "Jkk"; 
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-percent nav-icon"></li> &nbspDatabase JKK</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/ump/jkk/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/ump/jkk/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')
                 <form action="{{url('/backend/ump/jkk/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col" style="width: 10px">No</th>
                          <th scope="col">% Jkk</th>
                          <th scope="col" style="width: 10px">Action</th>
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
                          @foreach($jkks as $jkk)
                          @if($jkk->active != '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                              <td><!-- <a href="" class="jkk" 
                                      data-name="jkk" 
                                      data-type="text" 
                                      data-pk="{{$jkk->id}}" 
                                      data-url="/api/backend/ump/jkk/update/{{$jkk->id}}" 
                                      data-title="Masukkan jkk" style="color: #525f7f"> -->
                                      {{$jkk->jkk}}</a> %
                              </td>
                              <td class="project-actions text-center">
<!--                                   <a class="btn btn-primary btn-sm" href="#">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a> -->
                                  <a class="btn btn-success btn-sm" href="{{url('/backend/ump/jkk/edit/'.$jkk->id)}}">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      
                                  </a>
                                  <!-- <a class="btn btn-danger btn-sm" href="/backend/ump/jkk/delete/{{$jkk->id}}">
                                      <i class="fas fa-trash">
                                      </i>
                                      
                                  </a> -->
                              </td>
                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$jkk->id}}">
                                    <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                  </div>
                              </td>
                            <?php $i++; ?>
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                    </table>
                    <?php $i = 1; ?>
                    @foreach(App\jkk::all()->sortBy('id') as $jkk)
                        @if($jkk->active != '1')
                          <div class="delete_checkbox{{$jkk->id}}"></div> 
                          <?php $i = $jkk->id; ?>                    
                        @endif
                    @endforeach
                  </div>
                </form>
              @else
                <div class="table-responsive">
                    <!-- Projects table -->
                    <form action="{{url('/backend/ump/jkk/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col" style="width: 10px">No</th>
                          <th scope="col">% Jkk</th>
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
                          @foreach($jkks as $jkk)
                          @if($jkk->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                              <td><!-- <a href="" class="jkk" 
                                      data-name="jkk" 
                                      data-type="text" 
                                      data-pk="{{$jkk->id}}" 
                                      data-url="/api/backend/ump/jkk/update/{{$jkk->id}}" 
                                      data-title="Masukkan jkk" style="color: #525f7f"> -->
                                      {{$jkk->jkk}}</a> %
                              </td>
                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$jkk->id}}">
                                    <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                  </div>
                              </td>
                            <?php $i++; ?>
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                    </table>
                    <?php $i = 1; ?>
                    @foreach(App\jkk::all()->sortBy('id') as $jkk)
                        @if($jkk->active == '1')
                          <div class="delete_checkbox{{$jkk->id}}"></div> 
                          <?php $i = $jkk->id; ?>                    
                        @endif
                    @endforeach
                  </div>
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

  $("#jkk2").keyup(function(){
    var error_jkk2 = '';
    var jkk = $('#jkk2').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('jkk_available.check') }}",
        method:"POST",
        data:{jkk:jkk, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_jkk2').html('<label class="text-success">*jkk belum tersedia</label>');
            $('#jkk2').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_jkk2').html('<label class="text-danger">*jkk sudah ada</label>');
            $('#jkk2').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  });

  $("#jkk2").blur(function(){
    var error_jkk2 = '';
    var jkk = $('#jkk2').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('jkk_available.check') }}",
        method:"POST",
        data:{jkk:jkk, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_jkk2').html('<label class="text-success">*jkk belum tersedia</label>');
            $('#jkk2').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_jkk2').html('<label class="text-danger">*jkk sudah ada</label>');
            $('#jkk2').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  $("#jkk2").bind(function(){
    var error_jkk2 = '';
    var jkk = $('#jkk2').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('jkk_available.check') }}",
        method:"POST",
        data:{jkk:jkk, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_jkk2').html('<label class="text-success">*jkk belum tersedia</label>');
            $('#jkk2').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_jkk2').html('<label class="text-danger">*jkk sudah ada</label>');
            $('#jkk2').addClass('has-error');
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

@include('ump.jkk.add')



@endsection

















