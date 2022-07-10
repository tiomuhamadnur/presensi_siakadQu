<?php

namespace App\Http\Controllers\Teacher\Course\Student;

use App\Http\Controllers\Controller;
use App\Models\TransPresents;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentPresentController extends Controller
{
    public function present(Request $req)
    {
        $present = new TransPresents();
        $present->student_id = $req->student_id;
        $present->trans_course_id = $req->trans_course_id;
        $present->status = $req->status; //[0=>absen, 1=>hadir, 2=>sakit, 3=>izin]
        $present->description = $req->description;
        $present->on = $req->on;
        $present->save();
        return back()->with('message', ['message' => 'tambah data berhasil!']);
    }

    public function update(Request $req)
    {
        $present = TransPresents::where('id', $req->id)->first();
        if ($present) {
            $req->student_id ? $present->student_id = $req->student_id : null;
            $req->trans_course_id ? $present->trans_course_id = $req->trans_course_id : null;
            $req->status ? $present->status = $req->status : null;
            $req->description ? $present->description = $req->description : null;
            $req->on ? $present->on = $req->on : null;
            $present->save();
            return back()->with('message', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }

    public function delete(Request $req)
    {
        $present = TransPresents::where('id', (int)$req->id)->first();
        if ($present) {
            $present->delete();
            return back()->with('deleted', ['message' => 'data berhasil dihapus!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}
