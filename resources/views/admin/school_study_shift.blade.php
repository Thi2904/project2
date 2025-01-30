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

        <li style="display: flex;">

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
        <li class="sidebarActive" style="display: flex">
            <a style="width: 90% !important;" href="{{route('studyShift')}}">
                <i style="z-index: 10000!important;" class='bx bxs-calendar' ></i>
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
            <a class="active" href="#">Lịch học</a>
        </li>
    </ul>

@endsection('tro')

@section('narno')
    <h3>Tổng ca học</h3>

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
        .button-add {
            height: 28px;
            width: 68px;
            background: var(--blue);
            border-radius: 5px;
            border: none;
            color: white;
        }
    </style>
    <div class="head">
        <h3>Danh sách ca học</h3>
        <div style="display: flex">
            <div style="display: flex">
                <div style="margin-right: 12px" class="searchInput">
                    <label>
                        <input type="text" class="search_form" placeholder="Tìm kiếm"/>
                    </label>
                </div>
                <div >
                    <i class='click_search bx bx-search' ></i>
                    <i class='bx bx-filter' ></i>
                </div>


            </div>
        </div>
    </div>
    <table>
        <thead>
        <tr>
{{--            <th>Tên môn</th>--}}
            <th>Ngày</th>
            <th>Ca học</th>
            <th>Phòng học</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($SchoolShifts as $SchoolShift)
            <tr>
{{--                <td>{{$SchoolShift}}</td>--}}
                <td>{{$SchoolShift->dateInWeek}}</td>
                <td>{{$SchoolShift->time_in}} - {{$SchoolShift->time_out}}</td>
                <td>{{$SchoolShift->classroomName}}</td>
                <td>
                    <button data-popup-id="{{$SchoolShift->schoolShiftDetail_id}}" class="show-edit button-edit">Sửa</button>
                    <div id="popupEdit-{{$SchoolShift->schoolShiftDetail_id}}"  class="popup-edit">
                        <div class="close-btn">&times;</div>
                        <form action="{{route('editSchoolShiftDetail',['SchoolShift' => $SchoolShift->schoolShiftDetail_id])}}" method="POST">
                            @csrf
                            <h2 class="nameAction">Sửa ca học</h2>
                            <input name="schoolShiftID" type="hidden" value="{{$SchoolShift->schoolShiftID}}">
                            <div class="form-element">
                                <label for="dateInWeek">Ngày học</label>
                                <select class="select-element" name="dateInWeek" id="dateInWeek">
                                    <option value="Thứ hai">Thứ hai</option>
                                    <option value="Thứ ba">Thứ ba</option>
                                    <option value="Thứ tư">Thứ tư</option>
                                    <option value="Thứ năm">Thứ năm</option>
                                    <option value="Thứ sáu">Thứ sáu</option>
                                    <option value="Thứ bảy">Thứ bảy</option>
                                </select>
                            </div>

                            <div class="form-element">
                                <label for="description">Phòng học</label>
                                <select class="select-element" name="classroomID" id="classroomID">
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">
                                            {{ $room -> infrastructure }} - {{ $room -> floor }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <label for="shiftsID">Ca học</label>
                                <select class="select-element" name="shiftsID" id="shiftsID">
                                    @foreach($shifts as $shift)
                                        <option value="{{ $shift->id }}">
                                            {{ $shift -> time_in }} - {{ $shift -> time_out }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <button type="submit">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                    <form action="{{route('deleteSchoolShiftDetail',['SchoolShift'=>$SchoolShift->schoolShiftDetail_id])}}" onsubmit="return confirm('Do you want delete this subject ? ')" style="display: inline;" method="POST">
                        @csrf
                        @method('DELETE')
                        <button style="margin-right: 12px;" class="button-delete">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="custom-pagination">
        <div class="page-info">Trang {{ $SchoolShifts->currentPage() }} / {{ $SchoolShifts->lastPage() }}</div>
        <div class="page-links">
            @if($SchoolShifts->currentPage() > 1)
                <a href="{{ $SchoolShifts->previousPageUrl() }}" class="custom-pagination-link">&laquo; Trước</a>
            @endif

            @for($i = 1; $i <= $SchoolShifts->lastPage(); $i++)
                @if($i == $SchoolShifts->currentPage())
                    <span class="custom-pagination-link current-page">{{ $i }}</span>
                @else
                    <a href="{{ $SchoolShifts->url($i) }}" class="custom-pagination-link">{{ $i }}</a>
                @endif
            @endfor

            @if($SchoolShifts->hasMorePages())
                <a href="{{ $SchoolShifts->nextPageUrl() }}" class="custom-pagination-link">Sau &raquo;</a>
            @endif
        </div>
    </div>

@endsection('content')
@section('fileJs')
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>

@endsection
