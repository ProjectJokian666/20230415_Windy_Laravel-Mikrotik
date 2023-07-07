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
  @stack('jss')
  @foreach(App\Models\NotifSms::where('id_adm',Auth()->user()->id)->get() as $key => $value)
  <script>
    // setInterval(()=>{
    //   kirim_notif_sms_{{$value->id}}()
    // },60000);
    // function kirim_notif_sms_{{$value->id}}() {
    //   var currentDate = new Date();
      // var currentDate = new Date();
      // console.log({{$value->id}},currentDate.getFullYear()+"-"+(currentDate.getMonth()+1)+"-"+currentDate.getDate()+" "+currentDate.getHours()+":"+currentDate.getMinutes()+":"+currentDate.getSeconds());
      // $.ajax({
      //   url:"{{route('choice.notif_akun.notif_sms.kirim_notif')}}",
      //   data:{
      //     id:{{$value->id}},
      //     jam:{{$value->jam}},
      //     menit:{{$value->menit}},
      //     time_lock:'{{$value->time_lock}}',
      //     time_server:currentDate.getFullYear()+"-"+(currentDate.getMonth()+1)+"-"+currentDate.getDate()+" "+currentDate.getHours()+":"+currentDate.getMinutes()+":"+currentDate.getSeconds(),
      //   },
      //   success:function(data){
          // console.log(data)
      //     if(data.status=='kirim'){
      //       console.log(data)  
      //     }
      //   },
      //   error:function(data){
      //     console.log(data)
      //   }
      // });
    // }
  </script>
  @endforeach
  @foreach(App\Models\NotifEmail::where('id_adm',Auth()->user()->id)->get() as $key => $value)
  <script>
    // console.log('{{$value->time_lock}}');
    setInterval(()=>{
      kirim_notif_email_{{$value->id}}()
    },60000);
    function kirim_notif_email_{{$value->id}}() {
      var currentDate = new Date();
      // var currentDate = new Date();
      $.ajax({
        url:"{{route('choice.notif_akun.notif_email.kirim_notif')}}",
        data:{
          id:{{$value->id}},
          jam:{{$value->jam}},
          menit:{{$value->menit}},
          time_lock:'{{$value->time_lock}}',
          time_server:currentDate.getFullYear()+"-"+(currentDate.getMonth()+1)+"-"+currentDate.getDate()+" "+currentDate.getHours()+":"+currentDate.getMinutes()+":"+currentDate.getSeconds(),
        },
        success:function(data){
          // console.log(data)
          if(data.status=='kirim'){
            console.log(data) 
          }
        },
        error:function(data){
          console.log(data)
        }
      });
    }
  </script>
  @endforeach
  @foreach(App\Models\NotifWa::where('id_adm',Auth()->user()->id)->get() as $key => $value)
  <script>
    // setInterval(()=>{
    //   kirim_notif_wa_{{$value->id}}()
    // },60000);
    // function kirim_notif_wa_{{$value->id}}() {
      // var currentDate = new Date();
      // var currentDate = new Date();
      // console.log({{$value->id}},currentDate.getFullYear()+"-"+(currentDate.getMonth()+1)+"-"+currentDate.getDate()+" "+currentDate.getHours()+":"+currentDate.getMinutes()+":"+currentDate.getSeconds());
      // $.ajax({
        // url:"{{route('choice.notif_akun.notif_wa.kirim_notif')}}",
        // data:{
        //   id:{{$value->id}},
        //   jam:{{$value->jam}},
        //   menit:{{$value->menit}},
        //   time_lock:'{{$value->time_lock}}',
        //   time_server:currentDate.getFullYear()+"-"+(currentDate.getMonth()+1)+"-"+currentDate.getDate()+" "+currentDate.getHours()+":"+currentDate.getMinutes()+":"+currentDate.getSeconds(),
        // },
        // success:function(data){
          // console.log(data)
          // if(data.status=='kirim'){
            // console.log(data)  
          // }
        // },
        // error:function(data){
          // console.log(data)
        // }
      // });
    // }
  // </script>
  @endforeach
</body>
</html>
