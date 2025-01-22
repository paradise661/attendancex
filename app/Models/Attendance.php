<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'type',
        'checkin',
        'checkout',
        'break_start',
        'break_end',
        'total_break',
        'worked_hours',
        'overtime_minute',
        'ip_address',
        'latitude',
        'longitude',
        'device',
        'attendance_by',
        'request_reason'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
