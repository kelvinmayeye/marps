<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\ExamType;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::updateOrCreate(
            ['name' => 'admin'],
            [
                'is_active' => 1,
            ]
        );
        Role::updateOrCreate(
            ['name' => 'general user'],
            [
                'is_active' => 1,
            ]
        );

        User::updateOrCreate(
            ['username' => 'admin'], // Unique identifying field(s)
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123'),
                'role_id' => 1,
            ]
        );

        $examTypes = [
            'Mock', 'Mid Term', 'End Term', 'Continuous Assessment Test(CAT)', 'Weekly Test',
            'Opener', 'Formative', 'Summative'
        ];

        foreach ($examTypes as $type) {
            ExamType::updateOrCreate(
                ['name' => $type],
                ['name' => $type] // You can add additional fields here if needed
            );
        }

        $permissions = [
            'users' => ['accept_user', 'reject', 'resend_token'],
            'subject' => ['add_subject', 'delete_subject'],
            'classes' => ['add_classes', 'add_classes'],
        ];

        foreach ($permissions as $group => $names) {
            foreach (array_unique($names) as $name) {
                Permission::updateOrCreate(
                    ['name' => $name, 'group' => $group],
                    ['name' => $name, 'group' => $group]
                );
            }
        }
    }

}
