@extends('teacher/layout')

@section('title', 'Product Details')

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
        .linkDiemDanh{
            color: dodgerblue;
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
                <th style="text-align: center">Điểm danh</th>
            </tr>
            </thead>
            <tbody>
            @foreach($StudyShifts as $StudyShift)
                <tr>
                    <td>{{$StudyShift -> subjectName}}</td>
                    <td>{{$StudyShift -> className}}</td>
                    <td>{{$StudyShift -> name}}</td>
                    <td style="text-align: start"><a class="linkDiemDanh"  href="{{route('class.showdiemdanh', ['classID' => $StudyShift->classID,'schoolShiftID' => $StudyShift->id])}}">Điểm danh</a></td>
                </tr>

            @endforeach
            </tbody>

        </table>

    </div>
@endsection('content')
