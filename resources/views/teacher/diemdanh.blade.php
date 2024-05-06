@extends('teacher/layout')

@section('title', 'Product Details')

@section('content')
    <div class="content">
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
                        <input id="go" type="radio" name="Di hoc">
                        <label for="go"> Di hoc</label>
                    </div>
                    <div class="">
                        <input id="late" type="radio" name="Di muon">
                        <label for="late"> Di muon </label>

                    </div>
                    <div class="">
                        <input id="no" type="radio" name="Nghi hoc">
                        <label for="no"> Nghi </label>

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
