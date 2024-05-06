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
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {max-width:1480px; margin:0}

        .bg-main{
            background: blue;
            color: white;
            padding: 0;
            border-bottom-right-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn-main{
            background: #5959f6;
            color: white;

        }
        .main_content{
            height: 100vh;

        }
        .avatar img{
            border-radius: 50%;
        }
        .btn-out{
            position: absolute;
            top: -150%;
        }
        .search{
            position: relative;
            margin-right: 24px;
        }
        .bell{
            margin-right: 18px;
        }
        .search_content{
            position: absolute;
            top: -150%;
            right: 8.5%;
            opacity: 0;
            height: 30px;
            width: 200px;
            border-radius: 10px;
            padding: 5px;
        }
        .search_content.active{
            top: 13%;
            opacity: 1;
            animation: ease-in;
        }
        ul{
            list-style: none;
        }
        li{
            display: flex;
            align-items: center;
            align-content: center;
            justify-content: center;
        }
        .nentrang{
            height: 50px;
            width: 100%;
            background: white;
            color: blue;
            border-bottom-left-radius: 10px;
            border-top-left-radius: 10px;
        }
        .ele_diemdanh b{
            margin-top: 12px;
            font-size: 20px;
        }
        .ele_diemdanh span{
            margin-top: 12px;
            font-size: 20px;
        }

    </style>
    <title>Document</title>
</head>
<body>
<div class="row main_content">
    <div class="bg-main col-lg-2">
        <h3 class="mt-5" style="text-align: center">BKACAD</h3>
        <ul class="list_diemdanh mt-4">
            <li class="ele_diemdanh nentrang">
                <div>
                        <span>
                        <i class="fa-solid fa-clipboard-user"></i>
                        </span>
                    <b>Điểm danh</b>
                </div>
            </li>
        </ul>
    </div>
    <div class="col-lg-10">
        <div class="head mt-5 d-flex justify-content-between">
            <div class="">
                <h3>Diem danh</h3>
                <p>Diem danh</p>
            </div>
            <div class="d-flex">

                <div class="mt-2 bell">
                    <i class="fa-solid fa-bell"></i>
                </div>

                <div class="mt-2 search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <form action="">
                    <input placeholder="Search something" class="search_content" type="text">
                    <button style="display: none" type="submit"></button>
                </form>
                <div class="avatar mt-1 mb-2" style="text-align: end; margin-right: 12px">
                    <b style="color: #0a53be; margin-right: 2px">{{\Illuminate\Support\Facades\Auth::user()->name}}</b>
                    <span style="font-size: 20px" class="show_logout"><i class="fa-solid fa-caret-down"></i></span>
                    <form style="margin-right: 0" class="mt-2" method="post" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="btn-out btn-not-out btn btn-dark me-2">Logout</button>
                    </form>
                </div>

            </div>
        </div>
        @yield('content')


    </div>
</div>
<script src="{{asset('js/teacher.js')}}"></script>
</body>
</html>

{{--<h1>This is...whatever</h1>--}}
{{--<p class="me-2">--}}

{{--</p>--}}

{{--@stack('scripts')--}}

{{--<div id="calendar">--}}
{{--    @push('scripts')--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>--}}
{{--        <script>--}}
{{--            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                var calendarEl = document.getElementById('calendar');--}}
{{--                var calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--                    initialView: 'timeGridWeek',--}}
{{--                    slotMinTime: '8:00:00',--}}
{{--                    slotMaxTime: '19:00:00',--}}
{{--                    --}}{{--events: @json($events),--}}
{{--                });--}}
{{--                calendar.render();--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endpush--}}

{{--</div>--}}
