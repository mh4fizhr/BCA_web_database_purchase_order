<?php $page = "mcu"; ?>
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
                  <a class="dropdown-item" href="{{url('/backend/po/mcu/'.$tpo->id)}}">All</a>
                  @foreach($ss as $s)
                    @if($s->po_id == $tpo->id)
                    <a class="dropdown-item" href="{{url('/backend/po/mcu/filter/'.$tpo->id.'/'.$s->periode)}}">{{$s->periode}}</a>
                    @endif
                  @endforeach
                  <!-- <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-5">
                <a href="{{url('/backend/po/show/'.$tpo->id)}}" type="button" class="btn btn-default mt-2 float-right pull-right mr-4" >Back</a>
                <input type="hidden" name="driver_id" value="">
                <button type="button" class="btn btn-success mt-2 float-right pull-right mr-4" data-toggle="modal" data-target="#service" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add MCU & Seragam</button>
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
            <div class="card m-4 pb-4">
              <div class="card-header border-0">
                <h2 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-notes-medical"></li> &nbspMcu </h2>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush text-center mydatatable" id="myTable">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Periode</th>
                      <th scope="col">No PO</th>
                      <th scope="col">Medical Check Up</th>
                      <th scope="col">Seragam 3 Set</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($mcus as $mcu)
                        @if($mcu->po_id == $tpo->id && $mcu->active != '1')
                        <tr role="row" class="odd text-center">
                          <td>
                              {{$mcu->periode}}
                          </td>
                          <td>
                              {{$mcu->po->NoPo}}
                          </td>
                          <td>
                              @if($mcu->mcu == '')
                              @else
                                {{ date('d-M-Y', strtotime($mcu->mcu))}} 
                              @endif
                          </td>
                          <td>
                              @if($mcu->Seragam == '')
                              @else
                                {{ date('d-M-Y', strtotime($mcu->Seragam))}} 
                              @endif
                          </td>
                          <td>
                                @if($mcu->mcu != null && $mcu->Seragam != null)
                                <span class="badge badge-sm badge-success">Complete</span>
                                @else
                                <span class="badge badge-sm badge-warning">Un Complete</span>
                                @endif
                                
                          </td>
                          <td>
                            <a class="btn btn-success btn-sm" href="{{url('/backend/po/mcu/edit/'.$mcu->id)}}">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                  
                              </a>
                            <a class="btn btn-danger btn-sm" href="{{url('/backend/report/mcu/delete/'.$mcu->id)}}">
                                <i class="fas fa-trash">
                                </i>
                                
                            </a></td>
                        </tr>
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



<script>

  $(document).ready(function(){

  $('#submit').attr('disabled', 'disabled');

  $("#tahun").keyup(function(){
    var error_tahun = '';
    var tahun = $('#tahun').val();
    var po_id = $('#po_id').val();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url:"{{ route('mcu_service.check') }}",
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
        url:"{{ route('mcu_service.check') }}",
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
        url:"{{ route('mcu_service.check') }}",
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
</script>

@include('mcu.add')

@endsection


