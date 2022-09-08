<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tblUser = User::where('id', $user->id)->with(['classGuidings'])->first();
        return $this->sendResponse($tblUser, 'berhasil mengambil data user');
    }
}
