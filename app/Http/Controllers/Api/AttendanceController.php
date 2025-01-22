<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function checkIn(Request $request) {}
    public function checkOut(Request $request) {}
    public function breakStart(Request $request) {}
    public function breakEnd(Request $request) {}
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id',
            'checkin' => 'nullable|date_format:H:i',
            'checkout' => 'nullable|date_format:H:i',
            'break_start' => 'nullable|date_format:H:i',
            'break_end' => 'nullable|date_format:H:i',
            'ip_address' => 'nullable|ip',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 400);
        }

        $date = $request->date ?? Carbon::now()->toDateString();
        $checkin = $request->checkin ?? Carbon::now()->format('H:i');
        $checkout = $request->checkout ?? Carbon::now()->format('H:i');

        // Calculate worked hours (time between checkin and checkout)
        $checkinTime = Carbon::parse($checkin);
        $checkoutTime = Carbon::parse($checkout);

        // Calculate total worked hours in minutes and convert it to hours
        $workedHours = $checkoutTime->diffInMinutes($checkinTime);
        $workedHours = $workedHours / 60;  // Convert minutes to hours

        try {
            $attendance = Attendance::create([
                'user_id' => $request->user()->id,
                'date' => $date,
                'type' => $request->type ?? NULL,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'worked_hours' => $workedHours,
                'ip_address' => $request->ip_address ?? NULL,
                'latitude' => $request->latitude ?? NULL,
                'longitude' => $request->longitude ?? NULL,
                'device' => $request->device ?? 'Android',
                'attendance_by' => 'Self',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Attendance created successfully.',
                'data' => $attendance,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create attendance.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
