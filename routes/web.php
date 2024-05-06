<?php

use App\Http\Controllers\AdminController;
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
Route::get('/register', [\App\Http\Controllers\AuthController::class,'viewRegis'])->name('register');
Route::post('/register',[\App\Http\Controllers\AuthController::class,'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\AuthController::class,'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class,'logout'])->name('logout');


Route::post('/addClass', [AdminController::class, 'addClass'])->name('addClass');
Route::post('/editClass/{class}', [AdminController::class, 'editClass'])->name('editClass');
Route::delete('/deleteClass/{class}', [AdminController::class, 'deleteClass'])->name('deleteClass');

Route::get('/admin/student', [\App\Http\Controllers\AdminController::class, 'showClassAndStudent'])->name('admin.student');
Route::get('/admin/student/{class}', [\App\Http\Controllers\AdminController::class, 'showStudent'])->name('class.show');
Route::post('/add-student', [\App\Http\Controllers\AdminController::class,'addStudent'])->name('addStudent');
Route::post('/editStudent/{student}', [AdminController::class, 'editStudent'])->name('editStudent');
Route::delete('/deleteStudent/{student}', [AdminController::class, 'deleteStudent'])->name('deleteStudent');

Route::get('/admin/specialized', [\App\Http\Controllers\AdminController::class, 'showSpecialized'])->name('showSpecialized');
Route::get('/admin/studyShift', [\App\Http\Controllers\AdminController::class, 'studyShift'])->name('studyShift');
Route::get('/admin/subject', [\App\Http\Controllers\AdminController::class, 'showSubject'])->name('showSubject');
Route::get('/admin/showStudyShift', [\App\Http\Controllers\AdminController::class, 'showStudyShift'])->name('showStudyShift');
Route::get('/admin/showCurriculum', [\App\Http\Controllers\AdminController::class, 'showCurriculum'])->name('showCurriculum');

Route::get('/teacher/beforediemdanh', [\App\Http\Controllers\TeachController::class, 'classForCheckin'])->name('teacher.classForCheckin');
Route::get('/teacher/beforediemdanh/{class}', [\App\Http\Controllers\TeachController::class, 'studentForCheckin'])->name('class.showdiemdanh');
