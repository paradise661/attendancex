<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;


class AttendanceController extends Controller
{
    // Check-In Method
    public function checkIn(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'latitude' => 'nullable|string',
                'longitude' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Get the current date
            $currentDate = now()->format('Y-m-d');

            // Check if the user has already checked in today
            $existingAttendance = Attendance::where('user_id', $request->user()->id)
                ->where('date', $currentDate)
                ->first();

            if ($existingAttendance) {
                return response()->json([
                    'message' => 'You have already checked in today.',
                ], 400);
            }

            $attendance = Attendance::create([
                'user_id' => $request->user()->id,
                'date' => $currentDate,
                'type' => $request->type ?? NULL,
                'checkin' => now()->format('H:i:s'),
                'ip_address' => $request->ip(),
                'latitude' => $request->latitude ?? NULL,
                'longitude' => $request->longitude ?? NULL,
                'device' => $request->device ?? 'Andriod',
                'attendance_by' => 'Self',
            ]);

            return response()->json([
                'message' => 'Your attendance has been successfully recorded. Thank you for checking in!.',
            ]);
        } catch (Exception $e) {
            Log::error('Attendance Save Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Something went wrong while recording your attendance. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Check-Out Method
    public function checkOut(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'latitude' => 'nullable|string',
                'longitude' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $currentDate = now()->format('Y-m-d');

            $attendance = Attendance::where('user_id', $request->user()->id)
                ->where('date', $currentDate)
                ->first();

            if (!$attendance) {
                return response()->json([
                    'message' => 'No check-in record found for today.',
                ], 404);
            }

            $checkinTime = $attendance->checkin;
            $checkoutTime = now();

            $workedHours = calculateWorkedHours($checkinTime, $checkoutTime);

            $attendance->update([
                'checkout' => $checkoutTime->format('H:i:s'),
                'worked_hours' => number_format($workedHours, 2),
                'latitude' => $request->latitude ?? $attendance->latitude,
                'longitude' => $request->longitude ?? $attendance->longitude,
            ]);

            return response()->json([
                'message' => 'Checkout successful.',
                'worked_hours' => number_format($workedHours, 2),
            ]);
        } catch (Exception $e) {
            Log::error('Attendance Checkout Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to save checkout. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Break Start Method
    public function breakStart(Request $request) {}

    // Break End Method
    public function breakEnd(Request $request) {}

    public function getAttendance(Request $request)
    {
        try {
            $attendances = Attendance::where('user_id', $request->user()->id)
                ->oldest('date')
                ->get()
                ->map(function ($attendance) {
                    if ($attendance->checkin) {
                        $attendance->checkin = Carbon::parse($attendance->checkin)->format('g:i A');
                    }
                    if ($attendance->checkout) {
                        $attendance->checkout = Carbon::parse($attendance->checkout)->format('g:i A');
                    }

                    $attendance->worked_hours = formatWorkedHours($attendance->worked_hours);
                    return $attendance;
                });

            return response()->json([
                'status' => 'success',
                'message' => 'Attendance retrieved successfully.',
                'data' => $attendances,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve attendance.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
