<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeachController extends Controller
{
    public function TeachShift()
    {
        $teacherID = session('teacherID', Auth::user()->id);
        $StudyShifts = DB::table('schoolShift')
            ->join('subjects', 'schoolShift.subjectID', '=', 'subjects.id')
            ->join('classes', 'schoolShift.classID', '=', 'classes.id')
            ->join('users', 'schoolShift.teacherID', '=', 'users.id')
            ->select(
                'subjects.subjectName',
                'classes.className',
                'users.name',
                'schoolShift.classID',
                'schoolShift.id'
            )
            ->where('schoolShift.teacherID', $teacherID)
            ->get();
        return view('teacher.beforediemdanh', ['StudyShifts' => $StudyShifts]);
    }

    public function TeachShiftAttendance($classID)
    {
        $students = DB::table('students')
            ->where('classID', $classID)
            ->get();
        $schoolShiftID = DB::table('schoolShift')
            ->where('classID', $classID)
            ->value('id');
        return view('teacher.diemdanh', ['students' => $students, 'schoolShiftID' => $schoolShiftID]);
    }

    public function submitDiemDanh(Request $request)
    {
        $attendance = Attendance::create([
            'schoolShiftID' => $request->input('schoolShiftID'),
            'date' => now(),
        ]);

        foreach ($request->input('options') as $studentID => $status) {
            AttendDetail::create([
                'attendID' => $attendance->id,
                'studentID' => $studentID,
                'status' => $status,
            ]);
        }
        return redirect()->route('teacher.TeachShift')->with('success', 'Đã lưu điểm danh thành công!');
    }
}
