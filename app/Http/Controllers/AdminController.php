<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Song; 
use App\Models\Photo; // Hii inatumika kwa ajili ya picha
use App\Models\Member;
use App\Models\Permission; // Tumeongeza hii kwa ajili ya ruhusa
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Onyesha ukurasa wa Login
     */
    public function showLogin() {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }
            if ($user->role === 'teacher') {
                return redirect()->route('teacher.dashboard');
            }
            return redirect()->route('member.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle mchakato wa Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            // 1. Kama ni Admin mkuu
            if ($user->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }

            // 2. Kama ni Mwalimu / Conductor
            if ($user->role === 'teacher') {
                return redirect()->route('teacher.dashboard');
            }

            // 3. Kama analazimika kubadili password
            if ($user->must_change_password == 1) {
                return redirect()->route('password.change.notice');
            }

            // 4. Kama ni mwanakwaya wa kawaida
            return redirect()->route('member.dashboard');
        }

        return back()->withErrors([
            'email' => 'Taarifa hizi hazilingani na kumbukumbu zetu.',
        ]);
    }

    /**
     * Onyesha ukurasa mkuu wa Admin (Dashboard)
     */
    public function dashboard() {
        // Ulinzi wa ziada
        if (Auth::user()->is_admin != 1) {
            return redirect()->route('member.dashboard');
        }

        // Hesabu data mbalimbali kwa ajili ya kadi za Dashboard
        $songsCount = Song::count();
        $membersCount = Member::count();
        $galleryCount = Photo::count(); // Inatumia Photo model
        
        // Hesabu ruhusa ambazo ni 'pending' kwa ajili ya Notification
        $pendingPermissionsCount = Permission::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'songsCount', 
            'membersCount', 
            'galleryCount', 
            'pendingPermissionsCount'
        ));
    }

    /**
     * Sehemu ya Picha (Gallery)
     */
    public function createPhoto() {
        return view('admin.gallery.create');
    }

    public function storePhoto(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'category' => 'nullable|string',
        ]);

        if (! $request->hasFile('image')) {
            return redirect()->route('admin.gallery.create')->with('error', 'Hakuna faili iliyopakiwa.');
        }

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $photosDir = public_path('photos');

        if (! file_exists($photosDir)) {
            @mkdir($photosDir, 0755, true);
        }

        try {
            $file->move($photosDir, $filename);
        } catch (\Throwable $e) {
            return redirect()->route('admin.gallery.create')->with('error', 'Hitilafu ya kuhifadhi: ' . $e->getMessage());
        }

        Photo::create([
            'caption' => $validated['caption'],
            'path' => 'photos/' . $filename,
            'category' => $validated['category'],
        ]);

        return redirect()->route('admin.gallery.create')->with('success', 'Picha imewekwa kwa mafanikio!');
    }

    /**
     * Sehemu ya Nyimbo
     */
    public function createSong()
    {
        $songs = Song::all(); 
        return view('admin.songs.create', compact('songs'));
    }

    public function storeSong(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'composer' => 'required|string|max:255',
            'category' => 'required|string',
            'lyrics' => 'required|string',
            'youtube_url' => 'nullable|url',
        ]);

        Song::create($validated);
        return redirect()->route('admin.songs.create')->with('success', 'Wimbo umehifadhiwa!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}