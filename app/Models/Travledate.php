<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travledate extends Model
{
    use HasFactory;
    protected $fillable = ['traveldate', 'travel_modes_id'];
}
