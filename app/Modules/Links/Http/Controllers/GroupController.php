<?php

namespace App\Modules\Links\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Traits\PermissionsTrait;
use App\Modules\Links\Http\Requests\GroupStoreRequest;
use App\Modules\Links\Http\Requests\GroupUpdateRequest;
use App\Modules\Links\Services\GroupService;

class GroupController extends Controller
{
    use PermissionsTrait;

    public static $permissions = [
        ['name' => 'group--list', 'description' => 'Viewing a list of group'],
        ['name' => 'group--create', 'description' => 'Creating a new group'],
        ['name' => 'group--update', 'description' => 'Editing group data'],
        ['name' => 'group--delete', 'description' => 'Deleting a group'],
        ['name' => 'group--show', 'description' => 'Group information by ID']
    ];

    public function __construct()
    {
        $this->__constructPermissions();
    }

    /**
     * @PermissionGuard group--list
     * @param GroupService $service
     * @return mixed
     */
    public function index(GroupService $service)
    {
        return $service->index();
    }

    /**
     * @PermissionGuard group--create
     * @param GroupStoreRequest $request
     * @param GroupService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function store(GroupStoreRequest $request, GroupService $service)
    {
        return $service->store(auth()->user(), $request->validated());
    }

    /**
     * @PermissionGuard group--show
     * @param int $id
     * @param GroupService $service
     * @return Object
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function show(int $id, GroupService $service)
    {
        return $service->show(auth()->user(), $id);
    }

    /**
     * @PermissionGuard group--update
     * @param int $id
     * @param GroupUpdateRequest $request
     * @param GroupService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function update(int $id, GroupUpdateRequest $request, GroupService $service)
    {
        return $service->update(auth()->user(), $id, $request->validated());
    }

    /**
     * @PermissionGuard group--delete
     * @param int $id
     * @param GroupService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function delete(int $id, GroupService $service)
    {
        return $service->delete(auth()->user(), $id);
    }
}
