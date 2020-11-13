<?php $page = "Service"; ?>
@extends('sidebar')

@section('content')

<div class="header bg-primary pb-7">
      <div class="container-fluid">
        <div class="header-body pt-5">
          <div class="row align-items-center pl-4 pb-6">
            <div class="col-lg-6 col-7">
              <div class="dropdown mt-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{$tahun}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{url('/backend/po/service/'.$tpo->id)}}">All</a>
                  @foreach($ss as $s)
                    @if($s->po_id == $tpo->id)
                      <a class="dropdown-item" href="{{url('/backend/po/service/filter/'.$tpo->id.'/'.$s->periode)}}">{{$s->periode}}</a>
                    @endif
                  @endforeach
                  <!-- <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
              </div>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-6 col-5">
                <a href="{{url('/backend/po/show/'.$tpo->id)}}" type="button" class="btn btn-default mt-2 float-right pull-right mr-4" >Back</a>
                <input type="hidden" name="driver_id" value="">
                <button type="button" class="btn btn-success mt-2 float-right pull-right mr-4" data-toggle="modal" data-target="#service" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add Periode</button>
                <!-- <a href="javascript:history.back()" type="button" class="btn btn-default float-right pull-right mt-2 mr-4">Back</a> -->
              </form>
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
            
            <div class="card m-4 pb-3">
              <div class="card-header border-0">
                <h2 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-cog"></li> &nbspService </h2>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                  <thead class="thead-light" style="height: 70px">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Periode</th>
                      <th scope="col">No PO</th>
                      <th scope="col">Tanggal Service</th>
                      <th scope="col">KM</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col"></th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                      @foreach($services as $service)
                      @if($tpo->id == $service->po_id && $service->active != '1')

                      <tr role="row" class="odd">
                        <td>{{$i}}</td>
                        <td>
                            {{$service->periode}}
                        </td>
                        <td>
                            {{$service->po->NoPo}}
                        </td>
                        <td><!-- <a href="#" class="service text-dark" 
                              data-name="TglService" 
                              data-type="date" 
                              data-pk="{{$service->id}}" 
                              data-url="/api/backend/po/service/update/{{$service->id}}" 
                              data-title="Masukkan Tanggal service">
                              {{$service->TglService}}</a> -->
                              
                              @if($service->TglService == '')
                              @else
                                {{ date('d-M-Y', strtotime($service->TglService))}} 
                              @endif
                        </td>
                        <td><!-- <a href="#" class="service text-dark" 
                              data-name="km" 
                              data-type="number" 
                              data-pk="{{$service->id}}" 
                              data-url="/api/backend/po/service/update/{{$service->id}}" 
                              data-title="Masukkan Nilai KM"> -->

                              <!-- @if($service->km == '')
                              @else
                                @currency($service->km)
                              @endif -->
                              <span id="km">{{$service->km}}</span>
                        </td>
                        <td><!-- <a href="#" class="service text-dark" 
                              data-name="keterangan" 
                              data-type="text" 
                              data-pk="{{$service->id}}" 
                              data-url="/api/backend/po/service/update/{{$service->id}}" 
                              data-title="Masukkan Keterangan">  -->
                              {{$service->Keterangan}}</a>
                        </td>
                        <td>
                          <form action="{{url('/backend/po/service/tgl_service')}}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="periode" value="{{$service->periode}}">
                          <input type="hidden" name="po_id" value="{{$service->po_id}}">
                          <button class="btn btn-icon btn-sm btn-primary" type="submit">
                            <i class="fas fa-plus"></i>
                          </button>
                          </form>
                        </td>
                        <td>
                          <a class="btn btn-success btn-sm" href="{{url('/backend/po/service/edit/'.$service->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              
                          </a>
                          <a class="btn btn-danger btn-sm" href="{{url('/backend/report/service/delete/'.$service->id)}}">
                              <i class="fas fa-trash">
                              </i>
                              
                          </a>
                        </td>
                      </tr>
                      
                      <?php $i++; ?>
                      @endif
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





    <!-- <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
      <thead class="thead-light" style="height: 70px">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Periode</th>
          <th scope="col">No PO</th>
          <th scope="col">Salon 1</th>
          <th scope="col">Salon 2</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
          @foreach($salons as $salon)
          @if($tpo->id == $salon->po_id && $salon->active != '1')
          
          
          <tr role="row" class="odd">
            <td>{{$i}}</td>
            <td>
                {{$salon->periode}}
            </td>
            <td>
                {{$salon->po->NoPo}}
            </td>
            <td><a href="#" class="salon text-dark" 
                  data-name="salon1" 
                  data-type="date" 
                  data-pk="{{$salon->id}}" 
                  data-url="/api/backend/po/salon/update/{{$salon->id}}" 
                  data-title="Masukkan Salon 1">
                  {{$salon->Salon1}}</a> 
            </td>
            <td><a href="#" class="salon text-dark" 
                  data-name="salon2" 
                  data-type="date" 
                  data-pk="{{$salon->id}}" 
                  data-url="/api/backend/po/salon/update/{{$salon->id}}" 
                  data-title="Masukkan Salon 2"> 
                  {{$salon->Salon2}}</a> 
            </td>
            <td>
                  @if($salon->Salon1 != null && $salon->Salon2 != null)
                  <span class="badge badge-sm badge-success">Complete</span>
                  @else
                  <span class="badge badge-sm badge-warning">Un Complete</span>
                  @endif
            </td>
            <td>
              <a class="btn btn-info btn-sm" href="/backend/po/salon/edit/{{$salon->id}}">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
              </a>
              <a class="btn btn-danger btn-sm" href="/backend/report/salon/delete/{{$salon->id}}">
                  <i class="fas fa-trash">
                  </i>
                  Delete
              </a>
            </td>
          </tr>
          
          <?php $i++; ?>
          @endif
          @endforeach
      </tbody>
    </table> -->



<script>

  $(document).ready(function(){

  $('#submit').attr('disabled', 'disabled');

  $("#tahun").keyup(function(){
    var error_tahun = '';
    var tahun = $('#tahun').val();
    var po_id = $('#po_id').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('service.check') }}",
        method:"POST",
        data:{tahun:tahun,po_id:po_id, _token:_token},
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
    var po_id = $('#po_id').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('service.check') }}",
        method:"POST",
        data:{tahun:tahun,po_id:po_id, _token:_token},
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
    var po_id = $('#po_id').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('service.check') }}",
        method:"POST",
        data:{tahun:tahun,po_id:po_id, _token:_token},
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

  $(document).ready(function() {
    
      $('#km').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});

      $('#km').on('keyup',function() {
        $('#toggle').val('no');
        var x = document.getElementById("km").value;
        var z = x.replace(/\./g, "");
        var qty = parseInt(z);
        $('#km_hidden').val(qty);
        var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#km').val(hasil);
      });
      $('#km').on('input',function() {
        $('#toggle').val('no');
        var x = document.getElementById("km").value;
        var z = x.replace(/\./g, "");
        var qty = parseInt(z);
        $('#km_hidden').val(qty);
        var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#km').val(hasil);
      });

  });
</script> 

@include('service.add')



@endsection






















