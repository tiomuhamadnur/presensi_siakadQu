<?php

namespace App\Http\Controllers\Admin\Present\PresentByClass;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresentByClassController extends Controller
{
    public function index(Request $req)
    {
        $tblCourse = TblCourses::find($req->course_id);
        $transCourse = TransCourses::where('trans_courses.class_id', $req->class_id)->where('trans_courses.course_id', $req->course_id)
            ->join('tbl_courses', 'tbl_courses.id', 'trans_courses.course_id');
        if ($req->schedule) {
            $transCourse->where('tbl_courses.schedule', $req->schedule);
        }
        $transCourse = $transCourse->get();
        return view('admin.present.present_by_class.present_by_class', ['transCourse' => $transCourse, 'course' => $tblCourse]);
    }

    public function store(Request $req)
    {
        $course = new TransCourses();
        $course->class_id = $req->class_id;
        $course->course_id = $req->course_id;
        $course->student_id = $req->student_id;
        $course->save();
        return back()->with('success', 'tambah data berhasil!');
    }

    public function update(Request $req)
    {
        $course = TransCourses::where('id', $req->id)->first();
        if ($course) {
            $req->class_id ? $course->class_id = $req->class_id : null;
            $req->course_id ? $course->course_id = $req->course_id : null;
            $req->student_id ? $course->student_id = $req->student_id : null;
            $req->mid_score ? $course->mid_score = $req->mid_score : null;
            $req->quiz_score ? $course->quiz_score = $req->quiz_score : null;
            $req->assesment_score ? $course->assesment_score = $req->assesment_score : null;
            $req->final_score ? $course->final_score = $req->final_score : null;
            $req->total_score ? $course->total_score = $req->total_score : null;
            $course->save();
            return back()->with('success', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }

    public function delete(Request $req)
    {
        $course = TransCourses::where('id', (int)$req->id)->first();
        if ($course) {
            $course->delete();
            return back()->with('deleted', ['message' => 'data berhasil dihapus!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}
