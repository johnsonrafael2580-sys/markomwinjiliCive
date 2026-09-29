<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    \App\Models\Gallery::create([
        'image_title' => 'Wanakwaya Wakiimba Misa ya Pasaka',
        'image_path' => 'https://images.unsplash.com/photo-1510915361894-db8b60106cb1', 
        'event_id' => 1 // Inaunganishwa na event ya kwanza (Misa)
    ]);

    \App\Models\Gallery::create([
        'image_title' => 'Safari ya Utume Kondoa',
        'image_path' => 'https://images.unsplash.com/photo-1478147427282-58a87a120781',
        'event_id' => 3 // Inaunganishwa na event ya tatu (Safari)
    ]);
}
}
