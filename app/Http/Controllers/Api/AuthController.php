<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

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
                if ($user->role == 'guru') {
                    $token = $user->createToken('auth_token')->plainTextToken;
                    return $this->sendResponse([
                        'access_token' => [
                            'token_type' => 'Bearer',
                            'token' => $token
                        ],
                        'user' => $user
                    ], 'login berhasil');
                } else {
                    return $this->sendError("login gagal", "role bukan guru!!!", 401);
                }
            }
        }
        return $this->sendError("login gagal", "Pengguna tidak dapat ditemuka!!!", 401);
    }

    public function doRegister(Request $req)
    {
        $newUser = new User();
        $newUser->name = $req->name;
        $newUser->email = $req->email;
        $newUser->password = Hash::make($req->password);
        $newUser->phone = $req->phone;
        $newUser->role = 'guru';
        $newUser->save();

        $token = $newUser->createToken('MyApp')->plainTextToken;
        return $this->sendResponse([
            'access_token' => [
                'token_type' => 'Bearer',
                'token' => $token
            ],
            'user' => $newUser
        ], 'login berhasil');
    }
}
