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
        <li>
            <i class="fa-solid fa-retweet"></i>
            <a href="">
                <span>Dạy thay</span>
            </a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="content">
        <div class="onTheTable">
            <div class="onTheTable_element">
                <b style="color: var(--blue-hover)">Số lượng: </b>
                <span>{{sizeof($students)}} </span>
            </div>
            <div class="onTheTable_element">
                <b style="color: #04cb04">Đi học: </b>
                <span>{{sizeof($students)}}  </span>
            </div>
            <div class="onTheTable_element">
                <b style="color: #dede20">Đi muộn: </b>
                <span>0 </span>
            </div>
            <div class="onTheTable_element">
                <b style="color: red">Nghỉ học: </b>
                <span>0 </span>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <form action="{{ route('submit.diemdanh') }}" method="POST">
                @csrf
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->studentName }}</td>
                        <td class="d-flex justify-content-between">
                            <input type="hidden" name="schoolShiftID" value="{{ $schoolShiftID }}">
                            <input type="hidden" name="subjectID" value="{{ $subjectID }}">
                            <div class="">
                                <input id="di-hoc{{ $student->id }}" type="radio" name="options[{{ $student->id }}]" value="đi học" {{ $student->status == 'đi học' ? 'checked' : '' }} >
                                <label for="di-hoc{{ $student->id }}"> Đi học</label>
                            </div>
                            <div class="">
                                <input id="tre{{ $student->id }}" type="radio" name="options[{{ $student->id }}]" value="trễ" {{ $student->status == 'trễ' ? 'checked' : '' }}>
                                <label for="tre{{ $student->id }}"> Đi muộn </label>
                            </div>
                            <div class="">
                                <input id="nghi-co-phep{{ $student->id }}" type="radio" name="options[{{ $student->id }}]" value="nghỉ có phép" {{ $student->status == 'nghỉ có phép' ? 'checked' : '' }}>
                                <label for="nghi-co-phep{{ $student->id }}"> Nghỉ có phép </label>
                            </div>
                            <div class="">
                                <input id="nghi-khong-phep{{ $student->id }}" type="radio" name="options[{{ $student->id }}]" value="nghỉ không phép" {{ $student->status == 'nghỉ không phép' ? 'checked' : '' }}>
                                <label for="nghi-khong-phep{{ $student->id }}"> Nghỉ học </label>
                            </div>
                        </td>
                    </tr>
            @endforeach


            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div class="pagination"></div>
            <div style="" class="submit">
                <button type="submit" class="submit_diem_danh btn btn-main">Submit</button>
            </div>
        </div>
        </form>
        </table>
    </div>
@endsection
