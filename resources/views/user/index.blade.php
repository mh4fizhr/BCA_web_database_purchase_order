<?php $page = "User"; ?>
@extends('sidebar')

@section('content')

<div class="header bg-primary pb-7">
      <div class="container-fluid">
        <div class="header-body pt-5">
          <div class="row align-items-center pl-4 pb-6">
            <div class="col-lg-6 col-7">
              <h6 class="display-3 text-white d-inline-block mb-0">{{$page}} Table</h6>
              <!-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav> -->
            </div>
            <div class="col-lg-6">
              <button type="button" class="btn btn-success mt-2 float-right pull-right mr-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Add <?php echo $page ?></button>
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
                <div class="row align-items-center">
                  
                </div>
              </div>
              <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush table-hover text-center mydatatable" id="myTable">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $i = 1;
                      ?>
                      @foreach($users as $user)
                      <tr role="row" class="odd">
                        <td>{{$i}}</td>

                        <td><a href="" class="user" 
                                data-name="name" 
                                data-type="text" 
                                data-pk="{{$user->id}}" 
                                data-url="/api/backend/user/update/{{$user->id}}" 
                                data-title="Masukkan nama" style="color: #525f7f">
                                {{$user->name}}</a>
                        </td>
                        <td><a href="" class="user" 
                                data-name="email" 
                                data-type="text" 
                                data-pk="{{$user->id}}" 
                                data-url="/api/backend/user/update/{{$user->id}}" 
                                data-title="Masukkan Email" style="color: #525f7f">
                                {{$user->email}}</a>
                        </td>
                        <td><a href="" class="user_status"
                                data-name="status" 
                                data-type="select" 
                                data-pk="{{$user->id}}" 
                                data-url="/api/backend/user/update/{{$user->id}}" 
                                data-title="Masukkan status" style="color: #525f7f">
                                {{$user->status}}</a>
                        </td>
                        <td class="project-actions text-center">
  <!--                           <a class="btn btn-primary btn-sm" href="#">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a> -->

                            <!-- <a class="btn btn-info btn-sm" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a> -->
                            
                            <a class="btn btn-danger btn-sm" href="/backend/user/delete/{{$user->id}}">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>
                        <?php $i++; ?>
                      </tr>
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
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>



@endsection










