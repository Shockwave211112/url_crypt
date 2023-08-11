<?php

namespace App\Modules\Links\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Core\Traits\PermissionsTrait;
use App\Modules\Links\Http\Requests\LinkStoreRequest;
use App\Modules\Links\Http\Requests\LinkUpdateRequest;
use App\Modules\Links\Services\LinkService;

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
        }

        $service->checkStorePermissions($user, $data);

        $service->storeToGroup($data['group_id']);

        return $service->store($data);
    }

    /**
     * @PermissionGuard link--show
     * @param int $id
     * @param LinkService $service
     * @return Object
     * @throws DataBaseException
     */
    public function show(int $id, LinkService $service)
    {
        return $service->show(auth()->user(), $id);
    }

    /**
     * @PermissionGuard link--update
     * @param int $id
     * @param LinkUpdateRequest $request
     * @param LinkService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function update(int $id, LinkUpdateRequest $request, LinkService $service)
    {
        return $service->update(auth()->user(), $id, $request->validated());
    }

    /**
     * @PermissionGuard link--delete
     * @param int $id
     * @param LinkService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function delete(int $id, LinkService $service)
    {
        return $service->delete(auth()->user(), $id);
    }

    /**
     * @param string $referral
     * @param LinkService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \App\Modules\Core\Exceptions\DataBaseException
     */
    public function referral(string $referral, LinkService $service)
    {
        return $service->referral($referral);
    }
}
