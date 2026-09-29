<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Ni muhimu ku-import User model ili belongsTo isilete error
use App\Models\User; 

class Permission extends Model
{
    use HasFactory;

    /**
     * Column ambazo zinaruhusiwa kupokea data (Mass Assignment)
     */
    protected $fillable = [
        'user_id', 
        'reason', 
        'start_date', 
        'end_date', 
        'status', 
        'admin_remark'
    ];

    /**
     * Uhusiano: Ruhusa hii ni ya mwanakwaya (User) yupi?
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hiari: Unaweza kuweka default values kwa status kama hukuweka kwenye Database
     */
    protected $attributes = [
        'status' => 'pending',
    ];
}