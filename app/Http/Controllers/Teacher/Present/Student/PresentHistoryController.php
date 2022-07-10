<?php

namespace App\Http\Controllers\Teacher\Present\Student;

use App\Http\Controllers\Controller;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\TransPresents;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresentHistoryController extends Controller
{
    public function index(Request $req)
    {
        $schedule = Carbon::now()->toDateString();
        if ($req->schedule) {
            $schedule = $req->schedule;
        }
        $transPresents = TransPresents::where('trans_course_id', $req->trans_course_id)
            ->with(['transCourse.student', 'transCourse.course'])->get();
        return view('teacher.present.present_by_class.present_history', [
            'transPresents' => $transPresents, 'trans_course_id' => $req->trans_course_id
        ]);
    }

    public function doPresent(Request $req)
    {
        foreach ($req->ids as $transCourseId) {
            $transPresent = TransPresents::where('trans_course_id', $transCourseId)->first();
            if (!$transPresent) {
                $transPresent = new TransPresents();
            }

            $transPresent->trans_course_id = $transCourseId;
            $transPresent->status = $req->status;
            $transPresent->description = $this->getDescPresent($req->status);
            $transPresent->on = $req->schedule;
            $transPresent->save();
        }
        return back()->with('message', ['message' => 'presensi berhasil!']);
    }

    public function updatePresent(Request $req)
    {
        $transPresent = TransPresents::find($req->id);
        if($transPresent) {
            $transPresent->description = $req->description;
            $transPresent->save();
            return back()->with('message', ['message' => 'update deskripsi presensi berhasil!']);
        }
        return back()->with('message', ['message' => 'presensi tidak ditemukan!']);
    }

    public function getDescPresent($status)
    {
        $desc = null;
        switch ($status) {
            case 1:
                $desc = 'hadir';
                break;
            case 0:
                $desc = 'tidak hadir';
                break;
            case 2:
                $desc = 'sakit';
                break;
            default:
                $desc = 'izin';
        }
        return $desc;
    }

    public function presentCheck($req, $on)
    {
        $transCourse = TransCourses::where('trans_courses.class_id', $req->class_id)
            ->where('course_id', $req->course_id)->with(['student', 'course', 'present' => function ($q) use ($on) {
                if ($on) {
                    $q->whereDate('on', '=', $on);
                }
            }]);
        $transCourse = $transCourse->get();
        return $transCourse;
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
