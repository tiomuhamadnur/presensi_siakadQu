<?php

namespace App\Http\Controllers\Teacher\StudentClass;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = TblClasses::with(['students', 'teacherGuider'])->paginate();
        return view('admin.classes.class', ['classes' => $classes, 'classes' => $classes]);
    }

    public function store(Request $req)
    {
        $class = new TblClasses();
        if ($class) {
            $class->code = $req->code;
            $class->name = $req->name;
            $class->teacher_guider_id = $req->teacher_guider_id;
            $class->save();
            return back()->with('success', 'tambah data berhasil!');
        }
    }

    public function update(Request $req)
    {
        $class = TblClasses::where('id', $req->id)->first();
        if ($class) {
            $req ? $class->code = $req->code : null;
            $req ? $class->name = $req->name : null;
            $req ? $class->teacher_guider_id = $req->teacher_guider_id : null;
            $class->save();
            return back()->with('success', ['message' => 'update berhasil!']);
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
