<?php

namespace Database\Seeders;

use App\Models\Song; // Muhimu kuita Model hapa
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    public function run(): void
    {
        // Wimbo wa kwanza wa mfano
        Song::create([
            'title' => 'Utulivu',
            'composer' => 'Emil Shayo',
            'category' => 'Katikati',
            'lyrics' => 'Utulivu wa moyo wangu, unapatikana kwako Bwana...',
            'youtube_url' => 'https://www.youtube.com/watch?v=example1'
        ]);

        // Wimbo wa pili wa mfano
        Song::create([
            'title' => 'Asante Mungu',
            'composer' => 'Msuha Richard',
            'category' => 'Shukrani',
            'lyrics' => 'Asante Mungu kwa neema zako, umenipigania kila siku...',
            'youtube_url' => 'https://www.youtube.com/watch?v=example2'
        ]);

        // Wimbo wa tatu wa mfano
        Song::create([
            'title' => 'Uhimidiwe',
            'composer' => 'Hajulikani',
            'category' => 'Mwanzo',
            'lyrics' => 'Uhimidiwe Bwana Mungu wa Israeli, uliyekuja kutukomboa...',
        ]);
    }
}