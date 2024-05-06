<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('admin.home', ['classes' => $classes]);
    }

    public function addClass(Request $request)
    {

        $data = $request->validate([
            'className' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'totalStudent' => 'required|integer|max:50'
        ]);


        // Create the class record in the database
        $classes = Classes::create($data);

        // Perform any additional actions or redirects as needed
        return redirect()->back()->with('success', 'Added new class successfully.');
    }

    public function editClass(Request $request, Classes $class)
    {
        $data = $request->validate([
            'className' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'totalStudent' => 'required|integer|max:50'
        ]);

        // update the class record in the database
        $class->update($data);

        return redirect()->back()->with('success', 'Updated class successfully.');
    }

    public function deleteClass(Classes $class)
    {
        // Delete the class record from the database
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
            'address' => 'required|string|max:255',
            'DoB' => 'required|string|max:255',
            'classID' => 'required|string|max:255'
        ]);


        // Create the class record in the database
        $student = Student::create($data);

        // Perform any additional actions or redirects as needed
        return redirect()->back()->with('success', 'Added new student successfully.');
    }

    public function editStudent(Request $request, Student $student)
    {
        $data = $request->validate([
            'studentName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'DoB' => 'required|string|max:255',
            'classID' => 'required|string|max:255'
        ]);

        // update the class record in the database
        $student->update($data);

        return redirect()->back()->with('success', 'Updated student successfully.');
    }

    public function deleteStudent(Student $student)
    {
        // Delete the class record from the database
        $student->delete();

        return redirect()->back()->with('success', 'Deleted student successfully.');
    }
    public function showSpecialized()
    {
        return view('admin.specialized');
    }
    public function showStudyShift()
    {
        return view('admin.show_study_shift');
    }
    public function studyShift()
    {
        return view('admin.study_shift');
    }
    public function showSubject()
    {
        return view('admin.subject');
    }
    public function showCurriculum()
    {
        return view('admin.curriculum');
    }
}
