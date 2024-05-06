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
            <a class="active" href="#">Subject</a>
        </li>
    </ul>

@endsection('tro')

@section('narno')
    <h3>Total Subject</h3>

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
    <div class="head">
        <h3>List of Subject</h3>
        <div class="">
            <i class='bx bx-search' ></i>
            <i class='bx bx-filter' ></i>
        </div>
    </div>
    <table>
        <thead>
        <tr>
            <th>Subject</th>
            <th>Grade</th>
            <th>Status</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <p>Java</p>
            </td>
            <td>K14</td>
            <td>
                <button class="show-edit button-edit">Edit</button>
                <div class="popup-edit">
                    <div class="close-btn">&times;</div>
                    <form action="" method="POST">
                        @csrf
                        <h2 class="nameAction">Edit Subject</h2>
                        <div class="form-element">
                            <label for="className">Subject name</label>
                            <input name="className" value="" type="text" id="className" placeholder="Enter class name">
                        </div>
                        <div class="form-element">
                            <label for="grade">Grade</label>
                            <input name="grade" value="" type="text" id="grade" placeholder="Enter grade">
                        </div>

                        <div class="form-element">
                            <button type="submit">Update</button>
                        </div>
                    </form>


                </div>
                <button class="button-delete" type="submit">Delete</button>
            </td>
        </tr>
        </tbody>
    </table>

    <a class="button-add-student" href="{{route('showCurriculum')}}"><i class='icon_left bx bx-arrow-back'></i>Back to Curriculum</a>
@endsection('content')
@section('fileJs')
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
