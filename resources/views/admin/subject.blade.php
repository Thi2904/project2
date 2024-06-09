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

        <li class="">
            <a href="{{route('admin.student')}}">
                <i class='bx bxs-user' ></i>
                <span class="text">Sinh Viên</span>
            </a>
        </li>
        <li class="sidebarActive">
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
            <a class="active" href="#">Môn học</a>
        </li>
    </ul>

@endsection('tro')

@section('narno')
    <h3>Tổng số môn</h3>

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
        <h3>Danh sách môn học</h3>
        <div style="display: flex">
            <div style="margin-right: 12px" class="searchInput">
                <form action="">
                    <label>
                        <input name="keyword" type="text" class="search_form" placeholder="Tìm kiếm"/>
                    </label>
                    <button hidden type="submit"></button>
                </form>
            </div>
            <div >
                <i class='click_search bx bx-search' ></i>
                <i class='bx bx-filter' ></i>
            </div>


        </div>
    </div>
    <table>
        <thead>
        <tr>
            <th>Tên môn</th>
            <th>Tổng thời gian</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
        <tr>
            <td>
                <p>{{$subject -> subjectName}}</p>
            </td>
            <td>{{$subject -> subjectTime}}</td>
            <td>{{$subject -> description}}</td>
            <td>
                <button id=edit-"{{$subject->id}}" data-popup-id="{{$subject->id}}" style="margin-right: 12px;" class="show-edit button-edit"><i class='bx bx-edit'></i></button>
                <div id="popupEdit-{{$subject->id}}" class="popup-edit">
                    <div class="close-btn">&times;</div>
                    <form action="{{route("editSubject",['subject' => $subject -> id])}}" method="POST">
                        @csrf
                        <h2 class="nameAction">Chỉnh sửa môn học</h2>
                        <div class="form-element">
                            <label for="subjectName">Tên môn</label>
                            <input name="subjectName" type="text" id="subjectName" value="{{$subject -> subjectName}}">
                        </div>
                        <div class="form-element">
                            <label for="codeName">Mã môn</label>
                            <input name="codeName" type="text" id="codeName" value="{{$subject -> codeName}}">
                        </div>
                        <div class="form-element">
                            <label for="subjectName">Thời lượng môn</label>
                            <input name="subjectTime" type="text" id="subjectTime" value="{{$subject -> subjectTime}}">
                        </div>
                        <div class="form-element">
                            <label for="subjectName">Mô tả môn học</label>
                            <textarea name="description" id="multi-line-input" rows="4" cols="50" maxlength="150">{{$subject -> description}}</textarea>

                        </div>

                        <div class="form-element">
                            <button type="submit">Update</button>
                        </div>
                    </form>
                </div>
                <form action="{{ route('deleteSubject',['subject' => $subject->id]) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không ? ')" style="display: inline;" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style="margin-right: 12px;" class="button-delete"><i class='bx bx-trash'></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="custom-pagination">
        <div class="page-info">Trang {{ $subjects->currentPage() }} / {{ $subjects->lastPage() }}</div>
        <div class="page-links">
            @if($subjects->currentPage() > 1)
                <a href="{{ $subjects->previousPageUrl() }}" class="custom-pagination-link">&laquo; Trước</a>
            @endif

            @for($i = 1; $i <= $subjects->lastPage(); $i++)
                @if($i == $subjects->currentPage())
                    <span class="custom-pagination-link current-page">{{ $i }}</span>
                @else
                    <a href="{{ $subjects->url($i) }}" class="custom-pagination-link">{{ $i }}</a>
                @endif
            @endfor

            @if($subjects->hasMorePages())
                <a href="{{ $subjects->nextPageUrl() }}" class="custom-pagination-link">Sau &raquo;</a>
            @endif
        </div>
    </div>
    <a class="button-add-student" href="{{route('showCurriculum',$majorId)}}"><i class='icon_left bx bx-arrow-back'></i>Trang CTDT</a>

@endsection('content')
@section('fileJs')
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
@endsection
