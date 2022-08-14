<?php

namespace App\Http\Controllers\Teacher\Course\Student;

use App\Http\Controllers\Controller;
use App\Models\TransScore;
use Illuminate\Http\Request;

class StudentScoreController extends Controller
{
    public function index(Request $req)
    {
        $transScore = TransScore::where('trans_course_id', $req->id)->with(['transCourse.class', 'transCourse.course'])->first();
        $transScores = TransScore::where('trans_course_id', $req->id)->get();
        return view('teacher.courses.students.student_score', ['transScores' => $transScores, 'transScore' => $transScore]);
    }

    public function update(Request $req)
    {
        $transScore = TransScore::find($req->id);
        if($transScore) {
            $transScore->score = $req->score;
            $transScore->save();
            return back()->with('message', ['message' => 'update Skor berhasil!']);
        }
        return back()->with('message', ['message' => 'not found!']);
    }
}
