<?php

namespace App\Http\Controllers\Teacher\Course;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function index(Request $req)
    {
        $courses = TblCourses::with(['teacher', 'class', 'transCourses.student'])
            ->where('teacher_id', Auth::user()->id)->paginate(50);
        return view('teacher.courses.score', ['courses' => $courses]);
    }
}
