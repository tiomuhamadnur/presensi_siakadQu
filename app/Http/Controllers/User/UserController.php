<?php

namespace App\Http\Controllers\User\User;

use App\Models\TblUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.user.base_layout.index', ['user' => $user]);
    }
    
    public function update(Request $req)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($user) {
            $req->name ? $user->name = $req->name : null;
            $req->email ? $user->email = $req->email : null;
            $req->password ? $user->password = Hash::make($req->password) : null;
            $user->save();
            return back()->with('success', ['message' => 'update berhasil!']);
        }
        return back()->with('404', ['message' => 'data tidak ditemuka!']);
    }
}
