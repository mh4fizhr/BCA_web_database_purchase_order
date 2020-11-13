<?php $page = "Driver"; ?>
@extends('sidebar')

@section('content')

<?php
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentDate = date('m/d/Y');
?>

<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        $("#mobil").show();
        $("#driver").hide();
        $("#type_disabled").hide();
        $("#harga_mobil_disabled").hide();
        $("#harga_driver_disabled").hide();
        $("#sewa").change(function () {
            if ($(this).val() == "Mobil") {
                $("#mobil").show();
                $("#driver").hide();
                $("#type").show();
                $("#type_disabled").hide();
                $("#harga_driver_disabled").show();
                $("#harga_mobil_disabled").hide();
                $("#harga_driver").hide();
                $("#harga_mobil").show();
            } else if($(this).val() == "Driver") {
                $("#mobil").hide();
                $("#driver").hide();
                $("#type").hide();
                $("#type_disabled").show();
                $("#harga_mobil_disabled").show();
                $("#harga_driver_disabled").hide();
                $("#harga_mobil").hide();
                $("#harga_driver").show();
            } else{
                $("#mobil").show();
                $("#driver").show();
                $("#type").show();
                $("#type_disabled").hide();
                $("#harga_mobil_disabled").hide();
                $("#harga_driver_disabled").hide();
                $("#harga_mobil").show();
                $("#harga_driver").show();
            }
      });
        
    });

    $(document).ready(function(){
        var i = 1;
        $('.add').click(function(){
          i++;
          $("#tambuh").clone().appendTo( ".tempat_tambah" );
        });
    });
</script>

@foreach($errors->all() as $message)
      <div>{{ $message }}</div>
    @endforeach


@if(session('errors'))
  @foreach($errors as $error)
    <li>{{$error}}</li>
  @endforeach
@endif

@if(session('success'))
  {{session('success')}}
@endif

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
              <h1 class=" text-white d-inline-block mb-0">{{$page}} PO</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$page}} PO</li>
                </ol>
              </nav>
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
            <form action="{{url('/backend/driver/connect/proses/'.$driver->id)}}" method="post" role="form" id="dynamic_form">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Driver - PO</h3>
                  </div>
                  <!-- Card body -->
                  <div class="card-body">
                    <!-- Form groups used in grid -->


                    <div id="tambuh">
                    <!-- <hr> -->
                    <div class="row" id="tambuh">
                      <div class="col-md-12">
                        <div class="row">

                          <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Purchase Order </label>
                                </div>
                          </div>
                          <div class="col-md-9">
                              <div class="form-group">
                                <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                <select class="form-control select2" id="connect_po" name="po_id" required>

                                  <option value="">Pilih PO </option>
                                  @foreach($pos as $po)
                                    @if($po->status == '1' && $po->Sewa_sementara != 'Mobil' && $po->Driver_id == '' && $po->Sewa_sementara != 'null' && $po->vendor->KodeVendor == $driver->vendor_id)
                                      @if($po->Tgl_cutoff_driver != '' && $po->Tgl_cutoff_driver > $currentDate)
                                      @elseif($po->SelesaiSewa > $currentDateTime)
                                        <option value="{{$po->id}}">{{$po->NoPo}}&nbsp - &nbsp{{$po->Sewa}}&nbsp - 
                                          @if($po->Nopol == 'null')
                                            Tanpa Unit
                                          @else
                                            &nbsp{{$po->Nopol}}
                                          @endif
                                          &nbsp - &nbsp
                                          @foreach($cabangs as $cabang)
                                            @if($po->Cabang_id == $cabang->id)
                                              {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}}
                                            @endif
                                          @endforeach
                                          </option>
                                      @endif
                                    @endif
                                  @endforeach
                                
                                </select>

                              </div>
                          </div>      
                          <input type="hidden" name="driver_id" value="{{$driver->id}}">                                       
                          
                      
                         
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tanggal Bastd </label>
                                </div>
                              </div>
                              <div class="col-md-9">
                                <div class="form-group">
                                  <input class="form-control date" type="text" name="mulai" id="mulaisewa" placeholder="mm / dd / yyyy" required autocomplete="off">
                                </div>
                              </div>
                            
                       
                          
                          <!-- <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group text-right">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tanggal Selesai </label>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <input class="form-control date" type="text" name="selesai" id="selesaisewa" placeholder="mm / dd / yyyy" required>
                                </div>
                              </div>
                            </div>
                          </div> -->
                        </div>
                      </div>


                      <!-- <table class="table table-responsive align-items-center table-flush table-hover text-center mydatatable ml-3 mr-3" id="myTable">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col"><b>No</b></th>
                            <th scope="col"><b>No PO</b></th>
                            <th scope="col"><b>Jenis Sewa</b></th>
                            <th scope="col"><b>CP/D</b></th>
                            <th scope="col"><b>Vendor</b></th>
                            <th scope="col"><b>Type/unit</b></th>
                            <th scope="col"><b>No.pol</b></th>
                            <th scope="col"><b>Cabang</b></th>
                            <th scope="col"><b>Kota</b></th>
                            <th scope="col"><b>Mulai Sewa</b></th>
                            <th scope="col"><b>Tgl Bastk</b></th>
                            <th scope="col"><b>Tgl Bastd</b></th>
                            <th scope="col"><b>Selesai Sewa</b></th>
                            <th scope="col"><b>Harga Sewa Mobil(Rp)</b></th>
                            <th scope="col"><b>Harga Sewa Driver 2019(Rp)</b></th>
                            <th scope="col"><b>Harga Sewa Mobil + Driver(Rp)</b></th>
                            <th scope="col"><b>No Register</b></th>
                            <th scope="col"><b>Status</b></th>
                            <th scope="col"><b>Completing</th>
                            <th scope="col"><b>Action</b></th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table> -->
                      
   
                  </div>
                </div>
                <div class="tempat_tambah">
                  
                </div>
                </div>

                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                      <div class="form-group float-right pull-right">
                        <a href="javascript:history.back()" type="button" class="btn btn-default">Back</a>
                        <button type="submit" id="save" class="btn btn-success pl-5 pr-5">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
            

          </div>
        </div>
      </div>
    </section>




<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

// $(document).ready(function(){
//   var count = 1;


//   function dynamic_field(number)
//   {
//     var html = '<div class="row">'

//     html += '<p>asfasdad</p>';

//     if(number > 1)
//     {
//       html += '<button type="submit" id="tombol_remove" class="btn btn-danger pl-5 pr-5 pull-right float-right">Remove</button></div>';
//       $('#tombol_remove').append(html)
//     }else{

//     }
//   }

//   $('.add').click(function(){
//     count++;
//     dynamic_field(count);
//     $('#dynamic_field').append('<p>ketambah nih</p><br>')  
//   });

//   $(document).on('click', '#tombol_remove', function(){
//     count--;
//     dynamic_field(count);
//   });

//   $(#dynamic_field).on('submit', function(event){
//     event.preventDefault();
//     $.ajax({
//       url:'{{url("/backend/po/create")}}',
//       method:'post',
//       data:$(this).serialize(),
//       dataType:'json',
//       beforeSend:function(){
//         $('#save').attr('disabled','disabled');
//       },
//       success:function(data)
//       {
//         if (data.error) 
//         {
//           var error_html = '';
//           for(var count = 0;count < data.error.length; count++)
//           {
//             error_html += '<p>'+data.error[count]+'<p>';
//           }
//           $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
//         }
//         else
//         {
//           dynamic_field(1);
//           $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
//         }
//         $('#save').attr('disabled', false);
//       }
//     })
//   });

//   });
</script>


@endsection






