<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory;

    /**
     * Orodha ya column zinazoruhusiwa kuingiza data (Mass Assignment)
     */
    protected $fillable = [
        'full_name', 
        'reg_no', 
        'voice_part', 
        'is_active', 
        'course'
    ];

    /**
     * Casting: Inahakikisha is_active inatendewa kazi kama Boolean (true/false)
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * ACCESSOR: Inahakikisha voice_part inatoka ikiwa na herufi kubwa ya kwanza.
     * Hii itatatua tofauti kati ya database ('Soprano') na kodi ('soprano').
     */
    public function getVoicePartAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    /**
     * Uhusiano na Table ya Attendances
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Uhusiano na Table ya Users
     * Member mmoja ana akaunti moja ya User
     */
    public function user(): HasOne
    {
        // Hakikisha kwenye table ya 'users' kuna column inaitwa 'member_id'
        return $this->hasOne(User::class, 'member_id');
    }
}