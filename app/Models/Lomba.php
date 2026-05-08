<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    protected $fillable = [
        'title', 'category', 'organizer', 'registration_deadline',
        'event_date', 'level', 'prize', 'description',
        'registration_link', 'contact', 'status', 'is_published'
    ];
}