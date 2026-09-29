<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',                 // Inatofautisha admin na member
        'member_id',            // Inaunganisha na table ya members
        'is_admin',             // Inatumika kwa uthibitisho wa admin
        'must_change_password', // Kulazimisha kubadili password login ya kwanza
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',            
            'must_change_password' => 'boolean', 
            'member_id' => 'integer',
        ];
    }

    /**
     * Uhusiano: User mmoja anamilikiwa na Member mmoja
     */
   /**
 * Uhusiano: User mmoja anahusiana na rekodi moja ya Member
 * Tunatumia 'full_name' ya kwenye table ya members na 'name' ya kwenye table ya users
 */
public function member()
{
    // hasOne(Model_Husika, 'foreign_key_kwenye_members', 'local_key_kwenye_users')
    return $this->hasOne(Member::class, 'full_name', 'name'); 
}
    /**
     * Helper: Kuangalia kama user ni admin
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true || $this->role === 'admin';
    }
}