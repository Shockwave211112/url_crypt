<?php

namespace App\Modules\Users\Seeders;

use App\Modules\Links\Models\Group;
use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => '11111111'
        ]);

        $admin->assignRole(User::ADMIN);

        $baseUser = User::factory()->create([
            'name' => 'user',
            'email' => 'basic@user.ru',
            'password' => '11111111'
        ]);

        $baseUser->assignRole(User::BASIC_USER);
    }
}
