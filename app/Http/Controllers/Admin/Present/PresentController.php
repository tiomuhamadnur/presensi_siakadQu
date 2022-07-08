<?php

namespace App\Http\Controllers\Admin\Present;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\User;
use Illuminate\Http\Request;

class PresentController extends Controller
{
    public function index(Request $req)
    {
        $courses = TblCourses::with(['teacher', 'class', 'transCourses.student']);
        $teachers = User::where('role', self::ROLE_TEACHER)->get();
        $classes = TblClasses::all();
        $teacher = null;
        if ($req->teacher_id) {
            $teacher = User::where('id', $req->teacher_id)->where('role', self::ROLE_TEACHER)->first();
            $courses->where('teacher_id', $req->teacher_id);
        }
        $courses = $courses->paginate(10);
        return view('admin.present.present', ['courses' => $courses, 'teachers' => $teachers, 'classes' => $classes, 'teacher' => $teacher]);
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
