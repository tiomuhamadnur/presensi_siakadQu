<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\TblCourses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', self::ROLE_TEACHER)->with(['classGuiding'])->get();
        $classes = TblClasses::all();
        return view('admin.teachers.teacher', ['teachers' => $teachers, 'classes' => $classes]);
    }

    public function store(Request $req)
    {
        $teacher = new User();
        if ($teacher) {
            $teacher->name = $req->name;
            $teacher->email = $req->email;
            $teacher->password = $req->password ? $req->password : Hash::make('123456');
            $teacher->role = self::ROLE_TEACHER;
            $teacher->phone = $req->phone;
            $teacher->gender = $req->gender;
            $teacher->nisn = $req->nisn;
            $teacher->father_name = $req->father_name;
            $teacher->parent_phone = $req->parent_phone;
            $teacher->address = $req->address;
            $teacher->class_id = $req->class_id;
            $path = null;
            if ($req->hasFile('photo')) {
                $path = Storage::disk('public')->put('teacherfiles/profil', $req->file('photo'));
            }
            $teacher->photo = $path;
            $teacher->save();
            return back()->with('message', ['message' => 'tambah data berhasil!']);
        }
    }

    public function update(Request $req)
    {
        $teacher = User::where('id', $req->id)->first();
        if ($teacher) {
            $req->name ? $teacher->name = $req->name : null;
            $req->email ? $teacher->email = $req->email : null;
            $req->password ? ($teacher->password = $req->password ? Hash::make($req->password) : null) : null;
            $req->role ? $teacher->role = self::ROLE_TEACHER : null;
            $req->nip ? $teacher->nip = $req->nip : null;
            $req->phone ? $teacher->phone = $req->phone : null;
            $req->gender ? $teacher->gender = $req->gender : null;
            $req->role ? $teacher->role = $req->role : null;
            $req->nisn ? $teacher->nisn = $req->nisn : null;
            $req->father_name ? $teacher->father_name = $req->father_name : null;
            $req->parent_phone ? $teacher->parent_phone = $req->parent_phone : null;
            $req->address ? $teacher->address = $req->address : null;
            $req->class_id ? $teacher->class_id = $req->class_id : null;
            $path = null;
            if ($req->hasFile('photo')) {
                $path = Storage::disk('public')->put('teacherfiles/profil', $req->file('photo'));
            }
            $req->photo ? $teacher->photo = $path : null;
            $teacher->save();
            return back()->with('message', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }

    public function delete(Request $req)
    {
        $teacher = User::where('id', $req->id)->first();
        if ($teacher) {
            $teacher->delete();
            return back()->with('deleted', ['message' => 'data berhasil dihapus!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}
