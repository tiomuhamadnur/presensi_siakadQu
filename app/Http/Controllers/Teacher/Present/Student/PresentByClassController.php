<?php

namespace App\Http\Controllers\Teacher\Present\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\TransPresents;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresentByClassController extends Controller
{
    use Utils;

    public function index(Request $req)
    {
        $schedule = Carbon::now()->toDateString();

        $on = Carbon::now()->toDateString();
        if ($req->schedule) {
            $on = $req->schedule;
            $schedule = $req->schedule;
        }
        $tblCourse = TblCourses::find($req->course_id);
        $transCourse = $this->presentCheck($req, $on);
        return view('teacher.present.present_by_class.present_by_class', [
            'transCourse' => $transCourse, 'course' => $tblCourse, 'schedule' => $schedule, 'course_id' => $req->course_id, 'class_id' => $req->class_id
        ]);
    }

    public function doPresent(Request $req)
    {
        $text = 'Assalamualaikum Bpk/i, ananda ';
        $time = Carbon::now()->isoFormat('dddd, H:i:s D MMMM Y');
        $ids = $req->ids;
        $transPresents = TransPresents::whereIn('trans_course_id', $ids)->get();
        if (count($transPresents) > 0) {
            foreach ($transPresents as $transPresent) {
                $transCourseId = $transPresent->trans_course_id;
                $date = Carbon::parse($transPresent->on)->toDateString();
                $dateOn = Carbon::parse($req->schedule)->toDateString();
                if ($date != $dateOn) {
                    $transPresent = new TransPresents();
                    $transPresent->trans_course_id = $transCourseId;
                    $transPresent->status = $req->status;
                    $transPresent->description = $this->getDescPresent($req->status);
                    $transPresent->on = $req->schedule;
                    $transPresent->save();
                } else {
                    $transPresent->trans_course_id = $transCourseId;
                    $transPresent->status = $req->status;
                    $transPresent->description = $this->getDescPresent($req->status);
                    $transPresent->on = $req->schedule;
                    $transPresent->save();
                }

                $student = $transPresent->transCourse->student;
                $this->sendWa("$text $student->name pada hari ini $time " .  $this->getDescPresent($req->status) . "\nKeterangan: $transPresent->description", $student->phone);
            }
        } else {
            $transCourses = TransCourses::whereIn('id', $req->ids)->get();
            foreach ($transCourses as $transCourse) {
                $transPresent = new TransPresents();
                $transPresent->trans_course_id = $transCourse->id;
                $transPresent->status = $req->status;
                $transPresent->description = $this->getDescPresent($req->status);
                $transPresent->on = $req->schedule;
                $transPresent->save();
            }
        }
        return back()->with('message', ['message' => 'presensi berhasil!']);
    }

    public function updatePresent(Request $req)
    {
        $transPresent = TransPresents::find($req->id);
        if ($transPresent) {
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
            ->join('users', 'users.id', 'trans_courses.student_id')
            ->where('users.deleted_at', null)
            ->where('course_id', $req->course_id)
            ->with(['student', 'course', 'present' => function ($q) use ($on) {
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
