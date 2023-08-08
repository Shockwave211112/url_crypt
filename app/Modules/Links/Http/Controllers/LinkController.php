<?php

namespace App\Modules\Links\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Links\Services\LinkService;
use App\Modules\Links\Http\Requests\StoreRequest;
use App\Modules\Links\Http\Requests\UpdateRequest;
use App\Traits\PermissionsTrait;

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
     * @param StoreRequest $request
     * @param LinkService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function store(StoreRequest $request, LinkService $service)
    {
        return $service->store(auth()->user(), $request->validated());
    }

    /**
     * @PermissionGuard link--show
     * @param int $id
     * @param LinkService $service
     * @return Object
     * @throws \App\Exceptions\DataBaseException
     */
    public function show(int $id, LinkService $service)
    {
        return $service->show($id);
    }

    /**
     * @PermissionGuard link--update
     * @param int $id
     * @param UpdateRequest $request
     * @param LinkService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function update(int $id, UpdateRequest $request, LinkService $service)
    {
        return $service->update($id, $request->validated());
    }

    /**
     * @PermissionGuard link--delete
     * @param int $id
     * @param LinkService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function delete(int $id, LinkService $service)
    {
        return $service->delete($id);
    }

    /**
     * @param string $referral
     * @param LinkService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \App\Exceptions\DataBaseException
     */
    public function referral(string $referral, LinkService $service)
    {
        return $service->referral($referral);
    }
}
