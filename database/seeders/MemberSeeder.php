<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        // Mwanakwaya wa 1
        Member::create([
            'full_name' => 'Getruda Gervas Mfinanga',
            'registration_number' => 'UDOM/CIVE/2023/001',
            'voice_part' => 'Soprano',
            'course' => 'BSc. in Information Systems',
            'is_active' => true
        ]);

        // Mwanakwaya wa 2
        Member::create([
            'full_name' => 'John Doe',
            'registration_number' => 'UDOM/CIVE/2023/002',
            'voice_part' => 'Tenor',
            'course' => 'BSc. in Computer Science',
            'is_active' => true
        ]);

        // Mwanakwaya wa 3
        Member::create([
            'full_name' => 'Maria Joseph',
            'registration_number' => 'UDOM/CIVE/2022/015',
            'voice_part' => 'Alto',
            'course' => 'BSc. in Software Engineering',
            'is_active' => true
        ]);

        // Mwanakwaya wa 4 (Mfano wa Alumni)
        Member::create([
            'full_name' => 'Peter Kayanda',
            'registration_number' => 'UDOM/CIVE/2020/088',
            'voice_part' => 'Bass',
            'course' => 'BSc. in Computer Engineering',
            'is_active' => false
        ]);
    }
}