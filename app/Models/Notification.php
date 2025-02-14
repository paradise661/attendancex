<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'is_seen',
        'seen_by',
        'type',
        'entity_id',
        'url'
    ];
}
