<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Inaonyesha ukurasa wa Matunzio kwa watumiaji
     */
    public function index()
    {
        // Tunachukua picha zote, kuanzia ile ya mwisho ku-upload (latest)
        $photos = Photo::latest()->get();
        
        return view('gallery.index', compact('photos'));
    }

    /**
     * Inahifadhi picha mpya kwenye Database na Storage (Pamoja na Compression)
     */
    public function store(Request $request)
    {
        // 1. Validation: Hakikisha ni picha na isizidi 2MB
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required|string|max:255',
            'category' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $fileName = time() . '_' . pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';
            
            // Njia kamili ya kuhifadhi kwenye public storage
            $filePath = storage_path('app/public/gallery/' . $fileName);
            
            // Hakikisha folda ipo
            if (!file_exists(storage_path('app/public/gallery'))) {
                mkdir(storage_path('app/public/gallery'), 0755, true);
            }

            // Kusoma picha kutegemea aina yake kupitia GD Library
            $info = getimagesize($imageFile->getPathname());
            $mime = $info['mime'] ?? 'image/jpeg';

            switch ($mime) {
                case 'image/png':
                    $img = imagecreatefrompng($imageFile->getPathname());
                    break;
                case 'image/gif':
                    $img = imagecreatefromgif($imageFile->getPathname());
                    break;
                case 'image/jpeg':
                default:
                    $img = imagecreatefromjpeg($imageFile->getPathname());
                    break;
            }

            // Punguza vipimo (Dimensions) kama ni kubwa sana kuliko 1200px upana au urefu
            $width = imagesx($img);
            $height = imagesy($img);
            $maxDim = 1200;

            if ($width > $maxDim || $height > $maxDim) {
                if ($width > $height) {
                    $newWidth = $maxDim;
                    $newHeight = floor($height * ($maxDim / $width));
                } else {
                    $newHeight = $maxDim;
                    $newWidth = floor($width * ($maxDim / $height));
                }
                
                $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($tmpImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($img);
                $img = $tmpImg;
            }

            // Hifadhi picha ikiwa imebana ubora kwenda 75% (Quality compression) ili iwe nyepesi sana
            imagejpeg($img, $filePath, 75);
            imagedestroy($img);

            $path = 'gallery/' . $fileName;

            // 4. Hifadhi taarifa kwenye Database
            Photo::create([
                'path' => $path,
                'caption' => $request->caption,
                'category' => $request->category,
            ]);

            // 5. RUDISHA STATUS YA MAFANIKIO
            return redirect()->back()->with('success', 'Hongera! Picha imebana na kuhifadhiwa kikamilifu kwenye matunzio.');
        }

        // Ikifeli kwa bahati mbaya
        return redirect()->back()->with('error', 'Samahani, imeshindikana kupakia picha. Jaribu tena.');
    }

    /**
     * (Optional) Kufuta picha
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        // Futa faili halisi kule kwenye Storage kwanza
        if (Storage::disk('public')->exists($photo->path)) {
            Storage::disk('public')->delete($photo->path);
        }

        $photo->delete();

        return redirect()->back()->with('success', 'Picha imefutwa kwenye matunzio.');
    }
}