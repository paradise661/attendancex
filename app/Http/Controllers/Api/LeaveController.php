<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function getLeaveTypes()
    {
        try {
            $leavetypes = LeaveType::where('status', 1)
                ->oldest('order')
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Leavetypes retrieved successfully.',
                'data' => $leavetypes,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve leavetypes.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
