<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\schoolShiftDetail;
use App\Models\SchoolShifts;
use App\Models\subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SchoolShiftController extends Controller
{
    public function studyShift(Request $request)
    {
        $keyword = $request->query('keyword');
        if ($keyword) {
            $StudyShifts = DB::table('schoolShift')
                ->join('subjects', 'schoolShift.subjectID', '=', 'subjects.id')
                ->join('classes', 'schoolShift.classID', '=', 'classes.id')
                ->join('teachers', 'schoolShift.teacherID', '=', 'teachers.id')
                ->join('users','teachers.userID','=','users.id')
                ->where('users.name', 'LIKE', '%' . $keyword . '%')
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
                ->paginate(3);
            if ($StudyShifts->isEmpty()) {
                return redirect()->back()->with('warning', 'Không tìm thấy giảng viên.');
            }

        }

        else{
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
                ->paginate(3);
        }


        $teachers = DB::table('users')
            ->join('teachers', 'teachers.userID', '=', 'users.id')
            ->select('users.*', 'teachers.id as tId')
            ->get();

        $classes = DB::table('classes')->get();
        $subjects = DB::table('subjects')->get();
        $shifts = DB::table('_shifts')->get();
        $rooms = DB::table('classroom')->get();
        $countssd = SchoolShifts::withCount('schoolShiftDetails')->get();
        return view('admin.study_shift', ['rooms' => $rooms,'StudyShifts' => $StudyShifts,'classes' => $classes, 'shifts' => $shifts, 'subjects' => $subjects, 'teachers' => $teachers,'countssd' => $countssd]);
    }

    //beta
    public function addSchoolShift(Request $request)
    {

        $today = Carbon::now();
        $today->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'));
        $data = $request->validate([
            "dateStart" => "required|string|max:255",
            "subjectID" => "required|exists:subjects,id",
            "classID" => "required|exists:classes,id",
            "teacherID" => "required|exists:teachers,id",
        ]);
        $date = $data['dateStart'];
        $classId = $data['classID'];
        $dateStart = Carbon::createFromFormat('Y-m-d', $data['dateStart'], new \DateTimeZone('Asia/Ho_Chi_Minh'))->startOfDay();



        $classes = DB::table('classes')
            ->join('students','students.classID', '=' ,'classes.id' )
            ->where('classes.id',$classId)
            ->count();
        ;

        if($classes > 0){
            $schoolShift = SchoolShifts::create($data);
            return redirect()->back()->with('success', 'Thêm ca học mới thành công.');
        }
        elseif ($dateStart->lt($today)) {
            return redirect()->back()->with('error', 'Không thể thêm lịch học vì ngày bắt đầu là ngày trước ngày hôm nay.');
        }
        else{
            return redirect()->back()->with('error', 'Không thể thêm lịch học vì lớp chưa có sinh viên.');

        }

    }
    public function editSchoolShift(Request $request, SchoolShifts $StudyShift)
    {
        $data = $request->validate([
            "dateStart" => "required|string|max:255",
            "subjectID" => "required|exists:subjects,id",
            "classID" => "required|exists:classes,id",
            "teacherID" => "required|exists:teachers,id",
        ]);
        if ($StudyShift->update($data)) {
            return redirect()->back()->with('success', 'Edit subject successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to edit subject.');
        }
    }

    public function deleteSchoolShift(SchoolShifts $StudyShift, Request $request)
    {
        if($request->query('countSSD')>0){
            return redirect()->back()->with('error', 'Không thể xóa lịch học vì đã được xếp ca học');
        }else{
            $StudyShift->delete();
            return redirect()->back()->with('success', 'Xóa lịch học thành công.');

        }

    }

    public function showStudyShiftSchool($StudyShift)
    {
        $schoolShiftID = $StudyShift;

            $SchoolShifts = DB::table('schoolShiftDetail')
                ->join('classroom', 'schoolShiftDetail.classroomID', '=', 'classroom.id')
                ->join('_shifts', 'schoolShiftDetail.shiftsID', '=', '_shifts.id')
                ->where('schoolShiftDetail.schoolShiftID', $schoolShiftID)
                ->select(
                    'schoolShiftDetail.id as schoolShiftDetail_id',
                    'classroom.id as classroom_id',
                    '_shifts.id as shifts_id',
                    'schoolShiftDetail.*',
                    'classroom.*',
                    '_shifts.*'
                )
                ->paginate(3);


        $shifts = DB::table('_shifts')->get();

        $rooms = DB::table('classroom')->get();

        return view('admin.school_study_shift',['SchoolShifts' => $SchoolShifts, 'shifts' => $shifts ,'rooms' => $rooms]);
    }
    public function addSchoolShiftDetail(Request $request)
    {
        $data = $request->validate([
            "schoolShiftID" => "required|exists:schoolShift,id",
            "dateInWeek" => "required|string|max:255",
            "classroomID" => "required|exists:classroom,id",
            "shiftsID" => "required|exists:_shifts,id",
        ]);

        $schoolShift = DB::table('schoolShift')->where('id', $request->input('schoolShiftID'))->first();
        $newShift = DB::table('_shifts')->where('id', $request->input('shiftsID'))->first();

        $classConflictShifts = DB::table('schoolShiftDetail as ssd')
            ->join('schoolShift as ss', 'ssd.schoolShiftID', '=', 'ss.id')
            ->join('_shifts as s', 'ssd.shiftsID', '=', 's.id')
            ->where('ss.classID', $schoolShift->classID)
            ->where('ssd.dateInWeek', $request->input('dateInWeek'))
            ->where(function ($query) use ($newShift) {
                $query->where('s.time_in', '<', $newShift->time_out)
                    ->where('s.time_out', '>', $newShift->time_in);
            })
            ->count();

        $roomConflictShifts = DB::table('schoolShiftDetail as ssd')
            ->join('schoolShift as ss', 'ssd.schoolShiftID', '=', 'ss.id')
            ->join('_shifts as s', 'ssd.shiftsID', '=', 's.id')
            ->where('ssd.classroomID', $request->input('classroomID'))
            ->where('ssd.dateInWeek', $request->input('dateInWeek'))
            ->where(function ($query) use ($newShift) {
                $query->where('s.time_in', '<', $newShift->time_out)
                    ->where('s.time_out', '>', $newShift->time_in);
            })
            ->count();

        if ($classConflictShifts > 0) {
            return redirect()->back()->with('error', 'Ca học đã được xếp cho lớp này vào ngày và giờ này. Vui lòng chọn ca khác.');
        } elseif ($roomConflictShifts > 0) {
            return redirect()->back()->with('error', 'Phòng học đã được xếp vào ngày và giờ này cho lớp khác. Vui lòng chọn phòng học hoặc thời gian khác.');
        } else {
            $schoolShiftDetail = SchoolShiftDetail::create($data);
            return redirect()->back()->with('success', 'Thêm ngày học thành công.');
        }
    }


    public function editSchoolShiftDetail(Request $request, SchoolShiftDetail $SchoolShift)
    {
        $data = $request->validate([
            "schoolShiftID" => "required|exists:schoolShift,id",
            "dateInWeek" => "required|string|max:255",
            "classroomID" => "required|exists:classroom,id",
            "shiftsID" => "required|exists:_shifts,id",
        ]);

        $schoolShift = DB::table('schoolShift')->where('id', $request->input('schoolShiftID'))->first();
        $newShift = DB::table('_shifts')->where('id', $request->input('shiftsID'))->first();

        $classConflictShifts = DB::table('schoolShiftDetail as ssd')
            ->join('schoolShift as ss', 'ssd.schoolShiftID', '=', 'ss.id')
            ->join('_shifts as s', 'ssd.shiftsID', '=', 's.id')
            ->where('ss.classID', $schoolShift->classID)
            ->where('ssd.dateInWeek', $request->input('dateInWeek'))
            ->where('ssd.id', '!=', $SchoolShift->id)
            ->where(function ($query) use ($newShift) {
                $query->where('s.time_in', '<', $newShift->time_out)
                    ->where('s.time_out', '>', $newShift->time_in);
            })
            ->count();

        $roomConflictShifts = DB::table('schoolShiftDetail as ssd')
            ->join('schoolShift as ss', 'ssd.schoolShiftID', '=', 'ss.id')
            ->join('_shifts as s', 'ssd.shiftsID', '=', 's.id')
            ->where('ssd.classroomID', $request->input('classroomID'))
            ->where('ssd.dateInWeek', $request->input('dateInWeek'))
            ->where('ssd.id', '!=', $SchoolShift->id)
            ->where(function ($query) use ($newShift) {
                $query->where('s.time_in', '<', $newShift->time_out)
                    ->where('s.time_out', '>', $newShift->time_in);
            })
            ->count();

        if ($classConflictShifts > 0) {
            return redirect()->back()->with('error', 'Ca học đã được xếp cho lớp này vào ngày và giờ này. Vui lòng chọn ca khác.');
        } elseif ($roomConflictShifts > 0) {
            return redirect()->back()->with('error', 'Phòng học đã được xếp vào ngày và giờ này cho lớp khác. Vui lòng chọn phòng học hoặc thời gian khác.');
        } else {
            if ($SchoolShift->update($data)) {
                return redirect()->back()->with('success', 'Sửa ngày học thành công.');
            } else {
                return redirect()->back()->with('error', 'Sửa ngày học thất bại');
            }
        }
    }

    public function deleteSchoolShiftDetail(SchoolShiftDetail $SchoolShift)
    {
        $SchoolShift->delete();
        return redirect()->back()->with('success', 'Xóa ngày học thành công.');
    }
    public function getSubjects($classID)
    {
        $class = DB::table('classes')->where('id',$classID)->first();
        $majorID = $class->majorID;
        $curriculumID = $class->curriculumID;
        $subject = DB::table('subjects')
            ->where('majorID',$majorID)
            ->where('curriculumID',$curriculumID)
            ->select('id','subjectName')->get();
        if ($subject->isEmpty()) {
            $subject = collect([['subjectName' => 'Không tìm thấy môn học']]);
        }
        return response()->json($subject);
    }
    public function getTeachers($classID)
    {
        $class = DB::table('classes')->where('id',$classID)->first();
        $majorID = $class->majorID;
        $subject = DB::table('teachers')
            ->join('users','teachers.userID','=','users.id')
            ->where('majorID',$majorID)
            ->select('teachers.id','users.name')->get();
        if ($subject->isEmpty()) {
            $subject = collect([['name' => 'Không tìm thấy giảng viên']]);
        }
        return response()->json($subject);
    }
    public function getEditSubjects($classID)
    {
        $class = DB::table('classes')->where('id',$classID)->first();
        $majorID = $class->majorID;
        $curriculumID = $class->curriculumID;
        $subject = DB::table('subjects')
            ->where('majorID',$majorID)
            ->where('curriculumID',$curriculumID)
            ->select('id','subjectName')->get();
        if ($subject->isEmpty()) {
            $subject = collect([['subjectName' => 'Không tìm thấy môn học']]);
        }
        return response()->json($subject);
    }
    public function getEditTeachers($classID)
    {
        $class = DB::table('classes')->where('id',$classID)->first();
        $majorID = $class->majorID;
        $subject = DB::table('teachers')
            ->join('users','teachers.userID','=','users.id')
            ->where('majorID',$majorID)
            ->select('teachers.id','users.name')->get();
        if ($subject->isEmpty()) {
            $subject = collect([['name' => 'Không tìm thấy giảng viên']]);
        }
        return response()->json($subject);
    }
}
