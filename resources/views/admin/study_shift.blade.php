@extends('admin/layout')

@section('title', 'Product Details')
@section('sidebar_top')

    <ul class="side-menu top">
        <li class="">
            <a href="{{route('admin.home')}}">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Class</span>
            </a>
        </li>

        <li class="">
            <a href="{{route('admin.student')}}">
                <i class='bx bxs-user' ></i>
                <span class="text">Student</span>
            </a>
        </li>
        <li>
            <a href="{{route('showSpecialized')}}">
                <i class='bx bxl-slack' ></i>
                <span class="text">Specialized</span>
            </a>
        </li>
        <li class="sidebarActive">
            <a href="{{route('studyShift')}}">
                <i class='bx bxs-calendar' ></i>
                <span class="text">Study Shift</span>
            </a>
        </li>
        <li>
            <a href="{{route('showTeacher')}}">
                <i class='bx bxs-graduation'></i>
                <span class="text">Teacher</span>
            </a>
        </li>
    </ul>
@endsection

@section('tro')
    <ul class="my-breadcrumb ">
        <li>
            <a href="#">Dashboard</a>
        </li>
        <li><i class='bx bx-chevron-right' ></i></li>
        <li>
            <a class="active" href="#">Subject</a>
        </li>
    </ul>

@endsection('tro')

@section('narno')
    <h3>Total Study Shift</h3>

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
        <h3>List of Study Shift</h3>
        <div style="display: flex">
            <button style="margin-right: 12px" id="show-add" class="button-add">Add</button>

            <div class="popup">
                <div class="close-btn">&times;</div>
                <form action="{{ route('addSchoolShift')}}" method="POST">
                    @csrf
                    <h2 class="nameAction">Add Study Shift</h2>
                    <div class="form-element">
                        <label for="classID">Tên lớp</label>
                        <select class="select-element" name="classID" id="classID">
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
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">
                                    {{ $subject->subjectName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-element">
                        <label for="studentNum">Tên giảng viên</label>
                        <select class="select-element" name="teacherID" id="teacherID">
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-element">
                        <label for="dateStart">Thời gian bắt đầu </label>
                        <br>
                        <input name="dateStart" type="date" id="dateStart" placeholder="Nhập thời gian bắt đầu">
                    </div>
                    <div class="form-element">
                        <button type="submit">Add</button>
                    </div>
                </form>
            </div>
            <div style="display: flex">
                <div style="margin-right: 12px" class="">
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
            <th>Subject</th>
            <th>Class</th>
            <th>Teacher</th>
            <th>Date start</th>
            <th>Status</th>

        </tr>
        </thead>
        <tbody>
        @foreach($StudyShifts as $StudyShift)
        <tr>
            <td><p>{{$StudyShift -> subjectName}}</p>
            </td>
            <td>{{$StudyShift -> className}}</td>
            <td>{{$StudyShift -> name}}</td>
            <td>{{$StudyShift -> dateStart}}</td>
            <td>
                <button class="show-edit button-edit">Edit</button>
                <div class="popup-edit">
                    <div class="close-btn">&times;</div>
                    <form action="{{route('editSchoolShift',['StudyShift' => $StudyShift->id])}}" method="POST">
                        @csrf
                        <h2 class="nameAction">Edit Study Shift</h2>
                        <div class="form-element">
                            <label for="classID">Tên lớp</label>
                            <select class="select-element" name="classID" id="classID">
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
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ $subject->subjectName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="studentNum">Tên giảng viên</label>
                            <select class="select-element" name="teacherID" id="teacherID">
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="dateStart">Thời gian bắt đầu </label>
                            <br>
                            <input name="dateStart" type="date" id="dateStart" placeholder="Nhập thời gian bắt đầu">
                        </div>
                        <div class="form-element">
                            <button type="submit">Update</button>
                        </div>
                    </form>
                </div>
                <form action="{{ route('deleteSchoolShift',['StudyShift' => $StudyShift->id]) }}" onsubmit="return confirm('Do you want delete this subject ? ')" style="display: inline;" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style="margin-right: 12px;" class="button-delete"><i class='bx bx-trash'></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection('content')
@section('fileJs')
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>

@endsection
