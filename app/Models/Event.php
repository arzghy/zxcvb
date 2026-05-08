<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'type', 'description', 'event_date', 
        'start_time', 'end_time', 'location', 'pic', 
        'status', 'quota'
    ];
}