<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initecharts.min.jsial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title> Dashboard</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- sctylesheet -->
  <link rel="stylesheet" href="{{asset('./dist/css/index.css')}}">

  <style>
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand).sidebar-focused,
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover {
      width: 4.6rem !important;
    }

    .sidebar-collapse.sidebar-mini .main-sidebar.sidebar-focused:not(.sidebar-no-expand) .nav-link,
    .sidebar-collapse.sidebar-mini .main-sidebar:hover:not(.sidebar-no-expand) .nav-link,
    .sidebar-collapse.sidebar-mini-md .main-sidebar.sidebar-focused:not(.sidebar-no-expand) .nav-link,
    .sidebar-collapse.sidebar-mini-md .main-sidebar:hover:not(.sidebar-no-expand) .nav-link,
    .sidebar-collapse.sidebar-mini-xs .main-sidebar.sidebar-focused:not(.sidebar-no-expand) .nav-link,
    .sidebar-collapse.sidebar-mini-xs .main-sidebar:hover:not(.sidebar-no-expand) .nav-link {
      width: 3.6rem !important;
    }

    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand).sidebar-focused .brand-text,
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand).sidebar-focused .logo-xl,
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand).sidebar-focused .sidebar .nav-sidebar .nav-link p,
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand).sidebar-focused .user-panel>.info,
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover .brand-text,
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover .logo-xl,
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover .sidebar .nav-sidebar .nav-link p,
    .sidebar-mini.sidebar-collapse .main-sidebar:not(.sidebar-no-expand):hover .user-panel>.info {
      visibility: hidden !important;
    }

    .sidebar-collapse .square {
      width: 60px;
      height: 60px;
      transition: width 0.5s, height 0.5s;
    }

    .sidebar-collapse #user_name {
      font-size: 16px;
      transition: font-size 0.5s;
    }

    .sidebar-collapse .user-panels p {
      opacity: 0;
      transition: opacity 0.1s ease-out;
    }

    .sidebar-collapse .square i {
      font-size: 40px;
      transition: font-size 0.5s;
    }

    .square i {
      font-size: 80px;
      transition: font-size 0.5s;
    }

    .sidebar-collapse .user_profile span {
      opacity: 0;
      transition: opacity 0.1s ease-out;
    }
  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{asset('js/dashboard.js')}}"></script>
  @include('userDashboard.css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @include('userDashboard.navbar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('userDashboard.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- /.content-header -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @yield('content')
        </div>
      </section>
    </div>
    <!-- /.content-wrapper -->
    @include('userDashboard.footer')
    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  @include('userDashboard.script')
</body>

</html>