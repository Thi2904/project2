<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendDetail;
use DateTime;
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
        $currentTime = $today->format('H:i:s');

        $currentTimeToo = $today->format('Y-m-d');

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
        $checkHoc = DB::table('attendance')
            ->join('schoolShift','attendance.schoolShiftID','=','schoolShift.id')
            ->join('schoolShiftDetail','schoolShiftDetail.schoolShiftID','=','schoolShift.id')
            ->join('_shifts','schoolShiftDetail.shiftsID','=','_shifts.id')
            ->where('attendance.date',$currentTimeToo)
            ->where('attendance.time_out','>',$currentTime)
            ->where('attendance.time_in','<',$currentTime)
            ->first();

        if ($checkHoc == null){
            return view('teacher.beforediemdanh', ['StudyShifts' => $StudyShifts,'currentTime'=> $currentTime]);

        }else{
            return view('teacher.beforediemdanh', ['StudyShifts' => $StudyShifts,'currentTime'=> $currentTime,'checkHoc'=> $checkHoc]);

        }
        }

        public function TeachShiftAttendance($classID, $schoolShiftID, $subjectID,$teachID,$timeIn,$timeOut)
        {
            $latestAttendID = DB::table('attendance')
                ->join('schoolShift', 'attendance.schoolShiftID', '=', 'schoolShift.id')
                ->where('attendance.schoolShiftID', $schoolShiftID)
                ->where('schoolShift.teacherID', $teachID)
                ->orderBy('attendance.created_at', 'desc')
                ->value('attendance.id');

            $students = DB::table("students")
                ->where('classID', $classID)->get();

            $subject = DB::table('schoolShiftDetail')
                ->join('schoolShift as sS','sS.id' , '=','schoolShiftDetail.schoolShiftID')
                ->join('subjects','sS.subjectID','=','subjects.id')
                ->where('schoolShiftDetail.schoolShiftID',$schoolShiftID)
                ->first();

            $timeLeft = DB::table('schoolShift')->value('timeLeft');

            $times = [
                '8:00', '9:00', '10:00', '11:00', '12:00',
                '13:30', '14:30', '15:30', '16:30', '17:30'
            ];



            try {
                $timeIn = \Carbon\Carbon::createFromFormat('H:i:s', $timeIn);
                $timeOut = \Carbon\Carbon::createFromFormat('H:i:s', $timeOut);
            } catch (\Exception $e) {
                // Trả về trang trước với thông báo lỗi
                return back()->with('error', 'Invalid time format: ' . $e->getMessage());
            }

            // Lọc các thời gian nằm trong khoảng timeIn và timeOut
            $filteredTimes = array_filter($times, function($time) use ($timeIn, $timeOut) {
                $currentTime = \Carbon\Carbon::createFromFormat('H:i', $time);
                return $currentTime >= $timeIn && $currentTime <= $timeOut;
            });

            return view('teacher.diemdanh', [
                'students' => $students,
                'schoolShiftID' => $schoolShiftID,
                'subjectID' => $subjectID,
                'subject' => $subject,
                'timeLeft' => $timeLeft,
                'filteredTimes' => $filteredTimes,
            ]);
        }



    /**
     * @throws \Exception
     */
    public function submitDiemDanh(Request $request)
    {
        $tIn = new DateTime($request->input('time_in'));
        $tOut = new DateTime($request->input('time_out'));

        if (($tIn->diff($tOut))->h <= 0 || ($tIn->diff($tOut))->h > 4) {
            return redirect()->back()->with('error', 'Khung giờ chọn không hợp lệ !');
        }

        $today = Carbon::now();
        $today->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'));
        $currentTimeToo = $today->format('Y-m-d');

        $timeIn = new DateTime($request->input('time_in'));
        $timeOut = new DateTime($request->input('time_out'));
        $interval = $timeIn->diff($timeOut);
        $hours = $interval->h + ($interval->i / 60);

        $attendance = Attendance::create([
            'schoolShiftID' => $request->input('schoolShiftID'),
            'time_in' => $request->input('time_in'),
            'time_out' => $request->input('time_out'),
            'teacherID' => $request->input('teacherID'),
            'date' => $currentTimeToo,
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

            switch ($status) {
                case 'đi học':
                case 'nghỉ có phép':
                    break;
                case 'trễ':
                    $statusCounts[$studentID]['trễ'] += $hours;
                    break;
                case 'nghỉ không phép':
                    $statusCounts[$studentID]['nghỉ không phép'] += $hours;
                    break;
            }
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
                        'di_hoc' => $studentAttendance->di_hoc + $counts['đi học'],
                        'nghi_co_phep' => $studentAttendance->nghi_co_phep + $counts['nghỉ có phép'],
                        'nghi_khong_phep' => $studentAttendance->nghi_khong_phep + $counts['nghỉ không phép'],
                        'tre' => $studentAttendance->tre + $counts['trễ'],
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

        DB::table('schoolShift')
            ->where('id', $request->input('schoolShiftID'))
            ->increment('timeLeft', $hours);

        return redirect()->route('class.suadiemdanh', [
            'classID' => $request->input('classID'),
            'schoolShiftID' => $request->input('schoolShiftID'),
            'subjectID' => $request->input('subjectID'),
            'teachID' => $request->input('teacherID')
        ])->with('success', 'Đã lưu điểm danh thành công!');
    }





    public function showLatestAttendance($classID, $schoolShiftID, $subjectID, $teachID)
    {
        $latestAttendID = DB::table('attendance')
            ->join('schoolShift', 'attendance.schoolShiftID', '=', 'schoolShift.id')
            ->where('attendance.schoolShiftID', $schoolShiftID)
            ->where('schoolShift.teacherID', $teachID)
            ->orderBy('attendance.created_at', 'desc')
            ->value('attendance.id');

        $students = DB::table('students')
            ->join('attend_detail', 'students.id', '=', 'attend_detail.studentID')
            ->join('attendance', 'attend_detail.attendID', '=', 'attendance.id')
            ->join('schoolShift', 'attendance.schoolShiftID', '=', 'schoolShift.id')
            ->where('students.classID', $classID)
            ->where('attend_detail.attendID', $latestAttendID)
            ->where('attendance.schoolShiftID', $schoolShiftID)
            ->where('schoolShift.teacherID', $teachID)
            ->select('students.id as studentID', 'students.studentName', 'attend_detail.status')
            ->get();

        $time = DB::table('attendance')->where('id',$latestAttendID)->get();

        $subject = DB::table('attendance')
            ->join('schoolShift','attendance.schoolShiftID' , '=','schoolShift.id')
            ->join('subjects','schoolShift.subjectID','=','subjects.id')
            ->where('attendance.schoolShiftID',$schoolShiftID)
            ->first();
        $soTiengHoc = DB::table('attendance')
            ->where('attendance.schoolShiftID',$schoolShiftID)
            ->count();
        $timeLeft = DB::table('schoolShift')->value('timeLeft');


        return view('teacher.suadiemdanh',
               ['students' => $students,
                'schoolShiftID' => $schoolShiftID,
                   'subjectID' => $subjectID,
                   'attendID' => $latestAttendID,
                   'subject'=> $subject,
                   'soTiengHoc'=>$soTiengHoc,
                    'time' => $time,
                    'timeLeft'=> $timeLeft]);
    }


    /**
     * @throws \Exception
     */
    public function suadiemdanh(Request $request)
    {
        $attendID = $request->input('attendID');
        $attendanceData = $request->input('options');
        $subjectID = $request->input('subjectID');

        $attendance = Attendance::find($attendID);
        $timeIn = new DateTime($attendance->time_in);
        $timeOut = new DateTime($attendance->time_out);
        $interval = $timeIn->diff($timeOut);
        $hours = $interval->h + ($interval->i / 60);

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
                        'di_hoc' => $studentAttendance->di_hoc - ($currentStatus == 'đi học' ? 0 : 0) + ($status == 'đi học' ? 0 : 0),
                        'nghi_co_phep' => $studentAttendance->nghi_co_phep - ($currentStatus == 'nghỉ có phép' ? 0 : 0) + ($status == 'nghỉ có phép' ? 0 : 0),
                        'nghi_khong_phep' => $studentAttendance->nghi_khong_phep - ($currentStatus == 'nghỉ không phép' ? $hours : 0) + ($status == 'nghỉ không phép' ? $hours : 0),
                        'tre' => $studentAttendance->tre - ($currentStatus == 'trễ' ? $hours  : 0) + ($status == 'trễ' ? $hours : 0),
                    ];

                    DB::table('student_attend_manage')
                        ->where('studentID', $studentID)
                        ->where('subjectID', $subjectID)
                        ->update($updates);
                } else {
                    DB::table('student_attend_manage')->insert([
                        'studentID' => $studentID,
                        'subjectID' => $subjectID,
                        'di_hoc' => ($status == 'đi học' ? 0 : 0),
                        'nghi_co_phep' => ($status == 'nghỉ có phép' ? 0 : 0),
                        'nghi_khong_phep' => ($status == 'nghỉ không phép' ? $hours : 0),
                        'tre' => ($status == 'trễ' ? $hours : 0),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Sửa điểm danh thành công.');
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
            ->select('sam.*', 's.subjectName', 'std.studentName', '_s.*', 's.subjectTime')
            ->get();

        if ($chuyenCan->isNotEmpty()) {
            $subjectTime = $chuyenCan->first()->subjectTime; // Lấy tổng số giờ môn học
        } else {
            $subjectTime = null;
        }


        return view('teacher.chuyencanDetails', ['chuyenCan' => $chuyenCan, 'subjectTime' => $subjectTime]);
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

