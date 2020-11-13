@if(auth::user()->status == 'admin')
  <?php 
    $page = "db_hargaump";
    $page2 = "Tahun";
  ?>
@else
  <?php 
    $page = "UMP";
    $page2 = "Tahun";
  ?>
@endif

@extends('sidebar')

@section('content')


<!-- @foreach($errors->all() as $message)
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
 -->
<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="/backend/ump/harga_ump">{{$page2}}</a></li>
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
            <form action="{{url('/backend/ump/tahun/edit/proses/'.$tahun->id)}}" method="post" role="form" id="dynamic_form">
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
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">tahun</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <!-- <input type="text" class="form-control" name="nopo[]" id="example3cols2Input" placeholder="Example : 256/JS/BPD/KPS/2017"> -->
                                  <input type="text" name="tahun" id="tahun" class="form-control" value="{{$tahun->Tahun}}" id="exampleInputtext1" required>
                                  <span id="error_tahun"></span>
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
                        <button type="submit" id="submit" class="btn btn-success pl-5 pr-5">Submit</button>
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
// $(document).ready(function(){

//   $('#submit').attr('disabled', 'disabled');

//   $("#tahun").keyup(function(){
//     var error_tahun = '';
//     var tahun = $('#tahun').val();
//     var _token = $('input[name="_token"]').val();

//     $.ajax({
//         url:"{{ route('tahun_available.check') }}",
//         method:"POST",
//         data:{tahun:tahun, _token:_token},
//         success:function(result)
//         {
//          if(result == 'unique')
//          {
//             $('#error_tahun').html('<label class="text-success">*tahun belum tersedia</label>');
//             $('#tahun').removeClass('has-error');
//             $('#submit').attr('disabled', false);
//          }
//          else
//          {
//             $('#error_tahun').html('<label class="text-danger">*tahun sudah ada</label>');
//             $('#tahun').addClass('has-error');
//             $('#submit').attr('disabled', 'disabled');
//          }
//       }
//    })

//   }); 

//   $("#tahun").blur(function(){
//     var error_tahun = '';
//     var tahun = $('#tahun').val();
//     var _token = $('input[name="_token"]').val();

//     $.ajax({
//         url:"{{ route('tahun_available.check') }}",
//         method:"POST",
//         data:{tahun:tahun, _token:_token},
//         success:function(result)
//         {
//          if(result == 'unique')
//          {
//             $('#error_tahun').html('<label class="text-success">*tahun belum tersedia</label>');
//             $('#tahun').removeClass('has-error');
//             $('#submit').attr('disabled', false);
//          }
//          else
//          {
//             $('#error_tahun').html('<label class="text-danger">*tahun sudah ada</label>');
//             $('#tahun').addClass('has-error');
//             $('#submit').attr('disabled', 'disabled');
//          }
//       }
//    })

//   }); 

//   $("#myInput").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#myTable tbody tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// });






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









