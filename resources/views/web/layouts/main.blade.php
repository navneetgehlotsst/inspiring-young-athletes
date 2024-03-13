<!DOCTYPE html>
<html class="no-js" lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="" name="description">
        <meta content="" name="author">
        <meta name="keywords" content="">
        <link rel="icon" href="{{asset('assets/web/images/logo.png')}}" type="image/x-icon">
        <title>Gift & Goodwill</title>
        <link href="{{asset('assets/web/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/css/theme.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/vendor/icons/css/materialdesignicons.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/vendor/select2/css/select2-bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/vendor/owl-carousel/owl.theme.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/web/css/custom.css')}}" rel="stylesheet">
        @yield('style')
        
    </head>

    <body id="page-top">
            <script src="{{asset('assets/web/vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
            @include('web.layouts.elements.main_header')
            @yield('content')
            @include('web.layouts.elements.main_footer')
            <script src="{{asset('assets/web/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="e2c18a419fc67a6d0d04daf8-text/javascript"></script>
            <script src="{{asset('assets/web/vendor/jquery-easing/jquery.easing.min.js')}}" type="e2c18a419fc67a6d0d04daf8-text/javascript"></script>
            <script src="{{asset('assets/web/vendor/select2/js/select2.min.js')}}" type="e2c18a419fc67a6d0d04daf8-text/javascript"></script>
            <script src="{{asset('assets/web/vendor/owl-carousel/owl.carousel.js')}}" type="e2c18a419fc67a6d0d04daf8-text/javascript"></script>
            <script src="{{asset('assets/web/js/custom.js')}}" type="e2c18a419fc67a6d0d04daf8-text/javascript"></script>
            <script src="{{asset('assets/web/js/switcher.js')}}" type="e2c18a419fc67a6d0d04daf8-text/javascript"></script>
            <script src="{{asset('assets/web/js/rocket-loader.min.js')}}" data-cf-settings="ad0ddfcccee5de5d364dad84-|49" defer=""></script>
            @yield('script')
            @include('web.layouts.elements.sweet_alerts')
    </body>

</html>
