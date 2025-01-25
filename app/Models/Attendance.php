<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getCheckinAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('g:i A');
        }
    }
    public function getCheckoutAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('g:i A');
        }
    }
    public function getBreakStartAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('g:i A');
        }
    }
    public function getBreakEndAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('g:i A');
        }
    }

    public function getWorkedHoursAttribute($value)
    {
        if ($value) {
            return formatWorkedHours($value);
        }
    }

    public function getTotalBreakAttribute($value)
    {
        if ($value) {
            return ceil($value) . 'm';
        }
    }
}
