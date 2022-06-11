<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboard');
    }

    public function doLogin(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if($user) {
            if(Hash::check($req->password, $user->password)) {
                Auth::attempt($user);
                if($user->role == 'admin') {
                    return route('admin');
                }
                return route('user');
            }
        }
        return back()->with('401', 'Login Gagal, email atau password salah!');
    }
}