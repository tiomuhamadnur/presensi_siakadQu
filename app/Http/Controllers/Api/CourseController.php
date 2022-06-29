<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\StudentResource;
use App\Models\TransCourses;
use App\Models\TransSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
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
        $validator = Validator::make($req->all(),[
            'class_id' => 'required',
            'course_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->getMessageBag(), null, 422);
        }
        $date = $req->date;

        $students = TransCourses::where('class_id', $req->class_id)->where('course_id', $req->course_id)->with(['student', 'present' => function($q)use($date) {
            if($date){
                $q->where('on', $date);
            }
        }])->get();
        return $this->sendResponse(StudentResource::collection($students), 'success');
    }
}
