<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@setting('app_name') - @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/user/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/user/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/user/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  {{--<link href="{{asset('assets/user/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/user/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">--}}
  
  <link href="{{asset('assets/user/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/user/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/user/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/user/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/user/assets/vendor/toastr/toastr.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/user/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/user/assets/css/custom.css')}}" rel="stylesheet">
  
  @yield('link')

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @authorized
    @include('layouts.user.authorized')
  @else
    @include('layouts.user.unauthorized')
  @endauthorized

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/user/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/user/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets/user/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/user/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/user/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/user/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/user/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="{{asset('assets/user/assets/vendor/toastr/toastr.js')}}"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('assets/user/assets/js/main.js')}}"></script>
  @include('layouts.user.script')

</body>

</html>