<?php 
$page = "db_pks"; 
$page2 = "Addendum"; 
?>
@extends('sidebar')

@section('content')

<?php
    $currentDateTime = date('Y-m-d H:i:s');
?>

<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-7 col-7">
              <h1 class=" text-white d-inline-block mb-0">{{$page2}} Table</h1>
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
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add {{$page2}}</button>
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
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fa fa-database"></li> &nbspDatabase {{$page2}}</h3>
                <div class="dropdown float-right">
                  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if($s == 'active')
                        Active
                        <?php $status = ''; ?>
                      @elseif($s == 'deactive')
                        Deactive
                        <?php $status = 1; ?>
                      @else
                        All
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{url('/backend/admin/addendum')}}">All</a>
                    <a class="dropdown-item" href="{{url('/backend/admin/addendum/active')}}">Active</a>
                    <a class="dropdown-item" href="{{url('/backend/admin/addendum/deactive')}}">Deactive</a>
                  </div>
                </div>
              </div>
              

                  <div class="table-responsive">
                    <form action="{{url('backend/admin/addendum/delete')}}" method="post" role="form">
                        {{ csrf_field() }}
                    <table class="table align-items-center table-flush table-hover mydatatable text-center" id="serve">
                          <thead class="thead-light" style="height: 70px">
                            <tr>
                              <th scope="col" >No</th>
                              <th scope="col" >Vendor</th>
                              <th scope="col" >No pks</th>
                              <th scope="col" >Tgl pks</th>
                              <th scope="col" >Nama kontrak pks</th>
                              <th scope="col" >No addendum</th>
                              <th scope="col" >Tgl addendum</th>
                              <th scope="col" >Nama kontrak addendum</th>
                              <th scope="col" >Deskripsi</th>
                              <th scope="col" >File</th>
                              <th scope="col" >Action</th>
                              <th scope="col" width="10px">
                                <button class="btn btn-icon btn-sm btn-dark mr-2" type="submit">
                                  <span class="btn-inner--icon"><i class="fas fa-trash"></i> delete permanent</span>
                                </button>
                              </th>
                            </tr>
                          </thead>
                          <thead>
                              <tr>
                                  <td></td>
                                  <th>
                                    <select class="form-control form-control-sm" style="min-width:100px">
                                        <option value="">All</option>
                                        @foreach($vendor_uniques as $vendor_unique)
                                          @foreach($vendors as $vendor)
                                            @if($vendor_unique->vendor == $vendor->NamaVendor)
                                              <option value="{{$vendor->NamaVendor}}">{{$vendor->NamaVendor}}</option>
                                            @endif
                                          @endforeach
                                        @endforeach
                                    </select>
                                  </th>
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
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input checkAll" id="checkAll">
                                      <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $i = 1;
                            ?>
                            @foreach($addendums as $addendum)
                            @if($addendum->active != '1')
                              <tr role="row" class="odd">
                            @else
                              <tr role="row" class="odd bg-danger text-white">
                            @endif

                              <td>{{$i}}</td>
                              <td>{{$addendum->vendor}}</td>
                              @foreach($pkss as $pks)
                                @if($pks->id == $addendum->pks_id)
                                  <td>{{$pks->no_pks}}</td>
                                  <td>{{ date('d-M-Y', strtotime($pks->tgl_pks))}}</td>
                                  <td>{{$pks->nama_kontrak_pks}}</td>
                                @endif
                              @endforeach
                              <td>{{$addendum->no_addendum}}</td>
                              <td>{{ date('d-M-Y', strtotime($addendum->tgl_addendum))}}</td>
                              <td>{{$addendum->nama_kontrak_addendum}}</td>
                              <td>{{$addendum->deskripsi}}</td>
                              <td><a href="{{asset('file/addendum/'.$addendum->file)}}">{{$addendum->file}}</a></td>

                              <td class="project-actions text-center">
                                  <!-- <a class="btn btn-primary btn-sm" href="#">
                                      <i class="fas fa-folder">
                                      </i>
                                      View
                                  </a> -->
                                  <a class="btn btn-success btn-sm" href="{{url('/backend/addendum/edit/'.$addendum->id)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        
                                    </a>
                                  <!-- <a class="btn btn-danger btn-sm" href="/backend/addendum/delete/{{$addendum->id}}">
                                      <i class="fas fa-trash">
                                      </i>
                                  </a> -->
                              </td>
                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="addendum[]" id="customCheck{{$i}}" value="{{$addendum->id}}">
                                    <label class="custom-control-label" for="customCheck{{$i}}"></label>
                                  </div>
                              </td>
                              <?php $i++; ?>
                            </tr>
                            @endforeach
                          </tbody>
                        
                        </table>
                  </div>   
                  </form>   
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

            // Department Change
            $('#vendor').change(function(){

               // Department id
               var value = $(this).val();
               var _token = $('input[name="_token"]').val();

               // Empty the dropdown
               $('#pks_id').find('option').not(':first').remove();

               // AJAX request 
               $.ajax({
                 url:"{{ route('vendor_pks.check') }}",
                 method:"POST",
                 data:{value:value, _token:_token},
                 success: function(data) {
                     $('#pks_id').html(data.html);
                 }
              });
            });

            $('#pks_id').on('change', function() {

              var nopolID = $(this).val();

                if(nopolID) {

                    $.ajax({

                        url: '/backend/addendum/ajax/'+nopolID,

                        type: "GET",

                        dataType: "json",

                        success:function(data) {

                            $('#tgl_pks').val('');

                            $('#nama_kontrak_pks').val('');

                            $.each(data, function(key, value) {

                              $('#tgl_pks').val(value.tgl_pks);

                              $('#nama_kontrak_pks').val(value.nama_kontrak_pks);


                            });


                        }

                    });

                }else{

                    $('#harga_driver_ajax').empty();

                }

            });

          });


</script>



@include('pks.addendum.add')

@endsection

















