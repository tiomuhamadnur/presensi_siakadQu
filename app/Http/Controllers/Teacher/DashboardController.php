<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TransPresents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $countPresent = ($present / $allRow) * 100;
        $countAbsen = ($absen / $allRow) * 100;
        $countLeave =($leave / $allRow) * 100;
        $countSick = ($sick / $allRow) * 100;
        return view('teacher.dashboard.dashboard', ['countStudent' => $countStudent, 'countPresent' => $countPresent, 'countAbsen' => $countAbsen, 'countLeave' => $countLeave, 'countSick' => $countSick]);
    }

}