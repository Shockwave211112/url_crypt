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
            'password' => '111111'
        ]);

        $admin->assignRole('admin');
    }
}
