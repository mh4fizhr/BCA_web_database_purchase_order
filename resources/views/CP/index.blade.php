<?php 
$page = "Carpooling"; 
$name = "cp";
$page2 = "Carpooling"; 
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-map-marker-alt nav-icon"></li> &nbspDatabase Carpooling</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/cp/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/cp/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')
                 <form action="{{url('/backend/cp/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col" style="width: 10px">No</th>
                          <th scope="col">Carpooling - Kota</th>
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
                          @foreach($cps as $cp)
                          @if($cp->active != '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                              <td><!-- <a href="" class="cp" 
                                      data-name="cp" 
                                      data-type="text" 
                                      data-pk="{{$cp->id}}" 
                                      data-url="/api/backend/ump/cp/update/{{$cp->id}}" 
                                      data-title="Masukkan cp" style="color: #525f7f"> -->
                                      {{$cp->jenis}} - {{$cp->kota}}
                              </td>
                              <td class="project-actions text-center">
<!--                                   <a class="btn btn-primary btn-sm" href="#">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a> -->
                                  <a class="btn btn-success btn-sm" href="{{url('/backend/cp/edit/'.$cp->id)}}">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      
                                  </a>
                                  <!-- <a class="btn btn-danger btn-sm" href="/backend/ump/cp/delete/{{$cp->id}}">
                                      <i class="fas fa-trash">
                                      </i>
                                      
                                  </a> -->
                              </td>
                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"  id="customCheck{{$i}}" value="{{$cp->id}}">
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
                    @foreach(App\cp::all()->sortBy('id') as $cp)
                        @if($cp->active != '1')
                          <div class="delete_checkbox{{$cp->id}}"></div> 
                          <?php $i = $cp->id; ?>                    
                        @endif
                    @endforeach
                  </div>
                </form>
              @else
                <div class="">
                    <!-- Projects table -->
                    <form action="{{url('/backend/cp/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <div class="table-responsive">
                    <table class="table  align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col" style="width: 10px">No</th>
                          <th scope="col">Carpooling - Kota</th>
                          <th scope="col" style="width: 10px">
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
                          @foreach($cps as $cp)
                          @if($cp->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                              <td><!-- <a href="" class="cp" 
                                      data-name="cp" 
                                      data-type="text" 
                                      data-pk="{{$cp->id}}" 
                                      data-url="/api/backend/cp/update/{{$cp->id}}" 
                                      data-title="Masukkan cp" style="color: #525f7f"> -->
                                      {{$cp->jenis}} - {{$cp->kota}}
                              </td>
                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"  id="customCheck{{$i}}" value="{{$cp->id}}">
                                    <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                  </div>
                              </td>
                            <?php $i++; ?>
                          </tr>
                          @endif
                          @endforeach
                      </tbody>
                    </table>
                    </div>
                    <?php $i = 1; ?>
                    @foreach(App\cp::all()->sortBy('id') as $cp)
                        @if($cp->active == '1')
                          <div class="delete_checkbox{{$cp->id}}"></div> 
                          <?php $i = $cp->id; ?>                    
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

  $("#kota").keyup(function(){
    var error_kota = '';
    var kota = $('#kota').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('cp_available.check') }}",
        method:"POST",
        data:{kota:kota, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_kota').html('<label class="text-success">*Carpooling belum tersedia</label>');
            $('#kota').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_kota').html('<label class="text-danger">*Carpooling sudah ada</label>');
            $('#kota').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  });

  $("#kota").blur(function(){
    var error_kota = '';
    var kota = $('#kota').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('cp_available.check') }}",
        method:"POST",
        data:{kota:kota, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_kota').html('<label class="text-success">*Carpooling belum tersedia</label>');
            $('#kota').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_kota').html('<label class="text-danger">*Carpooling sudah ada</label>');
            $('#kota').addClass('has-error');
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

@include('CP.add')



@endsection

















