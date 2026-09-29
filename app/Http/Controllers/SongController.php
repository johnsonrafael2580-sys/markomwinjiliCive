<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SongController extends Controller
{
    // 1. Orodha ya nyimbo (Public View)
    public function index(Request $request) {
        $search = $request->query('search');
        $songs = Song::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('composer', 'like', "%{$search}%");
        })->orderBy('title', 'asc')->paginate(12);
        
        return view('songs.index', compact('songs'));
    }

    // 2. Orodha ya nyimbo (Admin View)
    public function adminIndex() {
        $songs = Song::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.songs.index', compact('songs'));
    }

    // 3. Fomu ya kuongeza wimbo
    public function create() {
        return view('admin.songs.create'); 
    }

    // 4. Kuhifadhi wimbo mpya (Modified for InfinityFree)
    public function store(Request $request) {
        $request->validate([
            'title'       => 'required|string|max:255',
            'composer'    => 'nullable|string|max:255',
            'category'    => 'required|string',
            'lyrics'      => 'required|string',
            'pdf_file'    => 'nullable|mimes:pdf|max:8192', // <-- HAPA: Imebadilishwa hapa
            'youtube_url' => 'nullable|url',
            'audio_file'  => 'nullable|mimes:mp3,wav|max:8192', // Unaweza kuweka na audio 8MB pia
        ]);

        $song = new Song();
        $song->title = $request->title;
        $song->composer = $request->composer;
        $song->category = $request->category;
        $song->lyrics = $request->lyrics;
        $song->youtube_url = $request->youtube_url;

        // Kushughulikia PDF (Nota) - Move to Public Path
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/notations'), $fileName);
            $song->notations = 'notations/' . $fileName; 
        }

        // Kushughulikia Audio - Move to Public Path
        if ($request->hasFile('audio_file')) {
            $file = $request->file('audio_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/songs/audio'), $fileName);
            $song->audio_url = 'songs/audio/' . $fileName;
        }

        $song->save();

        return redirect()->route('admin.songs.index')->with('success', 'Wimbo na Nota zimehifadhiwa kikamilifu!');
    }

    // 5. Kuonyesha wimbo mmoja
    public function show($id) {
        $song = Song::findOrFail($id);
        return view('songs.show', compact('song'));
    }

    // 6. Fomu ya kufanya marekebisho (Edit)
    public function edit($id) {
        $song = Song::findOrFail($id);
        return view('admin.songs.edit', compact('song'));
    }

    // 7. Kusasisha taarifa (Update - Modified for InfinityFree)
    public function update(Request $request, $id) {
        $song = Song::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'composer'    => 'nullable|string|max:255',
            'category'    => 'required|string',
            'lyrics'      => 'required|string',
            'pdf_file'    => 'nullable|mimes:pdf|max:8192', // <-- HAPA: Imebadilishwa na hapa pia
            'youtube_url' => 'nullable|url',
            'audio_file'  => 'nullable|mimes:mp3,wav|max:8192',
        ]);

        $song->title = $request->title;
        $song->composer = $request->composer;
        $song->category = $request->category;
        $song->lyrics = $request->lyrics;
        $song->youtube_url = $request->youtube_url;

        // Update PDF
        if ($request->hasFile('pdf_file')) {
            // Futa ya zamani
            if ($song->notations && file_exists(public_path('storage/' . $song->notations))) {
                unlink(public_path('storage/' . $song->notations));
            }
            $file = $request->file('pdf_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/notations'), $fileName);
            $song->notations = 'notations/' . $fileName;
        }

        // Update Audio
        if ($request->hasFile('audio_file')) {
            // Futa ya zamani
            if ($song->audio_url && file_exists(public_path('storage/' . $song->audio_url))) {
                unlink(public_path('storage/' . $song->audio_url));
            }
            $file = $request->file('audio_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/songs/audio'), $fileName);
            $song->audio_url = 'songs/audio/' . $fileName;
        }

        $song->save();

        return redirect()->route('admin.songs.index')->with('success', 'Wimbo umesasishwa kikamilifu!');
    }

    // 8. Kufuta wimbo (Destroy)
    public function destroy($id) {
        $song = Song::findOrFail($id);
        
        // Futa faili la Nota
        if ($song->notations && file_exists(public_path('storage/' . $song->notations))) {
            unlink(public_path('storage/' . $song->notations));
        }

        // Futa faili la Audio
        if ($song->audio_url && file_exists(public_path('storage/' . $song->audio_url))) {
            unlink(public_path('storage/' . $song->audio_url));
        }

        $song->delete();

        return redirect()->route('admin.songs.index')->with('success', 'Wimbo na faili zake umefutwa!');
    }
}