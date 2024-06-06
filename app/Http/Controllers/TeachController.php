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
        $today = now()->dayOfWeek;

        $daysOfWeek = [
            1 => 'Thứ hai',
            2 => 'Thứ ba',
            3 => 'Thứ tư',
            4 => 'Thứ năm',
            5 => 'Thứ sáu',
            6 => 'Thứ bảy',
        ];

        $todayName = $daysOfWeek[$today];


        $StudyShifts = DB::table('schoolShift')
            ->join('schoolShiftDetail', 'schoolShift.id', '=', 'schoolShiftDetail.schoolShiftID')
            ->join('_shifts', 'schoolShiftDetail.shiftsID', '=', '_shifts.id')
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
                'schoolShiftDetail.dateInWeek'
            )
            ->where('schoolShift.teacherID', $teacherID)
            ->where('schoolShiftDetail.dateInWeek', $todayName)
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
            ->select('students.id as studentID',
                'students.studentName',
                'attend_detail.status')
            ->get();
        return view('teacher.suadiemdanh',
               ['students' => $students,
                'schoolShiftID' => $schoolShiftID,
                   'subjectID' => $subjectID,
                   'attendID' => $latestAttendID]);
    }

    public function suadiemdanh(Request $request)
    {
        $attendID = $request->input('attendID');
        $attendanceData = $request->input('options');
        $subjectID = $request->input('subjectID');

        foreach ($attendanceData as $studentID => $status) {
            $attendanceDetail = AttendDetail::where('attendID', $attendID)
                ->where('studentID', $studentID)
                ->first();

            if ($attendanceDetail) {
                $currentStatus = $attendanceDetail->status;
                $attendanceDetail->status = $status;
                $attendanceDetail->save();

                $studentAttendance = DB::table('student_attend_manage')
                    ->where('studentID', $studentID)
                    ->where('subjectID', $subjectID)
                    ->first();

                if ($studentAttendance) {
                    $updates = [
                        'đi học' => $studentAttendance->{'đi học'} - ($currentStatus == 'đi học' ? 1 : 0) + ($status == 'đi học' ? 1 : 0),
                        'nghỉ có phép' => $studentAttendance->{'nghỉ có phép'} - ($currentStatus == 'nghỉ có phép' ? 1 : 0) + ($status == 'nghỉ có phép' ? 1 : 0),
                        'nghỉ không phép' => $studentAttendance->{'nghỉ không phép'} - ($currentStatus == 'nghỉ không phép' ? 1 : 0) + ($status == 'nghỉ không phép' ? 1 : 0),
                        'trễ' => $studentAttendance->{'trễ'} - ($currentStatus == 'trễ' ? 1 : 0) + ($status == 'trễ' ? 1 : 0),
                    ];

                    DB::table('student_attend_manage')
                        ->where('studentID', $studentID)
                        ->where('subjectID', $subjectID)
                        ->update($updates);
                } else {
                    DB::table('student_attend_manage')->insert([
                        'studentID' => $studentID,
                        'subjectID' => $subjectID,
                        'đi học' => ($status == 'đi học' ? 1 : 0),
                        'nghỉ có phép' => ($status == 'nghỉ có phép' ? 1 : 0),
                        'nghỉ không phép' => ($status == 'nghỉ không phép' ? 1 : 0),
                        'trễ' => ($status == 'trễ' ? 1 : 0),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Attendance updated successfully.');
    }




    public function showChuyenCan()
    {
        return view('teacher.chuyencan');
    }
}

