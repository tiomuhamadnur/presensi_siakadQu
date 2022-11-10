<?php

namespace App\Http\Controllers\Admin\Course\Student;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $req)
    {
        $transCourse = TransCourses::where('course_id', $req->course_id)
            ->join('users', 'users.id', 'trans_courses.student_id')
            ->where('users.deleted_at', null)
            ->with(['course', 'student', 'present'])->paginate(50);
        $studentIds = [];
        foreach ($transCourse as $item) {
            $studentIds[] = $item->student_id;
        }
        $tblCourse = TblCourses::find($req->course_id);
        $students = [];
        if ($tblCourse) {
            $students = User::where('role', self::ROLE_STUDENT)->whereNotIn('id', $studentIds)->where('class_id', $tblCourse->class_id)->get();
        }
        $classes = TblClasses::all();
        return view('admin.courses.students.student', ['transCourse' => $transCourse, 'class_id' => $tblCourse->class_id, 'classes' => $classes, 'students' => $students, 'course' => $tblCourse, 'course_id' => $req->course_id]);
    }

    public function syncStudentClass(Request $req)
    {
        $students = User::where('role', self::ROLE_STUDENT)->where('class_id', $req->class_id)->get();
        $transCourses = TransCourses::where('class_id', $req->class_id)->where('course_id', $req->course_id)->get();
        foreach ($students as $student) {
            $isFounded = false;
            foreach ($transCourses as $course) {
                if ($student->id == $course->student_id) {
                    $isFounded = true;
                }
            }
            if (!$isFounded) {
                $newTransCourse = new TransCourses();
                $newTransCourse->class_id = $req->class_id;
                $newTransCourse->course_id = $req->course_id;
                $newTransCourse->student_id = $student->id;
                $newTransCourse->save();
            }
        }
        return back()->with('message', ['message' => 'sinkronisasi berhasil!']);
    }

    public function store(Request $req)
    {
        $course = new TransCourses();
        $course->class_id = $req->class_id;
        $course->course_id = $req->course_id;
        $course->student_id = $req->student_id;
        $course->save();
        return back()->with('message', ['message' => 'tambah data berhasil!']);
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
            return back()->with('message', ['message' => 'update berhasil!']);
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
