@extends('teacher/layout')

@section('title', 'Product Details')
@section('sideBar')
    <ul class="side-menu">
        <li class="sideActive">
            <i class="fa-solid fa-calendar-days"></i>
            <a href="{{route('teacher.TeachShift')}}">
                <span>Điểm danh</span>
            </a>
        </li>
        <li>
            <i class="fa-solid fa-calendar-check"></i>
            <a href="{{route('listChuyenCan')}}">
                <span>Chuyên cần</span>
            </a>
        </li>

    </ul>
@endsection
@section('content')
    <style>
            .card{
                width: 48%;
                margin-bottom: 12px;
                margin-right: 12px;
            }
        .button-add-student{
            height: 40px;
            width: 200px;
            background: #2A72BEFF;
            border-radius: 5px;
            border: none;
            color: white;
        }
        .button-add-student:hover{
            opacity: 0.8;
        }
        .content{
            display: flex;
            flex-wrap: wrap;
        }
        a{
            display: block;
            text-decoration: none;
            text-align: center;
        }
        a:hover{
            color: blue;

        }
        .chuaLinkDiemDanh{
            display: flex;
            justify-content: center;
        }
        .linkDiemDanh{
            height: 50px;
            width: 100px;
            background: #4f98e5;
            border-radius: 2px;
            color: white;
            margin-right: 12px;
        }
        .linkSuaDiemDanh{
            height: 50px;
            width: 100px;
            background: #FFCD00;
            border-radius: 2px;
            color: white;
        }
        .linkSuaDiemDanh:hover{
            opacity: 0.8;
        }
        .linkDiemDanh:hover{
            opacity: 0.8;
        }
        .hidd{
            display: none;
        }
    </style>
    <div class="content">
        <h3>Lịch dạy hôm nay</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tên môn</th>
                <th>Lớp</th>
                <th>Giảng viên</th>
                <th>Giờ học</th>
                <th style="text-align: center">Điểm danh</th>
            </tr>
            </thead>
            <tbody>
            @forelse($StudyShifts as $StudyShift)

                <tr>
                    <td>{{$StudyShift -> subjectName}}</td>
                    <td>{{$StudyShift -> className}}</td>
                    <td>{{$StudyShift -> name}}</td>
                    <td>{{$StudyShift -> time_in}} - {{$StudyShift -> time_out}}</td>
                    <td class="chuaLinkDiemDanh" style="text-align: start">
                        @if(isset($checkHoc))
                            <a hidden id="{{$StudyShift->subjectID}}" class="linkDiemDanh" href="{{route('class.showdiemdanh', ['classID' => $StudyShift->classID,'schoolShiftID' => $StudyShift->id,'subjectID' => $StudyShift->subjectID])}}">
                                Điểm danh
                            </a>
                            <a class="linkSuaDiemDanh"  href="{{route('class.suadiemdanh', ['classID' => $StudyShift->classID,'schoolShiftID' => $StudyShift->id,'subjectID' => $StudyShift->subjectID,'teachID'=>Auth::user()->id])}}">Sửa điểm danh</a>
                        @else
                            <a  id="{{$StudyShift->subjectID}}" class="linkDiemDanh" href="{{route('class.showdiemdanh', ['classID' => $StudyShift->classID,'schoolShiftID' => $StudyShift->id,'subjectID' => $StudyShift->subjectID])}}">
                                Điểm danh
                            </a>
                            <a hidden class="linkSuaDiemDanh"  href="{{route('class.suadiemdanh', ['classID' => $StudyShift->classID,'schoolShiftID' => $StudyShift->id,'subjectID' => $StudyShift->subjectID,'teachID'=>Auth::user()->id])}}">Sửa điểm danh</a>
                        @endif

                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Hiện tại không có lịch dạy </td></tr>
            @endforelse
            </tbody>

        </table>

    </div>

@endsection('content')
