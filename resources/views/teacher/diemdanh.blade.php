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
    <form action="{{ route('submit.diemdanh') }}" method="POST">

    <div class="onTheContent">
        <div class="addTime">
            <div class="chonGio">
                <h4>Chọn khung giờ điểm danh</h4>
                <label>
                    <select class="select-element" name="time_in">
                        <option value="8:00">8:00</option>
                        <option value="9:00">9:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                    </select>
                </label>
                <span style="font-size: 25px">-</span>
                <label>
                    <select class="select-element" name="time_out">
                        <option value="8:00">8:00</option>
                        <option value="9:00">9:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
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
                    <td>{{$subject->subjectTime - ($soTiengHoc * 4)}}</td>
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
                @csrf
                @foreach ($students as $key => $student)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $student->studentName }}</td>
                        <td class="d-flex justify-content-between">
                            <input type="hidden" name="schoolShiftID" value="{{ $schoolShiftID }}">
                            <input type="hidden" name="subjectID" value="{{ $subjectID }}">
                            <input type="hidden" name="classID" value="{{ $student->classID }}">
                            <div class="">
                                <input id="di-hoc{{ $student->id }}" type="radio" name="options[{{ $student->id }}]" value="đi học" checked>
                                <label for="di-hoc{{ $student->id }}"> Đi học</label>
                            </div>
                            <div class="">
                                <input id="tre{{ $student->id }}" type="radio" name="options[{{ $student->id }}]" value="trễ">
                                <label for="tre{{ $student->id }}"> Đi muộn </label>
                            </div>
                            <div class="">
                                <input id="nghi-co-phep{{ $student->id }}" type="radio" name="options[{{ $student->id }}]" value="nghỉ có phép">
                                <label for="nghi-co-phep{{ $student->id }}"> Nghỉ có phép </label>
                            </div>
                            <div class="">
                                <input id="nghi-khong-phep{{ $student->id }}" type="radio" name="options[{{ $student->id }}]" value="nghỉ không phép">
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

    </div>
@endsection('content')
