<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\StudentResource;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\TransPresents;
use App\Models\TransSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use Utils;
    public function index(Request $req)
    {
        $courses = TransSchedule::with(['teacher', 'class.teacherGuider', 'course.transCourses'])->where('teacher_id', Auth::user()->id);
        if ($req->day) {
            $dayNumber = $this->getDayNumber($req->day);
            $courses->where('schedule', $dayNumber);
        }
        if ($req->time) {
            $courses->where('time', $req->time);
        }
        $courses = $courses->paginate(20);
        return $this->sendResponse(CourseResource::collection($courses), 'berhasil mengambil data course');
    }

    public function getDayNumber($plain)
    {
        switch (strtolower($plain)) {
            case 'selasa':
                $dayNumber = 2;
                break;
            case 'rabu':
                $dayNumber = 3;
                break;
            case 'kamis':
                $dayNumber = 4;
                break;
            case 'jumat':
                $dayNumber = 5;
                break;
            case 'sabtu':
                $dayNumber = 6;
                break;
            case 'minggu':
                $dayNumber = 7;
                break;
            default:
                $dayNumber = 1;
        }
        return $dayNumber;
    }

    public function presentByClass(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'class_id' => 'required',
            'course_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->getMessageBag(), null, 422);
        }

        $schedule = Carbon::now()->toDateString();

        $on = Carbon::now()->toDateString();
        if ($req->schedule) {
            $on = $req->schedule;
            $schedule = $req->schedule;
        }
        $tblCourse = TblCourses::find($req->course_id);
        $students = TransCourses::where('trans_courses.class_id', $req->class_id)
            ->where('course_id', $req->course_id)->with(['student', 'course', 'present' => function ($q) use ($on) {
                if ($on) {
                    $q->whereDate('on', '=', $on);
                }
            }]);
        $students = $students->get();
        return $this->sendResponse(StudentResource::collection($students), 'success');
    }

    public function presentHistory(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'trans_course_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->getMessageBag(), null, 422);
        }
        $transPresents = TransPresents::where('trans_course_id', $req->trans_course_id)
            ->with(['transCourse.student', 'transCourse.course'])->get();
        return $this->sendResponse($transPresents, 'success');
    }

    public function doPresent(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'ids' => 'required|array',
            'status' => 'required',
            'schedule' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->getMessageBag(), null, 422);
        }

        $text = 'Assalamualaikum Bpk/i, ananda ';
        $time = Carbon::now()->today();
        foreach ($req->ids as $transCourseId) {
            $transPresent = TransPresents::where('trans_course_id', $transCourseId)->with(['transCourse.student'])->first();
            if (!$transPresent) {
                $transPresent = new TransPresents();
            }

            $transPresent->trans_course_id = $transCourseId;
            $transPresent->status = $req->status;
            $transPresent->description = $this->getDescPresent($req->status);
            $transPresent->on = $req->schedule;
            $transPresent->save();

            $student = $transPresent->transCourse->student;
            $this->sendWa("$text $student->name pada hari ini $time" .  $this->getDescPresent($req->status). "\nKeterangan: $transPresent->description", $student->phone);
        }
        return $this->sendResponse(null, 'success ');
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
}
