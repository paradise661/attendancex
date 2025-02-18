<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicHoliday extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'total_days',
        'gender',
        'status',
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_public_holidays', 'public_holiday_id', 'department_id');
    }
}
