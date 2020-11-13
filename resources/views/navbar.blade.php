
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->

          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" id="all_nopo" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <div class="sidenav-toggler sidenav-toggler-dark d-none d-xl-block active" data-action="sidenav-unpin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>

            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            
          </ul>
          <?php $notifs = DB::table('tpos')->get(); ?>
          <?php $i=0; ?>
          <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown">
              @foreach($notifs as $notif)
                  @if(($notif->status == 0 || $notif->status == 2) && Auth::user()->status == 'operasional')
                    <?php $i++; ?>
                  @endif
                @endforeach
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                  @if($i > 0)
                    <button type="button" class="btn btn-danger btn-icon-only rounded-circle">
                      <span><i class="ni ni-bell-55"></i></span>
                      <span class="badge badge-sm badge-circle badge-floating badge-secondary border-white">{{$i}}</span>
                    </button>
                  @else
                    <i class="ni ni-bell-55"></i>
                  @endif

                </a>
                <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                  <!-- Dropdown header -->
                  <div class="px-3 py-3">
                    <h6 class="text-sm text-muted m-0">You have {{$i}} <strong class="text-primary"></strong> notifications.</h6>
                  </div>
                  <!-- List group -->
                  <div class="list-group list-group-flush">

                      @foreach($notifs as $notif)
                        @if(($notif->status == 0 || $notif->status == 2) && Auth::user()->status == 'operasional')
                        
                          <a href="{{url('/backend/po/completing/'.$notif->id)}}" class="list-group-item list-group-item-action">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <!-- Avatar -->
                                <h4 class="mb-0 text-sm">PO</h4>
                              </div>
                              <div class="col ml--2">
                                <div class="d-flex justify-content-between align-items-center">
                                  <div>
                                    <h4 class="mb-0 text-sm">{{$notif->NoPo}}</h4>
                                  </div>
                                  <div class="text-right text-muted">
                                    <small>{{$notif->MulaiSewa}}</small>
                                  </div>
                                </div>
                                <p class="text-sm text-bold mb-0">{{$notif->Sewa}}</p>
                                <p class="text-sm text-success mb-0">Completing..</p>
                              </div>
                            </div>
                          </a>

                        @endif
                      @endforeach

                  </div>
                  <!-- View all -->
                  <a href="{{url('/backend/po/table')}}" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                </div>

            </li>
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <i class="fas fa-user-circle " style="font-size: 20px"></i>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">&nbsp {{auth::user()->name}}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title text-center">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#myprofil" >
                  <i class="ni ni-single-02"></i>
                  <span>My Profile</span>
                </a>


                <!-- <a href="#!" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Activity</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Support</span>
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                      <i class="ni ni-button-power"></i>
                      <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>




<!-- Modal -->
<div class="modal fade" id="myprofil" tabindex="-1" role="dialog" aria-labelledby="myprofilLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myprofilLabel">Tambah Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('/backend/user/myprofile')}}" method="post">
        {{ csrf_field() }}
      <div class="modal-body">
          <div class="card-body">
                    <h1 class="text-center" style="margin-top: -20px"><i class="fas fa-user-circle" style="font-size: 100px;"></i></h1>
                    <br>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Username</label>
                        <input type="text" name="name" class="form-control" id="jkk" placeholder="" value="{{auth::user()->name}}" required>
                      </div>
                    </div>
                    <h4 class="text-center" id="error_jkk"></h4>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">E-mail</label>
                        <input type="text" name="email" class="form-control" id="jkk" placeholder="@gmail.com" value="{{auth::user()->email}}" required>
                      </div>
                    </div>
                    <h4 class="text-center" id="error_jkk"></h4>
                    <!-- <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Password</label>
                        <input type="password" name="password" class="form-control" id="jkk" placeholder="" required>
                      </div>
                    </div> -->
                    
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">Status</label>
                        <select class="form-control " name="status" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                          <option value="">{{auth::user()->status}}</option>>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <h4 class="text-center" id="error_jkk">Lupa password ?</h4>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="exampleInputtext1">New password</label>
                        <input type="password" name="password" class="form-control">
                      </div>
                    </div>
                  </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>



<?php $i = 0; ?>