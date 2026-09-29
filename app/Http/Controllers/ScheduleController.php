<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Inaonyesha orodha ya ratiba zote kwenye Panel ya Admin
     */
    public function index()
    {
        // Safi sana! Kupanga kwa tarehe kisha muda ni sahihi kabisa
        $schedules = Schedule::orderBy('date', 'asc')
                            ->orderBy('time', 'asc')
                            ->get();

        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Inahifadhi ratiba mpya kutoka kwenye fomu ya Admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'date'        => 'required|date',
            'time'        => 'required', // Unaweza kuongeza |date_format:H:i ikihitajika
            'location'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Mbinu ya usalama: Kama admin hakuweka location, mfumo unaweka mahali pa kawaida (Mfano: CIVE)
        if (empty($validated['location'])) {
            $validated['location'] = 'UDOM - CIVE'; 
        }

        Schedule::create($validated);

        return redirect()->route('admin.schedules.index')
                         ->with('success', 'Ratiba mpya imewekwa kikamilifu!');
    }

    /**
     * Kufuta ratiba kutoka kwenye database
     */
    public function destroy($id)
    {
        // Kutumia findOrFail ni sahihi kwa sababu inaleta 404 isipopatikana
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
                         ->with('success', 'Ratiba imefutwa kwenye mfumo.');
    }
}