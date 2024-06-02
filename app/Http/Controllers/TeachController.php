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
                'schoolShift.id',
                'schoolShift.subjectID'

            )
            ->where('schoolShift.teacherID', $teacherID)
            ->get();
        return view('teacher.beforediemdanh', ['StudyShifts' => $StudyShifts]);
    }

    public function listChuyenCan()
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
                'schoolShift.id',
                'schoolShift.subjectID'
            )
            ->where('schoolShift.teacherID', $teacherID)
            ->get();
        return view('teacher.chuyencan', ['StudyShifts' => $StudyShifts]);
    }

    public function TeachShiftAttendance($classID)
    {
    }

    public function submitDiemDanh(Request $request)
    {
        // Create new attendance record
        $attendance = Attendance::create([
            'schoolShiftID' => $request->input('schoolShiftID'),
            'date' => now(),
        ]);

        // Initialize an array to hold status counts for each student
        $statusCounts = [];

        // Iterate over the submitted attendance options
        foreach ($request->input('options') as $studentID => $status) {
            // Create new attendance detail record
            AttendDetail::create([
                'attendID' => $attendance->id,
                'studentID' => $studentID,
                'status' => $status,
            ]);

            // Initialize the student's status counts if not already done
            if (!isset($statusCounts[$studentID])) {
                $statusCounts[$studentID] = [
                    'đi học' => 0,
                    'nghỉ có phép' => 0,
                    'nghỉ không phép' => 0,
                    'trễ' => 0,
                ];
            }

            // Increment the corresponding status count for the student
            $statusCounts[$studentID][$status]++;
        }

        // Iterate over each student's status counts and update the student_attend_manage table
        foreach ($statusCounts as $studentID => $counts) {
            $studentAttendance = DB::table('student_attend_manage')
                ->where('studentID', $studentID)
                ->where('subjectID', $request->input('subjectID'))
                ->first();

            if ($studentAttendance) {
                // Update the existing record
                DB::table('student_attend_manage')
                    ->where('studentID', $studentID)
                    ->where('subjectID', $request->input('subjectID'))
                    ->update([
                        'đi học' => $studentAttendance->{'đi học'} + $counts['đi học'],
                        'nghỉ có phép' => $studentAttendance->{'nghỉ có phép'} + $counts['nghỉ có phép'],
                        'nghỉ không phép' => $studentAttendance->{'nghỉ không phép'} + $counts['nghỉ không phép'],
                        'trễ' => $studentAttendance->{'trễ'} + $counts['trễ'],
                    ]);
            } else {
                // Insert a new record
                DB::table('student_attend_manage')->insert([
                    'studentID' => $studentID,
                    'subjectID' => $request->input('subjectID'),
                    'đi học' => $counts['đi học'],
                    'nghỉ có phép' => $counts['nghỉ có phép'],
                    'nghỉ không phép' => $counts['nghỉ không phép'],
                    'trễ' => $counts['trễ'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Đã lưu điểm danh thành công!');
    }
    public function showChuyenCan()
    {
        return view('teacher.chuyencan');
    }
}

