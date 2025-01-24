<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'start_grace_time',
        'end_time',
        'end_grace_time',
        'total_time',
        'lunch_start',
        'lunch_end',
        'description',
        'order',
        'status',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getStartTimeAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('g:i A');
        }
    }
    public function getStartGraceTimeAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('g:i A');
        }
    }
    public function getEndTimeAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('g:i A');
        }
    }
    public function getEndGraceTimeAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('g:i A');
        }
    }
}
