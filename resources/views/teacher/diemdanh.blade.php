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
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->studentName }}</td>
                    <td class="d-flex justify-content-between">
                        <div class="">
                            <input id="ear{{ $student->id }}" type="radio" name="options{{ $student->id }}" value="ear">
                            <label for="ear{{ $student->id }}"> Đi học</label>
                        </div>
                        <div class="">
                            <input id="late{{ $student->id }}" type="radio" name="options{{ $student->id }}" value="late">
                            <label for="late{{ $student->id }}"> Đi muộn </label>

                        </div>
                        <div class="">
                            <input id="off{{ $student->id }}" type="radio" name="options{{ $student->id }}" value="off">
                            <label for="off{{ $student->id }}"> Nghỉ học </label>
                        </div>


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="foot d-flex justify-content-between">
        <div class="pagination"></div>
        <div class="submit">
            <button class="submit_diem_danh btn btn-main">
                Submit
            </button>
        </div>
    </div>
@endsection('content')
