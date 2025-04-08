<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\ExamType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        User::create([
            'name'=>'admin',
            'username'=>'admin',
            'email' => 'admin@admin.com',
            'password'=>bcrypt('123')
        ]);

        //add examination types
        ExamType::truncate();
        $examTypes = [
            'Mock', 'Mid Term', 'End Term', 'Continuous Assessment Test(CAT)', 'Weekly Test',
            'Opener', 'Formative', 'Summative'
        ];

        foreach ($examTypes as $type) {
            ExamType::create(['name' => $type]);
        }
    }
}
