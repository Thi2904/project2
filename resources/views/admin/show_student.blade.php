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

        <li class="sidebarActive">
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
            <a class="active" href="#">Student</a>
        </li>
    </ul>

@endsection('tro')

@section('narno')
    <h3>Total Student</h3>
@endsection('narno')

@section('content')
    <style>
        .popup-edit.active{
            top: 8%;
            opacity: 1;
        }
    </style>
    <div class="head list_student">
        <h3>List Student</h3>

        <i class='list_student bx bx-search'></i>
        <i class='list_student bx bx-filter'></i>
    </div>

    <table class="list_student">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $student)
            <tr>
                <td>
                    <p>{{ $student->id }}</p>
                </td>
                <td><p>{{ $student->studentName }}</p></td>
                <td><p>{{ $student->class->className }}</p></td>
                <td>
                    <button id="show-edit" class="button-edit" >Edit</button>
                    <div class="popup-edit">
                        <div class="close-btn">&times;</div>
                        <form action="{{ route('editStudent',['student' => $student->id])}}" method="POST">
                            @csrf
                            <h2 class="nameAction">Edit student information</h2>
                            <div class="form-element">
                                <label for="studentName">Name</label>
                                <input name="studentName" type="text" id="studentName" placeholder="Enter name">
                            </div>
                            <div class="form-element">
                                <label for="StudentID">StudentID</label>
                                <input name="StudentID" type="text" id="StudentID" placeholder="Enter ID">
                            </div>
                            <div class="form-element">
                                <label for="email">Email</label>
                                <input name="email" type="text" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-element">
                                <label for="phoneNumber">Phone Number</label>
                                <input name="phoneNumber" type="text" id="phoneNumber" placeholder="Enter phone number">
                            </div>
                            <div class="form-element">
                                <label for="address">Address</label>
                                <input name="address" type="text" id="address" placeholder="Enter address">
                            </div>
                            <div class="form-element">
                                <label for="Date of Birth">Date of Birth</label>
                                <input name="DoB" type="text" id="DoB" placeholder="dd/mm/yyyy">
                            </div>
                            <div class="form-element">
                                <input name="classID" type="hidden" id="classID">
                            </div>
                            <div class="form-element">
                                <button type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    <form action="{{ route('deleteStudent',['student' => $student->id]) }}" onsubmit="return confirm('Do you want delete this student ? ')" style="display: inline;" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button-delete" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="custom-pagination">
        <div class="page-info">Page {{ $students->currentPage() }} of {{ $students->lastPage() }}</div>
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
