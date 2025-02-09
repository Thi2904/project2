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

        <li class="" style="display: flex;">

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
    <h3>Tổng lịch học</h3>

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
        <h3>Danh sách lịch học</h3>
        <div style="display: flex">
            <button style="margin-right: 12px" id="show-add" class="button-add">Thêm</button>

            <div class="popup">
                <div class="close-btn">&times;</div>
                <form action="{{ route('addSchoolShift')}}" method="POST">
                    @csrf
                    <h2 class="nameAction">Thêm lịch học</h2>
                    <div class="form-element">
                        <label for="classID">Tên lớp</label>
                        <select class="select-element" name="classID" id="classID">
                            <option value="00">Chọn lớp học</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">
                                    {{ $class->className }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-element">
                        <label for="subjectID">Tên môn học</label>
                        <select class="select-element" name="subjectID" id="subjectID">
                            <option value="00">Chọn môn học</option>
                        </select>
                    </div>
                    <div class="form-element">
                        <label for="studentNum">Tên giảng viên</label>
                        <select class="select-element" name="teacherID" id="teacherID">
                            @foreach($teachers as $teacher)
                                <option value="00">Chọn giảng viên</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-element">
                        <label for="dateStart">Thời gian bắt đầu </label>
                        <br>
                        <input name="dateStart" type="date" id="dateStart" placeholder="Nhập thời gian bắt đầu">
                    </div>
                    <div class="form-element">
                        <button type="submit">Thêm</button>
                    </div>
                </form>
            </div>
            <div style="display: flex">
                <div style="margin-right: 12px" class="searchInput">
                    <form action="">
                        <label>
                            <input name="keyword" type="text" class="search_form" placeholder="Tìm kiếm"/>
                        </label>
                        <button type="submit"></button>
                    </form>

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
            <th>Tên môn</th>
            <th>Lớp</th>
            <th>Giảng viên</th>
            <th>Số ca học</th>
            <th>Ngày bắt đầu</th>
            <th>Hành động</th>

        </tr>
        </thead>
        <tbody>
        @foreach($StudyShifts as $key => $StudyShift)
        <tr>
            <td><a href="{{route('showStudyShiftSchool',['StudyShift' => $StudyShift->schoolShift_id])}}">{{$StudyShift -> subjectName}}</a>
            </td>
            <td>{{$StudyShift -> className}}</td>
            <td>{{$StudyShift -> name}}</td>
            <td>{{$countssd[$key] -> school_shift_details_count}}</td>
            <td>{{$StudyShift -> dateStart}}</td>
            <td>
                <button id="{{$StudyShift->schoolShift_id}}" data-popup-id="{{$StudyShift->schoolShift_id}}" class="show-add-day button-add-day">Thêm ngày học</button>

                <div id="popup-{{$StudyShift->schoolShift_id}}" class="popup">
                    <div class="close-btn">&times;</div>

                    <form action="{{ route('addSchoolShiftDetail')}}" method="POST">
                        @csrf
                        <h2 class="nameAction">Thêm ngày học</h2>
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
                        <input name="schoolShiftID" type="hidden" id="schoolShiftID" value="{{$StudyShift->schoolShift_id}}">
                        <input name="teacherID" type="hidden" id="teacherID" value="{{$StudyShift->teacherID}}">
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
                            <label for="description">Phòng học</label>
                            <select class="select-element" name="classroomID" id="classroomID">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">
                                        {{ $room -> classroomName }} - {{ $room -> infrastructure }} - {{ $room -> floor }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-element">
                            <button type="submit">Thêm</button>
                        </div>
                    </form>

                </div>

                <button data-popup-id="{{$StudyShift->schoolShift_id}}" class="show-edit button-edit">Sửa</button>
                <div id="popupEdit-{{$StudyShift->schoolShift_id}}" class="popup-edit">
                    <div class="close-btn">&times;</div>
                    <form action="{{route('editSchoolShift',['StudyShift' => $StudyShift->schoolShift_id])}}" method="POST">
                        @csrf
                        <h2 class="nameAction">Sửa lịch học</h2>
                        <div class="form-element">
                            <label for="classID">Tên lớp</label>
                            <select class=" select-element" name="classID" id="classEditID{{$StudyShift->schoolShift_id}}">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{ $class->id == $StudyShift->classID ? 'selected' : '' }}>{{$class->className}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="subjectID">Tên môn học</label>
                            <select class="select-element " name="subjectID"  id="subjectEditID{{$StudyShift->schoolShift_id}}">
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ $subject->id == $StudyShift->subjectID ? 'selected' : '' }}>
                                        {{ $subject->subjectName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="teacherID">Tên giảng viên</label>
                            <select class="select-element" name="teacherID" id="teacherEditID{{$StudyShift->schoolShift_id}}">
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->tId }}" {{ $teacher->tId == $StudyShift->teacherID ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="dateStart">Thời gian bắt đầu </label>
                            <br>
                            <input name="dateStart" type="date" id="dateStart" value="{{ $StudyShift->dateStart }}" placeholder="Nhập thời gian bắt đầu">
                        </div>
                        <div class="form-element">
                            <button type="submit">Cập nhật</button>
                        </div>
                    </form>
                </div>
                <form action="{{ route('deleteSchoolShift',['StudyShift' => $StudyShift->schoolShift_id,'countSSD' => $countssd[$key] -> school_shift_details_count]) }}" onsubmit="return confirm('Do you want delete this subject ? ')" style="display: inline;" method="POST">
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
        <div class="page-info">Trang {{ $StudyShifts->currentPage() }} / {{ $StudyShifts->lastPage() }}</div>
        <div class="page-links">
            @if($StudyShifts->currentPage() > 1)
                <a href="{{ $StudyShifts->previousPageUrl() }}" class="custom-pagination-link">&laquo; Trước</a>
            @endif

            @for($i = 1; $i <= $StudyShifts->lastPage(); $i++)
                @if($i == $StudyShifts->currentPage())
                    <span class="custom-pagination-link current-page">{{ $i }}</span>
                @else
                    <a href="{{ $StudyShifts->url($i) }}" class="custom-pagination-link">{{ $i }}</a>
                @endif
            @endfor

            @if($StudyShifts->hasMorePages())
                <a href="{{ $StudyShifts->nextPageUrl() }}" class="custom-pagination-link">Sau &raquo;</a>
            @endif
        </div>
    </div>

@endsection('content')
@section('fileJs')
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#classID').on('change', function() {
                var classID = $(this).val();
                $('#subjectID').empty();
                $('#teacherID').empty(); // Xóa các tùy chọn hiện có
                if (classID) {
                    $.ajax({
                        url: '/getSubjects/' + classID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#subjectID').append('<option value="' + value.id + '">' + value.subjectName + '</option>');
                            });
                        }
                    });
                    $.ajax({
                        url: '/getTeachers/' + classID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#teacherID').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subjectID').append('<option value="">Chọn môn học</option>'); // Tùy chọn mặc định khi không có lớp học nào được chọn
                }
            });
        });

        $('[id^=classEditID]').on('change', function() {
            var id = $(this).attr('id').replace('classEditID', '');
            var classID = $(this).val();
            $('#subjectEditID' + id).empty();
            $('#teacherEditID' + id).empty();
            if (classID) {
                $.ajax({
                    url: '/getEditSubjects/' + classID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#subjectEditID' + id).append('<option value="' + value.id + '">' + value.subjectName + '</option>');
                        });
                    }
                });
                $.ajax({
                    url: '/getEditTeachers/' + classID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#teacherEditID' + id).append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }

            });

    </script>


@endsection
