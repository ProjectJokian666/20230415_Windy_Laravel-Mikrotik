<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('soft-ui-dashboard-main')}}/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{asset('soft-ui-dashboard-main')}}/assets/img/favicon.png">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('soft-ui-dashboard-main')}}/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{asset('soft-ui-dashboard-main')}}/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('soft-ui-dashboard-main')}}/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('soft-ui-dashboard-main')}}/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <link href="{{asset('soft-ui-dashboard-main')}}/assets/css/nucleo-icons.css" rel="stylesheet">
  @stack('csss')
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid pe-0">
            @auth
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{route('choice.choice')}}">
              Selamat Datang {{Auth()->user()->email}}
            </a>
            @endauth
            @guest
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 ">
            @yield('title')
            </a>
            @endguest
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                @auth
                <!-- <li class="nav-item">
                  <a class="nav-link me-2" href="{{url('choice/login_akun')}}">
                    <i class="ni ni-money-coins opacity-6 text-dark me-1"></i>
                    Login Akun Mikrotik
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{url('choice/list_akun')}}">
                    <i class="ni ni-bullet-list-67 opacity-6 text-dark me-1"></i>
                    List Akun Mikrotik
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{url('choice/notif_akun')}}">
                    <i class="ni ni-bell-55 opacity-6 text-dark me-1"></i>
                    Notif
                  </a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{url('logout')}}">
                    Logout
                    <i class="ni ni-button-power opacity-6 text-dark me-1"></i>
                  </a>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{url('register')}}">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Sign Up
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{url('login')}}">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Sign In
                  </a>
                </li>
                @endguest
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content mt-0">
    @yield('content')
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Company
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            About Us
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Team
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Products
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Blog
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Pricing
          </a>
        </div>
        <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-dribbble"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-twitter"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-instagram"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-pinterest"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-github"></span>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Soft by Creative Tim.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{asset('soft-ui-dashboard-main')}}/assets/js/core/popper.min.js"></script>
  <script src="{{asset('soft-ui-dashboard-main')}}/assets/js/core/bootstrap.min.js"></script>
  <script src="{{asset('soft-ui-dashboard-main')}}/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="{{asset('soft-ui-dashboard-main')}}/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('soft-ui-dashboard-main')}}/assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
  <!-- jQuery -->
  <script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
  @stack('jss')
</body>

</html>