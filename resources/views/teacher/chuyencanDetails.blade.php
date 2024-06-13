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
                <th>ID</th>
                <th>Tên sinh viên</th>
                <th>Chuyên cần</th>

            </tr>
            </thead>
            <tbody>
            @foreach($chuyenCan as $key =>  $cC)
                @php
                    $percentage = ($cC->tre /$tongSoBuoi ) * (1 / 3) * 100 + ($cC->nghi_khong_phep / $tongSoBuoi) * 100;
                    $colorClass = $percentage > 50 ? 'red' : ($percentage > 20 ? 'yellow' : 'green');
                @endphp
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$cC->studentName}}</td>
                    <td class="{{ $colorClass }}">{{ number_format($percentage, 2) }}%</td>
                </tr>
            @endforeach

            </tbody>

        </table>

    </div>
@endsection('content')
