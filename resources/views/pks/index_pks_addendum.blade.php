<?php
$page = "pks"; 
$page2 = "pks"; 
?>
@extends('sidebar')

@section('content')


<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h1 class=" text-white d-inline-block mb-0">NO PKS : {{$pks->no_pks}}</h1>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">{{$page2}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">table</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-pills nav-fill flex-column flex-sm-row float-right pull-right" id="tabs-text" role="tablist" >
                <li class="nav-item">
                  <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-file-contract"></i>&nbspPilih addendum <span class="text-primary"></span>
                    
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/backend/pks')}}" type="button" class="btn btn-default float-right pull-right">Back</a>
                </li>
              </ul>
            </div>
            <!-- <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div> -->
          </div>
          <!-- Card stats -->
          @include('pks.add_pks_addendum')
        </div>
      </div>
    </div>
    <div class="container-fluid mt--6">
      <section class="content">
        <!-- <div class="row">
          <div class="col-12">
            <div class="card pb-4">
              <div class="card-header border-0">
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-file-powerpoint"></li> &nbspPKS</h3>
                
              </div>
              
              
                <div class="table-responsive">
                    <form action="{{url('/backend/pks/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    
                    <table class="table align-items-center table-flush table-hover text-center " id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" style="min-width: 10%" class="bg-success text-white">Vendor</th>
                          <th scope="col" style="min-width: 10%">No pks</th>
                          <th scope="col" style="min-width: 10%">Tgl pks</th>
                          <th scope="col" style="min-width: 10%">Nama kontrak pks</th>
                          <th scope="col" style="min-width: 20%">Deskripsi</th>
                          <th scope="col" style="min-width: 30%">File</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $i = 1;
                          ?>
                          
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td>{{$pks->vendor}}</td>
                            <td>{{$pks->no_pks}}</td>
                            <td>
                              {{ date('d-M-Y', strtotime($pks->tgl_pks))}}
                            </td>
                            <td>{{$pks->nama_kontrak_pks}}</td>
                            <td>{{$pks->deskripsi}}</td>
                            <td><a href="{{asset('file/pks/'.$pks->file)}}" target="_blank">{{$pks->file}}</a></td>
                            
                            <?php $i++; ?>
                          </tr>
                          
                      </tbody>
                    </table>
                    
                     </form>

                </div>           
              
              </div>
            
            </div>

        </div> -->


        <div class="row">
          <div class="col-12">
            <div class="card pb-4">
              <div class="card-header border-0">
                <h3 class="mb-0 text-uppercase d-inline-block"><li class="fas fa-file-contract"></li> &nbspAddendum</h3>
                <!-- <a href="#!" class="btn btn-sm btn-primary float-right">Pks</a> -->
              </div>
              
              
                <div class="table-responsive">
                    <form action="{{url('/backend/pks/delete_multiple')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush table-hover text-center " id="myTable">
                      <thead class="thead-light" style="height: 70px">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" style="min-width: 10%" class="bg-success text-white">Vendor</th>
                          <th scope="col" style="min-width: 10%">No addendum</th>
                          <th scope="col" style="min-width: 10%">Tgl addendum</th>
                          <th scope="col" style="min-width: 10%">Nama kontrak addendum</th>
                          <th scope="col" style="min-width: 20%">Deskripsi</th>
                          <th scope="col" style="min-width: 30%">File</th>
                          <th scope="col" style="min-width: 30%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $i = 1;
                          ?>
                          @foreach($addendums as $addendum)
                          @if($addendum->active != '1')
                          <tr role="row" class="odd">
                            <td>{{$i}}</td>
                            <td>{{$addendum->vendor}}</td>
                            <td>{{$addendum->no_addendum}}</td>
                            <td>
                              {{ date('d-M-Y', strtotime($addendum->tgl_addendum))}}
                            </td>
                            <td>{{$addendum->nama_kontrak_addendum}}</td>
                            <td>{{$addendum->deskripsi}}</td>
                            <!-- <td><a href="{{asset('file/addendum/'.$addendum->file)}}" target="_blank">{{$addendum->file}}</a></td> -->
                            <td><a href="{{asset('laravel/public/file/addendum/'.$addendum->file)}}">{{$addendum->file}}</a></td>
                            <td>
                              <a class="btn btn-danger btn-sm" href="{{url('/backend/addendum_id/delete/'.$addendum->id.'/'.$pks->id)}}">
                                  <i class="fas fa-times">
                                  </i>
                              </a>
                            </td>
                            <?php $i++; ?>
                          </tr>
                          @endif
                          @endforeach
                          
                      </tbody>
                    </table>
                    
                     </form>
                     
                </div>           
              
              </div>
            
            </div>

        </div>
        
      </section>
    <!-- /.content -->
    </div>








<script>
  

$(document).ready(function(){

  $('#addendum_id').on('change', function() {

    var nopolID = $(this).val();

      if(nopolID) {

          $.ajax({

              url: '{{url("/backend/all_addendum/ajax")}}'+"/"+nopolID,

              type: "GET",

              dataType: "json",

              success:function(data) {

                  $('#no_addendum').val('');

                  $('#tgl_addendum').val('');

                  $('#nama_kontrak_addendum').val('');

                  $('#vendor').val('');

                  $('#deskripsi').empty();

                  $('#file').empty();

                  $.each(data, function(key, value) {

                    $('#no_addendum').val(value.no_addendum);

                    $('#tgl_addendum').val(value.tgl_addendum);

                    $('#nama_kontrak_addendum').val(value.nama_kontrak_addendum);

                    $('#vendor').val(value.vendor);

                    $('#file').append(value.file);

                    $('#deskripsi').append(value.deskripsi);

                  });


              }

          });

      }else{

          $('#harga_driver_ajax').empty();

      }

  });

});

    


</script>


@endsection










