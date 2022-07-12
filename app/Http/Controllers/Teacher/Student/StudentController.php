<?php

namespace App\Http\Controllers\Teacher\Student;

use App\Http\Controllers\Controller;
use App\Models\TblClasses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $req)
    {
        $students = User::where('role', self::ROLE_STUDENT)->with(['class']);
        if($req->class_id) {
            $students->where('class_id', $req->class_id);
        }
        $students = $students->paginate(10);
        $classes = TblClasses::all();
        return view('teacher.students.student', ['students' => $students, 'classes' => $classes]);
    }

    public function store(Request $req)
    {
        $student = new User();
        if ($student) {
            $student->name = $req->name;
            $student->email = $req->email;
            $student->password = Hash::make('123456');
            $student->role = self::ROLE_STUDENT;
            $student->phone = $req->phone;
            $student->gender = $req->gender;
            $student->nisn = $req->nisn;
            $student->father_name = $req->father_name;
            $student->parent_phone = $req->parent_phone;
            $student->address = $req->address;
            $student->class_id = $req->class_id;
            $path = null;
            if ($req->hasFile('photo')) {
                $path = Storage::disk('public')->put('studentfiles/profil', $req->file('photo'));
            }
            $student->photo = $path;
            $student->save();
            return back()->with('message', ['message' => 'tambah data berhasil!']);
        }
    }

    public function update(Request $req)
    {
        $student = User::where('id', $req->id)->first();
        if ($student) {
            $req->name ? $student->name = $req->name : null;
            $req->email ? $student->email = $req->email : null;
            $req->password ? ($student->password = $req->password ? Hash::make($req->password) : null) : null;
            $req->role ? $student->role = self::ROLE_STUDENT : null;
            $req->nip ? $student->nip = $req->nip : null;
            $req->phone ? $student->phone = $req->phone : null;
            $req->gender ? $student->gender = $req->gender : null;
            $req->role ? $student->role = $req->role : null;
            $req->nisn ? $student->nisn = $req->nisn : null;
            $req->father_name ? $student->father_name = $req->father_name : null;
            $req->parent_phone ? $student->parent_phone = $req->parent_phone : null;
            $req->address ? $student->address = $req->address : null;
            $req->class_id ? $student->class_id = $req->class_id : null;
            $path = null;
            if ($req->hasFile('photo')) {
                $path = Storage::disk('public')->put('studentfiles/profil', $req->file('photo'));
            }
            $req->photo ? $student->photo = $path : null;
            $student->save();
            return back()->with('message', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }

    public function delete(Request $req)
    {
        $student = User::where('id', $req->id)->first();
        if ($student) {
            $student->delete();
            return back()->with('deleted', ['message' => 'data berhasil dihapus!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}
