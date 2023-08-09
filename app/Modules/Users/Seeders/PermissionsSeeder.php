<?php

namespace App\Modules\Users\Seeders;

use App\Modules\Links\Http\Controllers\GroupController;
use App\Modules\Links\Http\Controllers\LinkController;
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
            LinkController::class,
            GroupController::class
        ];

        foreach ($controllers as $controller) {
            foreach ($controller::$permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission['name'], 'description' => $permission['description']]);
            };
        }
    }
}
