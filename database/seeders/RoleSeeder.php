<?php

namespace Database\Seeders;

use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate([
            'id' => 1,
            'name' => User::ADMIN,
            'guard_name' => 'web',
            'description' => 'Никаких ограничений',
            'is_default' => 0
        ]);

        $user = Role::firstOrCreate([
            'id' => 2,
            'name' => User::BASIC_USER,
            'guard_name' => 'web',
            'description' => 'Ограничения на создание групп и ссылок',
            'is_default' => 1
        ]);
    }
}
