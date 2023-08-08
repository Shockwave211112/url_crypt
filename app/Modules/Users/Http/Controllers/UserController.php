<?php

namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Http\Requests\StoreRequest;
use App\Modules\Users\Http\Requests\UpdateRequest;
use App\Modules\Users\Models\User;
use App\Modules\Users\Services\UserService;
use App\Traits\PermissionsTrait;

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
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function store(StoreRequest $request, UserService $service)
    {
        return $service->store(auth()->user(), $request->validated());
    }

    /**
     * @PermissionGuard user--show
     * @param int $id
     * @param UserService $service
     * @return User
     * @throws \App\Exceptions\DataBaseException
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function update(int $id, UpdateRequest $request, UserService $service)
    {
        return $service->update($id, $request->validated());
    }

    /**
     * @PermissionGuard user--delete
     * @param int $id
     * @param UserService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function delete(int $id, UserService $service)
    {
        return $service->delete($id);
    }
}
