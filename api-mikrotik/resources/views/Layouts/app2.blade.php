<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <meta http-equiv="refresh" content="5"> -->
	<title>@yield('title','MONITORING')</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
	@stack('csss')	
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-dark">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="{{url('/')}}" class="nav-link">Home</a>
				</li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            	<!-- Navbar Search -->
            	<li class="nav-item">
                    <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a> -->
                    <div class="navbar-search-block">
                    	<form class="form-inline">
                    		<div class="input-group input-group-sm">
                    			<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    			<div class="input-group-append">
                    				<button class="btn btn-navbar" type="submit">
                    					<i class="fas fa-search"></i>
                    				</button>
                    				<button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    					<i class="fas fa-times"></i>
                    				</button>
                    			</div>
                    		</div>
                    	</form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                	<a class="nav-link" data-widget="fullscreen" href="#" role="button">
                		<i class="fas fa-expand-arrows-alt"></i>
                	</a>
                </li>
                <li class="nav-item">
                	<a class="nav-link" href="{{url('choice/logout')}}" onclick="return confirm('Apakah anda yakin akan keluar?')" role="button">
                		<i class="fas fa-sign-out-alt"></i>
                	</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        	<!-- Brand Logo -->
        	<a href="{{url('/')}}" class="brand-link">
        		<i class="nav-icon fas fa-laptop"></i>
        		<span class="brand-text font-weight-light">PUSKOM</span>
        	</a>

        	<!-- Sidebar -->
        	<div class="sidebar">

        		<!-- Sidebar Menu -->
        		<nav class="mt-2">
        			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        				<li class="nav-item">
        					<a href="{{url('/')}}" class="nav-link">
        						<i class="nav-icon fas fa-tachometer-alt"></i>
        						<p>
        							Dashboard
        						</p>
        					</a>
        				</li>
        				<li class="nav-item">
        					<a href="{{url('interfaces')}}" class="nav-link">
        						<i class="nav-icon  fas fa-ethernet"></i>
        						<p>
        							Interfaces
        						</p>
        					</a>
        				</li>
        				<!-- Log -->
        				<li class="nav-item">
        					<a href="{{url('log')}}" class="nav-link">
        						<i class="nav-icon fas fa-sticky-note"></i>
        						<p>
        							Log
        						</p>
        					</a>
        				</li>
        				<!-- Resources -->
        				<li class="nav-item">
        					<a href="{{url('resources')}}" class="nav-link">
        						<i class="nav-icon fas fa-cog"></i>
        						<p>
        							Resource
        						</p>
        					</a>
        				</li>
        			</ul>
        		</nav>
        		<!-- /.sidebar-menu -->
        	</div>
        	<!-- /.sidebar -->
        </aside>
        <div class="content-wrapper bg-dark">
        	@yield('content')
        </div>

        <footer class="main-footer dark-mode">
        	<strong>Copyright &copy; 2023 <a href="https://www.instagram.com/windy.tkpd/?hl=en">Windy TKPD</a>.</strong>
        	TA PSDKU Polinema Kediri.
        	<div class="float-right d-none d-sm-inline-block">
        		<b>Version</b> 1.0.0
        	</div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('template/dist/js/adminlte.js')}}"></script>
    @stack('jss')

</body>

</html>