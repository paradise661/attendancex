<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AttendanceRequest extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'checkin',
        'checkout',
        'reason',
        'action_by',
        'action_reason',
        'status'
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
}
