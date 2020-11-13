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
              <h1 class=" text-white d-inline-block mb-0">Create PKS & Addendum</h1>
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
                  <!-- <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-file-contract"></i>&nbspPilih addendum <span class="text-primary"></span> 
                  </a> -->
                </li>
                <li class="nav-item">
                  <a href="{{url('/backend/addendum')}}" type="button" class="btn btn-default float-right pull-right">Back</a>
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
        
        <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">Form insert PKS & Addendum</h3>
        </div>
        <!-- Card body -->
        <form action="{{url('/backend/pks/add')}}" method="post" role="form" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="card-body">
            <!-- Form groups used in grid -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label" for="example3cols1Input">Vendor</label>
                  <select class="form-control select2" id="vendor" name="vendor">
                    <option value="">-- pilih vendor --</option>
                    @foreach($vendors as $vendor)
                      @if($vendor->active != '1')
                      <option value="{{$vendor->NamaVendor}}">{{$vendor->KodeVendor}} - {{$vendor->NamaVendor}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <br>
            <h3 class="text-center">-- PKS --</h3>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="example2cols1Input">No pks</label>
                  <input type="text" name="no_pks" id="no_pks" class="form-control" list="pks_list" placeholder="" autocomplete="off" required>
                  <datalist id="pks_list">
                    @foreach($pkss as $pks)
                      @if($pks->active != '1')
                      <option>{{$pks->no_pks}}</option>
                      @endif
                    @endforeach
                  </datalist>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="example2cols2Input">Tgl pks</label>
                  <input class="form-control date" type="text" name="tgl_pks" id="tgl_pks" placeholder="mm / dd / yyyy" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label" for="example3cols1Input">Nama kontrak pks</label>
                  <input type="text" name="nama_kontrak_pks" class="form-control" id="nama_kontrak_pks" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="example3cols1Input">Keterangan</label>
                  <textarea class="form-control" name="deskripsi_pks" id="deskripsi_pks" rows="4"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="example3cols1Input">File pks <span class="text-warning text-sm">(maximum size : 6 mb)</span></label>
                  <div class="card text-center" style="box-shadow: 0 0 0;border: thin;border-style: dashed;">
                    <div class="card-body">
                      <input type="file" name="file_pks" class="ml-5 mt-4 mb-4">
                    </div>
                  </div>
                </div>
              </div>
            </div>



            <br>
            <h3 class="text-center">-- Addendum --</h3>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="example2cols1Input">No Addendum</label>
                  <input type="text" name="no_addendum" class="form-control" id="exampleInputtext1" placeholder="" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="example2cols2Input">Tgl Addendum</label>
                  <input class="form-control date" type="text" name="tgl_addendum" id="selesaisewa" placeholder="mm / dd / yyyy" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label" for="example3cols1Input">Nama kontrak addendum</label>
                  <input type="text" name="nama_kontrak_addendum" class="form-control" id="exampleInputtext1" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="example3cols1Input">Keterangan</label>
                  <textarea class="form-control" name="deskripsi_addendum" id="exampleFormControlTextarea1" rows="4"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="example3cols1Input">File pks <span class="text-warning text-sm">(maximum size : 6 mb)</span></label>
                  <div class="card text-center" style="box-shadow: 0 0 0;border: thin;border-style: dashed;">
                    <div class="card-body">
                      <input type="file" name="file_addendum" class="ml-5 mt-4 mb-4">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row float-right mb-3">
              <div class="col-md-12">
                <a href="{{url('/backend/addendum')}}" class="btn btn-secondary">Close</a>
                <button type="submit" id="submit" class="btn btn-success">Submit</button>
              </div>
            </div>

          </div>
        </form>
      </div>

        
        
      </section>
    <!-- /.content -->
    </div>








<script>
  

$(document).ready(function(){

  $('#no_pks').on('input', function() {

    var nopolID = $(this).val();

      if(nopolID) {

          $.ajax({

              url: '{{url("/backend/all_addendum/ajax")}}'+"/"+nopolID,

              type: "GET",

              dataType: "json",

              success:function(data) {

                  $('#tgl_pks').val('');

                  $('#nama_kontrak_pks').val('');

                  $('#deskripsi_pks').empty();

                  $('#file_pks').empty();

                  $.each(data, function(key, value) {

                    $('#tgl_pks').val(value.tgl_pks);

                    $('#nama_kontrak_pks').val(value.nama_kontrak_pks);

                    $('#file_pks').append(value.file);

                    $('#deskripsi_pks').append(value.deskripsi);

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










