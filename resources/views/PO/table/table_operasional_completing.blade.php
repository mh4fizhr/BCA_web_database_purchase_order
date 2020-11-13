<?php $page = "Penambahan"; ?>
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
            <form action="{{url('/backend/po/completing/proses/'.$pos->id)}}" method="post" role="form" id="dynamic_form">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form Purchase Order</h3>
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
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No Register :</label>
                                </div>
                          </div>
                          <div class="col-md-9">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" class="form-control" value="{{$pos->NoRegister}}" name="noregister" id="example3cols2Input" placeholder="Enter No register">
                                </div>
                          </div>

                          <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No Polisi :</label>
                                </div>
                          </div>
                          <div class="col-md-9">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  @if($pos->Nopol == 'null')
                                  <input type="text" class="form-control" value="{{$pos->Nopol}}" id="example3cols2Input" disabled="">
                                  <input type="hidden" name="nopol" value="{{$pos->Nopol}}">
                                  @else
                                  <input type="text" class="form-control" value="{{$pos->Nopol}}" name="nopol" id="example3cols2Input" placeholder="Example : B 1234 JKL">
                                  @endif
                                </div>
                          </div>

                          
                          
                          @if($pos->Sewa == 'Mobil')

                          <div class="col-md-6 ">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastk :</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input class="form-control date" type="text" value="{{$pos->Tgl_bastk}}" name="tgl_bastk" id="example-date-input" placeholder="mm / dd / yyyy">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6"></div>

                          @elseif($pos->Sewa == 'Driver')

                          <!-- <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastd </label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input class="form-control date" type="text" value="{{$pos->Tgl_bastd}}" name="tgl_bastd" id="example-date-input" placeholder="mm / dd / yyyy">
                                </div>
                              </div>
                            </div>
                          </div> -->

                          @else

                          <div class="col-md-6 ">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastk :</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input class="form-control date" type="text" value="{{$pos->Tgl_bastk}}" name="tgl_bastk" id="example-date-input" placeholder="mm / dd / yyyy">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6"></div>

                          <!-- <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl Bastd </label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <input class="form-control date" type="text" value="{{$pos->Tgl_bastd}}" name="tgl_bastd" id="example-date-input" placeholder="mm / dd / yyyy">
                                </div>
                              </div>
                            </div>
                          </div> -->

                          @endif
                          
                          <div class="col-md-3">
                                <div class="form-group">
                                  <br>
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input"><i class="fas fa-user"></i> &nbspUser Pengguna :</label>
                                </div>
                                <div id="nopo_ajax"></div>
                          </div>
                          <div class="col-md-9">
                                <div class="form-group">
                                  <br>
                                  <input type="text" id="user_pengguna" class="form-control" name="user_pengguna" value="{{$pos->UserPengguna}}" id="example3cols2Input" placeholder="enter user pengguna">
                                  <span class="text-sm text-success">*tidak mandatory</span>
                                </div>
                          </div>
                  
                          
                        </div>
                      </div>



                      
   
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




    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
          
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Insert your file</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{url('/backend/po/import_excel')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="modal-body">
              
                <div class="py-3 text-center">
                    <i class="fas fa-file-excel" style="font-size: 70px"></i>
                    <h4 class="heading mt-4">Download excel template in - <a href="{{asset('file/template.xlsx')}}">Here</a></h4>
                    
                    <hr>
                    <p>Please insert file.xls in here</p>
                    <!-- <div class="dropzone dropzone-single ml-5 mr-5" data-toggle="dropzone" data-dropzone-url="http://">
                        <div class="fallback">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="dropzoneBasicUpload">
                                <label class="custom-file-label" for="dropzoneBasicUpload">Choose file</label>
                            </div>
                        </div>

                        <div class="dz-preview dz-preview-single">
                            <div class="dz-preview-cover">
                                <img class="dz-preview-img" src="..." alt="..." data-dz-thumbnail>
                            </div>
                        </div>
                    </div> -->
                    <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="customFileLang" lang="en">
                            <label class="custom-file-label" for="customFileLang">Select file</label>
                        </div>


                </div>
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-white " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-white ml-auto">Submit</button>
                
            </div>
            </form>
            
        </div>
    </div>



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






