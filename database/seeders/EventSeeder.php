<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tukio la Misa ya Jumapili
        Event::create([
            'event_name' => 'Misa ya Jumapili ya Kwanza',
            'event_date' => Carbon::now()->addDays(2)->setTime(07, 30, 00), // Siku 2 kutoka leo, saa 1:30 asubuhi
            'location' => 'Chapel ya Mt. Marko - CIVE',
            'description' => 'Misa ya kwanza itakayoongozwa na kwaya ya Mt. Marko Mwinjili.',
            'status' => 'upcoming'
        ]);

        // 2. Tukio la Mazoezi ya Kwaya
        Event::create([
            'event_name' => 'Mazoezi ya Kwaya (Preparation)',
            'event_date' => Carbon::now()->addDays(1)->setTime(16, 00, 00), // Kesho saa 10:00 jioni
            'location' => 'CIVE Room 04',
            'description' => 'Maandalizi ya nyimbo mpya za utume kwa ajili ya safari ijayo.',
            'status' => 'upcoming'
        ]);

        // 3. Tukio la Safari ya Utume (Mfano wa tukio lililopita)
        Event::create([
            'event_name' => 'Safari ya Utume - Kondoa',
            'event_date' => Carbon::now()->subDays(10), // Siku 10 zilizopita
            'location' => 'Parokia ya Kondoa',
            'description' => 'Safari ya kutoa huduma ya uimbaji nje ya chuo.',
            'status' => 'completed'
        ]);
    }
}