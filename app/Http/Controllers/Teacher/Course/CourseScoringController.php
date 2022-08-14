<?php

namespace App\Http\Controllers\Teacher\Course;

use App\Http\Controllers\Controller;
use App\Models\MasterScoring;
use App\Models\TblClasses;
use App\Models\TblCourses;
use Illuminate\Http\Request;

class CourseScoringController extends Controller
{
    public $tblClass;
    public function __construct()
    {
        $this->tblClass = new TblClasses();
    }

    public function index(Request $req)
    {
        $scores = MasterScoring::where('tbl_course_id', $req->course_id)->paginate(50);
        $course = TblCourses::find($req->course_id);
        return view('teacher.courses.course_scoring', ['scores' => $scores, 'course' => $course]);
    }

    public function classGuider(Request $req)
    {
        $courses = TblCourses::with(['teacher', 'class', 'transCourses.student'])
            ->where('class_id', $req->class_id);
        $class = TblClasses::find($req->class_id);

        $courses = $courses->paginate(50);
        return view('teacher.courses.course_guider', ['courses' => $courses, 'class' => $class]);
    }

    public function store(Request $req)
    {
        $masterScore = MasterScoring::where('tbl_course_id', $req->tbl_course_id)->select('number')->orderBy('number', 'desc')->first();
        $number = 1;
        if($masterScore) {
            $number = $masterScore->number + 1;
        }
        $score = new MasterScoring();
        $score->number = $number;
        $score->name = $req->name;
        $score->tbl_course_id = $req->tbl_course_id;
        $score->percent = $req->percent;
        $score->description = $req->description;
        $score->save();
        return back()->with('message', ['message' => 'tambah data berhasil!']);
    }

    public function update(Request $req)
    {
        $score = MasterScoring::where('id', $req->id)->first();
        if ($score) {
            $score->name = $req->name;
            $score->percent = $req->percent;
            $score->description = $req->description;
            $score->save();
            return back()->with('message', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }

    public function delete(Request $req)
    {
        $score = MasterScoring::where('id', $req->id)->first();
        if ($score) {
            $score->delete();
            return back()->with('deleted', ['message' => 'data berhasil dihapus!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}
