<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule; // Hakikisha inatumia Schedule model
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Hii inapeleka data kwenye ukurasa wa Public (Ratiba na Matukio)
     */
    public function index()
    {
        // BADILISHA HAPA: Tumia $schedules badala ya $events
        $schedules = Schedule::where('date', '>=', Carbon::today())
                             ->orderBy('date', 'asc')
                             ->orderBy('time', 'asc')
                             ->get();
        
        // BADILISHA NA HAPA: Pitisha 'schedules' kwenda kwenye view
        return view('events.index', compact('schedules'));
    }
}