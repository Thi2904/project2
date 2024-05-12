<?php

namespace App\Http\Controllers;

use App\Models\curriculums;
use App\Models\major;
use App\Models\subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function showSpecialized()
    {
        $majors = DB::table('major')->get();
        return view('admin.specialized',['majors' => $majors]);
    }

    public function showCurriculum($id)
    {
        $curriculums = curriculums::where('majorID',$id)->get();
        $major = major::findOrFail($id);
        return view('admin.curriculum',['curriculums' => $curriculums], ['major' => $major]);
    }

    public function addCurriculum(Request $request)
    {
        $data = $request->validate([
            'curriculumName' => 'required|string|max:255',
            'majorID' => 'required|exists:major,id'
        ]);
        $curriculums = curriculums::create($data);
        return redirect()->back()->with('success', 'Added new curriculum successfully.');
    }

    public function editCurriculum(Request $request, curriculums $curriculum)
    {
        $data = $request->validate([
            'curriculumName' => 'required|string|max:255'
        ]);
        $curriculum ->update($data);
        return redirect()->back()->with('success', 'Edit curriculum successfully.');
    }

    public function showSubject()
    {
        $subjects = DB::table("subjects")->get();
        return view('admin.subject', ['subjects' => $subjects]);
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
    public function showStudyShift()
    {
        return view('admin.show_study_shift');
    }
    public function studyShift()
    {
        return view('admin.study_shift');
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
}
