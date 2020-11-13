<?php 
$page = "db_surat"; 
$page2 = "surat relokasi"; 
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
            <!-- <div class="col-lg-5">
              <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist" >
                <li class="nav-item">
                  <button type="button" class="btn btn-success float-right pull-right pl-5 pr-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add {{$page2}}</button>
                </li>
              </ul>
            </div> -->

            
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
                
              </div>
              

                  <div class="table-responsive">
                    <form action="{{url('backend/admin/surat/relokasi/delete')}}" method="post" role="form">
                        {{ csrf_field() }}
                    <table class="table align-items-center table-flush table-hover mydatatable text-center" id="serve">
                          <thead class="thead-light" style="height: 70px">
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Vendor</th>
                              <th scope="col">No surat</th>
                              <th scope="col">Tgl surat</th>
                              <th scope="col">action</th>
                              <th scope="col">Status</th>
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
                                    <select class="form-control form-control-sm" style="min-width: 100px">
                                        <option value="">All</option>
                                        @foreach($vendor_uniques as $vendor_unique)
                                          @foreach($vendors as $vendor)
                                            @if($vendor_unique->nama_vendor == $vendor->NamaVendor)
                                              <option value="{{$vendor->NamaVendor}}">{{$vendor->NamaVendor}}</option>
                                            @endif
                                          @endforeach
                                        @endforeach
                                    </select>
                                  </th>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                    <th>
                                      <select class="form-control form-control-sm" style="min-width: 100px">
                                        <option value="">All</option>
                                          <option value="Approve">Approve</option>
                                          <option value="Waiting Approval">Waiting Approval</option>
                                      </select>
                                    </th>
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
                            @foreach($template_relokasis as $template_relokasi)
                            @if($template_relokasi->active != '1')
                              <tr role="row" class="odd">
                            @else
                              <tr role="row" class="odd bg-danger text-white">
                            @endif

                              <td>{{$i}}</td>
                              <td>{{$template_relokasi->nama_vendor}}</td>
                              <td>
                                {{$template_relokasi->no_surat}}
                                @if($currentDateTime == date('d-m-Y', strtotime($template_relokasi->created_at)))
                                   <sup class=""><span class="badge badge-warning">new</span></sup>
                                @endif
                              </td>
                              <td>{{$template_relokasi->tgl_surat}}</td>
                              <td>
                                <a href="{{url('/backend/surat/relokasi/'.$template_relokasi->id)}}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> &nbspdownload</a>
                                <a href="{{url('/backend/surat/relokasi/view/'.$template_relokasi->id)}}" class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i> &nbspview</a>
                              </td>
                              <td>
                                @if($template_relokasi->status == '1')
                                  <span class="badge badge-default">Approve</span>
                                @else
                                  <span class="badge badge-warning">Waiting approval</span>
                                @endif
                              </td>
                              <td>
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="relokasi[]" id="customCheck{{$i}}" value="{{$template_relokasi->id}}">
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

            

</script>



@endsection

















