<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    protected $fillable = ['bank_interest', 'stock_return'];
}