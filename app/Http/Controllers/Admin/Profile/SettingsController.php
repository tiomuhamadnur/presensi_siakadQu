<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.profile.settings', ['profile' => $admin]);
    }

    public function update(Request $req)
    {
        $admin = Auth::user();
        $updateTeacher = User::where('id', $admin->id)->first();
        if ($updateTeacher) {
            $req->name ? $updateTeacher->name = $req->name : null;
            $req->email ? $updateTeacher->email = $req->email : null;
            $req->nip ? $updateTeacher->nip = $req->nip : null;
            $req->phone ? $updateTeacher->phone = $req->phone : null;
            $req->gender ? $updateTeacher->gender = $req->gender : null;
            $req->role ? $updateTeacher->role = $req->role : null;
            $req->nisn ? $updateTeacher->nisn = $req->nisn : null;
            $req->father_name ? $updateTeacher->father_name = $req->father_name : null;
            $req->parent_phone ? $updateTeacher->parent_phone = $req->parent_phone : null;
            $req->address ? $updateTeacher->address = $req->address : null;
            $req->class_id ? $updateTeacher->class_id = $req->class_id : null;
            if ($req->hasFile('photo')) {
                $updateTeacher->photo = $this->uploadFile($req, 'photo', 'user/profile/' . $updateTeacher->id, false);
            }
            $updateTeacher->save();
            return back()->with('message', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}