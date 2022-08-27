<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// response traits
use App\Traits\Responses\SuccessResponse;
use App\Traits\Responses\ErrorResponse;

class RegisterController extends Controller
{
    use SuccessResponse, ErrorResponse;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "nullable|string",
            "password" => "required|confirmed",
            "email" => "required|email|unique:users,email"
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($this->ErrorResponse([], $errors->all()), 422);
        }

        $user = User::create([
            "name" => $request->name,
            "password" => bcrypt($request->password),
            "email" => $request->email,
        ]);

        return response()->json($this->SuccessResponse($user, "registerd successfuly"), 200);
    }
}
