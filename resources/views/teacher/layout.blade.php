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
    <link rel="stylesheet" href="{{asset('css/teacher.css')}}">
    <title>BKACAD</title>
</head>
<body>
<div class="row main_content">
    <div id="sidebar" class="bg-main col-lg-2">
        <div class="side-menuTop">
            <i class="fa-solid fa-house"></i>
            <a href="">
                <span>BKAHUB</span>
            </a>
        </div>
        <ul class="side-menu">
            <li class="sideActive">
                <i class="fa-solid fa-calendar-days"></i>
                <a href="">
                    <span>Điểm danh</span>
                </a>
            </li>
            <li>
                <i class="fa-solid fa-calendar-check"></i>
                <a href="">
                    <span>Chuyên cần</span>
                </a>
            </li>
            <li>
                <i class="fa-solid fa-retweet"></i>
                <a href="">
                    <span>Dạy thay</span>
                </a>
            </li>
        </ul>
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
                    <span style="font-size: 20px" class="show_logout"><i class="fa-solid fa-caret-down"></i></span>
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
                <div class="alert alert-success" id="success-alert">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('warning'))
                <div class="alert alert-danger" id="warning-alert">
                    {{ session()->get('warning') }}
                </div>
            @endif
            @yield('content')
        </div>


    </div>
</div>
<script src="{{asset('js/teacher.js')}}"></script>
</body>
</html>
