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
    <div class="onTheContent">
        <div class="addTime">
            <div class="chonGio">
                <h4>Chọn khung giờ điểm danh</h4>
                <label>
                    <select class="select-element" name="time_in">
                        <option value="{{$time[0]->time_in}}">{{$time[0]->time_in}}</option>
                    </select>
                </label>
                <span style="font-size: 25px">-</span>
                <label>
                    <select class="select-element" name="time_out">
                        <option value="{{$time[0]->time_out}}">{{$time[0]->time_out}}</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="p-2 timeMinus">
            <h5 class="p-2">Thông tin môn học</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Tên lớp</th>
                    <td>D06K14</td>
                </tr>
                <tr>
                    <th>Tên môn</th>
                    <td>Java</td>
                </tr>
                <tr>
                    <th>Thời gian còn lại</th>
                    <td>{{$subject->subjectTime -  $hoursDifference}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="content">
        <div class="onTheTable">
            <div class="onTheTable_element">
                <b style="color: var(--blue-hover)">Số lượng: </b>
                <span id="total-students">{{sizeof($students)}} </span>
            </div>
            <div class="onTheTable_element">
                <b style="color: #04cb04">Đi học: </b>
                <span id="di-hoc-count">{{sizeof($students)}}  </span>
            </div>
            <div class="onTheTable_element">
                <b style="color: #dede20">Đi muộn: </b>
                <span id="tre-count">0 </span>
            </div>
            <div class="onTheTable_element">
                <b style="color: purple">Nghỉ có phép: </b>
                <span id="nghi-phep-count">0 </span>
            </div>
            <div class="onTheTable_element">
                <b style="color: red">Nghỉ học: </b>
                <span id="nghi-count">0 </span>
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
            <form action="{{ route('suadiemdanh') }}" method="POST">
                @csrf

                @foreach ($students as $key => $student)
                    <tr>
                        <td>{{ $student->studentID }}</td>
                        <td>{{ $student->studentName }}</td>
                        <td class="d-flex justify-content-between">
                            <input type="hidden" name="schoolShiftID" value="{{ $schoolShiftID }}">
                            <input type="hidden" name="subjectID" value="{{ $subjectID }}">
                            <input type="hidden" name="attendID" value="{{ $attendID }}">
                            <div class="">
                                <input id="di-hoc{{ $student->studentID }}" type="radio" name="options[{{ $student->studentID }}]" value="đi học" {{ $student->status == 'đi học' ? 'checked' : '' }} >
                                <label for="di-hoc{{ $student->studentID }}"> Đi học</label>
                            </div>
                            <div class="">
                                <input id="tre{{ $student->studentID }}" type="radio" name="options[{{ $student->studentID }}]" value="trễ" {{ $student->status == 'trễ' ? 'checked' : '' }}>
                                <label for="tre{{ $student->studentID }}"> Đi muộn </label>
                            </div>
                            <div class="">
                                <input id="nghi-co-phep{{ $student->studentID }}" type="radio" name="options[{{ $student->studentID }}]" value="nghỉ có phép" {{ $student->status == 'nghỉ có phép' ? 'checked' : '' }}>
                                <label for="nghi-co-phep{{ $student->studentID }}"> Nghỉ có phép </label>
                            </div>
                            <div class="">
                                <input id="nghi-khong-phep{{ $student->studentID }}" type="radio" name="options[{{ $student->studentID }}]" value="nghỉ không phép" {{ $student->status == 'nghỉ không phép' ? 'checked' : 'failed' }}>
                                <label for="nghi-khong-phep{{ $student->studentID }}"> Nghỉ học </label>
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
