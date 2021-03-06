<?php 
$page = "Mobil"; 
$name = "mobil"; 
?>
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
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page ?></button>
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-car"></li> &nbspDatabase Merek & Type Mobil </h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                      @else
                        Deactive
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/mobil/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/mobil/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              
              @if($s == 'active')
                  <div class="table-responsive">
                    <form action="{{url('/backend/mobil/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <table class="table  align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col"><b>No</b></th>
                          <th scope="col" style="min-width: 10%"><b>Kode Mobil</b></th>
                          <th scope="col" style="min-width: 20%"><b>Merek Mobil</b></th>
                          <th scope="col" style="min-width: 40%"><b>Type</b></th>
                          <th scope="col" style="min-width: 10%"><b>Tahun Mobil</b></th>
                          <th scope="col" style="min-width: 20%"><b>Action</b></th>
                          <th scope="col" style="min-width: 100%">
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
                              <td></td>
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
                          @foreach($mobils as $mobil)
                          @if($mobil->active != '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                              <td><!-- <a href="" class="mobil" 
                                      data-name="kodemobil" 
                                      data-type="text" 
                                      data-pk="{{$mobil->id}}" 
                                      data-url="/api/backend/mobil/update/{{$mobil->id}}" 
                                      data-title="Masukkan Kode Mobil" style="color: #525f7f"> -->
                                      {{$mobil->KodeMobil}}</a>
                              </td>
                              <td><!-- <a href="" class="mobil" 
                                      data-name="merekmobil" 
                                      data-type="text" 
                                      data-pk="{{$mobil->id}}" 
                                      data-url="/api/backend/mobil/update/{{$mobil->id}}" 
                                      data-title="Masukkan Merek Mobil" style="color: #525f7f"> -->
                                      {{$mobil->MerekMobil}}</a>
                              </td>
                              <td><!-- <a href="" class="mobil" 
                                      data-name="type" 
                                      data-type="text" 
                                      data-pk="{{$mobil->id}}" 
                                      data-url="/api/backend/mobil/update/{{$mobil->id}}" 
                                      data-title="Masukkan No Polisi" style="color: #525f7f"> -->
                                      {{$mobil->Type}}</a>
                              </td>
                              <td><!-- <a href="" class="mobil" 
                                      data-name="tahun" 
                                      data-type="text" 
                                      data-pk="{{$mobil->id}}" 
                                      data-url="/api/backend/mobil/update/{{$mobil->id}}" 
                                      data-title="Masukkan Tahun" style="color: #525f7f">  -->
                                      {{$mobil->Tahun}}</a>
                              </td>

                              <td class="project-actions text-center">
                                  <!-- <a class="btn btn-primary btn-sm" href="#">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a> -->
                                  <a class="btn btn-success btn-sm" href="{{url('/backend/mobil/edit/'.$mobil->id)}}">
                                      <i class="fas fa-pencil-alt">
                                      </i>
                                      
                                  </a>
                                  <!-- <a class="btn btn-danger btn-sm" href="/backend/mobil/delete/{{$mobil->id}}">
                                      <i class="fas fa-trash">
                                      </i>
                                      
                                  </a> -->
                              </td>
                              <td>

                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$mobil->id}}">
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
                    @foreach(App\mobil::all()->sortBy('id') as $mobil)
                      @if($mobil->active != '1')
                        <div class="delete_checkbox{{$mobil->id}}"></div>   
                        <?php $i = $mobil->id; ?>                   
                      @endif
                    @endforeach

                    </form>
                  </div>
              @else
                <div class="table-responsive">
                    <!-- Projects table -->
                    <form action="{{url('/backend/mobil/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <table class="table  align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col"><b>No</b></th>
                          <th scope="col" style="min-width: 20%"><b>Kode Mobil</b></th>
                          <th scope="col" style="min-width: 20%"><b>Merek Mobil</b></th>
                          <th scope="col" style="min-width: 20%"><b>Type</b></th>
                          <th scope="col" style="min-width: 20%"><b>Tahun</b></th>
                          <th scope="col" style="min-width: 20%">
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
                              <td></td>
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
                          @foreach($mobils as $mobil)
                          @if($mobil->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                              <td><!-- <a href="" class="mobil" 
                                      data-name="kodemobil" 
                                      data-type="text" 
                                      data-pk="{{$mobil->id}}" 
                                      data-url="/api/backend/mobil/update/{{$mobil->id}}" 
                                      data-title="Masukkan Kode Mobil" style="color: #525f7f"> -->
                                      {{$mobil->KodeMobil}}</a>
                              </td>
                              <td><!-- <a href="" class="mobil" 
                                      data-name="merekmobil" 
                                      data-type="text" 
                                      data-pk="{{$mobil->id}}" 
                                      data-url="/api/backend/mobil/update/{{$mobil->id}}" 
                                      data-title="Masukkan Merek Mobil" style="color: #525f7f"> -->
                                      {{$mobil->MerekMobil}}</a>
                              </td>
                              <td><!-- <a href="" class="mobil" 
                                      data-name="type" 
                                      data-type="text" 
                                      data-pk="{{$mobil->id}}" 
                                      data-url="/api/backend/mobil/update/{{$mobil->id}}" 
                                      data-title="Masukkan No Polisi" style="color: #525f7f"> -->
                                      {{$mobil->Type}}</a>
                              </td>
                              <td><!-- <a href="" class="mobil" 
                                      data-name="tahun" 
                                      data-type="text" 
                                      data-pk="{{$mobil->id}}" 
                                      data-url="/api/backend/mobil/update/{{$mobil->id}}" 
                                      data-title="Masukkan Tahun" style="color: #525f7f">  -->
                                      {{$mobil->Tahun}}</a>
                              </td>

                              <td>

                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$mobil->id}}">
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
                    @foreach(App\mobil::all()->sortBy('id') as $mobil)
                      @if($mobil->active == '1')
                        <div class="delete_checkbox{{$mobil->id}}"></div> 
                        <?php $i = $mobil->id; ?>                    
                      @endif
                    @endforeach

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

  $("#kodemobil").keyup(function(){
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{tkodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#kodemobil").blur(function(){
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{kodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 


  $("#merekmobil").keyup(function(){
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{kodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#merekmobil").blur(function(){
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{kodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 


  $("#typemobil").keyup(function(){
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{kodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#typemobil").blur(function(){
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{kodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#tahun").keyup(function(){
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{kodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 

  $("#tahun").blur(function(){
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{kodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })

  }); 


  $("#tahun").change(function () {
    var error_mobil = '';
    var kodemobil = $('#kodemobil').val();
    var merekmobil = $('#merekmobil').val();
    var typemobil = $('#typemobil').val();
    var tahun = $('#tahun').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mobil_available.check') }}",
        method:"POST",
        data:{kodemobil:kodemobil,merekmobil:merekmobil,typemobil:typemobil,tahun:tahun, _token:_token},
        success:function(result)
        {
         if(result == 'unique')
         {
            $('#error_mobil').html('<label class="text-success">*mobil belum tersedia</label>');
            $('#mobil').removeClass('has-error');
            $('#submit').attr('disabled', false);
         }
         else
         {
            $('#error_mobil').html('<label class="text-danger">*mobil sudah ada</label>');
            $('#mobil').addClass('has-error');
            $('#submit').attr('disabled', 'disabled');
         }
      }
   })
  }); 


  $('#mySelect').on('change', function (e) {
    var $optionSelected = $("option:selected", this);
    $optionSelected.tab('show')
  });
  
});

            

</script>



@include('mobil.add')

@endsection

















