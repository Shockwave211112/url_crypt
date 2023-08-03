<?php

namespace Database\Seeders;

use App\Modules\Users\Models\Role;
use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'login' => 'admin',
            'first_name' => '111',
            'last_name' => '222',
            'email' => 'admin@admin.ru',
            'password' => '111111',
            'role_id' => Role::where('name', Role::ADMIN)->first()->id
        ]);
    }
}
