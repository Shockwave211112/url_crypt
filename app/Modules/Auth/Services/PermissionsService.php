<?php

namespace App\Modules\Auth\Services;

use App\Modules\Core\Exceptions\DataBaseException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsService
{
    public function index()
    {
        $permissions = Permission::all();

        if(!isset($permissions)) {
            throw new DataBaseException('Unknown error.', 422);
        }

        return $permissions;
    }

    public function show(int $id)
    {
        $permission = Permission::where('id', $id)->first();

        if(!isset($permission)) {
            throw new DataBaseException('Permission not found.', 404);
        }

        return $permission;
    }

    public function sync(array $data)
    {
        $role = Role::where('id', $data['role_id'])->first();

        $permissions = Permission::whereIn('id', $data['permissions'])->get();

        $permissionsNames = $permissions->map(function ($permissions) {
            return collect($permissions->toArray())
                ->only('name')
                ->all();
        });
        dd($permissionsNames);
        $role->syncPermissions($permissionsNames);
//        $role->givePermissionTo();
        return $permissions;
    }
}
