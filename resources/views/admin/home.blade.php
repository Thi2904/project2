@extends('admin/layout')

@section('title', 'Product Details')

@section('sidebar_top')
    <ul class="side-menu top">
        <li class="sidebarActive">
            <a href="{{route('admin.home')}}">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Lớp</span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.student')}}">
                <i class='bx bxs-user' ></i>
                <span class="text">Sinh Viên</span>
            </a>
        </li>
        <li>
            <a href="{{route('showSpecialized')}}">
                <i class='bx bxl-slack' ></i>
                <span class="text">Chuyên ngành và CTDT</span>
            </a>
        </li>
        <li>
            <a href="{{route('studyShift')}}">
                <i class='bx bxs-calendar' ></i>
                <span class="text">Ca học</span>
            </a>
        </li>
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
            <a class="active" href="#">Lớp</a>
        </li>
    </ul>

@endsection('tro')

@section('narno')
    <h3>Tổng lớp</h3>
    <p>{{$classes->total()}}</p>
@endsection('narno')

@section('content')
    <style>

        .popup.active{
            top: 8%;
        }
    </style>
    <div class="head">
        <h3>List of Class</h3>
        <button id="show-add" class="button-add">Thêm</button>
        <div class="popup">
            <div class="close-btn">&times;</div>
            <form action="{{ route('addClass')}}" method="POST">
                @csrf
                <h2 class="nameAction">Thêm lớp</h2>
                <div class="form-element">
                    <label for="className">Tên chuyên ngành</label>
                    <select class="select-element" name="majorID" id="majorID">
                        @foreach($majors as $major)
                            <option value="{{ $major->id }}">
                                {{ $major->majorName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-element">
                    <label for="className">Chương trình học</label>
                    <select class="select-element" name="curriculumID" id="curriculumID">
                        @foreach($curriculums as $curriculum)
                            <option value="{{ $curriculum->id }}">
                                {{ $curriculum->curriculumName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-element">
                    <label for="className">Tên lớp</label>
                    <input name="className" type="text" id="className" placeholder="Nhập lớp">
                </div>
                <div class="form-element">
                    <label for="grade">Khóa</label>
                    <input name="grade" type="text" id="grade" placeholder="Nhập khóa">
                </div>
                <div class="form-element">
                    <button type="submit">Thêm</button>
                </div>
            </form>
        </div>
        <div style="margin-right: 7px" class="">
            <label>
                <form style="display: flex;"  action="">
                    <input type="text" class="search_form" placeholder="Tìm kiếm"/>
                    <button hidden type="submit"></button>
                </form>
            </label>
        </div>
        <i class='click_search bx bx-search' ></i>
        <i class='bx bx-filter' ></i>
    </div>
    <table>
        <thead>
        <tr>
            <th>Lớp</th>
            <th>Khóa</th>
            <th>Tổng sinh viên</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $key => $class)
            <tr>
                <td>

                    <a href="{{ route('class.show', ['class' => $class->id]) }}">{{ $class->className }}</a>
                </td>
                <td>{{ $class->grade }}</td>
                <td>
                    {{$stuCount[$key]-> student_count}}
                </td>
                <td>
                    <button id=edit-"{{$class->id}}" data-popup-id="{{$class->id}}" class="show-edit button-edit">Chỉnh sửa</button>
                    <div  id="popupEdit-{{$class->id}}" class="popup-edit">
                        <div class="close-btn">&times;</div>
                        <form action="{{ route('editClass', ['class' => $class->id])}}" method="POST">
                            @csrf
                            <h2 class="nameAction">Sửa lớp</h2>
                            <div class="form-element">
                                <label for="className">Tên lớp</label>
                                <input name="className" value="{{$class->className}}" type="text" id="className" placeholder="Nhập tên lớp">
                            </div>
                            <div class="form-element">
                                <label for="grade">Khóa</label>
                                <input name="grade" value="{{$class->grade}}" type="text" id="grade" placeholder="Nhập khóa">
                            </div>
                            <div class="form-element">
                                <label for="className">Chương trình học</label>
                                <select class="select-element" name="curriculumID" id="curriculumID">
                                    @foreach($curriculums as $curriculum)
                                        <option value="{{ $curriculum->id }}" {{ $class->curriculumID == $curriculum->id ? 'selected' : '' }}>
                                            {{ $curriculum->curriculumName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-element">
                                <button type="submit">Cập nhật</button>
                            </div>
                        </form>


                    </div>

                    <form action="{{ route('deleteClass', ['class' => $class->id]) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa lớp này không? ')" method="POST" style="display: inline;">
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
        <div class="page-info">Page {{ $classes->currentPage() }} of {{ $classes->lastPage() }}</div>
        <div class="page-links">
            @if($classes->currentPage() > 1)
                <a href="{{ $classes->previousPageUrl() }}" class="custom-pagination-link">&laquo; Trước</a>
            @endif

            @for($i = 1; $i <= $classes->lastPage(); $i++)
                @if($i == $classes->currentPage())
                    <span class="custom-pagination-link current-page">{{ $i }}</span>
                @else
                    <a href="{{ $classes->url($i) }}" class="custom-pagination-link">{{ $i }}</a>
                @endif
            @endfor

            @if($classes->hasMorePages())
                <a href="{{ $classes->nextPageUrl() }}" class="custom-pagination-link">Sau &raquo;</a>
            @endif
        </div>
    </div>
@endsection('content')
@section('fileJs')
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
