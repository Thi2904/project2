@extends('teacher/layout')

@section('title', 'Product Details')

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
                <div class="foot d-flex justify-content-between">
                    <div class="pagination"></div>
                    <div class="submit">
                        <button type="submit" class="submit_diem_danh btn btn-main">Submit</button>
                    </div>
                </div>
            </form>

            </tbody>
        </table>
    </div>
@endsection('content')
