<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'duration',
        'is_paid',
        'gender',
        'description',
        'order',
        'status',
    ];
}
