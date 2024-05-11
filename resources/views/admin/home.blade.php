@extends('admin/layout')

@section('title', 'Product Details')

@section('sidebar_top')
    <ul class="side-menu top">
        <li class="sidebarActive">
            <a href="{{route('admin.home')}}">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Class</span>
            </a>
        </li>

        <li>
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
            <a class="active" href="#">Class</a>
        </li>
    </ul>

@endsection('tro')

@section('narno')
    <h3>Total classes</h3>
    <p>{{$classes->total()}}</p>
@endsection('narno')

@section('content')
    <style>
        .select-element{
            margin-top: 5px;
            display: block;
            width: 100%;
            padding: 10px;
            outline: none;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        .popup.active{
            top: 8%;
        }
    </style>
    <div class="head">
        <h3>List of Class</h3>
        <button id="show-add" class="button-add">Add</button>
        <div class="popup">
            <div class="close-btn">&times;</div>
            <form action="{{ route('addClass')}}" method="POST">
                @csrf
                <h2 class="nameAction">Add class</h2>
                <div class="form-element">
                    <label for="className"> Specialized name</label>
                    <select class="select-element" name="majorID" id="majorID">
                        <option value="1">Dev</option>
                        <option value="2">Des</option>
                        <option value="3">Marketing</option>
                        <option value="4">Security</option>
                    </select>
                </div>

                <div class="form-element">
                    <label for="className">Tên lớp</label>
                    <input name="className" type="text" id="className" placeholder="Enter class name">
                </div>
                <div class="form-element">
                    <label for="grade">Grade</label>
                    <input name="grade" type="text" id="grade" placeholder="Enter grade">
                </div>
                <div class="form-element">
                    <label for="className">Chương trình học</label>
                    <select class="select-element" name="curriculumID" id="curriculumID">
                        <option value="1">BTEC 2022</option>
                    </select>
                </div>
                <div class="form-element">
                    <button type="submit">Add</button>
                </div>
            </form>
        </div>
        <i class='bx bx-search' ></i>
        <i class='bx bx-filter' ></i>
    </div>
    <table>
        <thead>
        <tr>
            <th>Class</th>
            <th>Grade</th>
            <th>Total Student</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
                <td>

                    <a href="{{ route('class.show', ['class' => $class->id]) }}">{{ $class->className }}</a>
                </td>
                <td>{{ $class->grade }}</td>
                <td>{{ $class->totalStudent }}</td>
                <td>
                    <button class="show-edit button-edit">Edit</button>
                    <div class="popup-edit">
                        <div class="close-btn">&times;</div>
                        <form action="{{ route('editClass', ['class' => $class->id])}}" method="POST">
                            @csrf
                            <h2 class="nameAction">Edit class</h2>
                            <div class="form-element">
                                <label for="className">Class name</label>
                                <input name="className" value="{{$class->className}}" type="text" id="className" placeholder="Enter class name">
                            </div>
                            <div class="form-element">
                                <label for="grade">Grade</label>
                                <input name="grade" value="{{$class->grade}}" type="text" id="grade" placeholder="Enter grade">
                            </div>
                            <div class="form-element">
                                <label for="className">Chương trình học</label>
                                <select class="select-element" name="curriculumID" id="curriculumID">
                                    <option value="1">BTEC 2022</option>
                                </select>
                            </div>
                            <div class="form-element">
                                <button type="submit">Update</button>
                            </div>
                        </form>


                    </div>

                    <form action="{{ route('deleteClass', ['class' => $class->id]) }}" onsubmit="return confirm('Do you want delete this class ? ')" method="POST" style="display: inline;">
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
        <div class="page-info">Page {{ $classes->currentPage() }} of {{ $classes->lastPage() }}</div>
        <div class="page-links">
            @if($classes->currentPage() > 1)
                <a href="{{ $classes->previousPageUrl() }}" class="custom-pagination-link">&laquo; Previous</a>
            @endif

            @for($i = 1; $i <= $classes->lastPage(); $i++)
                @if($i == $classes->currentPage())
                    <span class="custom-pagination-link current-page">{{ $i }}</span>
                @else
                    <a href="{{ $classes->url($i) }}" class="custom-pagination-link">{{ $i }}</a>
                @endif
            @endfor

            @if($classes->hasMorePages())
                <a href="{{ $classes->nextPageUrl() }}" class="custom-pagination-link">Next &raquo;</a>
            @endif
        </div>
    </div>
@endsection('content')
@section('fileJs')
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
