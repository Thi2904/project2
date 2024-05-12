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
        return view('admin.home', ['classes' => $classes, 'curriculums' => $curriculums, 'majors' => $majors]);
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

        return redirect()->back()->with('success', 'Added new class successfully.');
    }


    public function editClass(Request $request, Classes $class)
    {
        $data = $request->validate([
            'className' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'curriculumID' => 'required|exists:curriculum,id'
        ]);
        $class->update($data);
        return redirect()->back()->with('success', 'Updated class successfully.');
    }

    public function deleteClass(Classes $class)
    {
        $class->delete();
        return redirect()->back()->with('success', 'Deleted class successfully.');
    }

    public function showClassAndStudent()
    {
        $classes = DB::table('classes')->paginate(4);
        return view('admin.student', ['classes' => $classes]);
    }
    public function showStudent($id)
    {
        $students = Student::where('classID', $id)->paginate(3);
        $class = Classes::findOrFail($id);
        return view('admin.show_student',  ['students' => $students], ['id' => $id]);
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
        return redirect()->back()->with('success', 'Added new student successfully.');
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
        return redirect()->back()->with('success', 'Updated student successfully.');
    }

    public function deleteStudent(Student $student)
    {
        $student->delete();
        return redirect()->back()->with('success', 'Deleted student successfully.');
    }

}
