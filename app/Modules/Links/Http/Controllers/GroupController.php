<?php

namespace App\Modules\Links\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Traits\PermissionsTrait;
use App\Modules\Links\Http\Requests\GroupPatchRequest;
use App\Modules\Links\Http\Requests\GroupStoreRequest;
use App\Modules\Links\Http\Requests\GroupPutRequest;
use App\Modules\Links\Services\GroupService;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    use PermissionsTrait;

    public static $permissions = [
        ['name' => 'group--list', 'description' => 'Viewing a list of group'],
        ['name' => 'group--create', 'description' => 'Creating a new group'],
        ['name' => 'group--put', 'description' => 'Editing group data'],
        ['name' => 'group--patch', 'description' => 'Partial editing group data'],
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
     * @return JsonResponse
     */
    public function store(GroupStoreRequest $request, GroupService $service)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        return $service->store($data);
    }

    /**
     * @PermissionGuard group--show
     * @param int $id
     * @param GroupService $service
     * @return JsonResponse
     * @throws \App\Modules\Core\Exceptions\AuthException
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function show(int $id, GroupService $service)
    {
        $service->exists($id);
        $service->hasAccess(auth()->user(), $id);

        return $service->show(auth()->user(), $id);
    }

    /**
     * @PermissionGuard group--put
     * @param int $id
     * @param GroupPutRequest $request
     * @param GroupService $service
     * @return JsonResponse
     * @throws \App\Modules\Core\Exceptions\AuthException
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function put(int $id, GroupPutRequest $request, GroupService $service)
    {
        $service->exists($id);
        $service->hasAccess(auth()->user(), $id);

        return $service->put($id, $request->validated());
    }

    /**
     * @PermissionGuard group--patch
     * @param int $id
     * @param GroupPatchRequest $request
     * @param GroupService $service
     * @return JsonResponse
     * @throws \App\Modules\Core\Exceptions\AuthException
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function patch(int $id, GroupPatchRequest $request, GroupService $service)
    {
        $service->exists($id);
        $service->hasAccess(auth()->user(), $id);

        return $service->patch($id, $request->validated());
    }

    /**
     * @PermissionGuard group--delete
     * @param int $id
     * @param GroupService $service
     * @return JsonResponse
     * @throws \App\Modules\Core\Exceptions\AuthException
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function delete(int $id, GroupService $service)
    {
        $service->exists($id);
        $service->hasAccess(auth()->user(), $id);

        return $service->delete($id);
    }
}
