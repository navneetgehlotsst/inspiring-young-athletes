<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inspiring Young Athletes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('web/assets/images/new-img/favicon.svg')}}">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,900&display=swap" rel="stylesheet">
    <!-- LOAD CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/pgwslider.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/pgwslideshow.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/megamenu.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/custom.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">

    {{-- LOAD script --}}
    <script src="{{asset('web/assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




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
    {{-- @if(session('error'))
        <script>
            toastr.error('{{ session('error') }}');
        </script>
    @endif --}}
    <!-- PRE LOADER -->
    <div class="preloader">
        <div class='uil-ring-css' style='transform:scale(0.45);'>
            <div></div>
        </div>
    </div>
    @include('web.layouts.elements.header')
    @yield('content')
    @include('web.layouts.elements.footer')
    <!--Modal Box Start-->
    <!-- Button trigger modal -->
    <button type="button" class="ask-questions" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <img src="{{asset('web/assets/images/new-img/ask.svg')}}" alt="ask">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Ask a Question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" action="{{ route('web.askquestion.create') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <input type="text" name="name" class="form-control py-3 mb-4" placeholder="Full Name">
                        <input type="email" name="email" class="form-control py-3 mb-4" placeholder="Email">
                        <input type="text" name="atheliticsandcoachname" class="form-control py-3 mb-4" placeholder="Which Athlete or Coach would you like to ask a question">
                        <textarea class="form-control py-3 mb-4" name="askquestion" placeholder="Ask Question/s"></textarea>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn iya-btn-blue bg-dark" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn iya-btn-blue">Send</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!--Modal Box End-->
    {{-- login Model Start --}}
        <!-- Modal -->
        <div class="modal fade" id="Login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="staticEmail" value="">
                    </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword">
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Login</button>
                </div>
            </div>
            </div>
        </div>
    {{-- Login Model End --}}
    <!-- Load JS -->
    <script src="{{asset('web/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('web/assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('web/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('web/assets/js/pgwslideshow.min.js')}}"></script>
    <script src="{{asset('web/assets/js/pgwslider.min.js')}}"></script>
    <script src="{{asset('web/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('web/assets/js/jquery.lazy.min.js')}}"></script>
    <script src="{{asset('web/assets/js/jquery.lazy.plugins.min.js')}}"></script>
    <script src="{{asset('web/assets/js/megamenu.js')}}"></script>
    <script src="{{asset('web/assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        function uploadImage(id) {
            let formData = new FormData(document.getElementById('imageUploadForm'+id));
            document.getElementById('formFileLg'+id).disabled = true;
            axios.post('{{ route("web.athletes.coach.uploadVideo") }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    document.getElementById('progress-bar-container'+ id).style.display = 'block';
                    document.getElementById('progress-bar'+id).style.width = percentCompleted + '%';
                    document.getElementById('progress-bar'+id).innerText = percentCompleted + '%';
                    document.getElementById('progress-text'+id).innerText = percentCompleted + '%';
                },
            })
                .then(function (response) {
                    console.error(response.data.success);
                    if(response.data.success == true){
                        document.getElementById('uploadStatus'+id).innerHTML = response.data.message;
                        $("#uploadStatus"+id).addClass("Videosucces");
                        $("#uploadStatus"+id).removeClass("Videoerror");
                        document.getElementById('showanswerecount').innerHTML = '';
                        document.getElementById('showanswerecount').innerHTML += response.data.count;
                        if(response.data.count == '0'){
                            document.getElementById('compltedquestioncount').innerHTML = '';
                            document.getElementById('compltedquestioncount').innerHTML += '0';
                        }else if(response.data.count > 1){
                            document.getElementById('compltedquestioncount').innerHTML = '';
                            document.getElementById('compltedquestioncount').innerHTML += '8';
                            //Swal.fire("Congratulations, you have activated your account, please go to the dashboard button below to add bank details for payments. There is nothing to tell you what to do next.!");
                        }else{
                            document.getElementById('compltedquestioncount').innerHTML = '';
                            document.getElementById('compltedquestioncount').innerHTML += response.data.count;
                            // Swal.fire("Congratulations, you have activated your account, please go to the dashboard button below to add bank details for payments. There is nothing to tell you what to do next.!");
                            Swal.fire({
                                title: "Congratulations",
                                text: "you have activated your account, please go to the dashboard button below to add bank details for payments. There is nothing to tell you what to do next.!",
                                icon: "question"
                            });
                        }
                        $("#imageUploadForm"+id).addClass("d-none");
                        $("#removeVideobutton"+id).removeClass("d-none");
                        $("#ansGiven"+id).removeClass("d-none");
                        document.getElementById('progress-bar-container'+ id).style.display = 'none';
                        if(response.data.count == 0){
                            $("#enabledisable").addClass("disabled");
                        }else if(response.data.count < 1){
                            $("#enabledisable").addClass("disabled");
                        }else{
                            $("#enabledisable").removeClass("disabled");
                            $("#enabledisable").addClass("enable");
                        }
                    }else{
                        document.getElementById('uploadStatus'+id).innerHTML = response.data.message;
                        $("#uploadStatus"+id).addClass("Videoerror");
                        $("#uploadStatus"+id).removeClass("Videosucces");
                        if(response.data.count == '0'){
                            document.getElementById('compltedquestioncount').innerHTML = '';
                           document.getElementById('compltedquestioncount').innerHTML += '0';
                        }else if(response.data.count > 1){
                            document.getElementById('compltedquestioncount').innerHTML = '';
                            document.getElementById('compltedquestioncount').innerHTML += '8';
                        }else{
                            document.getElementById('compltedquestioncount').innerHTML = '';
                            document.getElementById('compltedquestioncount').innerHTML += response.data.count;
                        }
                        document.getElementById('compltedquestioncount').innerHTML = '';
                        document.getElementById('compltedquestioncount').innerHTML += response.data.count ;
                        document.getElementById('progress-bar-container'+ id).style.display = 'none';
                        if(error.response.data.count == 0){
                            $("#enabledisable").addClass("disabled");
                        }else if(error.response.data.count < 1){
                            $("#enabledisable").addClass("disabled");
                        }else{
                            $("#enabledisable").removeClass("disabled");
                            $("#enabledisable").addClass("enable");
                        }
                    }
                })
                .catch(function (error) {
                    console.error(error.response);
                    document.getElementById('uploadStatus'+id).innerHTML = error.response.data.message;
                    $("#uploadStatus"+id).addClass("Videoerror");
                    $("#uploadStatus"+id).removeClass("Videosucces");
                    document.getElementById('showanswerecount').innerHTML = '';
                    document.getElementById('showanswerecount').innerHTML += error.response.data.count ;
                    document.getElementById('compltedquestioncount').innerHTML = '';
                    document.getElementById('compltedquestioncount').innerHTML += error.response.data.count ;
                    document.getElementById('progress-bar-container'+ id).style.display = 'none';
                    if(error.response.data.count == 0){
                        $("#enabledisable").addClass("disabled");
                    }else if(error.response.data.count < 1){
                        $("#enabledisable").addClass("disabled");
                    }else{
                        $("#enabledisable").removeClass("disabled");
                        $("#enabledisable").addClass("enable");
                    }
                });
        }

        function uploadIntroVideo(id) {
            let formData = new FormData(document.getElementById('imageUploadForm'+id));
            document.getElementById('formFileLg'+id).disabled = true;
            axios.post('{{ route("web.athletes.coach.uploadVideo") }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    document.getElementById('progress-bar-containerintro').style.display = 'block';
                    document.getElementById('progress-barintro').style.width = percentCompleted + '%';
                    document.getElementById('progress-barintro').innerText = percentCompleted + '%';
                    // document.getElementById('progress-text'+id).innerText = percentCompleted + '%';
                },
            })
                .then(function (response) {
                    console.log(response.data.success);
                    if(response.data.success == true){
                        $("#saveintro").removeClass("disabled");
                        console.log(response.data.message)
                        document.getElementById('uploadStatusintro').innerHTML = response.data.message;
                        $("#removeprogrssbarintro").addClass("d-none");
                        $("#uploadStatusintro").addClass("Videosucces");
                        $("#uploadStatusintro").removeClass("Videoerror");
                        // document.getElementById('showanswerecount').innerHTML = '';
                        // document.getElementById('showanswerecount').innerHTML += response.data.count;
                        // if(response.data.count == '0'){
                        //     document.getElementById('compltedquestioncount').innerHTML = '';
                        //    document.getElementById('compltedquestioncount').innerHTML += '0';
                        // }else if(response.data.count > 1){
                        //     document.getElementById('compltedquestioncount').innerHTML = '';
                        //     document.getElementById('compltedquestioncount').innerHTML += '8';
                        // }else{
                        //     document.getElementById('compltedquestioncount').innerHTML = '';
                        //     document.getElementById('compltedquestioncount').innerHTML += response.data.count;
                        // }
                        $("#imageUploadFormintro").addClass("d-none");
                        $("#removevideobuttonintro").removeClass("d-none");
                        $("#ansGiven"+id).removeClass("d-none");

                        document.getElementById('progress-bar-containerintro').style.display = 'none';
                        if(response.data.count == 0){
                            $("#enabledisable").addClass("disabled");
                        }else if(response.data.count < 1){
                            $("#enabledisable").addClass("disabled");
                        }else{
                            $("#enabledisable").removeClass("disabled");
                            $("#enabledisable").addClass("enable");

                        }
                    }else{
                        document.getElementById('uploadStatusintro').innerHTML = response.data.message;
                        $("#uploadStatusintro").addClass("Videoerror");
                        $("#uploadStatusintro").removeClass("Videosucces");
                        if(response.data.count == '0'){
                            document.getElementById('compltedquestioncount').innerHTML = '';
                           document.getElementById('compltedquestioncount').innerHTML += '0';
                        }else if(response.data.count > 1){
                            document.getElementById('compltedquestioncount').innerHTML = '';
                            document.getElementById('compltedquestioncount').innerHTML += '8';
                        }else{
                            document.getElementById('compltedquestioncount').innerHTML = '';
                            document.getElementById('compltedquestioncount').innerHTML += response.data.count;
                        }
                        document.getElementById('compltedquestioncount').innerHTML = '';
                        document.getElementById('compltedquestioncount').innerHTML += response.data.count ;
                        document.getElementById('progress-bar-container'+ id).style.display = 'none';
                        if(error.response.data.count == 0){
                            $("#enabledisable").addClass("disabled");
                        }else if(error.response.data.count < 1){
                            $("#enabledisable").addClass("disabled");
                        }else{
                            $("#enabledisable").removeClass("disabled");
                            $("#enabledisable").addClass("enable");
                        }
                    }
                })
                // .catch(function (error) {
                //     document.getElementById('uploadStatusintro').innerHTML = error.response.data.message;
                //     $("#uploadStatusintro").addClass("Videoerror");
                //     $("#uploadStatusintro").removeClass("Videosucces");
                //     document.getElementById('showanswerecount').innerHTML = '';
                //     document.getElementById('showanswerecount').innerHTML += error.response.data.count ;
                //     document.getElementById('compltedquestioncount').innerHTML = '';
                //     document.getElementById('compltedquestioncount').innerHTML += error.response.data.count ;
                //     document.getElementById('progress-bar-containerintro').style.display = 'none';
                //     if(error.response.data.count == 0){
                //         $("#enabledisable").addClass("disabled");
                //     }else if(error.response.data.count < 1){
                //         $("#enabledisable").addClass("disabled");
                //     }else{
                //         $("#enabledisable").removeClass("disabled");
                //         $("#enabledisable").addClass("enable");
                //     }
                // });
        }


        function uploadIntroVideo(id) {
            let formData = new FormData(document.getElementById('imageUploadForm'+id));
            document.getElementById('formFileLg'+id).disabled = true;
            axios.post('{{ route("web.athletes.coach.uploadVideo") }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    document.getElementById('progress-bar-containerintro').style.display = 'block';
                    document.getElementById('progress-barintro').style.width = percentCompleted + '%';
                    document.getElementById('progress-barintro').innerText = percentCompleted + '%';
                    // document.getElementById('progress-text'+id).innerText = percentCompleted + '%';
                },
            })
                .then(function (response) {
                    console.log(response.data.success);
                    if(response.data.success == true){
                        $("#saveintro").removeClass("disabled");
                        console.log(response.data.message)
                        document.getElementById('uploadStatusintro').innerHTML = response.data.message;
                        $("#removeprogrssbarintro").addClass("d-none");
                        $("#uploadStatusintro").addClass("Videosucces");
                        $("#uploadStatusintro").removeClass("Videoerror");
                        $("#imageUploadFormintro").addClass("d-none");
                        $("#ansGiven"+id).removeClass("d-none");
                        $("#progress-barintro").removeClass("bg-success");
                        $("#progress-barintro").addClass("bg-info");

                        // document.getElementById('progress-bar-containerintro').style.display = 'none';
                        if(response.data.count == 0){
                            $("#enabledisable").addClass("disabled");
                        }else if(response.data.count < 1){
                            $("#enabledisable").addClass("disabled");
                        }else{
                            $("#enabledisable").removeClass("disabled");
                            $("#enabledisable").addClass("enable");

                        }
                    }else{
                        document.getElementById('uploadStatusintro').innerHTML = response.data.message;
                        $("#imageUploadFormintro").addClass("d-none");
                        $("#uploadStatusintro").addClass("Videoerror");
                        $("#uploadStatusintro").removeClass("Videosucces");
                        if(error.response.data.count == 0){
                            $("#enabledisable").addClass("disabled");
                        }else if(error.response.data.count < 1){
                            $("#enabledisable").addClass("disabled");
                        }else{
                            $("#enabledisable").removeClass("disabled");
                            $("#enabledisable").addClass("enable");
                        }
                    }
                })
        }


        function uploadAddVideo(id) {
            var title = $('#title').val();
            var formFileLgaddvideo = $('#formFileLgaddvideo').val();

            if(title == ""){
                $("#titlemessgae").removeClass("d-none");
                return false;
            }

            if($("#formFileLgaddvideo").length == '0'){
                console.log(formFileLgaddvideo);
                $("#formFileLgaddvideocheck").removeClass("d-none");
                return false;
            }
            let formData = new FormData(document.getElementById('imageUploadFormaddvideo'));
            document.getElementById('formFileLg'+id).disabled = true;
            axios.post('{{ route("web.Video.store") }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    document.getElementById('progressbarcontaineraddVideo').style.display = 'block';
                    document.getElementById('progressbaraddVideo').style.width = percentCompleted + '%';
                    document.getElementById('progressbaraddVideo').innerText = percentCompleted + '%';
                    // document.getElementById('progress-text'+id).innerText = percentCompleted + '%';
                },
            })
            .then(function (response) {
                console.log(response.data.message);
                if(response.data.success == true){
                    document.getElementById('uploadStatusaddVideo').innerHTML = response.data.message;
                    $("#removeprogrssbaraddVideo").addClass("d-none");
                    $("#uploadStatusaddVideo").addClass("Videosucces");
                    $("#uploadStatusaddVideo").removeClass("Videoerror");
                    //$("#imageUploadFormaddvideo").addClass("d-none");
                    $("#ansGiven"+id).removeClass("d-none");
                    $("#progressbaraddVideo").removeClass("bg-info");
                    $("#progressbaraddVideo").addClass("bg-success");
                    window.location.replace("{{ route('web.Video.index','new_video') }}");
                }else{
                    document.getElementById('uploadStatusaddVideo').innerHTML = response.data.message;
                    //$("#imageUploadFormaddvideo").addClass("d-none");
                    $("#uploadStatusaddVideo").addClass("Videoerror");
                    $("#uploadStatusaddVideo").removeClass("Videosucces");
                }
            })
        }

        function uploadEditVideo(id) {
            var title = $('#title').val();
            var formFileLgaddvideo = $('#formFileLgeditvideo').val();


            if(title == ""){
                $("#titlemessgae").removeClass("d-none");
                return false;
            }

            if(formFileLgaddvideo.length == '0'){
                console.log(formFileLgaddvideo);
                $("#formFileLgeditvideocheck").removeClass("d-none");
                return false;
            }
            let formData = new FormData(document.getElementById('imageUploadFormeditvideo'));
            document.getElementById('formFileLg'+id).disabled = true;
            axios.post('{{ route("web.Video.update") }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    document.getElementById('progressbarcontainereditVideo').style.display = 'block';
                    document.getElementById('progressbareditVideo').style.width = percentCompleted + '%';
                    document.getElementById('progressbareditVideo').innerText = percentCompleted + '%';
                    // document.getElementById('progress-text'+id).innerText = percentCompleted + '%';
                },
            })
                .then(function (response) {
                    console.log(response.data.message);
                    if(response.data.success == true){
                        document.getElementById('uploadStatuseditVideo').innerHTML = response.data.message;
                        $("#removeprogrssbareditVideo").addClass("d-none");
                        $("#uploadStatuseditVideo").addClass("Videosucces");
                        $("#uploadStatuseditVideo").removeClass("Videoerror");
                        //$("#imageUploadFormeditvideo").addClass("d-none");
                        $("#ansGiven"+id).removeClass("d-none");
                        $("#progressbareditVideo").removeClass("bg-info");
                        $("#progressbareditVideo").addClass("bg-success");
                        window.location.replace("{{ route('web.Video.index','edit_video') }}");
                    }else{
                        document.getElementById('uploadStatuseditVideo').innerHTML = response.data.message;
                        //$("#imageUploadFormeditvideo").addClass("d-none");
                        $("#uploadStatuseditVideo").addClass("Videoerror");
                        $("#uploadStatuseditVideo").removeClass("Videosucces");
                    }
                })
        }


        function uploadquesVideo(id) {
            var formFileLgaddvideo = $('#formFileLgaddquestiovideo').val();

            if(formFileLgaddvideo.length == '0'){
                console.log(formFileLgaddvideo);
                $("#formFileLgaddquestionvideocheck").removeClass("d-none");
                return false;
            }
            let formData = new FormData(document.getElementById('imageUploadFormaddquestiovideo'));
            document.getElementById('formFileLgaddquestiovideo').disabled = true;
            axios.post('{{ route("web.athletes.coach.question.store") }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    document.getElementById('progressbarcontaineraddquesVideo').style.display = 'block';
                    document.getElementById('progressbaraddquesVideo').style.width = percentCompleted + '%';
                    document.getElementById('progressbaraddquesVideo').innerText = percentCompleted + '%';
                    // document.getElementById('progress-text'+id).innerText = percentCompleted + '%';
                },
            })
                .then(function (response) {
                    console.log(response);
                    if(response.data.success == true){
                        document.getElementById('uploadStatusaddquesVideo').innerHTML = response.data.message;
                        $("#removeprogrssbareditVideo").addClass("d-none");
                        $("#uploadStatusaddquesVideo").addClass("Videosucces");
                        $("#uploadStatusaddquesVideo").removeClass("Videoerror");
                        //$("#imageUploadFormaddquestiovideo").addClass("d-none");
                        $("#ansGiven"+id).removeClass("d-none");
                        $("#progressbaraddquesVideo").removeClass("bg-info");
                        $("#progressbaraddquesVideo").addClass("bg-success");
                        window.location.replace("{{ route('web.athletes.coach.questionandanswere','add_question') }}");
                    }else{
                        document.getElementById('uploadStatusaddquesVideo').innerHTML = response.data.message;
                        ///$("#imageUploadFormaddquestiovideo").addClass("d-none");
                        $("#uploadStatusaddquesVideo").addClass("Videoerror");
                        $("#uploadStatusaddquesVideo").removeClass("Videosucces");
                    }
                })
        }


        function uploadqueseditVideo(id) {
            var formFileLgeditquestionvideo = $('#formFileLgeditquestionvideo').val();

            if(formFileLgeditquestionvideo.length == '0'){
                console.log(formFileLgeditquestionvideo);
                $("#formFileLgeditquestionvideocheck").removeClass("d-none");
                return false;
            }
            let formData = new FormData(document.getElementById('imageUploadFormeditquestiovideo'));
            document.getElementById('formFileLgeditquestionvideo').disabled = true;
            axios.post('{{ route("web.athletes.coach.question.update") }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                onUploadProgress: function (progressEvent) {
                    var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    document.getElementById('progressbarcontainereditquesVideo').style.display = 'block';
                    document.getElementById('progressbareditquesVideo').style.width = percentCompleted + '%';
                    document.getElementById('progressbareditquesVideo').innerText = percentCompleted + '%';
                    // document.getElementById('progress-text'+id).innerText = percentCompleted + '%';
                },
            })
                .then(function (response) {
                    console.log(response);
                    if(response.data.success == true){
                        document.getElementById('uploadStatuseditquesVideo').innerHTML = response.data.message;
                        $("#removeprogrssbareditquesVideo").addClass("d-none");
                        $("#uploadStatuseditquesVideo").addClass("Videosucces");
                        $("#uploadStatuseditquesVideo").removeClass("Videoerror");
                        //$("#imageUploadFormeditquestiovideo").addClass("d-none");
                        $("#ansGiven"+id).removeClass("d-none");
                        $("#progressbareditquesVideo").removeClass("bg-info");
                        $("#progressbareditquesVideo").addClass("bg-success");
                        window.location.replace("{{ route('web.athletes.coach.questionandanswere','update_question') }}");
                    }else{
                        document.getElementById('uploadStatuseditquesVideo').innerHTML = response.data.message;
                        ///$("#imageUploadFormeditquestiovideo").addClass("d-none");
                        $("#uploadStatuseditquesVideo").addClass("Videoerror");
                        $("#uploadStatuseditquesVideo").removeClass("Videosucces");
                    }
                })
        }

        function removevideo(id) {
            $.ajax({
                url: '{{ route("web.athletes.coach.removeVideo") }}',
                type: 'GET',
                data: {
                    id: id,
                },
                success: function (response) {
                    console.log(response);
                    $("#imageUploadForm"+id).removeClass("d-none");
                    $("#removeVideobutton"+id).addClass("d-none");
                    document.getElementById('showanswerecount').innerHTML = '';
                    document.getElementById('showanswerecount').innerHTML += response.count;
                    document.getElementById('compltedquestioncount').innerHTML = '';
                    document.getElementById('compltedquestioncount').innerHTML += response.count;
                    document.getElementById('uploadStatus'+id).innerHTML = response.message;
                    $("#uploadStatus"+id).addClass("Videosucces");
                    inputValue = $("#formFileLg"+id).val();
                    $("#ansGiven"+id).addClass("d-none");
                    document.getElementById('progress-bar-container'+ id).style.display = 'none';
                    if(response.count == 0){
                        $("#enabledisable").addClass("disabled");
                    }else if(response.count < 8){
                        $("#enabledisable").addClass("disabled");
                    }else{
                        $("#enabledisable").addClass("enable");
                    }
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle errors
                }
            });
        }

        function loginUser(id) {
            $.ajax({
                url: '{{ route("web.athletes.coach.removeVideo") }}',
                type: 'GET',
                data: {
                    id: id,
                },
                success: function (response) {
                    console.log(response);

                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle errors
                }
            });
        }

        $(document).ready(function(){
            $(".confrmationmsg").click(function(){
                swal.fire({
                    title: "Are you sure you want to proceed?",
                    text: "In that case, you won't be able to change your role!",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.replace("{{ route('web.athletes.coach.SaveAnswere') }}");
                    }
                });
            });
        });
    </script>

    <script>
        //show Video
        $(".showvideo").click(function(){
            var $this = $(this);
            var id = $this.data("question");
            var url = $this.data("url");
            var token = $("meta[name='csrf-token']").attr("content");

            $.post(url, { id: id, _token: token })
            .done(function(response) {
                console.log(response);
                if (response.success) {
                $('#modalVideo').modal('show');
                $('#viewVideo').attr('src', response.data.video);
                $('#VideoTitle').text(response.data.video_title);
                } else {
                Swal.fire("No Video Found", "", "info");
                }
            })
            .fail(function() {
                Swal.fire("Error", "Failed to retrieve video data", "error");
            });
        });
    </script>


    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#image-preview').attr('src', e.target.result);
            $('#image-preview').hide();
            $('#image-preview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
        }

        $("#file-input").change(function() {
        readURL(this);
        });
    </script>


    <script>
        function cancelUploade() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't to cancel!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
                //$(".refreshableDiv").load(location.href + ".refreshableDiv");
                // if (formData) {
                //     formData.abort();
                //     formData = null;
                //     console.log("Canceled");
                // }
                // return false;
            }
            });
        }
    </script>
</body>

</html>
