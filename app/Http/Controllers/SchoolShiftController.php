<?php

namespace App\Http\Controllers;

use App\Models\schoolShiftDetail;
use App\Models\SchoolShifts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolShiftController extends Controller
{
    public function studyShift()
    {
        $StudyShifts = DB::table('schoolShift')
            ->join('subjects', 'schoolShift.subjectID', '=', 'subjects.id')
            ->join('classes', 'schoolShift.classID', '=', 'classes.id')
            ->join('users', 'schoolShift.teacherID', '=', 'users.id')->get();
        $teachers = DB::table('users')
            ->join('teachers', 'users.id', '=', 'teachers.userID')->get();
        $classes = DB::table('classes')->get();
        $subjects = DB::table('subjects')->get();
        $shifts = DB::table('_shifts')->get();
        return view('admin.study_shift', ['StudyShifts' => $StudyShifts,'classes' => $classes, 'shifts' => $shifts, 'subjects' => $subjects, 'teachers' => $teachers]);
    }

    //beta
    public function addSchoolShift(Request $request)
    {
        $data = $request->validate([
            "dateStart" => "required|string|max:255",
            "subjectID" => "required|exists:subjects,id",
            "classID" => "required|exists:classes,id",
            "teacherID" => "required|exists:teachers,id",
        ]);
        $schoolShift = SchoolShifts::create($data);
        return redirect()->back()->with('success', 'Added new study shift successfully.');
    }
    public function editSchoolShift(Request $request, SchoolShifts $schoolShift)
    {
        $data = $request->validate([
            "dateStart" => "required|string|max:255",
            "subjectID" => "required|exists:subjects,id",
            "classID" => "required|exists:classes,id",
            "teacherID" => "required|exists:teachers,id",
        ]);
        $schoolShift ->update($data);
        return redirect()->back()->with('success', 'Edit subject successfully.');
    }

    public function deleteSchoolShift(SchoolShifts $schoolShift)
    {
        $schoolShift->delete();
        return redirect()->back()->with('success', 'Deleted subject successfully.');
    }

    public function addSchoolShiftDetail(Request $request)
    {
        $data = $request->validate([
            "schoolShiftID" => "required|exists:schoolShift,id",
            "dateInWeek" => "required|string|max:255",
            "classroomID" => "required|exists:classes,id",
            "shiftsID" => "required|exists:teachers,id",
        ]);
        $schoolShiftDetail = SchoolShifts::create($data);
        return redirect()->back()->with('success', 'Added new study shift successfully.');
    }
    public function editSchoolShiftDetail(Request $request, SchoolShiftDetail $schoolShiftDetail)
    {
        $data = $request->validate([
            "schoolShiftID" => "required|exists:schoolShift,id",
            "dateInWeek" => "required|string|max:255",
            "classroomID" => "required|exists:classes,id",
            "shiftsID" => "required|exists:teachers,id",
        ]);
        $schoolShiftDetail ->update($data);
        return redirect()->back()->with('success', 'Edit subject successfully.');
    }
    public function deleteSchoolShiftDetail(SchoolShiftDetail $schoolShiftDetail)
    {
        $schoolShiftDetail->delete();
        return redirect()->back()->with('success', 'Deleted subject successfully.');
    }
}
