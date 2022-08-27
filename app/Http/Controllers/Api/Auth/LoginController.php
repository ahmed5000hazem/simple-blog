<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// response traits
use App\Traits\Responses\SuccessResponse;
use App\Traits\Responses\ErrorResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use SuccessResponse, ErrorResponse;
    public function login(Request $request)
    {
        $creds = $request->only("email", "password");

        $validator = Validator::make($request->all(), [
            "password" => "required",
            "email" => "required|email"
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($this->ErrorResponse([], $errors->all()), 422);
        }

        // check the creds
        if (!Auth::attempt($creds)) {
            return response()->json($this->ErrorResponse($creds, "oops! either email ot password is wrong."), 422);
        }
        
        // generate auth token
        $token = $request->user()->createToken("AUTH-TOKEN");

        $data = [
            "AUTH_TOKEN" => $token->plainTextToken
        ];

        return response()->json($this->SuccessResponse($data, "registerd successfuly"), 200);

    }
}
