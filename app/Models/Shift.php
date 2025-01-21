<?php

namespace App\Models;

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
}
