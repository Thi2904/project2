<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\curriculums;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function home(Request $request)
    {
        $keyword = $request->input('keyword');
        if ($keyword) {
            $classes = DB::table('classes')->where('className','LIKE', '%' . $keyword . '%')
                ->paginate(3);

        }else{
            $classes = DB::table('classes')->paginate(3);
        }
        $curriculums = DB::table('curriculum')->get();
        $majors = DB::table('major')->get();
        $stuCount = Classes::withCount('student')->get();
        $shiftCount = Classes::withCount('SchoolShifts')->get();


        return view('admin.home', ['classes' => $classes, 'curriculums' => $curriculums, 'majors' => $majors, 'stuCount' => $stuCount,'shiftCount'=> $shiftCount]);
    }

    public function addClass(Request $request)
    {
        $data = $request->validate([
            'className' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'curriculumID' => 'required|exists:curriculum,id',
            'majorID' => 'required|exists:major,id'
        ]);

        $classes = Classes::create($data);

        return redirect()->back()->with('success', 'Đã thêm lớp thành công.');
    }


    public function editClass(Request $request, Classes $class)
    {
        $data = $request->validate([
            'className' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'curriculumID' => 'required|exists:curriculum,id'
        ]);
        $class->update($data);
        return redirect()->back()->with('success', 'Đã sửa lớp thành công.');
    }

    public function deleteClass(Classes $class, Request $request)
    {

        if($request->query('countFrk') > 0){
            return redirect()->back()->with('error', 'Không thể xóa lớp vì trong lớp có sinh viên.');

        }elseif ($request->query('countScs') > 0){
            return redirect()->back()->with('error', 'Không thể xóa lớp vì lớp đã xếp lịch học.');

        }
        $class->delete();
        return redirect()->back()->with('success', 'Xóa lớp thành công.');
    }

    public function showClassAndStudent(Request $request)
    {
        $keyword = $request->input('keyword');
        if ($keyword) {
            $classes = DB::table('classes')->where('className','LIKE', '%' . $keyword . '%')
                ->paginate(3);

        }else{
            $classes = DB::table('classes')->paginate(4);

        }
        $stuCount = Classes::withCount('student')->get();
        return view('admin.student', ['classes' => $classes ,'stuCount' => $stuCount]);
    }
    public function showStudent($id,Request $request)
    {
        $class = Classes::findOrFail($id);
        $keyword = $request->input('keyword');
        if ($keyword) {
            $students = DB::table('students')
                ->join('classes', 'students.classID' , '=', 'classes.id')
                ->where('studentName','LIKE', '%' . $keyword . '%')
                ->where('classID', $id)
                ->paginate(3);

        }else{
            $students = DB::table('students')
                ->join('classes', 'students.classID' , '=', 'classes.id')
                ->where('classID', $id)->paginate(3);
        }
        $checkAttent =  Student::withCount('AttendDetail')->get();
        return view('admin.show_student',  ['students' => $students], ['id' => $id,'checkAttent' => $checkAttent]);
    }


    public function addStudent(Request $request)
    {
        $data = $request->validate([
            'studentName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'classID' => 'required|exists:classes,id'
        ]);

        $student = Student::create($data);
        return redirect()->back()->with('success', 'Đã thêm học sinh mới thành công.');
    }

    public function editStudent(Request $request, Student $student)
    {
        $data = $request->validate([
            'studentName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'gender' => 'required|string|max:255'
        ]);
        $student->update($data);
        return redirect()->back()->with('success', 'Đã sửa học sinh mới thành công.');
    }

    public function deleteStudent(Student $student, Request $request)
    {
        if($request->query('checkAtt')>0){
            return redirect()->back()->with('error', 'Sinh viên đã từng điểm danh, hiện không thể xóa!');

        }else{
            $student->delete();
            return redirect()->back()->with('success', 'Đã xóa sinh viên thành công.');
        }

    }
}
