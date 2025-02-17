<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentPublicHoliday extends Model
{
    protected $fillable = [
        'public_holiday_id',
        'department_id',
    ];
}
