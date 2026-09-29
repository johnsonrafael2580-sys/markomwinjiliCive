<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Schedule;
use Illuminate\Http\Request;

class TeacherScheduleController extends Controller
{
    /**
     * Display the teacher dashboard with songs and schedules
     */
    public function index()
    {
        $songs = Song::orderBy('title', 'asc')->get();
        $schedules = Schedule::orderBy('date', 'desc')->paginate(10);
        return view('teacher.dashboard', compact('songs', 'schedules'));
    }

    /**
     * Store a newly created schedule in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'mass_name' => 'required|string|max:255',
            
            'song_kuingia' => 'nullable|string|max:255',
            'pianist_kuingia' => 'nullable|string|max:255',
            'conductor_kuingia' => 'nullable|string|max:255',
            
            'song_utukufu' => 'nullable|string|max:255',
            'pianist_utukufu' => 'nullable|string|max:255',
            'conductor_utukufu' => 'nullable|string|max:255',
            
            'song_katikati' => 'nullable|string|max:255',
            'pianist_katikati' => 'nullable|string|max:255',
            'conductor_katikati' => 'nullable|string|max:255',
            
            'song_matoleo' => 'nullable|string|max:255',
            'pianist_matoleo' => 'nullable|string|max:255',
            'conductor_matoleo' => 'nullable|string|max:255',
            
            'song_mtakatifu' => 'nullable|string|max:255',
            'pianist_mtakatifu' => 'nullable|string|max:255',
            'conductor_mtakatifu' => 'nullable|string|max:255',
            
            'song_komunyo' => 'nullable|string|max:255',
            'pianist_komunyo' => 'nullable|string|max:255',
            'conductor_komunyo' => 'nullable|string|max:255',
            
            'song_kutoka' => 'nullable|string|max:255',
            'pianist_kutoka' => 'nullable|string|max:255',
            'conductor_kutoka' => 'nullable|string|max:255',
        ]);

        Schedule::create([
            'date' => $request->date,
            'title' => $request->mass_name,
            'mass_name' => $request->mass_name,
            
            'song_kuingia' => $request->song_kuingia,
            'pianist_kuingia' => $request->pianist_kuingia,
            'conductor_kuingia' => $request->conductor_kuingia,
            
            'song_utukufu' => $request->song_utukufu,
            'pianist_utukufu' => $request->pianist_utukufu,
            'conductor_utukufu' => $request->conductor_utukufu,
            
            'song_katikati' => $request->song_katikati,
            'pianist_katikati' => $request->pianist_katikati,
            'conductor_katikati' => $request->conductor_katikati,
            
            'song_matoleo' => $request->song_matoleo,
            'pianist_matoleo' => $request->pianist_matoleo,
            'conductor_matoleo' => $request->conductor_matoleo,
            
            'song_mtakatifu' => $request->song_mtakatifu,
            'pianist_mtakatifu' => $request->pianist_mtakatifu,
            'conductor_mtakatifu' => $request->conductor_mtakatifu,
            
            'song_komunyo' => $request->song_komunyo,
            'pianist_komunyo' => $request->pianist_komunyo,
            'conductor_komunyo' => $request->conductor_komunyo,
            
            'song_kutoka' => $request->song_kutoka,
            'pianist_kutoka' => $request->pianist_kutoka,
            'conductor_kutoka' => $request->conductor_kutoka,
        ]);

        return redirect()->route('teacher.dashboard')->with('success', 'Ratiba ya Misa imehifadhiwa kikamilifu!');
    }

    /**
     * Update the specified schedule in the database.
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $request->validate([
            'song_kuingia' => 'nullable|string|max:255',
            'pianist_kuingia' => 'nullable|string|max:255',
            'conductor_kuingia' => 'nullable|string|max:255',
            
            'song_utukufu' => 'nullable|string|max:255',
            'pianist_utukufu' => 'nullable|string|max:255',
            'conductor_utukufu' => 'nullable|string|max:255',
            
            'song_katikati' => 'nullable|string|max:255',
            'pianist_katikati' => 'nullable|string|max:255',
            'conductor_katikati' => 'nullable|string|max:255',
            
            'song_matoleo' => 'nullable|string|max:255',
            'pianist_matoleo' => 'nullable|string|max:255',
            'conductor_matoleo' => 'nullable|string|max:255',
            
            'song_mtakatifu' => 'nullable|string|max:255',
            'pianist_mtakatifu' => 'nullable|string|max:255',
            'conductor_mtakatifu' => 'nullable|string|max:255',
            
            'song_komunyo' => 'nullable|string|max:255',
            'pianist_komunyo' => 'nullable|string|max:255',
            'conductor_komunyo' => 'nullable|string|max:255',
            
            'song_kutoka' => 'nullable|string|max:255',
            'pianist_kutoka' => 'nullable|string|max:255',
            'conductor_kutoka' => 'nullable|string|max:255',
        ]);

        $schedule->update([
            'song_kuingia' => $request->song_kuingia,
            'pianist_kuingia' => $request->pianist_kuingia,
            'conductor_kuingia' => $request->conductor_kuingia,
            
            'song_utukufu' => $request->song_utukufu,
            'pianist_utukufu' => $request->pianist_utukufu,
            'conductor_utukufu' => $request->conductor_utukufu,
            
            'song_katikati' => $request->song_katikati,
            'pianist_katikati' => $request->pianist_katikati,
            'conductor_katikati' => $request->conductor_katikati,
            
            'song_matoleo' => $request->song_matoleo,
            'pianist_matoleo' => $request->pianist_matoleo,
            'conductor_matoleo' => $request->conductor_matoleo,
            
            'song_mtakatifu' => $request->song_mtakatifu,
            'pianist_mtakatifu' => $request->pianist_mtakatifu,
            'conductor_mtakatifu' => $request->conductor_mtakatifu,
            
            'song_komunyo' => $request->song_komunyo,
            'pianist_komunyo' => $request->pianist_komunyo,
            'conductor_komunyo' => $request->conductor_komunyo,
            
            'song_kutoka' => $request->song_kutoka,
            'pianist_kutoka' => $request->pianist_kutoka,
            'conductor_kutoka' => $request->conductor_kutoka,
        ]);

        return redirect()->route('teacher.dashboard')->with('success', 'Ratiba ya Misa imesasishwa kikamilifu!');
    }

    /**
     * Remove the specified schedule from the database.
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('teacher.dashboard')->with('success', 'Ratiba ya Misa imefutwa kikamilifu!');
    }
}