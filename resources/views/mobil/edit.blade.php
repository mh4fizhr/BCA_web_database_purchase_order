@if(auth::user()->status == 'admin')
  <?php 
    $page = "db_mobil";
    $page2 = "Mobil";
  ?>
@else
  <?php 
    $page = "Mobil";
    $page2 = "Mobil";
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
                  <li class="breadcrumb-item"><a href="#">{{$page2}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
            <form action="{{url('/backend/mobil/edit/proses/'.$mobil->id)}}" method="post" role="form" id="dynamic_form">
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
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Kode Mobil</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <input type="text" name="kodemobil" class="form-control" id="exampleInputtext1" value="{{$mobil->KodeMobil}}">
                                </div>
                          </div>                       
                          
                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Merek Mobil</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <input type="text" name="merekmobil" class="form-control" id="exampleInputtext1" value="{{$mobil->MerekMobil}}">
                                </div>
                          </div>  

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Type Mobil</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <input type="text" name="type" class="form-control" id="exampleInputtext1" value="{{$mobil->Type}}">
                                </div>
                          </div>  

                          <div class="col-md-2">
                                <div class="form-group">
                                  <label class="form-control-label ml-3 mt-3" for="example3cols1Input">Tahun</label>
                                </div>
                          </div>
                          <div class="col-md-10">
                                <div class="form-group">
                                  <select class="form-control select2" name="tahun" data-toggle="select"  required>
                                    @foreach($tahuns as $tahun)
                                      @if($tahun->active != '1')
                                      <option value="{{$tahun->Tahun}}" {{ $mobil->Tahun == $tahun->Tahun ? 'selected' : '' }}>{{$tahun->Tahun}}</option>
                                      @endif
                                    @endforeach
                                  </select>
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




@endsection









