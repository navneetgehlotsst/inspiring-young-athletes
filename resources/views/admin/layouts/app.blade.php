<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inspiring Young Athletes</title>
    <link rel="icon" type="image/png" href="{{asset('web/assets/images/new-img/favicon.svg')}}">
    <!-- LOAD CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/fonts/boxicons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/css/theme-default.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/css/pages/page-auth.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <script src="{{asset('admin/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('admin/assets/js/config.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.8.6/apexcharts.min.js"></script>
    <script>
      //toster
      $(document).ready(function() {
      toastr.options = {
          'closeButton': true,
          'debug': false,
          'newestOnTop': false,
          'progressBar': false,
          'positionClass': 'toast-top-right',
          'preventDuplicates': false,
          'showDuration': '1000',
          'hideDuration': '1000',
          'timeOut': '5000',
          'extendedTimeOut': '1000',
          'showEasing': 'swing',
          'hideEasing': 'linear',
          'showMethod': 'fadeIn',
          'hideMethod': 'fadeOut',
      }
      });
  </script>
</head>

<body>
    @include('admin.layouts.elements.header')
    @yield('content')
    @include('admin.layouts.elements.footer')
    <!-- Load JS -->
    <script src="{{asset('admin/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/js/menu.js')}}"></script>
    <script src="{{asset('admin/assets/js/main.js')}}"></script>
    <script src="{{asset('admin/assets/js/coustom.js')}}"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
