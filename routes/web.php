<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolShiftController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get("/admin/home",function (){
    return view("admin.home");
})->middleware("auth")->name("admin.home");


Route::get("/teacher/beforediemdanh",function (){
    return view("teacher.beforediemdanh");
})->name("teacher.beforediemdanh");

Route::get("/teacher/diemdanh",function (){
    return view("teacher.diemdanh");
})->name("teacher.diemdanh");

Route::get('/admin/home', [AdminController::class, 'home'])
->middleware('auth')->name('admin.home');

Route::get('/login', [\App\Http\Controllers\AuthController::class,'viewLogin'])->name('login');
Route::post('/register',[\App\Http\Controllers\AuthController::class,'register'])->name('register');
Route::get('/registerStudent', [\App\Http\Controllers\AuthController::class,'viewRegis'])->name('registerView');
Route::post('/registerStudent',[\App\Http\Controllers\AuthController::class,'registerStudent'])->name('registerStudent');
Route::post('/login', [\App\Http\Controllers\AuthController::class,'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class,'logout'])->name('logout');

Route::post('/addClass', [AdminController::class, 'addClass'])->name('addClass');
Route::post('/editClass/{class}', [AdminController::class, 'editClass'])->name('editClass');
Route::delete('/deleteClass/{class}', [AdminController::class, 'deleteClass'])->name('deleteClass');

Route::get('/admin/student', [\App\Http\Controllers\AdminController::class, 'showClassAndStudent'])->name('admin.student');
Route::get('/admin/student/{class}', [\App\Http\Controllers\AdminController::class, 'showStudent'])->name('class.show');
Route::post('/addStudent', [\App\Http\Controllers\AdminController::class,'addStudent'])->name('addStudent');
Route::post('/editStudent/{student}', [AdminController::class, 'editStudent'])->name('editStudent');
Route::delete('/deleteStudent/{student}', [AdminController::class, 'deleteStudent'])->name('deleteStudent');

Route::get('/admin/specialized', [\App\Http\Controllers\SubjectController::class, 'showSpecialized'])->name('showSpecialized');
Route::get('/admin/showCurriculum/{major}', [\App\Http\Controllers\SubjectController::class, 'showCurriculum'])->name('showCurriculum');
Route::post('/addCurriculum', [\App\Http\Controllers\SubjectController::class,'addCurriculum'])->name('addCurriculum');
Route::post('/editCurriculum/{curriculum}', [SubjectController::class, 'editCurriculum'])->name('editCurriculum');
Route::delete('/deleteCurriculum/{curriculum}', [SubjectController::class, 'deleteCurriculum'])->name('deleteCurriculum');

Route::get('/admin/studyShift', [\App\Http\Controllers\SchoolShiftController::class, 'studyShift'])->name('studyShift');
Route::post('/addSchoolShift', [\App\Http\Controllers\SchoolShiftController::class,'addSchoolShift'])->name('addSchoolShift');
Route::post('/editSchoolShift/{StudyShift}', [SchoolShiftController::class, 'editSchoolShift'])->name('editSchoolShift');
Route::delete('/deleteSchoolShift/{StudyShift}', [SchoolShiftController::class, 'deleteSchoolShift'])->name('deleteSchoolShift');

Route::get('/admin/viewTeacher', [\App\Http\Controllers\SubjectController::class, 'showTeacher'])->name('showTeacher');
Route::post('/addTeacher', [\App\Http\Controllers\SubjectController::class, 'addTeacher'])->name('addTeacher');

Route::get('/admin/subject/{majorId}/{curriculum}', [\App\Http\Controllers\SubjectController::class, 'showSubject'])->name('showSubject');
Route::post('/addSubject', [\App\Http\Controllers\SubjectController::class,'addSubject'])->name('addSubject');
Route::post('/editSubject/{subject}', [SubjectController::class, 'editSubject'])->name('editSubject');
Route::delete('/deleteSubject/{subject}', [SubjectController::class, 'deleteSubject'])->name('deleteSubject');

Route::get('/admin/showStudyShiftSchool/{StudyShift}', [\App\Http\Controllers\SchoolShiftController::class, 'showStudyShiftSchool'])->name('showStudyShiftSchool');
Route::post('/addSchoolShiftDetail', [\App\Http\Controllers\SchoolShiftController::class,'addSchoolShiftDetail'])->name('addSchoolShiftDetail');
Route::post('/editSchoolShiftDetail/{SchoolShift}', [\App\Http\Controllers\SchoolShiftController::class,'editSchoolShiftDetail'])->name('editSchoolShiftDetail');
Route::delete('/deleteSchoolShiftDetail/{SchoolShift}', [SchoolShiftController::class, 'deleteSchoolShiftDetail'])->name('deleteSchoolShiftDetail');

Route::get('/teacher/beforediemdanh', [\App\Http\Controllers\TeachController::class, 'TeachShift'])->name('teacher.TeachShift');
Route::get('/teacher/diemdanh/{classID}/{schoolShiftID}/{subjectID}', [\App\Http\Controllers\TeachController::class, 'TeachShiftAttendance'])->name('class.showdiemdanh');
Route::post('/submit-diemdanh', [\App\Http\Controllers\TeachController::class, 'submitDiemDanh'])->name('submit.diemdanh');
Route::get('/teacher/suadiemdanh/{classID}/{schoolShiftID}/{subjectID}', [\App\Http\Controllers\TeachController::class, 'showLatestAttendance'])->name('class.suadiemdanh');
Route::post('/suadiemdanh', [\App\Http\Controllers\TeachController::class, 'suadiemdanh'])->name('suadiemdanh');

Route::get('/chuyencan/{subjectID}', [\App\Http\Controllers\TeachController::class, 'showChuyenCan'])->name('class.showChuyenCan');
Route::get('/listchuyenCan', [\App\Http\Controllers\TeachController::class, 'listChuyenCan'])->name('listChuyenCan');


