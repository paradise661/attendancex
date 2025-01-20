<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'radius',
        'ip_address',
        'latitude',
        'longitude',
        'description',
        'order',
        'status'
    ];
}
