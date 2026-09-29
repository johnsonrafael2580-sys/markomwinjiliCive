<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MassSchedule extends Model
{
    protected $fillable = [
        'mass_date',
        'mass_name',
        'pianist',
        'conductor',
        'selected_songs',
        'notes'
    ];
}