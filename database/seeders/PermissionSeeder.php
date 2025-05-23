<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_permissions')->truncate();
        DB::table('permissions')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = [
            'users' => ['accept_user', 'all_users', 'all_users_request', 'roles_permission', 'resend_token'],
            'subject' => ['add_subject', 'delete_subject', 'subject_list'],
            'classes' => ['add_classes', 'list_classes'],
            'examination' => ['exam_list'],
            'settings' => ['general_settings'],
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
