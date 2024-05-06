<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;

class TeachController extends Controller
{
    public function studentForCheckin($id)
    {
        $students = Student::where('classID', $id)->paginate(3);
        $class = Classes::findOrFail($id);
        return view('teacher.diemdanh', ['students' => $students], ['id' => $id]);
    }

    public function classForCheckin()
    {
        $classes = Classes::paginate(4);
        return view('teacher.beforediemdanh', ['classes' => $classes]);
    }
}
