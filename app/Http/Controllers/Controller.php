<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const ROLE_STUDENT = 'siswa';
    const ROLE_ADMIN = 'admin';
    const ROLE_TEACHER = 'guru';

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'message' => $message,
            'data'    => $result
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
            'data' => null
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function uploadFile(Request $req, $reqName, $path, $isLoop = false)
    {
        $file = null;
        if($isLoop) {
            $file = $reqName;
        } else {
            $file = $req->file($reqName);
        }
        
        $filename = date('YmdHi');
        $file->move(public_path($path), $filename);
        return "$path/$filename";
    }
}
