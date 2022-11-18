<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransPresents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $countStudent = User::where('role', self::ROLE_STUDENT)->count();
        $present = TransPresents::where('status', 1)->count();
        $absen = TransPresents::where('status', 0)->count();
        $leave = TransPresents::where('status', 2)->count();
        $sick = TransPresents::where('status', 3)->count();
        $allRow = TransPresents::count();

        if ($allRow == 0) {
            $allRow = 1;
        }

        $countPresent = round(($present / $allRow) * 100, 2);
        $countAbsen = round(($absen / $allRow) * 100, 2);
        $countLeave = round(($leave / $allRow) * 100, 2);
        $countSick = round(($sick / $allRow) * 100, 2);
        return view('admin.dashboard.dashboard', ['countStudent' => $countStudent, 'countPresent' => $countPresent, 'countAbsen' => $countAbsen, 'countLeave' => $countLeave, 'countSick' => $countSick]);
    }

    public function doLogin(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                Auth::attempt($user);
                if ($user->role == 'admin') {
                    return route('admin');
                }
                return route('user');
            }
        }
        return back()->with('401', 'Login Gagal, email atau password salah!');
    }
}