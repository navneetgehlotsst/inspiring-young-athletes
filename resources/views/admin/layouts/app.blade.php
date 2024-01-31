<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inspiring Young Athletes</title>
    <link rel="icon" type="image/png" href="{{asset('web/assets/images/new-img/favicon.svg')}}">
    <!-- LOAD CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/bootstrap.min.css')}}">
</head>

<body>
    @include('admin.layouts.elements.header')
    @yield('content')
    @include('admin.layouts.elements.footer')
    <!-- Load JS -->
    <script src="{{asset('web/assets/js/popper.min.js')}}"></script>
</body>

</html>
