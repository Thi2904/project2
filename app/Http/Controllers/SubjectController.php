<?php

namespace App\Http\Controllers;

use App\Models\curriculums;
use App\Models\major;
use App\Models\subjects;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function showSpecialized()
    {
        $majors = DB::table('major')->get();
        $mjs = major::withCount('curriculums')->get();
        return view('admin.specialized',['majors' => $majors, 'mjs' => $mjs]);
    }

    public function showCurriculum($id, Request $request)
    {
        $keyword = $request->query('keyword');
        if ($keyword) {
            $classes = DB::table('classes')->where('className','LIKE', '%' . $keyword . '%')
                ->paginate(3);

        }else{
            $curriculums = curriculums::where('majorID',$id)->get();

        }
        $majorId = $id;
        $cuss = curriculums::withCount('subjects')->where('majorID',$id)->get();
        return view('admin.curriculum',['curriculums' => $curriculums, 'majorId' => $majorId , 'cuss' => $cuss ]);
    }

    public function addCurriculum(Request $request)
    {
        $data = $request->validate([
            'curriculumName' => 'required|string|max:255',
            'curriculumCode' => 'required|string|max:255',
            'curriculumVNName' => 'required|string|max:255',
            'majorID' => 'required|exists:major,id'
        ]);
        $curriculums = curriculums::create($data);
        return redirect()->back()->with('success', 'Added new curriculum successfully.');
    }

    public function editCurriculum(Request $request, curriculums $curriculum)
    {
        $data = $request->validate([
            'curriculumName' => 'required|string|max:255',
            'curriculumCode' => 'required|string|max:255',
            'curriculumVNName' => 'required|string|max:255'
        ]);
        $curriculum ->update($data);
        return redirect()->back()->with('success', 'Edit curriculum successfully.');
    }

    public function showSubject($major, $curriculum)
    {
        $majorId = $major;
        $subjects = subjects::where('majorID', $major)
            ->where('curriculumID', $curriculum)
            ->get();

        return view('admin.subject', compact('subjects', 'majorId'));
    }
    public function addSubject(Request $request)
    {
        $data = $request->validate([
            'subjectName' => 'required|string|max:255',
            'codeName' => 'required|string|max:255',
            'subjectTime' => 'required|string|max:255',
            'description' => 'required|string',
            'majorID' => 'required|exists:major,id',
            'curriculumID' => 'required|exists:curriculum,id'
        ]);
        $subjects = subjects::create($data);
        return redirect()->back()->with('success', 'Added new curriculum successfully.');
    }
    public function editSubject(Request $request, subjects $subject)
    {
        $data = $request->validate([
            'subjectName' => 'required|string|max:255',
            'codeName' => 'required|string|max:255',
            'subjectTime' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $subject ->update($data);
        return redirect()->back()->with('success', 'Edit subject successfully.');
    }

    public function deleteCurriculum(curriculums $curriculum)
    {
        $curriculum->delete();
        return redirect()->back()->with('success', 'Deleted curriculum successfully.');
    }

    public function deleteSubject(subjects $subject)
    {
        $subject->delete();
        return redirect()->back()->with('success', 'Deleted subject successfully.');
    }
    public function showTeacher()
    {
        $teachers = DB::table('teachers')
            ->join('users', 'teachers.userID', '=', 'users.id')
            ->join('major', 'teachers.majorID', '=', 'major.id')
            ->select(
                'teachers.teacherCode',
                'users.email',
                'users.password',
                'major.majorName'
            )
            ->get();
        $users = DB::table('users')->where('role','teacher')->get();
        $majors = DB::table('major')->get();
        return view('admin.teacherView', ['teachers' => $teachers, 'users' => $users, 'majors' => $majors]);
    }

    public function addTeacher(Request $request)
    {
        $data = $request->validate([
            'userID' => 'required|exists:users,id',
            'teacherCode' => 'required|string|max:255',
            'majorID' => 'required|exists:major,id'
        ]);
        $teachers = Teachers::create($data);
        return redirect()->back()->with('success', 'Added new teacher successfully.');
    }

    public function editTeacher(Request $request, Teachers $teacher)
    {
        $data = $request->validate([
            'teacherCode' => 'required|string|max:255',
            'majorID' => 'required|exists:major,id'
        ]);
        $teacher ->update($data);
        return redirect()->back()->with('success', 'Edit subject successfully.');
    }

    public function deleteTeacher(Teachers $teacher)
    {
        $teacher->delete();
        return redirect()->back()->with('success', 'Deleted subject successfully.');
    }
}
