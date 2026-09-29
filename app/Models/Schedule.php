<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * Sehemu hii imepanuliwa ili kuruhusu nyimbo zote na viongozi wao
     * kuhifadhiwa kwa pamoja bila kuleta kizuizi cha Mass Assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'date',
        'time',
        'location',
        'description',

        // Wimbo wa Kuingia
        'song_kuingia',
        'pianist_kuingia',
        'conductor_kuingia',

        // Utukufu
        'song_utukufu',
        'pianist_utukufu',
        'conductor_utukufu',

        // Katikati (Wimbo wa Katikati / Zaburi)
        'song_katikati',
        'pianist_katikati',
        'conductor_katikati',

        // Matoleo
        'song_matoleo',
        'pianist_matoleo',
        'conductor_matoleo',

        // Mtakatifu
        'song_mtakatifu',
        'pianist_mtakatifu',
        'conductor_mtakatifu',

        // Komunyo
        'song_komunyo',
        'pianist_komunyo',
        'conductor_komunyo',

        // Wimbo wa Kutoka
        'song_kutoka',
        'pianist_kutoka',
        'conductor_kutoka',
    ];
}