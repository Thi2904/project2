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
            ->join('schoolshiftdetail', 'schoolShift.id', '=', 'schoolshiftdetail.schoolShiftID')
            ->join('_shifts', 'schoolshiftdetail.shiftsID', '=', '_shifts.id')
            ->join('subjects', 'schoolShift.subjectID', '=', 'subjects.id')
            ->join('classes', 'schoolShift.classID', '=', 'classes.id')
            ->join('users', 'schoolShift.teacherID', '=', 'users.id')
            ->select(
                'subjects.subjectName',
                'classes.className',
                'users.name',
                'schoolShift.classID',
                'schoolShift.id',
                'schoolShift.subjectID',
                '_shifts.time_in',
                '_shifts.time_out',
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

    public function TeachShiftAttendance($classID, $schoolShiftID, $subjectID)
    {
        $students = DB::table("students")
            ->where('classID', $classID)->get();
        return view('teacher.diemdanh', ['students' => $students, 'schoolShiftID' => $schoolShiftID, 'subjectID' => $subjectID]);
    }

    public function submitDiemDanh(Request $request)
    {
        $attendance = Attendance::create([
            'schoolShiftID' => $request->input('schoolShiftID'),
            'date' => now(),
        ]);

        $statusCounts = [];

        foreach ($request->input('options') as $studentID => $status) {
            AttendDetail::create([
                'attendID' => $attendance->id,
                'studentID' => $studentID,
                'status' => $status,
            ]);
            if (!isset($statusCounts[$studentID])) {
                $statusCounts[$studentID] = [
                    'đi học' => 0,
                    'nghỉ có phép' => 0,
                    'nghỉ không phép' => 0,
                    'trễ' => 0,
                ];
            }
            $statusCounts[$studentID][$status]++;
        }
        foreach ($statusCounts as $studentID => $counts) {
            $studentAttendance = DB::table('student_attend_manage')
                ->where('studentID', $studentID)
                ->where('subjectID', $request->input('subjectID'))
                ->first();
            if ($studentAttendance) {
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
            return redirect()->route('teacher.TeachShift')
                ->with('success', 'Đã lưu điểm danh thành công!');
    }

    public function showLatestAttendance($classID, $schoolShiftID, $subjectID)
    {
        $latestAttendID = DB::table('attendance')->orderBy('created_at', 'desc')
            ->where('schoolShiftID',$schoolShiftID)
            ->value('id');
        $students = DB::table("students")
            ->join('attend_detail', 'students.id', '=', 'attend_detail.studentID')
            ->join('attendance', 'attend_detail.attendID' , '=' , 'attendance.id')
            ->where('classID', $classID)
            ->where('attendID', $latestAttendID)
            ->where('schoolShiftID', $schoolShiftID)
            ->get();
        return view('teacher.suadiemdanh', ['students' => $students, 'schoolShiftID' => $schoolShiftID, 'subjectID' => $subjectID]);
    }

    public function suadiemdanh(Request $request)
    {
        return redirect()->back()->with('success', 'Attendance updated successfully.');
    }


    public function showChuyenCan()
    {
        return view('teacher.chuyencan');
    }
}

