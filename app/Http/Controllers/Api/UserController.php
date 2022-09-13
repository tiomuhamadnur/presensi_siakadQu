<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProfileResource;
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
        return $this->sendResponse(new ProfileResource($tblUser), 'berhasil mengambil data user');
    }

    public function update(Request $req)
    {
        $user = Auth::user();
        $tblUser = User::where('id', $user->id)->with(['classGuidings'])->first();
        if(!$tblUser) return $this->sendError('user tidak dapat detemukan!', null, 400);
        $req->name ? $tblUser->name = $req->name : null;
        $req->email ? $tblUser->email = $req->email : null;
        $req->nip ? $tblUser->nip = $req->nip : null;
        $req->phone ? $tblUser->phone = $req->phone : null;
        $req->address ? $tblUser->address = $req->address : null;
        if($req->hasFile('photo')) $tblUser->photo = $this->uploadFile($req, 'photo', 'user/profile' . $tblUser->id);
        $tblUser->save() ;
        return $this->sendResponse(new ProfileResource($tblUser), 'berhasil mengambil data user');
    }
}
