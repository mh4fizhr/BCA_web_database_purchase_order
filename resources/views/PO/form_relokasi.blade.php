<?php $page = "Relokasi"; ?>
@extends('sidebar')

@section('content')


<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        $("#mobil").show(); 
        $("#driver").hide();
        $("#sewa").change(function () {
            if ($(this).val() == "mobil") {
                $("#mobil").show();
                $("#driver").hide();
            } else if($(this).val() == "Driver") {
                $("#mobil").hide();
                $("#driver").hide();
            } else{
                $("#mobil").show();
                $("#driver").show();
            }
        });
        $("#cabang").change(function () {
            $("#harga_driver").val('0');
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

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
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
            <form action="{{url('/backend/po/edit_relokasi/'.$pos->id)}}" method="post" role="form">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form Purchase Order</h3>
                  </div>
                  <!-- Card body -->
                  <div class="card-body">
                    <!-- Form groups used in grid -->
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No PO :</label>
                                    </div>
                              </div>
                              
                              <div class="col-md-10">
                                    <div class="form-group">
                                      @if($pos->Nopo_relokasi == '')
                                      <input type="text" class="form-control" value="{{$pos->NoPo}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled>
                                      @else
                                      <input type="text" class="form-control" value="{{$pos->Nopo_relokasi}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled>
                                      @endif
                                    </div>
                              </div>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Cabang & Kota (Old)</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                    <?php $ckota = "" ?>
                                    @if($pos->Cabang_relokasi == '')
                                      @foreach($cabangs as $cabang)
                                        @if($cabang->id == $pos->Cabang_id)
                                          <input type="text" class="form-control" value="{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled="">
                                        @endif
                                      @endforeach
                                    @else
                                      @foreach($cabangs as $cabang)
                                        @if($cabang->id == $pos->Cabang_relokasi)
                                          <input type="text" class="form-control" value="{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017" disabled="">
                                        @endif
                                      @endforeach
                                    @endif
                                    
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Vendor </label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" id="vendor" name="vendor_id" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}" {{ $pos->Vendor_Mobil == $vendor->id ? 'selected' : '' }}>{{$vendor->NamaVendor}}</option>
                              
                                    @endforeach

                                  </select>
                                </div>
                              </div>


                              <div class="col-md-2">
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <label class="form-control-label mt-3" for="example3cols1Input">NEW</label>
                                </div>  
                              </div>

                              <div class="col-md-2">
                                    <div class="form-group">
                                      <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No PO :</label>
                                    </div>
                              </div>
                              
                              <div class="col-md-10">
                                    <div class="form-group">
                                      @if($pos->Nopo_relokasi == '')
                                      <input type="text" class="form-control" name="nopo_relokasi" value="" id="example3cols2Input" placeholder="">
                                      @else
                                      <input type="text" class="form-control" name="nopo_relokasi" value="" id="example3cols2Input" placeholder="">
                                      @endif
                                    </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Cabang & Kota (New)</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" id="cabang" name="cabang_relokasi" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    <option value="unknown">unknown</option>
                                    <?php $ckota = "" ?>
                                    @foreach($cabangs as $cabang)
                                      @if($cabang->active != '1')
                                      <option value="{{$cabang->id}}">{{$cabang->KWL}} - {{$cabang->KodeCabang}} - {{$cabang->NamaCabang}} - {{$cabang->Kota}}</option>
                                      <?php $ckota = $cabang->Kota ?>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Efektif Relokasi</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <input class="form-control date" type="text" name="tgl_efektif_relokasi" id="example-date-input" placeholder="mm / dd / yyyy" required>
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Harga S.Driver (include)</label>
                                </div>
                              </div>
                              <div class="col-md-10">
                                <div class="form-group">
                                  <div class="input-group input-group-merge">
                                    <div class="input-group-prepend" id="harga_driver_aja">
                                      <span class="input-group-text">Rp</span>
                                    </div>                                       

                                      @if($pos->Sewa == 'Mobil+Driver' || $pos->Sewa == 'Driver')

                                      <input class="form-control harga_driver" id="harga_driver" type="text" value="0">
                                      <input type="hidden" id="harga_driver_hidden" name="hargasewadriver_relokasi" value="0">

                                      @else

                                      <input class="form-control harga_driver" type="text" value="0" disabled>
                                      <input type="hidden" name="hargasewadriver_relokasi" value="0">

                                      @endif

                                    <div class="input-group-append">
                                      <span class="input-group-text"><small class="font-weight-bold">,00</small></span>
                                    </div>    

                                  </div>
                                </div>
                              </div>

                            </div>
                            
                          </div>
                          <div class="col-md-6" >
                                
                                @if($pos->Cabang_relokasi == '')
                                <input type="hidden" name="cabang_lama" value="{{$pos->Cabang_id}}">
                                <input type="hidden" name="nopo_lama" value="{{$pos->NoPo}}">
                                <input type="hidden" name="hargasewadriver" value="{{$pos->HargaSewaDriver2019}}">
                                @else
                                <input type="hidden" name="cabang_lama" value="{{$pos->Cabang_relokasi}}">
                                <input type="hidden" name="nopo_lama" value="{{$pos->Nopo_relokasi}}">
                                <input type="hidden" name="hargasewadriver" value="{{$pos->Hargasewadriver_relokasi}}">
                                @endif

                          </div>
                        </div>
                      </div>
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
            <div class="tempat_tambah">
              
            </div>

          </div>
        </div>
      </div>
    </section>



<script>
$(document).ready(function(){

  $('#harga_mobil').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});

  $('#harga_driver').autoNumeric("init", {aSep: '.', aDec: ',', mDec: '0'});


  $('#harga_driver').on('keyup',function() {
    $('#toggle').val('no');
    var x = document.getElementById("harga_driver").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#harga_driver_hidden').val(qty);
    var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $('#harga_driver').val(hasil);
  });
  $('#harga_driver').on('input',function() {
    $('#toggle').val('no');
    var x = document.getElementById("harga_driver").value;
    var z = x.replace(/\./g, "");
    var qty = parseInt(z);
    $('#harga_driver_hidden').val(qty);
    var hasil = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $('#harga_driver').val(hasil);
  });

});

$('#cabang').on('change', function(e) {

          e.preventDefault();

          var kota = $(this).val();

          var vendor = $('#vendor').val();

          $.ajax({

               type:'POST',

               url:'{{ route('kota_ajax') }}',

               dataType:"json",

               data:{"_token": "{{ csrf_token() }}",kota:kota, vendor:vendor},

               success:function(data){

                  $('#harga_driver_ajax_empty').empty();

                    $.each(data, function(key, value) {


                      // $('#harga_driver').val(value.Harga_include);

                      $('#harga_driver_hidden').val(value.Harga_include);
                      var hasil = value.Harga_include.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                      $('#harga_driver').val(hasil);

                    });

               }

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






