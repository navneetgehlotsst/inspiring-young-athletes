<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | On Me</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Coderthemes" name="author" />
        <link rel="shortcut icon" href="{{asset('assets/admin/images/logo.png')}}">
        <link href="{{asset('assets/admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{asset('assets/admin/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style" />
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @yield('style')
    </head>
    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                function setFlesh(status, message = '') {
                    Toast.fire({
                        icon: status,
                        title: message
                    })
                }
            </script>
            @if(Session::has('success'))
            <script>
                Toast.fire({
                    icon: 'success',
                    title: "{{ !empty(Session::get('message')) ? Session::get('message') :Session::get('success') }}"
                })
            </script>
            @endif
            @if(Session::has('error'))
            <script>
                Toast.fire({
                    icon: 'error',
                    title: "{{ !empty(Session::get('message')) ? Session::get('message') :Session::get('error') }}"
                })
            </script>
            @endif
            @if(Session::has('warning'))
            <script>
                Toast.fire({
                    icon: 'warning',
                    title: "{{ !empty(Session::get('message')) ? Session::get('message') :Session::get('warning') }}"
                })
            </script>
            @endif
        @yield('content')
        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © On Me
        </footer>
        <script src="{{asset('assets/admin/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/app.min.js')}}"></script>
        @yield('script')
    </body>
</html>