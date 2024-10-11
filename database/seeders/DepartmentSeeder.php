<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'departmentName' => 'Computer Science',
                'facultyId' => '1',
            ],
            [
                'departmentName' => 'Software Engineering',
                'facultyId' => '1',
            ],
            ] ) ;
    }
}
