<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordChangeController extends Controller
{
    /**
     * Kusasisha password mpya
     */
    public function update(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        
        // Tunabadilisha password na kuzima ile alama ya must_change_password
        $user->update([
            'password' => Hash::make($request->new_password),
            'must_change_password' => 0,
        ]);

        // Mpeleke kwenye dashboard yake sasa
        if ($user->is_admin == 1) {
            return redirect()->route('admin.dashboard')->with('success', 'Password imebadilishwa kikamilifu!');
        }

        return redirect()->route('member.dashboard')->with('success', 'Password imebadilishwa kikamilifu!');
    }
}