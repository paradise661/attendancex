<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'user_id',
        'leavetype_id',
        'from_date',
        'to_date',
        'no_of_days',
        'reason',
        'leave_taken',
        'action_by',
        'action_reason',
        'supporting_document',
        'status',
    ];

    public function leavetype()
    {
        return $this->belongsTo(LeaveType::class, 'leavetype_id');
    }
}
