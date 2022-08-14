<?php

namespace App\Http\Controllers\Teacher\Present;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentController extends Controller
{
    public $tblClass;
    public function __construct()
    {
        $this->tblClass = new TblClasses();
    }

    public function index(Request $req)
    {
        $courses = TblCourses::with(['teacher', 'class', 'transCourses.student'])
            ->where('teacher_id', Auth::user()->id)->paginate(50);
        return view('teacher.present.present', ['courses' => $courses]);
    }

    public function getDayString($dayInt)
    {
        switch (strtolower($dayInt)) {
            case 2:
                $dayString = 'selasa';
                break;
            case 3:
                $dayString = 'rabu';
                break;
            case 4:
                $dayString = 'kamis';
                break;
            case 5:
                $dayString = 'jumat';
                break;
            case 6:
                $dayString = 'sabtu';
                break;
            case 7:
                $dayString = 'minggu';
                break;
            default:
                $dayString = 'senin';
        }
        return $dayString;
    }

    public function store(Request $req)
    {
        $course = new TblCourses();
        $course->name = $req->name;
        $course->teacher_id = $req->teacher_id;
        $course->class_id = $req->class_id;
        $course->save();
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
