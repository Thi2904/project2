<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('css/teacher.css')}}">
    <title>BKACAD</title>
</head>
<body>
<div class="row main_content">
    <div id="sidebar" class="bg-main col-lg-2">
        <div class="side-menuTop mt-2" >
            <i class="fa-solid fa-house"></i>
            <a href="">
                <span>BKAHUB</span>
            </a>
        </div>
        @yield('sideBar')

    </div>
    <div class="contentBenTrong col-lg-10">
        <div class="head p-3 d-flex justify-content-between">
            <div class="" style="display: flex">
                <div>
                    <i style="cursor: pointer" class="icon_bar fa-solid fa-bars"></i>
                </div>
                <div class="">
                </div>
            </div>
            <div class="d-flex">

                <div class="mt-1 bell">
                    <i class="fa-solid fa-bell"></i>
                </div>

                <div class="mt-1 search">

                    <div class="searchInput" style="margin-right: 12px">
                        <form action="">
                            <input placeholder="Search something" class="search_content" type="text">
                            <button style="display: none" type="submit"></button>
                        </form>
                    </div>
                    <div class="">
                        <i class="search_icon fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>

                <div class="avatar" style="text-align: end; margin-right: 12px">
                    <b style="color: #0a53be; margin-right: 2px">{{\Illuminate\Support\Facades\Auth::user()->name}}</b>
                    <span style="font-size: 20px" class="show_logout"><i id="dropDowmTeacher" class="fa-solid fa-caret-down"></i></span>
                    <div class="drop_down drop_downActive mt-2">
                        <form style="margin-right: 0" method="post" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="drop_downItem log-out btn-not-out btn ">
{{--                                <i class="fa-solid fa-arrow-right-from-bracket"></i>--}}
                                Logout
                            </button>
                        </form>
                        <button class="drop_downItem btn me-2">
                            Profile
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <div class="main mt-3">
            @if(session()->has('success'))
                <script>
                    toastr.options = {
                        "progressBar": true,
                        "closeButton": true
                    }
                    toastr.success("{{ session()->get('success') }}","Thành công!", {timeOut:5000});
                </script>
            @endif
            @if(session()->has('error'))
                <script>
                    toastr.options = {
                        "progressBar": true,
                        "closeButton": true
                    }
                    toastr.error("{{ session()->get('error')}}","Lỗi!", {timeOut:5000});
                </script>
            @endif

            @if(session()->has('warn'))
                <script>
                    toastr.options = {
                        "progressBar": true,
                        "closeButton": true
                    }
                    toastr.warning("{{ session()->get('warn')}}","Thông báo!", {timeOut:5000});
                </script>
            @endif

            @yield('content')
        </div>


    </div>
</div>
<script src="{{asset('js/teacher.js')}}"></script>
</body>
</html>
