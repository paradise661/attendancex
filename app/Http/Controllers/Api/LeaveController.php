<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotify;

class LeaveController extends Controller
{
    public function getLeaveTypes(Request $request)
    {
        try {
            $userId = $request->user()->id;

            // Retrieve active leave types
            $leavetypes = LeaveType::where('status', 1)
                ->oldest('order')
                ->get();

            // Get total leave taken by the user per leave type
            $leaveTaken = Leave::where('user_id', $userId)
                ->groupBy('leavetype_id')
                ->selectRaw('leavetype_id, SUM(no_of_days) as total_taken')
                ->pluck('total_taken', 'leavetype_id');

            // Append remaining leave to each leave type
            foreach ($leavetypes as $leavetype) {
                $leaveTypeId = $leavetype->id;
                $totalEntitlement = $leavetype->duration ?? 0; // Using 'duration' as total leave entitlement
                $totalTaken = $leaveTaken[$leaveTypeId] ?? 0;
                $leavetype->remaining_leave = max($totalEntitlement - $totalTaken, 0);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Leavetypes retrieved successfully.',
                'data' => $leavetypes,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve leavetypes.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getLeaves(Request $request)
    {
        try {
            $leaves = Leave::with('leavetype')->where('user_id', $request->user()->id)->latest()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Leaves retrieved successfully.',
                'data' => $leaves,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve leaves.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function leaveRequest(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
                'leavetype_id' => 'nullable|exists:leave_types,id',
                'reason' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $fromDate = Carbon::parse($request->from_date);
            $toDate = Carbon::parse($request->to_date);

            // Calculate number of days (inclusive)
            $noOfDays = $fromDate->diffInDays($toDate) + 1;

            // Check if a leave already exists for this user within the same date range
            $alreadyLeave = Leave::where('user_id', $request->user()->id)
                ->where(function ($query) use ($fromDate, $toDate) {
                    $query->whereBetween('from_date', [$fromDate, $toDate])
                        ->orWhereBetween('to_date', [$fromDate, $toDate])
                        ->orWhere(function ($q) use ($fromDate, $toDate) {
                            $q->where('from_date', '<=', $fromDate)
                                ->where('to_date', '>=', $toDate);
                        });
                })
                ->first();

            if ($alreadyLeave) {
                return response()->json(['error' => 'You already have a leave applied for this date range.'], 422);
            }

            $leave =  Leave::create([
                'user_id' => $request->user()->id,
                'leavetype_id' => $request->leavetype_id ?? NULL,
                'from_date' => $fromDate,
                'to_date' => $toDate,
                'no_of_days' => $noOfDays,
                'reason' => $request->reason ?? NULL,
                'status' => 'Pending',
            ]);

            //notification
            $userDetail = User::find($request->user()->id);
            sendNotificationToAdmin($request->user()->id, $userDetail->first_name . ' has submitted a leave request.', 'Leave', $leave->id);

            //send mail to admin
            Mail::to('durgesh.upadhyaya7@gmail.com')->send(
                new AdminNotify($userDetail, 'leaveRequest')
            );

            return response()->json([
                'message' => 'Your leave request has been submitted successfully. Please wait for admin approval.',
            ]);
        } catch (Exception $e) {
            Log::error('Leave Save Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Something went wrong while recording your Leave. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function leaveCancelRequest(Request $request)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'leave_id' => 'required|exists:leaves,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Invalid request. Please provide a valid leave ID.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Fetch leave record
            $leave = Leave::find($request->leave_id);

            // Ensure leave record exists
            if (!$leave) {
                return response()->json([
                    'message' => 'The leave request does not exist.',
                ], 404);
            }

            // Allow cancellation only if the leave status is 'Pending'
            if ($leave->status !== 'Pending') {
                return response()->json([
                    'message' => 'Only pending leave requests can be canceled.',
                ], 422);
            }

            $leave->update([
                'status' => 'Cancelled',
                'action_by' => $request->user()->id ?? null
            ]);

            return response()->json([
                'message' => 'Your leave request has been successfully canceled',
            ], 200);
        } catch (Exception $e) {
            Log::error('Leave Cancellation Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while processing your request. Please try again later.',
            ], 500);
        }
    }
}
