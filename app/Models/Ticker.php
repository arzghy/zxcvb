<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    protected $fillable = ['kode', 'harga', 'change', 'pct', 'tren', 'status'];
}
