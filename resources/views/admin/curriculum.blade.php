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
            <a class="active" href="#">Chương trình đào tạo</a>
        </li>
    </ul>

@endsection('tro')
@section('narno')
    <h3>Tổng chương trình đào tạo</h3>
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
        <div style="display: flex">
            <div style="margin-right: 12px" class="">
                <label>
                    <form action="">
                        <input type="text" class="search_form" placeholder="Tìm kiếm"/>
                        <button type="submit"></button>
                    </form>
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
                <th>Tên CTDT</th>
                <th>Tổng số môn</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($curriculums as $key => $curriculum)
            <tr>
                <td>{{$curriculum -> id}}</td>
                <td><a href="{{route('showSubject',['majorId' => $majorId ,'curriculum' => $curriculum->id])}}">{{$curriculum -> curriculumName}}</a></td>
                <td>{{$cuss[$key]-> subjects_count}}</td>
                <td style="display: flex;">
                    <div class="">
                        <button id=edit-"{{$curriculum->id}}" data-popup-id="{{$curriculum->id}}" style="margin-right: 12px;" class="show-edit button-edit"><i class='bx bx-edit'></i></button>
                        <div id="popupEdit-{{$curriculum->id}}" class="popup-edit">
                            <div class="close-btn">&times;</div>
                            <form action="{{ route('editCurriculum', ['curriculum' => $curriculum->id]) }}" method="POST">
                                @csrf
                                <h2 class="nameAction">Edit Curriculum</h2>
                                <div class="form-element">
                                    <label for="curriculumCode">Mã chương trình học</label>
                                    <input name="curriculumCode" type="text" id="curriculumCode" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <label for="curriculumName">Tên chương trình học</label>
                                    <input name="curriculumName" type="text" id="curriculumName" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <label for="curriculumVNName">Tên tiếng việt</label>
                                    <input name="curriculumVNName" type="text" id="curriculumVNName" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <label for="description">Mô tả chương trình học</label>
                                    <textarea name="description" id="multi-line-input" rows="4" cols="50" maxlength="150"></textarea>
                                </div>
                                <div class="form-element">
                                    <button type="submit">Cập nhật</button>
                                </div>
                            </form>

                        </div>
                        <form action="{{ route('deleteCurriculum',['curriculum' => $curriculum->id]) }}" onsubmit="return confirm('Do you want delete this curriculum ? ')" style="display: inline;" method="POST">
                            @csrf
                            @method('DELETE')
                        <button style="margin-right: 12px;" class="button-delete"><i class='bx bx-trash'></i></button>
                        </form>
                    </div>
                    <button style="margin-right: 12px;"  id="{{$curriculum->id}}" data-popup-id="{{$curriculum->id}}" class="show-add button-add-student">Thêm môn học vào CTDT</button>
                    <div class="head list_student">
                        <div id="popup-{{$curriculum->id}}" class="popup">
                            <div class="close-btn">&times;</div>
                            <form action="{{ route('addSubject')}}" method="POST">
                                @csrf
                                <h2 class="nameAction">Add Subject</h2>
                                <div class="form-element">
                                    <label for="subjectName">Tên môn</label>
                                    <input name="subjectName" type="text" id="subjectName" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <label for="subjectName">Mã môn</label>
                                    <input name="codeName" type="text" id="codeName" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <label for="subjectName">Thời lượng môn</label>
                                    <input name="subjectTime" type="text" id="subjectTime" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <input name="majorID" type="hidden" id="majorID" value="{{ $majorId }}" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <input name="curriculumID" type="hidden" id="curriculumID" value="{{ $curriculum -> id }}" placeholder="Enter name">
                                </div>
                                <div class="form-element">
                                    <label for="description">Mô tả môn học</label>
                                    <textarea name="description" id="multi-line-input" rows="4" cols="50" maxlength="150"></textarea>
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
    <a class="button-add-student" href="{{route('showSpecialized')}}"><i class='icon_left bx bx-arrow-back'></i> Back to Specialized</a>
@endsection('content')
@section('fileJs')
    <script src="{{asset('js/student.js')}}"></script>
@endsection
