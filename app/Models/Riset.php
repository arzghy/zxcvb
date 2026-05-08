<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riset extends Model
{
    protected $fillable = [
        'title', 'category', 'author', 'release_date', 
        'file_size', 'file_path', 'status'
    ];
}