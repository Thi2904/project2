<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin</title>
    <style>
        .alert{position:relative;padding:.75rem 1.25rem;margin-bottom:1rem;border:1px solid transparent;border-radius:.25rem}
        .alert-success{color:#155724;background-color:#d4edda;border-color:#c3e6cb}.alert-success hr{border-top-color:#b1dfbb}.alert-success .alert-link{color:#0b2e13}
        .alert-danger{color:#721c24;background-color:#f8d7da;border-color:#f5c6cb}.alert-danger hr{border-top-color:#f1b0b7}.alert-danger .alert-link{color:#491217}

        .rounded{
            border-radius:.25rem!important
        }
    </style>
</head>
<body>
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">BKAHUB</span>
    </a>
    @yield('sidebar_top')
    {{--        <ul class="side-menu">--}}
    {{--            <li>--}}
    {{--                <a href="#">--}}
    {{--                    <i class='bx bxs-cog' ></i>--}}
    {{--                    <span class="text">Settings</span>--}}
    {{--                </a>--}}
    {{--            </li>--}}

    {{--        </ul>--}}
</section>
<!-- SIDEBAR -->



<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu' ></i>

        <form>
            <div class="form-input">

            </div>
        </form>
        {{--            <input type="checkbox" id="switch-mode" hidden>--}}
        {{--            <label for="switch-mode" class="switch-mode"></label>--}}
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            <img src="{{asset('IMG/HD-wallpaper-jujutsu-kaisen-op-strong-anime-gojo-satoru-love.jpg')}}">
        </a>
        <div class="">
                <span class="me-2">
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                </span>
            <form method="post" action="{{route('logout')}}">
                @csrf
                <button type="submit" class="btn-logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
            </form>
        </div>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                @yield('tro')
            </div>

        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check' ></i>
                <span class="text">

                                @yield('narno')


                </span>
            </li>
            {{--                <li>--}}
            {{--                    <i class='bx bxs-group' ></i>--}}
            {{--                    <span class="text">--}}
            {{--                                <h3></h3>--}}
            {{--                                <p></p>--}}
            {{--                    </span>--}}
            {{--                </li>--}}
            {{--                <li>--}}
            {{--                    <i class='bx bxs-dollar-circle' ></i>--}}
            {{--                    <span class="text">--}}
            {{--                                <h3></h3>--}}
            {{--                                <p></p>--}}
            {{--                            </span>--}}
            {{--                </li>--}}
        </ul>


        <div class="table-data">
            <div class="order">
                @yield('content')
            </div>
        </div>
    </main>
    @yield('fileJs')
    <!-- MAIN -->
</section>

</body>
</html>

