<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// Controllers
use App\Http\Controllers\SongController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\JoinRequestController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\TeacherScheduleController; // Controller Mpya ya Walimu

/*
|--------------------------------------------------------------------------
| 1. NJIA ZA WEBSITE (PUBLIC ROUTES)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/nyimbo', [SongController::class, 'index'])->name('songs.index');
Route::get('/nyimbo/{song}', [SongController::class, 'show'])->name('songs.show'); 
Route::get('/wanakwaya', [MemberController::class, 'index'])->name('members.index');
Route::get('/matunzio', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/matukio', [EventController::class, 'index'])->name('events.index');

Route::get('/join', function () {
    return redirect()->to(route('home') . '#jiunge');
});

// Added throttle middleware here (max 5 requests per minute per IP address)
Route::post('/join', [JoinRequestController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('join.store');

/*
|--------------------------------------------------------------------------
| 2. MFUMO WA LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/login', [AdminController::class, 'showLogin'])->name('login'); 
Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| 3. NJIA ZA MEMBER (WANAKWAYA WA KAWAIDA) - PROTECTED BY AUTH
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard ya Mwanakwaya
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');

    // Mfumo wa Ruhusa kwa Member
    Route::get('/my-permissions', [PermissionController::class, 'index'])->name('permissions.index');
    $request_permission_store = [PermissionController::class, 'store']; // Assigned to local variable to ensure safe rendering
    Route::post('/request-permission', $request_permission_store)->name('permissions.store');

    // Notisi ya kubadili password
    Route::get('/change-password-notice', function () {
        return view('auth.passwords.change_notice');
    })->name('password.change.notice');
    
    Route::post('/update-password', [PasswordChangeController::class, 'update'])->name('password.update');

  
   // Redirect logic kulingana na Role (Admin, Teacher, au Member)
    Route::get('/dashboard', function () {
        if (Auth::user()->is_admin) { 
            return redirect()->route('admin.dashboard');
        }
        
        // HAKIKISHA HIKI KIPANDE KIPO JUU YA REDIRECT YA MEMBER
        if (Auth::user()->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
            
        }
        
        return redirect()->route('member.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | 3b. NJIA ZA WALIMU / CONDUCTORS (MEMBER GROUP YA NDANI)
    |--------------------------------------------------------------------------
    | Sehemu hii inasimamia mambo yote yanayofanywa na Walimu kwenye Dashboard yao.
    */
    Route::middleware(['teacher'])->prefix('teacher')->group(function () {
        // Dashboard ya Mwalimu - inaonyesha ratiba zote na nyimbo
        Route::get('/dashboard', [TeacherScheduleController::class, 'index'])->name('teacher.dashboard');
        
        // Route za kupanga Misa mpya (Store)
        Route::post('/schedule/store', [TeacherScheduleController::class, 'store'])->name('teacher.schedule.store');
        Route::post('/dashboard/store', [TeacherScheduleController::class, 'store'])->name('teacher.dashboard.store'); 
        
        // Route za kuhariri na kufuta ratiba za Misa (Update & Destroy)
        Route::put('/schedule/{id}', [TeacherScheduleController::class, 'update'])->name('teacher.schedule.update');
        Route::delete('/schedule/{id}', [TeacherScheduleController::class, 'destroy'])->name('teacher.schedule.destroy');
        
        // Route ya kuhifadhi nyimbo mpya kutoka kwa mwalimu
        Route::post('/songs/store', [SongController::class, 'store'])->name('songs.store');
    });
});

/*
|--------------------------------------------------------------------------
| 4. NJIA ZA ADMIN (PROTECTED BY AUTH & ADMIN MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // --- MFUMO WA RUHUSA (ADMIN) ---
    Route::get('/permissions', [PermissionController::class, 'adminIndex'])->name('permissions.index');
    Route::post('/permissions/{id}/process', [PermissionController::class, 'adminProcess'])->name('permissions.process');
    Route::post('/permissions/{id}/update-status', [PermissionController::class, 'updateStatus'])->name('permissions.updateStatus');

    // --- ADMIN - MAHUDHURIO (ATTENDANCE) ---
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

    // --- ADMIN - NYIMBO (SONGS) ---
    Route::get('/songs', [SongController::class, 'adminIndex'])->name('songs.index');
    Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/songs/store', [SongController::class, 'store'])->name('songs.store');
    Route::get('/songs/{id}/edit', [SongController::class, 'edit'])->name('songs.edit');
    Route::put('/songs/{id}', [SongController::class, 'update'])->name('songs.update');
    Route::delete('/songs/{id}', [SongController::class, 'destroy'])->name('songs.destroy');

    // --- ADMIN - WANAKWAYA (MEMBERS) ---
    Route::get('/members-list', [MemberController::class, 'adminIndex'])->name('members.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/members/store', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
    
    // Reset Password Route
    Route::post('/members/{id}/reset-password', [MemberController::class, 'resetPassword'])->name('members.reset_password');
    
    // --- ADMIN - MATUNZIO & RATIBA ---
    Route::get('/gallery/create', [AdminController::class, 'createPhoto'])->name('gallery.create');
    Route::post('/gallery/store', [AdminController::class, 'storePhoto'])->name('gallery.store');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    // --- ADMIN - RIPOTI ---
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/member-reports', [MemberController::class, 'reportIndex'])->name('reports.members');
    Route::post('/reports/update-status', [ReportsController::class, 'updateStatus'])->name('reports.updateStatus');
});

/*
|--------------------------------------------------------------------------
| 5. DEBUG TOOLS
|--------------------------------------------------------------------------
*/
Route::get('/debug-join/{token}', function ($token) {
    if ($token !== 'debug2026') { abort(404); }
    try {
        $id = DB::table('join_requests')->insertGetId([
            'name' => 'TEST-'.uniqid(),
            'phone' => '000',
            'voice' => 'soprano',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(['ok' => true, 'insert_id' => $id]);
    } catch (\Throwable $e) {
        return response()->json(['ok' => false, 'error' => $e->getMessage()]);
    }
});