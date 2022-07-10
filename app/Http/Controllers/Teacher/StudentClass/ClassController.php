<?php

namespace App\Http\Controllers\Teacher\StudentClass;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = TblClasses::with(['students', 'teacherGuider'])->paginate();
        $teachers = User::where('role', self::ROLE_TEACHER)->get();
        return view('teacher.classes.class', ['classes' => $classes, 'teachers' => $teachers]);
    }

    public function store(Request $req)
    {
        $class = new TblClasses();
        if ($class) {
            $class->code = $req->code;
            $class->name = $req->name;
            $class->teacher_guider_id = $req->teacher_guider_id;
            $class->save();
            return back()->with('message', ['message' => 'tambah data berhasil!']);
        }
    }

    public function update(Request $req)
    {
        $class = TblClasses::where('id', $req->id)->first();
        if ($class) {
            $req->code ? $class->code = $req->code : null;
            $req->name ? $class->name = $req->name : null;
            $req->teacher_guider_id ? $class->teacher_guider_id = $req->teacher_guider_id : null;
            $class->save();
            return back()->with('message', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }

    public function delete(Request $req)
    {
        $class = TblClasses::where('id', $req->id)->first();
        if ($class) {
            $class->delete();
            return back()->with('deleted', ['message' => 'data berhasil dihapus!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}
