<?php

namespace App\Http\Controllers;

use App\Models\SchoolShifts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolShiftController extends Controller
{
    public function studyShift(Request $request)
    {
        $classes = DB::table('classes')->get();
        $shifts = DB::table('_shifts')->get();
        return view('admin.study_shift', ['classes' => $classes], ['shifts' => $shifts]);
    }

    //beta
    public function addSchoolShift()
    {
//        $data = request()->validate([
//            "dateStart" => "required|string|max:255",
//            "subjectID" => "required|exists:subjects,id",
//            "classID" => "required|exists:classes,id",
//            "teacherID" => "required|exists:teachers,id",
//        ]);
//        $schoolShift = SchoolShifts::create($data);
//        return redirect()->back()->with('success', 'Added new school shift successfully.');
    }
}
