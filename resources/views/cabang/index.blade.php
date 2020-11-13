<?php 
$page = "Cabang"; 
$name = "cabang"; 
?>
@extends('sidebar')

@section('content')

<!-- @foreach($errors->all() as $message)
      <div>{{ $message }}</div>
    @endforeach -->

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
                <!-- <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true" style="font-size: 11px">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false" style="font-size: 11px">Deactive</a>
                </li> -->
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-building"></li> &nbspDatabase Cabang</h3>
                
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if($s == 'active')
                      Active
                    @else
                      Deactive
                    @endif 
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/cabang/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/cabang/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
                  @if($s == 'active')
                      
                      <div class="">
                        <form action="{{url('/backend/cabang/delete_multiple')}}" method="post" role="form">
                        {{ csrf_field() }}
                        <!-- Projects table -->
                        <table class="table table-responsive align-items-center table-flush table-hover mydatatable text-center" id="serve">
                          <thead class="thead-light" style="height: 70px">
                            <tr>
                              <th scope="col"><b>No</b></th>
                              <th scope="col"  style="min-width: 10%"><b>Kode Cabang</b></th>
                              <th scope="col"  style="min-width: 20%"><b>Nama Cabang</b></th>
                              <th scope="col"  style="min-width: 10%"><b>Inisial Cabang</b></th>
                              <th scope="col"  style="min-width: 20%"><b>Cabang Utama</b></th>
                              <th scope="col"  style="min-width: 10%"><b>Status Cabang</b></th>
                              <th scope="col"  style="min-width: 10%"><b>Wilayah</b></th>
                              <th scope="col"  style="min-width: 10%"><b>Kota</b></th>
                              @if(auth::user()->status == 'admin' || auth::user()->status == 'operasional' || auth::user()->status == 'pengada')
                              <th scope="col" style="min-width: 10%"><b>Action</b></th>
                              @endif
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
                                  <td></td>
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
                            @foreach($cabangs as $cabang)
                            @if($cabang->active != '1')
                            <tr role="row" class="odd">
                              <td>{{$i}}</td>
                              <td>{{$cabang->KodeCabang}}</td>
                              <td>{{$cabang->NamaCabang}}</td>
                              <td>{{$cabang->InisialCabang}}</td>
                              <td>{{$cabang->CabangUtama}}</td>
                              <td>{{$cabang->StatusCabang}}</td>
                              <td>{{$cabang->KWL}}</td>
                              <td>{{$cabang->Kota}}</td>
                              @if(auth::user()->status == 'admin' || auth::user()->status == 'operasional' || auth::user()->status == 'pengada')
                              <td class="project-actions text-center">
                                  <a class="btn btn-success btn-sm" href="{{url('/backend/cabang/edit/'.$cabang->id)}}" >
                                      <i class="fas fa-pencil-alt" >
                                      </i>
              
                                  </a>
                              </td>
                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}" value="{{$cabang->id}}">
                                    <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                  </div>
                              </td>
                              @endif
                              <?php $i++; ?>
                            </tr>
                            @endif
                            @endforeach
                            
                          </tbody>
                        </table>
                        <?php $i = 1; ?>
                        @foreach(App\cabang::all()->sortBy('id') as $cabang)
                          @if($cabang->active != '1')
                            <div class="delete_checkbox{{$cabang->id}}"></div>
                            <?php $i = $cabang->id; ?>
                          @endif
                        @endforeach

                      </div>
                    </form>
                  @else
                    <div class="">
                      <!-- Projects table -->
                      <form action="{{url('/backend/cabang/delete_multiple')}}" method="post" role="form">
                      {{ csrf_field() }}
                      <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable" id="deactiv">
                        <thead class="thead-light" style="height: 70px">
                          <tr>
                            <th scope="col"><b>No</b></th>
                            <th scope="col" style="min-width: 10%"><b>Kode Cabang</b></th>
                            <th scope="col" style="min-width: 20%"><b>Nama Cabang</b></th>
                            <th scope="col" style="min-width: 10%"><b>Inisial Cabang</b></th>
                            <th scope="col" style="min-width: 20%"><b>Cabang Utama</b></th>
                            <th scope="col" style="min-width: 10%"><b>Status Cabang</b></th>
                            <th scope="col" style="min-width: 10%"><b>Wilayah</b></th>
                            <th scope="col" style="min-width: 10%"><b>Kota</b></th>
                            <th scope="col" style="min-width: 10%">
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
                          @foreach($cabangs as $cabang)
                          @if($cabang->active == '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td>{{$cabang->KodeCabang}}</td>
                            <td>{{$cabang->NamaCabang}}</td>
                            <td>{{$cabang->InisialCabang}}</td>
                            <td>{{$cabang->CabangUtama}}</td>
                            <td>{{$cabang->StatusCabang}}</td>
                            <td>{{$cabang->KWL}}</td>
                            <td>{{$cabang->Kota}}</td>
                            <td>

                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="customCheck{{$i}}"  value="{{$cabang->id}}" >
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
                      @foreach(App\cabang::all()->sortBy('id') as $cabang)
                        @if($cabang->active == '1')
                          <div class="delete_checkbox{{$cabang->id}}"></div>
                          <?php $i = $cabang->id; ?>
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

  // $('#submit').attr('disabled', 'disabled');

  $('#server').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route('json_cabang_active') }}',
            language: {
               paginate: {
               next: '<i class="fas fa-angle-right">',
               previous: '<i class="fas fa-angle-left">'  
                }
             },
            "columnDefs": [
            {
                "targets": [0],
                "data":'DT_RowIndex'
            },
            {
                "targets": [1],
                "data":'KodeCabang'
            },
            {
                "targets": [2],
                "data":'NamaCabang'
            },
            {
                "targets": [3],
                "data":'InisialCabang'
            },
            {
                "targets": [4],
                "data":'CabangUtama'
            },
            {
                "targets": [5],
                "data":'StatusCabang'
            },
            {
                "targets": [6],
                "data":'KWL'
            },
            {
                "targets": [7],
                "data":'Kota'
            },
            {
                "targets": [8],
                "data":'action'
            },
            {
                "targets": [9],
                "data":'delete'
            },
            ]
        });

  $('#deactive').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route('json_cabang_notactive') }}',
            language: {
               paginate: {
               next: '<i class="fas fa-angle-right">',
               previous: '<i class="fas fa-angle-left">'  
                }
             },
            "columnDefs": [
            {
                "targets": [0],
                "data":'DT_RowIndex'
            },
            {
                "targets": [1],
                "data":'KodeCabang'
            },
            {
                "targets": [2],
                "data":'NamaCabang'
            },
            {
                "targets": [3],
                "data":'InisialCabang'
            },
            {
                "targets": [4],
                "data":'CabangUtama'
            },
            {
                "targets": [5],
                "data":'StatusCabang'
            },
            {
                "targets": [6],
                "data":'KWL'
            },
            {
                "targets": [7],
                "data":'Kota'
            },
            {
                "targets": [8],
                "data":'action'
            },
            ]
        });
  

  $("#cabut").keyup(function(){
    var error_cabut = '';
    var cabut = $('#cabut').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('cabut_available.check') }}",
        method:"POST",
        data:{cabut:cabut, _token:_token},
        success:function(data) {

          $('#statuscabang2').html('<label for="exampleInputtext1">status cabang</label><select class="form-control" name="statuscabang" id="statuscabang"><option value="Wil">Wil</option><option value="KCU">KCU</option><option value="KCP">KCP</option><option value="KCK">KCK</option><option value="KK">KK</option><option value="KP">KP</option></select>');

          $('#kota').val('').change();

          $('#wilayah').val('1').change();

          $.each(data, function(key, value) {

            $('#id_po').val(value.id);

            $('#wilayah').val(value.KWL).change();

            $('#kota').val(value.Kota).change();

            $('#statuscabang').val(value.StatusCabang).change();

            // $('#statuscabang2').empty('<label for="exampleInputtext1">status cabang</label><select class="form-control" name="statuscabang" id="statuscabang"><option value="Wil">Wil</option><option value="KCU">KCU</option><option value="KCP">KCP</option><option value="KCK">KCK</option><option value="KK">KK</option><option value="KP">KP</option></select>');

            $('#statuscabang2').html('<label for="exampleInputtext1">status cabang</label><select class="form-control" name="statuscabang" id="statuscabang"><option value="KCU">KCU</option><option value="KCP">KCP</option><option value="KP">KP</option></select>');

          });
      }
   })

  });


  $("#cabut").blur(function(){
    var error_cabut = '';
    var cabut = $('#cabut').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('cabut_available.check') }}",
        method:"POST",
        data:{cabut:cabut, _token:_token},
        success:function(data) {

          $('#statuscabang2').html('<label for="exampleInputtext1">status cabang</label><select class="form-control" name="statuscabang" id="statuscabang"><option value="Wil">Wil</option><option value="KCU">KCU</option><option value="KCP">KCP</option><option value="KCK">KCK</option><option value="KK">KK</option><option value="KP">KP</option></select>');

          $('#kota').val('').change();

          $('#wilayah').val('1').change();

          $.each(data, function(key, value) {

            $('#id_po').val(value.id);

            $('#wilayah').val(value.KWL).change();

            $('#kota').val(value.Kota).change();

            $('#statuscabang').val(value.StatusCabang).change();

            // $('#statuscabang2').empty('<label for="exampleInputtext1">status cabang</label><select class="form-control" name="statuscabang" id="statuscabang"><option value="Wil">Wil</option><option value="KCU">KCU</option><option value="KCP">KCP</option><option value="KCK">KCK</option><option value="KK">KK</option><option value="KP">KP</option></select>');

            $('#statuscabang2').html('<label for="exampleInputtext1">status cabang</label><select class="form-control" name="statuscabang" id="statuscabang"><option value="KCU">KCU</option><option value="KCP">KCP</option><option value="KP">KP</option></select>');

          });
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

@include('cabang.add');

@endsection





















