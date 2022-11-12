<?php

namespace App\Http\Controllers\Teacher\Course\Student;

use App\Http\Controllers\Controller;
use App\Models\MasterScoring;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\TransScore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $req)
    {
        $transCourse = TransCourses::where('course_id', $req->course_id)->with(['course', 'student', 'presents', 'transScores'])->paginate(50);
        $studentIds = [];
        foreach ($transCourse as $item) {
            $studentIds[] = $item->student_id;
        }
        $tblCourse = TblCourses::where('id', $req->course_id)->with(['class'])->first();
        $isEditor = true;
        $students = [];
        $class = null;
        $userId = Auth::user()->id;
        if ($tblCourse) {
            $class = $tblCourse->class;
            if ($tblCourse->class->teacher_guider_id == $userId && $tblCourse->teacher_id != $userId) {
                $isEditor = false;
            }
            $students = User::where('role', self::ROLE_STUDENT)->whereNotIn('id', $studentIds)->where('class_id', $tblCourse->class_id)->get();
        }
        $classes = TblClasses::all();
        return view('teacher.courses.students.student', ['class' => $class, 'class_id' => $tblCourse->class_id, 'is_editor' => $isEditor, 'course_id' => $req->course_id, 'transCourse' => $transCourse, 'classes' => $classes, 'students' => $students, 'course' => $tblCourse]);
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

    public function syncStudentClass(Request $req)
    {
        $students = User::where('role', self::ROLE_STUDENT)->where('class_id', $req->class_id)->get();
        $transCourses = TransCourses::where('class_id', $req->class_id)->where('course_id', $req->course_id)->with(['transScores'])->get();
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
        $this->syncMasterScore($transCourses, $req->course_id);

        return back()->with('message', ['message' => 'sinkronisasi berhasil!']);
    }

    public function syncMasterScore($transCourses, $courseId)
    {
        $masterScores = MasterScoring::where('tbl_course_id', $courseId)->get();
        $transScoresNumbers = [];
        foreach ($transCourses as $transCourse) {
            foreach ($transCourse->transScores as $transScore) {
                $transScoresNumbers[] = $transScore->number;
                foreach ($masterScores as $masterScore) {
                    if ((int)$masterScore->number == (int)$transScore->number) {
                        $transScore->name = $masterScore->name;
                        $transScore->percent = $masterScore->percent;
                        $transScore->description = $masterScore->description;
                        $transScore->save();
                    }
                }
            }
            $masterScoresWithTrans = MasterScoring::where('tbl_course_id', $courseId)->whereNotIn('number', $transScoresNumbers)->get();
            foreach ($masterScoresWithTrans as $masterScore) {
                $newTransScore = new TransScore();
                $newTransScore->number = $masterScore->number;
                $newTransScore->name = $masterScore->name;
                $newTransScore->trans_course_id = $transCourse->id;
                $newTransScore->percent = $masterScore->percent;
                $newTransScore->description = $masterScore->description;
                $newTransScore->save();
            }
        }
        return MasterScoring::where('tbl_course_id', $courseId)->whereNotIn('number', $transScoresNumbers)->get();
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
