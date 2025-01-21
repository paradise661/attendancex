<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    /**
     * Return a standardized success response
     */
    private function respondWithSuccess($message, $data = [])
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     * Return a standardized error response
     */
    private function respondWithError($message, $errors = [], $statusCode = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Validation failed', $validator->errors(), 422);
        }

        $user = User::with(['department', 'branch', 'shift'])->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->respondWithError('The provided credentials are incorrect.', [
                'email' => ['The provided credentials are incorrect.']
            ], 401);
        }

        $token = $user->createToken('MyAppToken')->plainTextToken;

        return $this->respondWithSuccess('Login successful', [
            'access_token' => $token,
            'user' => $user,
        ]);
    }
}
