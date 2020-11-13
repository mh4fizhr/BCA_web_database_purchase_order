<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>BCA - Pengadaan Mobil</title>
  <!-- Favicon -->
  <link rel="icon" href="{{asset('/dist/img/BCA-logo.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  
  <!-- Page plugins -->
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/animate.css/animate.min.css')}}">

  <link rel="stylesheet" href="{{asset('dist/argon/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/argon/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">



  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{asset('dist/argon/css/argon.css?v=1.2.0')}}" type="text/css">
  <link href="{{asset('dist/bootstrap4-editable/css/bootstrap-editable.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>

<body class="bg-default g-sidenav-show g-sidenav-pinned">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="../../pages/dashboards/dashboard.html">
        <img src="{{asset('dist/argon/img/BCA-logo-white.png')}}">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../../pages/dashboards/dashboard.html">
                <img src="../../assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="/backend/dashboard" class="nav-link">
              <span class="nav-link-inner--text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/backend/po/table" class="nav-link">
              <span class="nav-link-inner--text">Purchase Order</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="../../pages/examples/login.html" class="nav-link">
              <span class="nav-link-inner--text">Login</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../pages/examples/register.html" class="nav-link">
              <span class="nav-link-inner--text">Register</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../pages/examples/lock.html" class="nav-link">
              <span class="nav-link-inner--text">Lock</span>
            </a>
          </li> -->
        </ul>
        <hr class="d-lg-none">
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <!-- <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.facebook.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
              <i class="fab fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
              <i class="fab fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">Instagram</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://twitter.com/creativetim" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Twitter">
              <i class="fab fa-twitter-square"></i>
              <span class="nav-link-inner--text d-lg-none">Twitter</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial" target="_blank" data-toggle="tooltip" data-original-title="Star us on Github">
              <i class="fab fa-github"></i>
              <span class="nav-link-inner--text d-lg-none">Github</span>
            </a>
          </li> -->
          <li class="nav-item d-none d-lg-block ml-lg-4">
            <a href="/login" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
                <i class="ni ni-circle-08 mr-2"></i>
              </span>
              <span class="nav-link-inner--text">Login</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-6">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">
                  <img src="{{asset('dist/argon/img/BCA-logo3.png')}}"
                     class="elevation-2" width="70%" 
                     style="opacity: .9">
              </h1>
              <!-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p> -->
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Register</small>
              </div>
              <form method="POST" action="{{ route('register') }}" class="login100-form validate-form" oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")'>
                    @csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input class="form-control" placeholder="name" name="name" type="text" required="">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="email" name="email" type="email" required="">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" id="password1" placeholder="password" name="password" type="password" required="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" id="password2" placeholder="Confirm password" name="password_confirmation" type="password" required="">
                  </div>
                </div>
            
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Register</button>
                </div>
              </form>
            </div>
          </div>
          <!-- <div class="row mt-3">
            <div class="col-6">
              <a href="#" class="text-light"><small>Forgot password?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="#" class="text-light"><small>Create new account</small></a>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            © 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">BCA</a>
          </div>
        </div>
        <div class="col-xl-6">
          <!-- <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
            </li>
          </ul> -->
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{asset('dist/argon/vendor/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
  
  <script src="{{asset('dist/argon/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{asset('dist/argon/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{asset('dist/argon/js/argon.min.js?v=1.2.0')}}"></script><div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target="undefined"></div>
  <!-- Demo JS - remove this in your project -->
  <script src="{{asset('dist/argon/js/demo.min.js')}}"></script>


<style>
    #ofBar {
    background: #de2e2e;
    text-align: left;
min-height: 60px;
z-index: 999999999;
font-size: 16px;
color: #fff;
    padding: 18px 5%;
font-weight: 400;
display: block;
position: relative;
top: 0px;
width: 100%;
box-shadow: 0 6px 13px -4px rgba(0, 0, 0, 0.25);
}
#ofBar b {
font-size: 15px !important;
}
#count-down {
display: initial;
padding-left: 10px;
font-weight: bold;
}
#close-bar {
font-size: 22px;
color: #3e3947;
    margin-right: 0;
position: absolute;
right: 5%;
background: white;
opacity: 0.5;
padding: 0px;
height: 25px;
line-height: 21px;
width: 25px;
border-radius: 50%;
text-align: center;
top: 18px;
cursor: pointer;
z-index: 9999999999;
font-weight: 200;
}
#close-bar:hover{
opacity: 1;
}
#btn-bar {
background-color: #fff;
    color: #40312d;
    border-radius: 4px;
padding: 10px 20px;
font-weight: bold;
text-transform: uppercase;
font-size: 12px;
opacity: .95;
margin-left: 15px;
top: 0px;
position: relative;
cursor: pointer;
text-align: center;
box-shadow: 0 5px 10px -3px rgba(0,0,0,.23), 0 6px 10px -5px rgba(0,0,0,.25);
}
#btn-bar:hover{
opacity: 0.9;
}
#btn-bar{
opacity: 1;
}

#btn-bar span {
color: red;
}
.right-side{
    float: right;
    margin-right: 60px;
    top: -6px;
    position: relative;
    display: block;
}

#oldPriceBar {
text-decoration: line-through;
font-size: 16px;
color: #fff;
    font-weight: 400;
top: 2px;
position: relative;
}
#newPrice{
color: #fff;
    font-size: 19px;
font-weight: 700;
top: 2px;
position: relative;
margin-left: 7px;
}

#fromText {
font-size: 15px;
color: #fff;
    font-weight: 400;
margin-right: 3px;
top: 0px;
position: relative;
}

@media(max-width: 991px){
    .right-side{
    float:none;
    margin-right: 0px;
    margin-top: 5px;
    top: 0px
}
#ofBar {
padding: 50px 20px 20px;
text-align: center;
}
#btn-bar{
display: block;
margin-top: 10px;
margin-left: 0;
}
}
@media (max-width: 768px) {
    #count-down {
    display: block;
font-size: 25px;
}
}
</style>
</body>