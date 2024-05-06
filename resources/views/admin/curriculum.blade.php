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
            <a class="active" href="#">Curriculum</a>
        </li>
    </ul>

@endsection('tro')
@section('narno')
    <h3>Total Curriculum</h3>
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
        <div class="">
            <i class='bx bx-search' ></i>
            <i class='bx bx-filter' ></i>
        </div>
    </div>
    <div class="body-list">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Curriculum Name</th>
                <th>Total Subject</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td><a href="{{route('showSubject')}}">BTEC 2017</a></td>
                <td>15</td>
                <td style="display: flex;">
                    <div class="">
                        <button style="margin-right: 12px;" class="show-edit button-edit"><i class='bx bx-edit'></i></button>
                        <div class="popup-edit">
                            <div class="close-btn">&times;</div>
                            <form action="" method="POST">
                                @csrf
                                <h2 class="nameAction">Edit class</h2>
                                <div class="form-element">
                                    <label for="className">Class name</label>
                                    <input name="className" value="" type="text" id="className" placeholder="Enter class name">
                                </div>
                                <div class="form-element">
                                    <label for="grade">Grade</label>
                                    <input name="grade" value="" type="text" id="grade" placeholder="Enter grade">
                                </div>
                                <div class="form-element">
                                    <label for="studentNum">Total Student</label>
                                    <input name="totalStudent" value="" type="text" id="studentNum" placeholder="Enter quantity of student">
                                </div>
                                <div class="form-element">
                                    <button type="submit">Update</button>
                                </div>
                            </form>


                        </div>
                        <button style="margin-right: 12px;" class="button-delete"><i class='bx bx-trash'></i></button>
                    </div>
                    <a style="margin-right: 12px;" href="#" class="show-add button-add-student">Add new Subject</a>
                    <div class="head list_student">
                        <div class="popup">
                            <div class="close-btn">&times;</div>
                            <form action="{{ route('addStudent')}}" method="POST">
                                @csrf
                                <h2 class="nameAction">Add Subject</h2>
                                <div class="form-element">
                                    <label for="subjectName">Name subject</label>
                                    <input name="subjectName" type="text" id="subjectName" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <label for="grade">Grade</label>
                                    <input name="gradeName" type="text" id="gradeName" placeholder="Enter grade name">

                                </div>

                                <div class="form-element">
                                    <button type="submit">Add</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </td>
            </tr>
            </tbody>
        </table>


    </div>
    <a class="button-add-student" href="{{route('showSpecialized')}}"><i class='icon_left bx bx-arrow-back'></i> Back to Specialized</a>
@endsection('content')
@section('fileJs')
    <script src="{{asset('js/student.js')}}"></script>
@endsection
