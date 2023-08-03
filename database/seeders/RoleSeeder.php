<?php

namespace Database\Seeders;

use App\Modules\Users\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['id' => 1, 'name' => Role::UNVERIFIED_USER]);
        Role::firstOrCreate(['id' => 2, 'name' => Role::USER]);
        Role::firstOrCreate(['id' => 3, 'name' => Role::ADMIN]);
    }
}
