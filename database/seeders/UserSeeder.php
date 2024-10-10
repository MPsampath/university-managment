<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'ADMIN', // Assigning the admin role
        ]);

        User::create([
            'name' => 'Academic Head User',
            'email' => 'academic@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'ACADEMIC_HEAD', // Assigning the academic head role
        ]);

        User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'STUDENT', // Assigning the academic head role
        ]);

        User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'TEACHER', // Assigning the academic head role
        ]);
    }
}
