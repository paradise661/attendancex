<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use App\Models\User;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotify;

class AttendanceController extends Controller
{
    // Check-In Method
    public function checkIn(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $currentDate = now()->format('Y-m-d');

            // Check if the user has already checked in today
            $existingAttendance = Attendance::where('user_id', $request->user()->id)
                ->where('date', $currentDate)
                ->first();

            $distance = getDistance($request->user()->branch->latitude, $request->user()->branch->longitude, $request->latitude, $request->longitude);
            $area = $request->user()->branch->radius / 1000;

            if ($distance > $area) {
                return response()->json([
                    'message' => 'You are not in office area.',
                ], 400);
            }

            if ($existingAttendance) {
                return response()->json([
                    'message' => 'You have already checked in today.',
                ], 400);
            }

            $attendance = Attendance::create([
                'user_id' => $request->user()->id,
                'date' => $currentDate,
                'type' => 'Present',
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

    // Break Start Method
    public function breakStart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $currentDate = now()->format('Y-m-d');
            $userId = $request->user()->id;

            $attendance = Attendance::where('user_id', $userId)
                ->where('date', $currentDate)->first();

            $distance = getDistance($request->user()->branch->latitude, $request->user()->branch->longitude, $request->latitude, $request->longitude);
            $area = $request->user()->branch->radius / 1000;

            if ($distance > $area) {
                return response()->json([
                    'message' => 'You are not in office area.',
                ], 400);
            }

            // Check if the attendance record exists and whether the user has checked in
            if (!$attendance || !$attendance->checkin) {
                return response()->json([
                    'message' => 'You must check in first before starting your break.',
                ], 400);
            }

            // If the break start is already recorded, return a message
            if ($attendance->break_start) {
                return response()->json([
                    'message' => 'You have already started your break today.',
                ], 400);
            }

            // Set the break start time
            $attendance->break_start = now()->format('H:i:s');
            $attendance->save();

            return response()->json([
                'message' => 'Your break has been successfully started.',
                'data' => $attendance,
            ]);
        } catch (Exception $e) {
            Log::error('Break Start Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to start break. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Break End Method
    public function breakEnd(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $currentDate = now()->format('Y-m-d');
            $userId = $request->user()->id;

            $attendance = Attendance::where('user_id', $userId)
                ->where('date', $currentDate)->first();

            $distance = getDistance($request->user()->branch->latitude, $request->user()->branch->longitude, $request->latitude, $request->longitude);
            $area = $request->user()->branch->radius / 1000;

            if ($distance > $area) {
                return response()->json([
                    'message' => 'You are not in office area.',
                ], 400);
            }

            if (!$attendance || !$attendance->checkin) {
                return response()->json([
                    'message' => 'You must check in first before ending your break.',
                ], 400);
            }

            if (!$attendance->break_start) {
                return response()->json([
                    'message' => 'You must start your break before ending it.',
                ], 400);
            }

            // Calculate total break time in minutes
            // $breakStart = Carbon::createFromFormat('H:i:s', $attendance->break_start);
            $breakStart = Carbon::createFromFormat('g:i A', $attendance->break_start);

            $breakEnd = now();
            $totalBreakMinutes = $breakStart->diffInMinutes($breakEnd);

            // Set the break end time and total break time
            $attendance->break_end = $breakEnd->format('H:i:s');
            $attendance->total_break = number_format($totalBreakMinutes, 2);
            $attendance->save();

            return response()->json([
                'message' => 'Your break has been successfully ended.',
                'data' => $attendance,
            ]);
        } catch (Exception $e) {
            Log::error('Break End Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to end break. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Check-Out Method
    public function checkOut(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'latitude' => 'required',
                'longitude' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $currentDate = now()->format('Y-m-d');

            $attendance = Attendance::where('user_id', $request->user()->id)->where('date', $currentDate)->first();

            $distance = getDistance($request->user()->branch->latitude, $request->user()->branch->longitude, $request->latitude, $request->longitude);
            $area = $request->user()->branch->radius / 1000;

            if ($distance > $area) {
                return response()->json([
                    'message' => 'You are not in office area.',
                ], 400);
            }

            if (!$attendance || !$attendance->checkin) {
                return response()->json([
                    'message' => 'No check-in record found for today.',
                ], 404);
            }

            // Check if break_start is set but break_end is not
            if ($attendance->break_start && !$attendance->break_end) {
                return response()->json([
                    'message' => 'You must end your break before checking out.',
                ], 400);
            }

            $checkinTime = $attendance->checkin;
            $checkoutTime = now();

            $workedHours = calculateWorkedHours($checkinTime, $checkoutTime);


            // calculation for overtime
            $start_time = $request->user()->shift->start_time;
            $end_time = $request->user()->shift->end_time;

            // Parse the start and end times to Carbon instances
            $start = Carbon::parse($start_time);
            $end = Carbon::parse($end_time);

            // Calculate the difference in hours as a float (including fractions of an hour)
            $totalHours = $start->diffInRealSeconds($end) / 3600;

            $overtime_minute = 0;
            if ($workedHours > $totalHours) {
                $hoursDifference = $workedHours - $totalHours;
                $overtime_minute = $hoursDifference * 60;
            }
            // overtime calculation ends

            $attendance->update([
                'checkout' => $checkoutTime->format('H:i:s'),
                'worked_hours' => $workedHours,
                'latitude' => $request->latitude ?? $attendance->latitude,
                'longitude' => $request->longitude ?? $attendance->longitude,
                'overtime_minute' => $overtime_minute
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

    public function getAttendance(Request $request)
    {
        try {
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');

            $joinDate = $request->user()->join_date;

            if (!$startDate || !$endDate) {
                $startDate = now()->subDays(7)->format('Y-m-d');
                $endDate = now()->format('Y-m-d');
            }

            // Adjust startDate if join_date is set and is later than the requested startDate
            if ($joinDate && Carbon::parse($joinDate)->gt(Carbon::parse($startDate))) {
                $startDate = Carbon::parse($joinDate)->format('Y-m-d');
            }

            $attendances = AttendanceService::getAttendance($startDate, $endDate, $request->user()->id);

            return response()->json([
                'status' => 'success',
                'message' => 'Attendance retrieved successfully.',
                'data' => $attendances['attendances'] ?? null,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve attendance.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getSpecificDateAttendanceRecord(Request $request)
    {
        try {
            $attendance = Attendance::where('user_id', $request->user()->id)->where('date', $request->date)->first();

            return response()->json([
                'status' => 'success',
                'message' => 'Attendance retrieved successfully.',
                'data' => $attendance,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to attendance request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getMyAttendanceRequest(Request $request)
    {
        try {
            $attendance_request = AttendanceRequest::where('user_id', $request->user()->id)->latest()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Attendance Request retrieved successfully.',
                'data' => $attendance_request,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve attendance request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function attendanceRequest(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'date' => 'required',
                'reason' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $alreadyExist = AttendanceRequest::where('user_id', $request->user()->id)->where('date', $request->date)->first();
            if ($alreadyExist) {
                return response()->json([
                    'message' => 'You have already submitted an attendance request for this date.',
                ], 400);
            }

            $attendanceRequest =  AttendanceRequest::create([
                'user_id' => $request->user()->id ?? NULL,
                'date' => $request->date ?? NULL,
                'checkin' => $request->checkin ? date('H:i:s', strtotime($request->checkin)) : NULL,
                'checkout' => $request->checkout ? date('H:i:s', strtotime($request->checkout)) : NULL,
                'reason' => $request->reason ?? NULL,
                'status' => 'Pending'
            ]);

            //notification
            $userDetail = User::find($request->user()->id);
            sendNotificationToAdmin($request->user()->id, $userDetail->first_name . ' has submitted an attendance request.', 'Attendance', $attendanceRequest->id);

            //send mail to admin
            Mail::to(getSetting()['smtp_email'] ?? 'durgesh.upadhyaya7@gmail.com')->send(
                new AdminNotify($userDetail, 'attendanceRequest')
            );

            return response()->json([
                'message' => 'Your request has been submitted successfully. Please wait for admin approval.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
