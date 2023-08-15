<?php

namespace App\Modules\Links\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Core\Traits\PermissionsTrait;
use App\Modules\Links\Http\Requests\LinkPatchRequest;
use App\Modules\Links\Http\Requests\LinkPutRequest;
use App\Modules\Links\Http\Requests\LinkStoreRequest;
use App\Modules\Links\Services\GroupService;
use App\Modules\Links\Services\LinkService;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    use PermissionsTrait;

    public static $permissions = [
        ['name' => 'link--list', 'description' => 'Viewing a list of links'],
        ['name' => 'link--create', 'description' => 'Creating a new link'],
        ['name' => 'link--update', 'description' => 'Editing link data'],
        ['name' => 'link--delete', 'description' => 'Deleting a link'],
        ['name' => 'link--show', 'description' => 'Link information by ID']
    ];

    public function __construct()
    {
        $this->__constructPermissions();
    }

    /**
     * @PermissionGuard link--list
     * @param LinkService $service
     * @return mixed
     */
    public function index(LinkService $service)
    {
        return $service->index();
    }

    /**
     * @PermissionGuard link--create
     * @param LinkStoreRequest $request
     * @param LinkService $service
     * @return mixed
     * @throws AuthException
     * @throws DataBaseException
     */
    public function store(LinkStoreRequest $request, LinkService $service)
    {
        $user = auth()->user();
        $data = $request->validated();

        $data['user_id'] = $user->id;
        $data['referral'] = $service->generateReferral();

        if (!isset($data['group_id'])) {
            $data['group_id'] = $user->groups->where('name', 'like', '%Default')->first()->id;
        } else $service->checkStorePermissions($user, $data);

        $service->groupCountIncrement($data['group_id']);

        return $service->store($data);
    }

    /**
     * @PermissionGuard link--show
     * @param int $id
     * @param LinkService $service
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function show(int $id, LinkService $service)
    {
        $service->hasAccess(auth()->user(), $id);

        return $service->show($id);
    }

    /**
     * @PermissionGuard link--update
     * @param int $id
     * @param LinkPutRequest $request
     * @param LinkService $linkService
     * @param GroupService $groupService
     * @return JsonResponse
     * @throws AuthException
     */
    public function put(int $id, LinkPutRequest $request, LinkService $linkService, GroupService $groupService)
    {
        $data = $request->validated();

        if (isset($data['group_id'])) {
            foreach ($data['group_id'] as $groupId) {
                $groupService->hasAccess(auth()->user(), $groupId);
            }

            $relations = [
                'groups' => $data['group_id']
            ];
            unset($data['group_id']);
        }
        else $relations = [];

        return $linkService->put($id, $data, $relations);
    }

    /**
     * @PermissionGuard link--update
     * @param int $id
     * @param LinkPatchRequest $request
     * @param LinkService $linkService
     * @param GroupService $groupService
     * @return JsonResponse
     * @throws AuthException
     */
    public function patch(int $id, LinkPatchRequest $request, LinkService $linkService, GroupService $groupService)
    {
        $data = $request->validated();

        if (isset($data['group_id'])) {
            foreach ($data['group_id'] as $groupId) {
                $groupService->hasAccess(auth()->user(), $groupId);
            }

            $relations = [
                'groups' => $data['group_id']
            ];
            unset($data['group_id']);
        }
        else $relations = [];

        return $linkService->patch($id, $data, $relations);
    }

    /**
     * @PermissionGuard link--delete
     * @param int $id
     * @param LinkService $service
     * @return JsonResponse
     * @throws AuthException
     */
    public function delete(int $id, LinkService $service)
    {
        $service->hasAccess(auth()->user(), $id);

        $service->groupsDecrement($id);

        return $service->delete($id);
    }

    /**
     * @param string $referral
     * @param LinkService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws DataBaseException
     */
    public function referral(string $referral, LinkService $service)
    {
        return $service->referral($referral);
    }
}
