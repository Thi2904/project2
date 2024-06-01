@extends('teacher/layout')

@section('title', 'Product Details')
@section('sideBar')
    <ul class="side-menu">
        <li class="">
            <i class="fa-solid fa-calendar-days"></i>
            <a href="{{route('teacher.TeachShift')}}">
                <span>Điểm danh</span>
            </a>
        </li>
        <li class="sideActive">
            <i class="fa-solid fa-calendar-check"></i>
            <a href="{{route('listChuyenCan')}}">
                <span>Chuyên cần</span>
            </a>
        </li>
        <li>
            <i class="fa-solid fa-retweet"></i>
            <a href="">
                <span>Dạy thay</span>
            </a>
        </li>
    </ul>
@endsection
@section('content')
    <style>
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
        .linkChuyenCan{
            color: dodgerblue;
        }
    </style>
    <div class="content">
        <h3>Danh sách môn học</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tên môn</th>
                <th>Lớp</th>
                <th>Giảng viên</th>
                <th style="text-align: center">Chuyên cần</th>
            </tr>
            </thead>
            <tbody>
            @foreach($StudyShifts as $StudyShift)
                <tr>
                    <td>{{$StudyShift -> subjectName}}</td>
                    <td>{{$StudyShift -> className}}</td>
                    <td>{{$StudyShift -> name}}</td>
                    <td style="text-align: start"><a class="linkDiemDanh"  href="{{route('class.showChuyenCan', ['subjectID' => $StudyShift->subjectID])}}">Xem chuyên cần</a></td>
                </tr>

            @endforeach
            </tbody>

        </table>

    </div>
@endsection('content')
