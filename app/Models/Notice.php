<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'date',
        'time',
        'created_by',
        'file',
        'order',
        'status'
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_notices')->withTimestamps();
    }
}
