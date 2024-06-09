@extends('admin/layout')

@section('title', 'Product Details')
@section('sidebar_top')
    <ul class="side-menu top">
        <li class="">
            <a href="{{route('admin.home')}}">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Lớp</span>
            </a>
        </li>

        <li class="sidebarActive">
            <a href="{{route('admin.student')}}">
                <i class='bx bxs-user' ></i>
                <span class="text">Sinh Viên</span>
            </a>
        </li>
        <li>
            <a href="{{route('showSpecialized')}}">
                <i class='bx bxl-slack' ></i>
                <span class="text">Chuyên ngành và CTDT</span>
            </a>
        </li>
        <li>
            <a href="{{route('studyShift')}}">
                <i class='bx bxs-calendar' ></i>
                <span class="text">Ca học</span>
            </a>
        </li>
        <li>
            <a href="{{route('showTeacher')}}">
                <i class='bx bxs-graduation'></i>
                <span class="text">Giảng viên</span>
            </a>
        </li>

    </ul>
@endsection
@section('tro')

    <ul class="my-breadcrumb ">
        <li>
            <a href="#">Bảng điều khiển</a>
        </li>
        <li><i class='bx bx-chevron-right' ></i></li>
        <li>
            <a class="active" href="#">Sinh Viên</a>
        </li>
    </ul>

@endsection('tro')

@section('narno')
    <h3>Tổng sinh viên</h3>
@endsection('narno')

@section('content')
    <style>
        .button-add-student{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 40px;
            width: 200px;
            background: var(--blue);
            border-radius: 5px;
            border: none;
            color: white;
        }
        .button-add-student:hover{
            opacity: 0.8;
            color: white;
        }
        a{

            text-decoration: none;
            text-align: center;
        }
        a:hover{
            color: blue;
        }
        .card{
            width: 48%;
            margin-bottom: 12px;
            margin-right: 12px;
        }
        .body-list{
            display: flex;
            flex-wrap: wrap;
        }
        .popup.active{
            top: 8%;
        }
        .select-element{
            margin-top: 5px;
            display: block;
            width: 100%;
            padding: 10px;
            outline: none;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        .icon_left{
            margin-left: 15px;
            font-size: 22px;
            position: relative;
            animation: chuyenDong 0.5s infinite;
        }
        @keyframes chuyenDong {
            from {
                transform: translateX(-5px)

            }
            to {
                transform: translateX(0px);

            }
        }

        .head-list{
            display: flex;
            justify-content: end;
        }
    </style>
    <div class="head-list">
        <div style="display: flex">
            <div style="margin-right: 12px" class="searchInput">
                <label>
                    <form action="">
                        <input name="keyword" type="text" class="search_form" placeholder="Tìm kiếm"/>
                        <button type="submit"></button>
                    </form>
                </label>
            </div>
            <i class='click_search bx bx-search' ></i>
            <i class='bx bx-filter' ></i>
        </div>
    </div>
    <div class="body-list">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Lớp</th>
                <th>Khóa</th>
                <th>Tổng sinh viên</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($classes as $key => $class)
                <tr>
                    <td>{{$class->id}}</td>
                    <td>
                        <a href="{{ route('class.show', ['class' => $class->id]) }}">
                            <span>{{ $class->className }}</span>
                        </a>
                    </td>
                    <td>{{ $class->grade }}</td>
                    <td>{{$stuCount[$key]-> student_count}}</td>
                    <td>
                        <button id="{{$class->id}}" data-popup-id="{{$class->id}}" class="show-add button-add-student">Thêm sinh viên</button>
                        <div id="popup-{{$class->id}}" class="popup">
                            <div class="close-btn">&times;</div>
                            <form action="{{ route('addStudent')}}" method="POST">
                                @csrf
                                <input type="hidden" id="{{ $class->id }}" name="classID" value="{{ $class->id }}">
                                <h2 class="nameAction">Thêm sinh viên</h2>
                                <div class="form-element">
                                    <label for="studentName">Tên</label>
                                    <input name="studentName" type="text" id="studentName" placeholder="Nhập tên">
                                </div><div class="form-element">
                                    <label for="email">Email</label>
                                    <input name="email" type="text" id="email" placeholder="Nhập Email">
                                </div>
                                <div class="form-element">
                                    <label for="phoneNumber">Số điện thoại</label>
                                    <input name="phoneNumber" type="text" id="phoneNumber" placeholder="Nhập số điện thoại">
                                </div>
                                <div class="form-element">
                                    <label for="gender"> Giới tính </label>
                                    <select class="select-element" name="gender" id="gender">
                                        <option value="Male">Nam</option>
                                        <option value="Female">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-element">
                                    <button type="submit">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection('content')
@section('fileJs')
    <script src="{{asset('js/student.js')}}"></script>
@endsection

