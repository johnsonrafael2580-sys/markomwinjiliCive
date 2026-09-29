<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Song;
use App\Models\Attendance;
use App\Models\ReportSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // 1. Kamata mwezi uliochaguliwa (Default ni mwezi uliopo)
        $reportMonth = $request->get('report_month', date('Y-m'));
        $date = Carbon::parse($reportMonth);
        $month = $date->month;
        $year = $date->year;

        // 2. Mahesabu ya Jumla
        $totalMembers = Member::where('created_at', '<=', $date->endOfMonth())->count();
        $totalSongs = Song::whereMonth('created_at', $month)
                          ->whereYear('created_at', $year)
                          ->count();
        $totalPhotos = 0; 

        // 3. Mahesabu ya Sauti
        $hasVoiceColumn = Schema::hasColumn('members', 'voice_part');
        if ($hasVoiceColumn) {
            $soprano = Member::where('voice_part', 'Soprano')->where('created_at', '<=', $date->endOfMonth())->count();
            $alto    = Member::where('voice_part', 'Alto')->where('created_at', '<=', $date->endOfMonth())->count();
            $tenor   = Member::where('voice_part', 'Tenor')->where('created_at', '<=', $date->endOfMonth())->count();
            $bass    = Member::where('voice_part', 'Bass')->where('created_at', '<=', $date->endOfMonth())->count();
        } else {
            $soprano = $alto = $tenor = $bass = 0;
        }

        // 4. Mahesabu ya Mahudhurio
        $presents = Attendance::whereMonth('attendance_date', $month)
                    ->whereYear('attendance_date', $year)
                    ->where('status', 'present')
                    ->count();

        $totalAttendanceRecords = Attendance::whereMonth('attendance_date', $month)
                                ->whereYear('attendance_date', $year)
                                ->count();

        $percentage = ($totalAttendanceRecords > 0) ? ($presents / $totalAttendanceRecords) * 100 : 0;

        // 5. Maoni ya Uongozi - FIXED: Using created_at instead of report_date
        $reportSetting = ReportSetting::whereMonth('created_at', $month)
                                      ->whereYear('created_at', $year)
                                      ->first();

        // 6. Kurudisha View
        return view('admin.reports.index', compact(
            'totalMembers', 
            'totalSongs', 
            'totalPhotos', 
            'soprano', 
            'alto', 
            'tenor', 
            'bass', 
            'percentage', 
            'reportSetting',
            'reportMonth'
        ));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'choir_status' => 'required|string',
            'report_date'  => 'required' // Keeping the input name from the form
        ]);

        $date = Carbon::parse($request->report_date);

        // FIXED: Using created_at for matching as seen in image_3e859d.png
        // Note: updateOrCreate will look for an existing record in that month/year
        $report = ReportSetting::whereMonth('created_at', $date->month)
                               ->whereYear('created_at', $date->year)
                               ->first();

        if ($report) {
            $report->update(['choir_status' => $request->choir_status]);
        } else {
            ReportSetting::create([
                'choir_status' => $request->choir_status,
                'created_at' => $date->startOfMonth() 
            ]);
        }

        return redirect()->back()->with('success', 'Maoni yamehifadhiwa!');
    }
}