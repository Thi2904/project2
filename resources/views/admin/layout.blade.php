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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <button id="show_addTeacher" style="margin-top: 300px;margin-left: 12px;width: 250px; font-size: 16px" class="button-add-student"><i style="margin-right: 12px" class='bx bx-user-plus'></i> Thêm tài khoản giảng viên </button>

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
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif
                @if(session()->has('warning'))
                    <div class="alert alert-danger">
                        {{session()->get('warning')}}
                    </div>
                @endif
                @error('password')
                <div class="alert alert-danger">Mật khẩu cần có ít nhất 8 kí tự</div>
                @enderror
                <h1>Bảng điều khiển</h1>
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
                <div id="popup_addTeacher" class="popupAdd">
                    <div class="close-btn">&times;</div>
                    <h3 style="text-align: center">Tạo tài khoản giảng viên</h3>
                    <form method="post" action="{{route('register')}}">
                        @csrf
                        <input type="hidden" name="role" value="teacher">
                        <div class="form-element">
                            <label class="form-label" for="form2Example37">Họ và tên</label>
                            <input type="text" name="name" id="form2Example37" placeholder="Họ và tên" class="form-control form-control-lg" />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="form2Example27">Số điện thoại</label>
                            <input type="text" name="phone" id="form2Example27" placeholder="Số điện thoại" class="form-control form-control-lg" />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="form2Example7">Địa chỉ</label>
                            <input type="text" name="address" id="form2Example7" placeholder="Địa chỉ" class="form-control form-control-lg" />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="form2Example1">Địa chỉ email</label>
                            <input name="email" type="text" id="form2Example1" placeholder="Địa chỉ email" class="form-control form-control-lg" />
                        </div>

                        <div class="form-element">
                            <label class="form-label"  for="form2Example27">Mật khẩu</label>
                            <input name="password"  type="text" placeholder="Mật khẩu" id="form2Example27" class="form-control form-control-lg" />

                        </div>

                        <div class="form-element">
                            <button type="submit" name="register">Tạo tài khoản</button>

                        </div>

                    </form>
                </div>
                @yield('content')
            </div>
        </div>

    </main>
    @yield('fileJs')
    <!-- MAIN -->
</section>
<script>
    var addTeacher = document.querySelector("#show_addTeacher")
    addTeacher.addEventListener("click",function () {
        document.querySelector(".popupAdd").classList.add("active")
    });
    document.querySelector(".popupAdd .close-btn")
        .addEventListener("click",function (){
            document.querySelector(".popupAdd").classList.remove("active");
    });
</script>
<div id="overlay" class="hidden"></div>
</body>
</html>

