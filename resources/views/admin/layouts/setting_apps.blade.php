<!DOCTYPE html>

<html lang="en" ng-app="CleanSmartApp">

    <head>

        <meta charset="utf-8" />

        <title>{{ config('settings.site_title')?? '' }} </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="" />

        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="shortcut icon" href="{{ asset('uploads/'.config('settings.site_favicon')) }}">

        <link href="{{CSS_URL}}vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />

        <link href="{{CSS_URL}}vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

        <link href="{{CSS_URL}}vendor/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />

        <link href="{{CSS_URL}}vendor/select.bootstrap4.css" rel="stylesheet" type="text/css" />

        <link href="{{CSS_URL}}vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <link href="{{CSS_URL}}icons.min.css" rel="stylesheet" type="text/css" />

        <link href="{{CSS_URL}}app.min.css" rel="stylesheet" type="text/css" id="light-style" />

        <link href="{{CSS_URL}}app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{CSS_URL}}developer.css" rel="stylesheet" type="text/css" id="developer-style" />

            <style>

            .btn-group > .btn:focus{

                background: #1a223d;

                outline: none!important;

                box-shadow:none;

                    color: #fff;

                border: 1px solid #ddd;

            }

        </style>

        

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{JS_URL}}angularjs/angular.min.js"></script> 

        

    </head>



    <body class="loading">

        <div class="wrapper">

            <style>

                .preloader .loader {

                    text-align: center;

                    display: flex;

                    justify-content: center;

                    align-items: center;

                    height: -webkit-fill-available;

                }
                .preloader .loader .loader_img {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 120px;
                    height: 120px;
                    margin:-60px 0 0 -60px;
                    -webkit-animation:spin 4s linear infinite;
                    -moz-animation:spin 4s linear infinite;
                    animation:spin 4s linear infinite;
                }
                @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
                @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
                @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
            </style>

            <div class="preloader" id="preloader">

                <div class="loader">

                   {{-- <svg class="spinner" viewbox="0 0 50 50">

                      <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>

                   </svg> --}}

                   <img src="{{IMAGE_URL}}favicon-loader.png" class="loader_img">

                </div>

            </div>



            <!-- tost message -->

           






            @include('layouts.elements.left_menu')

            <div class="content-page">

                <div class="content">

                    @include('layouts.elements.header')



                    @yield('content')

                </div>

                @include('layouts.elements.footer')

            </div>



        </div>

        <style>
            .select2-container--default .select2-selection--single .select2-selection__clear {
                padding-right: 10px;
                z-index: 99;
            }
        </style>

        <script src="{{JS_URL}}vendor.min.js"></script> 

        <script src="{{JS_URL}}app.min.js"></script> 

        <script src="{{JS_URL}}vendor/apexcharts.min.js"></script> 

        <script src="{{JS_URL}}vendor/jquery-jvectormap-1.2.2.min.js"></script> 

        <script src="{{JS_URL}}vendor/jquery-jvectormap-world-mill-en.js"></script> 

        <script src="{{JS_URL}}pages/demo.dashboard.js"></script> 

        <script src="{{JS_URL}}vendor/jquery.dataTables.min.js"></script> 

        <script src="{{JS_URL}}vendor/dataTables.bootstrap4.js"></script> 

        <script src="{{JS_URL}}vendor/dataTables.responsive.min.js"></script> 

        <script src="{{JS_URL}}vendor/responsive.bootstrap4.min.js"></script> 

        <script src="{{JS_URL}}vendor/dataTables.buttons.min.js"></script> 

        <script src="{{JS_URL}}vendor/buttons.bootstrap4.min.js"></script> 

        <script src="{{JS_URL}}vendor/buttons.html5.min.js"></script> 

        <script src="{{JS_URL}}vendor/dataTables.keyTable.min.js"></script> 

        <script src="{{JS_URL}}vendor/dataTables.select.min.js"></script> 

        <script src="{{JS_URL}}pages/demo.datatable-init.js"></script>

        

        <script src="{{JS_URL}}angularjs/app.js"></script> 



        <script>

            $(document).ready(function () {

                $(".btn-group > button.btn").on("click", function(){

                    var letter =  $(this).text();        

                    $(".searchable tr td:nth-child(1)").each(function () {

                        $(this).parent().show();            

                        if(!$(this).text().toUpperCase().indexOf(letter) == 0  && letter !== 'ALL'){

                            $(this).parent().hide();

                        }

                    });      

                });

                

            });

        </script>

        <!-- Image Preview start---->    
        <script type="text/javascript">
            $("input[type=file]").change(function() {
                var filename = $(this).val().replace(/.*(\/|\\)/, '');
                $(this).next().text(filename);
            });
        </script>
        <!-- Image Preview end----->   

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <script type="text/javascript">
            $('.show_confirm').click(function(event) {
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                Swal.fire({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.image-popup-vertical-fit').magnificPopup({
                    type: 'image',
                    mainClass: 'mfp-with-zoom', 
                    gallery:{
                        enabled:true
                    },
                    zoom: {
                        enabled: true, 
                        duration: 300, // duration of the effect, in milliseconds
                        easing: 'ease-in-out', // CSS transition easing function
                        opener: function(openerElement) {
                            return openerElement.is('img') ? openerElement : openerElement.find('img');
                        }
                    }
                });
            });	
        </script>

        @yield('script')



    </body>

</html>