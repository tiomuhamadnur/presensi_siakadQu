<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->redirectTo = url()->previous();
    }
    public function login()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        session(['url.intended' => route('admin.dashboard')]);
        return redirect()->route('login');
    }

    public function doLogin(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                Auth::attempt(['email' => $req->email, 'password' => $req->password]);
                if ($user->role == 'admin') {
                    // return redirect(session('url')['intended']);
                    return redirect()->route('admin.dashboard');
                } elseif($user->role == 'guru') {
                    return redirect()->route('teacher.dashboard');
                } else {
                    return back()->with('unauthorized', ['message' => 'anda tidak punya akses masuk!']);
                }
            }
        }
        return back()->with('unauthorized', ['message' => 'email atau password yang dimasukan salah!']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $req)
    {
        $newUser = new User();
        $newUser->name = $req->name;
        $newUser->email = $req->email;
        $newUser->password = Hash::make($req->password);
        $newUser->phone = $req->phone;
        $newUser->role = 'admin';
        $newUser->save();

        return redirect()->route('login')->with('message', 'pendaftaran berhasil!');
    }
}
