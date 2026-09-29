<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Member;
use App\Models\Song; 
use App\Models\Gallery;
use App\Models\ReportSetting;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Dashboard ya Mwanakwaya Binafsi (Member Dashboard)
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        $member = Member::where('full_name', $user->name)->first();

        if (!$member) {
            return view('members.dashboard', [
                'member' => null,
                'my_requests' => collect([]),
                'totalPresent' => 0,
                'totalDays' => 0,
                'attendancePercentage' => 0
            ])->with('error', 'Taarifa zako za uanachama hazijapatikana.');
        }

        $totalDays = Attendance::where('member_id', $member->id)->count();

        $totalPresent = Attendance::where('member_id', $member->id)
                                  ->where('status', 'present')
                                  ->count();

        $attendancePercentage = ($totalDays > 0) ? round(($totalPresent / $totalDays) * 100) : 0;

        $my_requests = Permission::where('user_id', $user->id)
                                ->latest()
                                ->get();

        return view('members.dashboard', compact(
            'member', 
            'my_requests', 
            'totalPresent', 
            'totalDays', 
            'attendancePercentage'
        ));
    }

    /**
     * Orodha ya Wanachama (Public View)
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $voice = $request->query('voice');

        $members = Member::where('is_active', true)
            ->when($search, function($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                      ->orWhere('reg_no', 'like', "%{$search}%");
                });
            })
            ->when($voice, function($query, $voice) {
                return $query->where('voice_part', $voice);
            })
            ->orderBy('full_name', 'asc')
            ->paginate(12); 

        return view('members.index', compact('members'));
    }

    /**
     * Ripoti ya Jumla kwa ajili ya Admin
     */
    public function reportIndex()
    {
        $reportSetting = ReportSetting::first();

        $soprano = Member::where('voice_part', 'Soprano')->count();
        $alto    = Member::where('voice_part', 'Alto')->count();
        $tenor   = Member::where('voice_part', 'Tenor')->count();
        $bass    = Member::where('voice_part', 'Bass')->count();

        $totalMembers = Member::count(); 
        $totalSongs   = Song::count();   

        $path = public_path('assets/photos');
        $totalPhotos = File::exists($path) ? count(File::files($path)) : 0;

        $currentMonth = date('m');
        $currentYear = date('Y');

        $presentCount = Attendance::whereYear('attendance_date', $currentYear)
            ->whereMonth('attendance_date', $currentMonth)
            ->where('status', 'present')
            ->count();

        $totalPossible = Attendance::whereYear('attendance_date', $currentYear)
            ->whereMonth('attendance_date', $currentMonth)
            ->count();

        $percentage = ($totalPossible > 0) ? ($presentCount * 100.0) / $totalPossible : 0;

        return view('admin.reports.index', compact(
            'soprano', 'alto', 'tenor', 'bass', 
            'totalMembers', 'totalSongs', 'totalPhotos', 'percentage', 'reportSetting'
        ));
    }

    /**
     * Usimamizi wa Wanachama (Admin View)
     */
    public function adminIndex(Request $request)
    {
        $search = $request->query('search');

        $members = Member::when($search, function($query, $search) {
                return $query->where('full_name', 'LIKE', "%{$search}%")
                             ->orWhere('reg_no', 'LIKE', "%{$search}%");
            })
            ->orderBy('full_name', 'asc')
            ->paginate(12);

        return view('admin.members.index', compact('members'));
    }

    public function create() 
    { 
        return view('admin.members.create'); 
    }

    /**
     * Kuhifadhi Mwanachama Mpya + Auto Attendance entry
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6',
            'reg_no'     => 'required|unique:members,reg_no',
            'voice_part' => 'required|in:Soprano,Alto,Tenor,Bass,soprano,alto,tenor,bass',
        ]);

        try {
            DB::beginTransaction();

            $voicePart = ucfirst(strtolower($request->voice_part));

            // 1. Create Member record
            $member = Member::create([
                'full_name'  => $request->full_name,
                'reg_no'     => $request->reg_no,
                'voice_part' => $voicePart,
                'course'     => $request->course,
                'is_active'  => $request->is_active ?? 1,
            ]);

            // 2. Create User account linked to member_id
            User::create([
                'name'      => $request->full_name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => 'member',
                'member_id' => $member->id,
                'is_admin'  => false,
                'must_change_password' => true,
            ]);

            // 3. Create initial Attendance entry
            Attendance::create([
                'member_id'       => $member->id,
                'attendance_date' => now()->toDateString(),
                'status'          => 'absent',
                'remark'          => 'Auto-generated on registration',
            ]);

            DB::commit();
            return redirect()->route('admin.members.index')->with('success', 'Mwanakwaya ' . $request->full_name . ' amesajiliwa kikamilifu!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Imeshindikana kusajili: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        
        $validated = $request->validate([
            'reg_no'     => 'required|string|unique:members,reg_no,' . $id,
            'full_name'  => 'required|string|max:255',
            'voice_part' => 'required|in:Soprano,Alto,Tenor,Bass,soprano,alto,tenor,bass',
            'course'     => 'nullable|string|max:255',
            'is_active'  => 'required|in:0,1',
        ]);

        try {
            DB::beginTransaction();

            $validated['voice_part'] = ucfirst(strtolower($request->voice_part));

            $member->update($validated);
            
            if ($member->user) {
                $member->user->update([
                    'name' => $validated['full_name']
                ]);
            }

            DB::commit();
            return redirect()->route('admin.members.index')->with('success', 'Taarifa za ' . $member->full_name . ' zimesasishwa!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Imeshindikana kusasisha taarifa.');
        }
    }

    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);
            
            DB::beginTransaction();

            if ($member->user) {
                $member->user->delete();
            }
            
            $member->delete();

            DB::commit();
            return redirect()->route('admin.members.index')->with('success', 'Mwanachama amefutwa kikamilifu!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Imeshindikana kufuta.');
        }
    }

    /**
     * MPYA: Reset Password bila kumfuta mwanachama
     * Inatumika kutatua tatizo la kusahau password bila kupoteza historia ya mahudhurio
     */
    public function resetPassword($id)
    {
        try {
            $member = Member::findOrFail($id);
            $user = User::where('member_id', $member->id)->first();

            if (!$user) {
                return back()->with('error', 'Akaunti ya login haijapatikana kwa mwanachama huyu.');
            }

            // Logic ya kubadili password
            $user->password = Hash::make('password123'); // Password ya kuanzia
            $user->must_change_password = true;
            $user->save();

            return back()->with('success', 'Password ya ' . $member->full_name . ' imerudishwa kuwa: password123');

        } catch (\Exception $e) {
            return back()->with('error', 'Imeshindikana kureset password.');
        }
    }
}