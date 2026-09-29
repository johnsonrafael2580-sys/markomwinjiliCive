<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'composer', 
        'category', 
        'lyrics', 
        'notations',    // Hii ni muhimu kwa ajili ya nota za Sol-fa
        'audio_url',    // Inahifadhi path ya file la MP3
        'youtube_url', 
    ];
}