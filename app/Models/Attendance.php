<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Hapa ndipo unaruhusu columns hizi kupokea data kutoka kwenye Controller
    protected $fillable = [
        'member_id',
        'attendance_date',
        'status',
        'remark',
    ];

    // Uhusiano na Model ya Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}