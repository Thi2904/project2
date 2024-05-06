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
        <h3>List of Study Shift</h3>
        <div class="">
            <a href="#" class="button-add-student">Add Study Shift</a>
            <i class='bx bx-search' ></i>
            <i class='bx bx-filter' ></i>
        </div>
    </div>
    <table>
        <thead>
        <tr>
            <th>Subject</th>
            <th>Class</th>
            <th>Room</th>
            <th>Teacher</th>
            <th>Status</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <p>Java</p>
            </td>
            <td>D06K14</td>
            <td>202</td>
            <td>Nguyen Ngoc Tan</td>
            <td>
                <button class="show-edit button-edit">Edit</button>
                <div class="popup-edit">
                    <div class="close-btn">&times;</div>
                    <form action="" method="POST">
                        @csrf
                        <h2 class="nameAction">Edit Study Shift</h2>
                        <div class="form-element">
                            <label for="subjectName">Name subject</label>
                            <select class="select-element" name="" id="">
                                <option value="1">Java</option>
                                <option value="2">PHP</option>
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="email">Place</label>
                            <br>
                            <select class="select-element" name="" id="">
                                <option value="1">Ta Quang Buu</option>
                                <option value="2">Le Thanh Nghi</option>
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="email">Floor</label>
                            <br>
                            <select class="select-element" name="" id="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div><div class="form-element">
                            <label for="email">Room</label>
                            <br>
                            <select class="select-element" name="" id="">
                                <option value="1">102</option>
                                <option value="2">202</option>
                                <option value="3">302</option>
                                <option value="4">402</option>
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="email">Time</label>
                            <br>
                            <select class="select-element" name="" id="">
                                <option value="1">8:00 - 12:00</option>
                                <option value="2">8:00 - 10:30</option>
                                <option value="3">10:30 - 12:00</option>
                                <option value="4">13:30 - 15:30</option>
                                <option value="4">15:30 - 17:30</option>
                                <option value="4">13:30 - 17:30</option>
                            </select>
                        </div>
                        <div class="form-element">
                            <label for="email">Teacher</label>
                            <input name="email" type="text" id="email" placeholder="Enter Teacher">
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

@endsection('content')
@section('fileJs')
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
