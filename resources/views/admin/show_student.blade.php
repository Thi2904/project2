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

        <li class="sidebarActive" style="display: flex;">

            <a style="width: 90% !important;" href="{{route('admin.student')}}">
                <i class='bx bxs-user' ></i>
                <span   class="text">Sinh Viên </span>
            </a>
{{--            <i style="margin-top: 10px" id="student_dropDown" class='bx bxs-chevron-down' ></i>--}}

        </li>

        <li class="">
            <a href="{{route('showSpecialized')}}">
                <i class='bx bxl-slack' ></i>
                <span class="text">Chuyên ngành và CTDT</span>
            </a>
        </li>
        <li style="display: flex">
            <a style="width: 90% !important;" href="{{route('studyShift')}}">
                <i class='bx bxs-calendar' ></i>
                <span class="text">Ca học</span>
            </a>
            <i style="margin-top: 10px" id="calender_dropDown" class='bx bxs-chevron-down' ></i>

        </li>

        <ul class="listCalenderAction" >
            <li  style="color: black ; padding: 4px">
                <a href="#">
                    <i class='bx bxs-calendar-check'></i>
                    <span>Quản lý ca học</span>
                </a>
            </li>
        </ul>

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
        .popup-edit.active{
            top: 8%;
            opacity: 1;
        }
    </style>
    <div class="head list_student">
        <h3>Danh sách sinh viên</h3>
        <div style="margin-right: 12px" class="searchInput">
            <label>
                <form style="display: flex; margin-top: 10px" action="">
                    <input name="keyword" type="text" class="search_form" placeholder="Tìm kiếm"/>
                    <button hidden type="submit"></button>
                </form>
            </label>
        </div>
        <i class='click_search bx bx-search'></i>
        <i class='click_search bx bx-filter'></i>
    </div>

    <table class="list_student">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Lớp</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $key =>  $student)
            <tr>
                <td>
                    <p>{{ $student->id }}</p>
                </td>
                <td><p>{{ $student->studentName }}</p></td>
                <td><p>{{ $student->className }}</p></td>
                <td>
                    <button id=edit-"{{$student->id}}" data-popup-id="{{$student->id}}" class="button-edit" >Chỉnh sửa</button>
                    <div id="popupEdit-{{$student->id}}" class="popup-edit">
                        <div class="close-btn">&times;</div>
                        <form action="{{ route('editStudent',['student' => $student->id])}}" method="POST">
                            @csrf
                            <h2 class="nameAction">Chỉnh sửa thông tin sinh viên</h2>
                            <div class="form-element">
                                <label for="studentName">Tên</label>
                                <input name="studentName" type="text" id="studentName" placeholder="Nhập tên">
                            </div>
{{--                            <div class="form-element">--}}
{{--                                <label for="StudentID">StudentID</label>--}}
{{--                                <input name="StudentID" type="text" id="StudentID" placeholder="Enter ID">--}}
{{--                            </div>--}}
                            <div class="form-element">
                                <label for="email">Email</label>
                                <input name="email" type="text" id="email" placeholder="Nhập email">
                            </div>
                            <div class="form-element">
                                <label for="phoneNumber">Số điện thoại</label>
                                <input name="phoneNumber" type="text" id="phoneNumber" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="form-element">
                                <label for="gender"> Tên chuyên ngành </label>
                                <select class="select-element" name="gender" id="gender">
                                    <option value="Male">Nam</option>
                                    <option value="Female">Nữ</option>
                                </select>
                            </div>

{{--                            <div class="form-element">--}}
{{--                                <input name="classID" type="hidden" id="classID">--}}
{{--                            </div>--}}
                            <div class="form-element">
                                <button type="submit">Chỉnh sửa</button>
                            </div>
                        </form>
                    </div>
                    <form action="{{ route('deleteStudent',['student' => $student->id,'checkAtt' => $checkAttent[$key]->attend_detail_count]) }}" onsubmit="return confirm('Do you want delete this student ? ')" style="display: inline;" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button-delete" type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="custom-pagination">
        <div class="page-info">Trang {{ $students->currentPage() }} / {{ $students->lastPage() }}</div>
        <div class="page-links">
            @if($students->currentPage() > 1)
                <a href="{{ $students->previousPageUrl() }}" class="custom-pagination-link">&laquo; Previous</a>
            @endif

            @for($i = 1; $i <= $students->lastPage(); $i++)
                @if($i == $students->currentPage())
                    <span class="custom-pagination-link current-page">{{ $i }}</span>
                @else
                    <a href="{{ $students->url($i) }}" class="custom-pagination-link">{{ $i }}</a>
                @endif
            @endfor

            @if($students->hasMorePages())
                <a href="{{ $students->nextPageUrl() }}" class="custom-pagination-link">Next &raquo;</a>
            @endif
        </div>
    </div>
@endsection('content')
@section('fileJs')
    <script src="{{asset('js/student.js')}}"></script>
@endsection
