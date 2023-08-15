<?php

namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Core\Traits\PermissionsTrait;
use App\Modules\Users\Http\Requests\StoreRequest;
use App\Modules\Users\Http\Requests\UpdateRequest;
use App\Modules\Users\Models\User;
use App\Modules\Users\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use PermissionsTrait;

    public static $permissions = [
        ['name' => 'user--list', 'description' => 'Viewing a list of users'],
        ['name' => 'user--create', 'description' => 'Creating a new user'],
        ['name' => 'user--update', 'description' => 'Editing user data'],
        ['name' => 'user--delete', 'description' => 'Deleting a user'],
        ['name' => 'user--show', 'description' => 'User information by ID'],
        ['name' => 'user--info', 'description' => 'Information about the authorized user'],
    ];

    public function __construct()
    {
        $this->__constructPermissions();
    }

    /**
     * @PermissionGuard user--list
     * @param UserService $service
     * @return mixed
     */
    public function index(UserService $service)
    {
        return $service->index();
    }

    /**
     * @PermissionGuard user--create
     * @param StoreRequest $request
     * @param UserService $service
     * @return JsonResponse
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function store(StoreRequest $request, UserService $service)
    {
        $data = $request->validated();
        if (!isset($data['role_id'])) {
            $data['role_id'] = 2;
        }

        return $service->store($data);
    }

    /**
     * @PermissionGuard user--show
     * @param int $id
     * @param UserService $service
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function show(int $id, UserService $service)
    {
        return $service->show($id);
    }

    /**
     * @PermissionGuard user--info
     * @param UserService $service
     * @return User
     */
    public function getInfo(UserService $service)
    {
        return $service->getInfo(auth()->user());
    }

    /**
     * @PermissionGuard user--update
     * @param int $id
     * @param UpdateRequest $request
     * @param UserService $service
     * @return JsonResponse
     */
    public function put(int $id, UpdateRequest $request, UserService $service)
    {
        $data = $request->validated();
        if (isset($data['role_id'])) {
            $relations = [
                'roles' => $data['role_id']
            ];
            unset($data['role_id']);
        }
        else $relations = [];

        return $service->put($id, $data, $relations);
    }
    /**
     * @PermissionGuard user--update
     * @param int $id
     * @param UpdateRequest $request
     * @param UserService $service
     * @return JsonResponse
     */
    public function patch(int $id, UpdateRequest $request, UserService $service)
    {
        $data = $request->validated();
        if (isset($data['role_id'])) {
            $relations = [
                'roles' => $data['role_id']
            ];
            unset($data['role_id']);
        }
        else $relations = [];

        return $service->patch($id, $data, $relations);
    }

    /**
     * @PermissionGuard user--delete
     * @param int $id
     * @param UserService $service
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function delete(int $id, UserService $service)
    {
        return $service->delete($id);
    }
}
