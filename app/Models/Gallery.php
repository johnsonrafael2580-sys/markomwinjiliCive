<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_title', 
        'image_path', 
        'event_id'
    ];

    // Hii inatusaidia kujua picha hii ni ya tukio gani (Relationship)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}