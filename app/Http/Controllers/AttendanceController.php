<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Muhimu kwa ajili ya DB::table
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // 1. Inatumika na Admin kuona fomu ya kuchukua mahudhurio
    public function index()
    {
        $members = Member::orderBy('id', 'asc')->get();
        $today = Carbon::today()->format('Y-m-d');
        
        $existingAttendance = Attendance::where('attendance_date', $today)
            ->pluck('status', 'member_id');

        return view('admin.attendance.index', compact('members', 'today', 'existingAttendance'));
    }

    // 2. Inatumika na Mwanachama kuona mahudhurio yake (Dashboard)
    public function dashboard()
    {
        $user = Auth::user();
        
        // Tunatafuta record ya member inayohusiana na huyu user
        // Hapa tunatumia member_id iliyopo kwenye table ya users
        $member = Member::where('id', $user->member_id)->first();

        // 1. Vuta mahudhurio 5 ya mwisho ya mwanachama huyu
        $recent_attendance = DB::table('attendances')
            ->where('member_id', $user->member_id)
            ->orderBy('attendance_date', 'desc')
            ->take(5)
            ->get();

        // 2. Tafuta jumla ya siku alizokuwepo (Present)
        $totalPresent = DB::table('attendances')
            ->where('member_id', $user->member_id)
            ->where('status', 'present')
            ->count();

        // 3. Tafuta jumla ya siku zote za mahudhurio zilizorekodiwa kwa ajili yake
        $totalDays = DB::table('attendances')
            ->where('member_id', $user->member_id)
            ->count();

        // 4. Piga hesabu ya asilimia (Percentage)
        $attendancePercentage = ($totalDays > 0) ? round(($totalPresent / $totalDays) * 100) : 0;

        // Vuta data ya ruhusa
        $my_requests = DB::table('permissions')->where('user_id', $user->id)->get();

        // Tunarudisha view ya dashboard tukiwa na data zote
        return view('dashboard', compact(
            'recent_attendance', 
            'totalPresent', 
            'totalDays', 
            'attendancePercentage',
            'my_requests',
            'member' // Tumeongeza mwanachama hapa ili jina/sauti ionekane
        ));
    }

    // 3. Hifadhi mahudhurio (Inatumiwa na Admin)
    public function store(Request $request)
    {
        $request->validate([
            'attendance_date' => 'required|date',
            'statuses' => 'required|array',
        ]);

        foreach ($request->statuses as $member_id => $status) {
            Attendance::updateOrCreate(
                [
                    'member_id' => $member_id,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'status' => $status,
                    'remark' => $request->remarks[$member_id] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Mahudhurio yamehifadhiwa kikamilifu!');
    }
}