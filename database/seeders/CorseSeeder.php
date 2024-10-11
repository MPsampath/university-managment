<?php

namespace Database\Seeders;

use App\Models\Corses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Corses::create([
            'name' => 'Computer Science',
            'seo_url' => 'computer-science',
            'status' => 'publish',
            'category' => 'science',
            'facultyId' => '1',
        ]);

        Corses::create([
            'name' => 'Software Engineering',
            'seo_url' => 'software-engineering',
            'status' => 'publish',
            'category' => 'science',
            'facultyId' => '1',
        ]);
    }
}
