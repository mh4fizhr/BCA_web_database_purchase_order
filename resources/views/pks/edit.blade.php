@if(auth::user()->status == 'admin')
  <?php 
    $page = "db_pks";
    $page2 = "pks";
  ?>
@else
  <?php 
    $page = "pks";
    $page2 = "pks";
  ?>
@endif
@extends('sidebar')

@section('content')


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
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/backend/ump/harga_ump">{{$page}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$page2}}</li>
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
            <form action="{{url('/backend/pks/edit/proses/'.$pks->id)}}" method="post" role="form" id="dynamic_form" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card mb-4">
                  <!-- Card header -->
                  <div class="card-header">
                    <h3 class="mb-0">Form edit {{$page2}}</h3>
                  </div>
                  <!-- Card body -->
                  <div class="card-body">
                    <!-- Form groups used in grid -->


                    <div id="tambuh">
                    <!-- <hr> -->
                    <div class="row" id="tambuh">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Vendor</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <select class="form-control" id="vendor" name="vendor">
                                    @foreach($vendors as $vendor)
                                      @if($vendor->active != '1')
                                        <option value="{{$vendor->NamaVendor}}" {{$vendor->NamaVendor == $pks->vendor ? 'selected' : ''}}>{{$vendor->NamaVendor}}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                          </div> 



                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">No pks</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" name="no_pks" value="{{$pks->no_pks}}" class="form-control" id="exampleInputtext1" placeholder="Enter code" required="">
                                </div>
                          </div>                       
                          
                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tgl pks</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input class="form-control date" type="text" name="tgl_pks" value="{{$pks->tgl_pks}}" placeholder="mm / dd / yyyy" required>
                                </div>
                          </div> 

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Nama kontrak pks</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" name="nama_kontrak_pks" value="{{$pks->nama_kontrak_pks}}" class="form-control" id="exampleInputtext1" placeholder="Enter kontrak" required="">
                                </div>
                          </div> 

                          <!-- <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">addendum</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                              <div class="form-group">
                                <select class="form-control" id="addendum_id" name="addendum_id">
                                  <option></option>
                                  @foreach($addendums as $addendum)
                                    @if($addendum->active != '1')
                                      @if($addendum->vendor == $pks->vendor)
                                    <option value="{{$addendum->id}}" {{$addendum->id == $pks->addendum_id ? 'selected' : ''}}>{{$addendum->no_addendum}} - {{$addendum->nama_kontrak_addendum}} - {{ date('d M Y', strtotime($addendum->tgl_addendum))}}</option>
                                      @endif
                                    @endif
                                  @endforeach
                                </select>
                              </div>
                          </div>  -->

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Keterangan</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3">{{$pks->deskripsi}}</textarea>
                                </div>
                          </div> 

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">File <span class="text-warning text-sm">(maximum size : 6 mb)</span></label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="card text-center" style="box-shadow: 0 0 0;border: thin;border-style: dashed;">
                                  <div class="card-body">
                                    <input type="file" name="file" class="ml-5 mt-4 mb-4">
                                  </div>
                                </div>
                          </div> 
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
            

          </div>
        </div>
      </div>
    </section>




<script>
$(document).ready(function(){

      // Department Change
      $('#vendor').change(function(){

         // Department id
         var value = $(this).val();
         var _token = $('input[name="_token"]').val();

         // Empty the dropdown
         $('#addendum_id').find('option').remove();

         // AJAX request 
         $.ajax({
           url:"{{ route('vendor_addendum.check') }}",
           method:"POST",
           data:{value:value, _token:_token},
           success: function(data) {
               $('#addendum_id').html(data.html);
           }
        });
      });

    });

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









