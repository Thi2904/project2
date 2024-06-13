<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeachController extends Controller
{
    public function TeachShift()
    {
        $teacherID = session('teacherID', Auth::user()->id);

        $today = Carbon::now();
        $today->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'));

        $daysOfWeek = [
            0 => 'Chủ nhật',
            1 => 'Thứ hai',
            2 => 'Thứ ba',
            3 => 'Thứ tư',
            4 => 'Thứ năm',
            5 => 'Thứ sáu',
            6 => 'Thứ bảy',
        ];

        $todayName = $daysOfWeek[$today->dayOfWeek];

        $currentTime = $today->format('H:i:s');
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
            ->where('_shifts.time_in','<=', $currentTime)
            ->where('_shifts.time_out','>=', $currentTime)
            ->get();

        return view('teacher.beforediemdanh', ['StudyShifts' => $StudyShifts]);
        }

    public function TeachShiftAttendance($classID, $schoolShiftID, $subjectID)
    {
        $students = DB::table("students")
            ->where('classID', $classID)->get();
        $soTiengHoc = DB::table('attendance')
            ->where('attendance.schoolShiftID',$schoolShiftID)
            ->count();
        $subject = DB::table('attendance')
            ->join('schoolShift','attendance.schoolShiftID' , '=','schoolShift.id')
            ->join('subjects','schoolShift.subjectID','=','subjects.id')
            ->where('attendance.schoolShiftID',$schoolShiftID)
            ->first();
        return view('teacher.diemdanh', ['students' => $students, 'schoolShiftID' => $schoolShiftID, 'subjectID' => $subjectID,'soTiengHoc'=>$soTiengHoc,'subject'=>$subject]);
    }

    public function submitDiemDanh(Request $request)
    {
        $attendance = Attendance::create([
            'schoolShiftID' => $request->input('schoolShiftID'),
            'time_in' => $request->input('time_in'),
            'time_out' => $request->input('time_out'),
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
                        'di_hoc' => $studentAttendance->{'di_hoc'} + $counts['đi học'],
                        'nghi_co_phep' => $studentAttendance->{'nghi_co_phep'} + $counts['nghỉ có phép'],
                        'nghi_khong_phep' => $studentAttendance->{'nghi_khong_phep'} + $counts['nghỉ không phép'],
                        'tre' => $studentAttendance->{'tre'} + $counts['trễ'],
                    ]);
            } else {
                DB::table('student_attend_manage')->insert([
                    'studentID' => $studentID,
                    'subjectID' => $request->input('subjectID'),
                    'di_hoc' => $counts['đi học'],
                    'nghi_co_phep' => $counts['nghỉ có phép'],
                    'nghi_khong_phep' => $counts['nghỉ không phép'],
                    'tre' => $counts['trễ'],
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
                        'di_hoc' => $studentAttendance->{'di_hoc'} - ($currentStatus == 'đi học' ? 1 : 0) + ($status == 'đi học' ? 1 : 0),
                        'nghi_co_phep' => $studentAttendance->{'nghi_co_phep'} - ($currentStatus == 'nghỉ có phép' ? 1 : 0) + ($status == 'nghỉ có phép' ? 1 : 0),
                        'nghi_khong_phep' => $studentAttendance->{'nghi_khong_phep'} - ($currentStatus == 'nghỉ không phép' ? 1 : 0) + ($status == 'nghỉ không phép' ? 1 : 0),
                        'tre' => $studentAttendance->{'tre'} - ($currentStatus == 'trễ' ? 1 : 0) + ($status == 'trễ' ? 1 : 0),
                    ];

                    DB::table('student_attend_manage')
                        ->where('studentID', $studentID)
                        ->where('subjectID', $subjectID)
                        ->update($updates);
                } else {
                    DB::table('student_attend_manage')->insert([
                        'studentID' => $studentID,
                        'subjectID' => $subjectID,
                        'di_hoc' => ($status == 'đi học' ? 1 : 0),
                        'nghi_co_phep' => ($status == 'nghỉ có phép' ? 1 : 0),
                        'nghi_khong_phep' => ($status == 'nghỉ không phép' ? 1 : 0),
                        'tre' => ($status == 'trễ' ? 1 : 0),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Attendance updated successfully.');
    }


    public function showChuyenCan($id)
    {

        $uniqueShiftDetails = DB::table('schoolShiftDetail')
            ->select('schoolShiftID', DB::raw('MIN(id) as id'))
            ->groupBy('schoolShiftID');

        $chuyenCan = DB::table('student_attend_manage as sam')
            ->join('subjects as s', 'sam.subjectID', '=', 's.id')
            ->join('schoolShift as ss', 's.id', '=', 'ss.subjectID')
            ->join('students as std', 'sam.studentID', '=', 'std.id')
            ->joinSub($uniqueShiftDetails, 'uniqueShiftDetails', function ($join) {
                $join->on('ss.id', '=', 'uniqueShiftDetails.schoolShiftID');
            })
            ->join('schoolShiftDetail as ssdt', 'uniqueShiftDetails.id', '=', 'ssdt.id')
            ->join('_shifts as _s', '_s.id', '=', 'ssdt.shiftsID')
            ->where('sam.subjectID', $id)
            ->select('sam.*', 's.*', 'ss.*', 'std.*', 'ssdt.*', '_s.*')
            ->get();


        if ($chuyenCan->isNotEmpty()) {

            $subjectTime = $chuyenCan->first()->subjectTime;

            $tongSoBuoi = $subjectTime / 4;
        } else {

            $tongSoBuoi = null;
        }
        return view('teacher.chuyencanDetails', ['chuyenCan' => $chuyenCan,'tongSoBuoi'=> $tongSoBuoi]);
    }
    public function listChuyenCan()
    {
        $teacherID = session('teacherID', Auth::user()->id);
        $StudyShifts = DB::table('schoolShift')
            ->join('subjects', 'schoolShift.subjectID', '=', 'subjects.id')
            ->join('classes', 'schoolShift.classID', '=', 'classes.id')
            ->join('teachers', 'schoolShift.teacherID', '=', 'teachers.id')
            ->join('users','teachers.userID','=','users.id')
            ->select(
                'schoolShift.id as schoolShift_id',
                'subjects.id as subject_id',
                'classes.id as class_id',
                'users.id as user_id',
                'schoolShift.*',
                'subjects.*',
                'classes.*',
                'users.*'
            )
            ->where('schoolShift.teacherID', $teacherID)
            ->paginate(3);

        return view('teacher.chuyencan', ['StudyShifts' => $StudyShifts]);
    }

}

