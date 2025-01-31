<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceRequest extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'reason',
        'action_by',
        'status'
    ];
}
