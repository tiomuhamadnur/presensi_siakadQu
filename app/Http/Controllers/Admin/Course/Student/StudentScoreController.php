<?php

namespace App\Http\Controllers\Admin\Course\Student;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\User;
use Illuminate\Http\Request;

class StudentScoreController extends Controller
{
    public function index(Request $req)
    {
        $courses = TblCourses::with(['teacher', 'class', 'transCourses.student']);
        $teachers = User::where('role', self::ROLE_TEACHER)->get();
        $classes = TblClasses::all();
        $teacher = null;
        $class_id = null;
        if ($req->teacher_id) {
            $teacher = User::where('id', $req->teacher_id)->where('role', self::ROLE_TEACHER)->first();
            $courses->where('teacher_id', $req->teacher_id);
        }
        if ($req->class_id) {
            $class_id = $req->class_id;
            $courses->where('class_id', $req->class_id);
        }
        $courses = $courses->paginate(50);
        return view('admin.courses.student.score', ['courses' => $courses, 'teachers' => $teachers, 'class_id' => $class_id, 'classes' => $classes, 'teacher' => $teacher]);
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
            $req->name ? $course->name = $req->name : null;
            $req->teacher_id ? $course->teacher_id = $req->teacher_id : null;
            $req->class_id ? $course->class_id = $req->class_id : null;
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
