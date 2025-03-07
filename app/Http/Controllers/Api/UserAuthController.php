<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendOTPToEmployee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Support\Facades\Mail;

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
            'expo_token' => 'nullable|string',
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

        // Check if user status is active
        if ($user->status !== 'Active') {
            $message = 'Your account is ' . strtolower($user->status) . '. Please contact the administrator for further assistance.';
            return $this->respondWithError($message, [], 403);
        }

        // Update expo_token only if provided and different
        if ($request->has('expo_token') && $request->expo_token !== $user->expo_token) {
            $user->expo_token = $request->expo_token;
            $user->save();
        }

        $token = $user->createToken('MyAppToken')->plainTextToken;
        $user->profile_name = strtoupper(string: ucfirst($user->first_name[0] ?? '')) . strtoupper(ucfirst($user->last_name[0] ?? ''));

        return $this->respondWithSuccess('Login successful', [
            'access_token' => $token,
            'user' => $user,
        ]);
    }

    public function biometricLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'expo_token' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Validation failed', $validator->errors(), 422);
        }

        $user = User::with(['department', 'branch', 'shift'])->where('email', $request->email)->first();

        if (!$user) {
            return $this->respondWithError('The provided credentials are incorrect.', [
                'email' => ['The provided credentials are incorrect.']
            ], 401);
        }

        // Check if user status is active
        if ($user->status !== 'Active') {
            $message = 'Your account is ' . strtolower($user->status) . '. Please contact the administrator for further assistance.';
            return $this->respondWithError($message, [], 403);
        }

        // Update expo_token only if provided and different
        if ($request->has('expo_token') && $request->expo_token !== $user->expo_token) {
            $user->expo_token = $request->expo_token;
            $user->save();
        }

        $token = $user->createToken('MyAppToken')->plainTextToken;
        $user->profile_name = strtoupper(string: ucfirst($user->first_name[0] ?? '')) . strtoupper(ucfirst($user->last_name[0] ?? ''));

        return $this->respondWithSuccess('Login successful', [
            'access_token' => $token,
            'user' => $user,
        ]);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Validation failed', $validator->errors(), 422);
        }

        $user = $request->user(); // Assuming you are using Sanctum or similar for authentication

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return $this->respondWithError('Current password is incorrect.', [
                'current_password' => ['The current password is incorrect.']
            ], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return $this->respondWithSuccess('Password changed successfully');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $request->user();

        if ($request->hasFile('image')) {
            if ($user->image) {
                $this->removeFile($user->image);
            }

            $user->image = $this->fileUpload($request, 'image');
        }

        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'user' => $user,
        ]);
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/uploads/employee';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }


    public function removeFile($file)
    {
        if ($file) {
            $filePath = str_replace(asset(''), '', $file);

            if ($filePath === 'assets/images/profile.jpg') {
                return;
            }

            $path = public_path($filePath);

            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }

    public function forgotPasswordOtp(Request $request)
    {
        $user = User::where('email', $request->email)->where('user_type', 'Employee')->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => 'Email Not Found',
            ], 422);
        }

        $otp = rand(10000, 99999);
        $user->update(['otp' => $otp]);

        //send mail to employee
        Mail::to($request->email ?? "")->send(
            new SendOTPToEmployee($user)
        );

        return response()->json([
            'success' => true,
            'message' => 'OTP has been sent to your mail',
        ]);
    }

    public function forgotPasswordCheckOtp(Request $request)
    {
        $user = User::where('email', $request->email)->where('otp', $request->otp)->where('user_type', 'Employee')->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid OTP',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP Matched',
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Validation failed', $validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->where('otp', $request->otp)->where('user_type', 'Employee')->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid Data',
            ], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->otp = null;
        $user->save();

        return $this->respondWithSuccess('Password reset successfully');
    }
}
