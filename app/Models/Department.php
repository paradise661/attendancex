<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
        'order',
        'status',
        'branch_id',
        'holidays'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function notices()
    {
        return $this->belongsToMany(Notice::class, 'department_notices')->withTimestamps();
    }

    public function publicHolidays()
    {
        return $this->belongsToMany(PublicHoliday::class, 'department_public_holidays', 'department_id', 'public_holiday_id');
    }
}
