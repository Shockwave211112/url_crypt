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

        if(!$permissions) {
            throw new DataBaseException('Unknown error.', 422);
        }

        return $permissions;
    }

    public function show(int $id)
    {
        $permission = Permission::find($id);

        if(!$permission) {
            throw new DataBaseException('Permission not found.', 404);
        }

        return $permission;
    }

    public function sync(array $data)
    {
        $role = Role::where('id', $data['role_id'])->first();

        $role->syncPermissions($data['permissions']);

        return response()->json([
            'message' => 'Permissions setted.',
        ]);
    }
}
