<?php

namespace Database\Seeders;

use App\Modules\Users\Http\Controllers\UserController;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $controllers = [
            UserController::class,
        ];

        foreach ($controllers as $controller) {
            foreach ($controller::$permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission['name'], 'description' => $permission['description']]);
            };
        }
    }
}