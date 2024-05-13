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
        <li class="sidebarActive">
            <a href="{{route('showSpecialized')}}">
                <i class='bx bxl-slack' ></i>
                <span class="text">Specialized</span>
            </a>
        </li>
        <li>
            <a href="{{route('studyShift')}}">
                <i class='bx bxs-calendar' ></i>
                <span class="text">Study Shift</span>
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
            <a class="active" href="#">Specialized</a>
        </li>
    </ul>

@endsection('tro')
@section('narno')
    <h3>Total Specialized</h3>
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
    <div class="body-list">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Specialized Name</th>
                <th>Total Curriculum</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($majors as $major)
                <tr>
                    <td>{{ $major->id }}</td>
                    <td><a href="{{ route('showCurriculum', ['major' => $major->id]) }}">{{ $major->majorName }}</a></td>
                    <td>{{$mjs[$major->id - 1] -> curriculums_count}}</td>
                    <td style="display: flex;">
                        <button id="{{ $major->id }}" data-popup-id="{{$major->id}}" class="show-add button-add-student">Add Curriculum</button>
                        <div class="head list_student">
                            <div id="popup-{{$major->id}}" class="popup">
                                <div class="close-btn">&times;</div>
                                <form action="{{ route('addCurriculum')}}" method="POST">
                                    @csrf
                                    <input name="majorID" type="hidden" class="majorID" value="{{ $major->id }}">
                                    <h2 class="nameAction">Add Curriculum</h2>
                                    <div class="form-element">
                                        <label for="curriculumName">Name Curriculum</label>
                                        <input name="curriculumName" type="text" id="curriculumName" placeholder="Enter name">
                                    </div>

                                    <div class="form-element">
                                        <button type="submit">Add</button>
                                    </div>
                                </form>
                            </div>
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
