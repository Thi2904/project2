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

        <li class="">
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
        <li class="">
            <a href="{{route('studyShift')}}">
                <i class='bx bxs-calendar' ></i>
                <span class="text">Ca học</span>
            </a>
        </li>
        <li class="sidebarActive">
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
            <a class="active" href="#">Giảng viên</a>
        </li>
    </ul>

@endsection('tro')
@section('narno')
    <h3>Tổng số giảng viên</h3>
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
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .button-edit{
            height: 40px;
            width: 110px;
            font-size: 15px;
        }
        .button-delete{
            height: 40px;
            width: 110px;
            font-size: 14px;
        }


    </style>
    <div class="head-list">
        <h3>Danh sách giảng viên</h3>

        <div style="display: flex">

            <div style="margin-right: 12px" class="searchInput">
                <label>
                    <form action="">
                        <input type="text" class="search_form" placeholder="Tìm kiếm"/>
                        <button type="submit"></button>
                    </form>
                </label>
            </div>
            <div >
                <button id="show-add" class="button-add">Thêm</button>
                <div class="popup">
                    <div class="close-btn">&times;</div>
                    <form action="{{ route('addTeacher')}}" method="POST">
                        @csrf
                        <h2 class="nameAction">Thêm giảng viên</h2>
                        <div class="form-element">
                            <label for="className">Chọn chuyên ngành</label>
                            <select class="select-element" name="majorID" id="majorID">
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}">
                                        {{ $major->majorName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="userID">Ten giảng viên</label>
                            <select class="select-element" name="userID" id="userID">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="teacherCode">Mã giảng viên</label>
                            <input name="teacherCode" type="text" id="teacherCode" placeholder="Nhập mã giảng viên">
                        </div>
                        <div class="form-element">
                            <button type="submit">Add</button>
                        </div>
                    </form>
                </div>
                <i class='click_search bx bx-search' ></i>
                <i class='bx bx-filter' ></i>
            </div>


        </div>
    </div>
    <div class="body-list">
        <table>
            <thead>
            <tr>
                <th>Mã giảng viên</th>
                <th>Tên chuyên ngành </th>
                <th>Email</th>
                <th>Mật khẩu</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teachers as $teacher)
                <tr>
                    <td>{{$teacher -> teacherCode}}</td>
                    <td>{{$teacher -> majorName}}</td>
                    <td>{{$teacher -> email}}</td>
                    <td>{{$teacher -> password}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection('content')
@section('fileJs')
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
