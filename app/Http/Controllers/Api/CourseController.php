<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\StudentResource;
use App\Models\TblCourses;
use App\Models\TransCourses;
use App\Models\TransPresents;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use Utils;
    public function index(Request $req)
    {
        $courses = TblCourses::where('teacher_id', Auth::user()->id)->with(['class.teacherGuider', 'transCourses'])->paginate(20);
        return CourseResource::collection($courses);
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

        if ($req->on) {
            $on = $req->on;
        } else {
            $on = Carbon::now()->toDateString();
        }
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
        $transPresents = TransPresents::where('trans_course_id', $req->trans_course_id);
        $req->on ?  $transPresents->where('on', $req->on) : null;
        $transPresents = $transPresents->with(['transCourse.student', 'transCourse.course'])->get();
        return $this->sendResponse($transPresents, 'success');
    }

    public function presentHistoryCourse(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'course_id' => 'required',
            'on' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->getMessageBag(), null, 422);
        }
        $on = $req->on;
        $courses = TblCourses::where('id', $req->course_id)->with(['transCourses.student', 'transCourses.present' => function ($q) use ($on) {
            $q->where('on', $on);
        }])->get();
        return $this->sendResponse($courses, 'success');
    }

    public function doPresent(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'ids' => 'required|array',
            'status' => 'required|array',
            'on' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->getMessageBag(), null, 422);
        }

        $text = 'Assalamualaikum Bpk/i, ananda ';
        $time = Carbon::now()->isoFormat('dddd, H:i:s D MMMM Y');
        $ids = $req->ids;
        $idsString = null;
        foreach ($ids as $key => $id) {
            if ($key == 0) {
                $idsString = "$id";
            } else {
                $idsString = $idsString . ",$id";
            }
        }
        $transPresents = TransPresents::whereIn('trans_course_id', $ids)
            ->orderByRaw('FIELD (trans_course_id, ' . implode(', ', $ids) . ') ASC')->get();
        if (count($transPresents) > 0) {
            foreach ($transPresents as $key => $transPresent) {
                $transCourseId = $transPresent->trans_course_id;
                $date = Carbon::parse($transPresent->on)->toDateString();
                $dateOn = Carbon::parse($req->on)->toDateString();
                if ($date != $dateOn) {
                    $transPresent = new TransPresents();
                    $transPresent->trans_course_id = $transCourseId;
                    $transPresent->status = $req->status[$key];
                    $transPresent->description = $this->getDescPresent($req->status[$key]);
                    $transPresent->on = $req->on;
                    $transPresent->save();
                } else {
                    $transPresent->trans_course_id = $transCourseId;
                    $transPresent->status = $req->status[$key];
                    $transPresent->description = $this->getDescPresent($req->status[$key]);
                    $transPresent->on = $req->on;
                    $transPresent->save();
                }

                $student = $transPresent->transCourse->student;
                $this->sendWa("$text $student->name pada hari ini $time " .  $this->getDescPresent($req->status[$key]) . "\nKeterangan: $transPresent->description", $student->phone);
            }
        } else {
            $transCourses = TransCourses::whereIn('id', $req->ids)->get();
            foreach ($transCourses as $key => $transCourse) {
                $transPresent = new TransPresents();
                $transPresent->trans_course_id = $transCourse->id;
                $transPresent->status = $req->status[$key];
                $transPresent->description = $this->getDescPresent($req->status[$key]);
                $transPresent->on = $req->on;
                $transPresent->save();
            }
        }
        return $this->sendResponse(null, 'success ');
    }
}
