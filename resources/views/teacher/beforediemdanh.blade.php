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
            color: white;

        }
    </style>
{{--    <div class="content">--}}
{{--        @foreach ($schoolShifts as $schoolShift)--}}
{{--        <x-classes class-name="{{ $schoolShift->className }}"--}}
{{--                   grade="{{ $class->grade }}"--}}
{{--                   total-name="Ca học"--}}
{{--                   total-result="10:00 - 12:00"--}}
{{--                   link-btn="{{ route('class.showdiemdanh', ['class' => $class->id]) }}"--}}
{{--                   name-btn="Điểm danh"--}}
{{--                   link="{{ route('class.showdiemdanh', ['class' => $class->id]) }}"--}}
{{--                   name-link="Xem chuyên cần">--}}
{{--        </x-classes>--}}
{{--        @endforeach--}}
{{--    </div>--}}
    <table>
        <thead>
        <tr>
            <th>Tên môn</th>
            <th>Lớp</th>
            <th>Giảng viên</th>
{{--            <th>Ca học</th>--}}
            <th>Điểm danh</th>
        </tr>
        </thead>
        <tbody>
        @foreach($StudyShifts as $StudyShift)
            <tr>
                <td>{{$StudyShift -> subjectName}}</td>
                <td>{{$StudyShift -> className}}</td>
                <td>{{$StudyShift -> name}}</td>
{{--                <td>{{$StudyShift->time_in}} - {{$StudyShift->time_out}}</td>--}}
                <td><a href="{{route('class.showdiemdanh', ['classID' => $StudyShift->classID,'schoolShiftID' => $StudyShift->id])}}">đieểm danh</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection('content')
