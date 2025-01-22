<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentNotice extends Model
{
    protected $fillable = [
        'notice_id',
        'department_id'
    ];
}
