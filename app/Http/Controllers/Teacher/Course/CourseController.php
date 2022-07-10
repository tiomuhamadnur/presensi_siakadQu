<?php

namespace App\Http\Controllers\Teacher\Course;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $req)
    {
        $courses = TblCourses::with(['teacher', 'class', 'transCourses.student'])->where('teacher_id', Auth::user()->id);
        $teachers = User::where('role', self::ROLE_TEACHER)->get();
        $classes = TblClasses::all();
        $teacher = null;
        if ($req->teacher_id) {
            $teacher = User::where('id', $req->teacher_id)->where('role', self::ROLE_TEACHER)->first();
            $courses->where('teacher_id', $req->teacher_id);
        }
        if ($req->class_id) {
            $courses->where('class_id', $req->class_id);
        }
        $courses = $courses->paginate(10);
        return view('teacher.courses.course', ['courses' => $courses, 'teachers' => $teachers, 'classes' => $classes, 'teacher' => $teacher]);
    }

    public function store(Request $req)
    {
        $course = new TblCourses();
        $course->name = $req->name;
        $course->teacher_id = $req->teacher_id;
        $course->class_id = $req->class_id;
        $course->save();
        $students = User::where('class_id', $req->class_id)->where('role', self::ROLE_STUDENT)->get();
        foreach($students as $student) {
            $transCourse = new TransCourses();
            $transCourse->class_id = $req->class_id;
            $transCourse->course_id = $course->id;
            $transCourse->student_id = $student->id;
            $transCourse->save();
        }
        return back()->with('message', ['message' => 'tambah data berhasil!']);
    }

    public function update(Request $req)
    {
        $course = TblCourses::where('id', $req->id)->first();
        if ($course) {
            $req->id ? $course = $req->id : null;
            $req->name ? $course = $req->name : null;
            $req->teacher_id ? $course = $req->teacher_id : null;
            $req->class_id ? $course = $req->class_id : null;
            $course->save();
            return back()->with('message', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }

    public function delete(Request $req)
    {
        $course = TblCourses::where('id', $req->id)->first();
        if ($course) {
            $course->delete();
            return back()->with('deleted', ['message' => 'data berhasil dihapus!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}
