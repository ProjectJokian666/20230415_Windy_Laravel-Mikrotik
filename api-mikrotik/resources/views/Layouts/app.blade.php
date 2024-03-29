<!DOCTYPE html>
<html dir="ltr" lang="id">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template"/>
  <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework"/>
  <meta name="robots" content="noindex,nofollow" />
  <title>@yield('title','MONITORING')</title>
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('matrix-admin-bt5-master')}}/assets/images/favicon.png"/>

  <link href="{{asset('matrix-admin-bt5-master')}}/dist/css/style.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{asset('matrix-admin-bt5-master')}}/assets/libs/select2/dist/css/select2.min.css" />

  <link href="{{asset('matrix-admin-bt5-master')}}/assets/libs/toastr/build/toastr.min.css" rel="stylesheet" />
  @stack('csss')
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    @include('Layouts.header')
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    @include('Layouts.sidebar')
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      @yield('content')
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="{{asset('matrix-admin-bt5-master')}}/assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="{{asset('matrix-admin-bt5-master')}}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('matrix-admin-bt5-master')}}/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="{{asset('matrix-admin-bt5-master')}}/assets/extra-libs/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="{{asset('matrix-admin-bt5-master')}}/dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="{{asset('matrix-admin-bt5-master')}}/dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="{{asset('matrix-admin-bt5-master')}}/dist/js/custom.min.js"></script>

  <script src="{{asset('matrix-admin-bt5-master')}}/assets/libs/select2/dist/js/select2.full.min.js"></script>
  <script src="{{asset('matrix-admin-bt5-master')}}/assets/libs/select2/dist/js/select2.min.js"></script>

  <script src="{{asset('matrix-admin-bt5-master')}}/assets/libs/toastr/build/toastr.min.js"></script>
  @stack('jss')
  <script type="text/javascript">
    $(".select2").select2();

    setInterval(()=>{
      cek_notif_web()
    },3000);
    function cek_notif_web(){
      $.ajax({
        url:"{{route('update_notif_web')}}",
        success:function(data){
          // console.log(data)
          if (data.status_jaringan=='ubah') {
            if (data.status=='putus') {
              toastr.warning("KONEKSI ANDA TERPUTUS", "Silahkan Logout Terlebih Dahulu");
            }
            else if(data.status=='connect'){
              toastr.success("KONEKSI ANDA TERSAMBUNG KEMBALI", "");
            }
          }
          data.data_jaringan_tx.forEach(function(isi_data){
            // console.log(isi_data);
            if (isi_data.status_ubah=='ubah') {
              if (isi_data.status_tx=='up') {
                toastr.success("ip anda "+isi_data.ip,isi_data.message);
                $.ajax({
                  url:"{{route('kirim_notif_base_app')}}",
                  data:{
                    ip:isi_data.ip,
                    message:isi_data.message,
                    title:isi_data.title,
                  },
                  success:function(hasil){
                    console.log(hasil);
                  },
                  error:function(hasil){
                    console.log(hasil)
                  }
                });
              }
              if (isi_data.status_tx=='down') {
                toastr.warning("ip anda "+isi_data.ip,isi_data.message);
                $.ajax({
                  url:"{{route('kirim_notif_base_app')}}",
                  data:{
                    ip:isi_data.ip,
                    message:isi_data.message,
                    title:isi_data.title,
                  },
                  success:function(hasil){
                    console.log(hasil);
                  },
                  error:function(hasil){
                    console.log(hasil)
                  }
                });
              }
            }
            // else{
            //   if (isi_data.status_tx=='up') {
            //     toastr.success(
            //       "ip anda "+isi_data.ip
            //       ,
            //       isi_data.message
            //       );
            //   }
            //   if (isi_data.status_tx=='down') {
            //     toastr.warning(
            //       "ip anda "+isi_data.ip
            //       ,
            //       isi_data.message
            //       );
            //   }
            // }
          });
          data.data_jaringan_rx.forEach(function(isi_data){
            // console.log(isi_data);
            if (isi_data.status_ubah=='ubah') {
              if (isi_data.status_rx=='up') {
                toastr.success("ip anda "+isi_data.ip,isi_data.message);
                $.ajax({
                  url:"{{route('kirim_notif_base_app')}}",
                  data:{
                    ip:isi_data.ip,
                    message:isi_data.message,
                    title:isi_data.title,
                  },
                  success:function(hasil){
                    console.log(hasil);
                  },
                  error:function(hasil){
                    console.log(hasil)
                  }
                });
              }
              if (isi_data.status_rx=='down') {
                toastr.warning("ip anda "+isi_data.ip,isi_data.message);
                $.ajax({
                  url:"{{route('kirim_notif_base_app')}}",
                  data:{
                    ip:isi_data.ip,
                    message:isi_data.message,
                    title:isi_data.title,
                  },
                  success:function(hasil){
                    console.log(hasil);
                  },
                  error:function(hasil){
                    console.log(hasil)
                  }
                });
              }
            }
            // else{
            //   if (isi_data.status_rx=='up') {
            //     toastr.success(
            //       "ip anda "+isi_data.ip
            //       ,
            //       isi_data.message
            //       );
            //   }
            //   if (isi_data.status_rx=='down') {
            //     toastr.warning(
            //       "ip anda "+isi_data.ip
            //       ,
            //       isi_data.message
            //       );
            //   }
            // }
          });
          // console.log(data.data_jaringan_tx,data.data_jaringan_rx)
        },
        error:function(data){
          console.log(data)
        }
      });
}
setInterval(()=>{
  kirim_periodik();
},60000);
function kirim_periodik() {
  $.ajax({
    url:"{{route('kirim_periodik')}}",
    success:function(hasil){
      console.log(hasil);
    },
    error:function(hasil){
      console.log(hasil)
    }
  });
}
</script>

</body>
</html>
