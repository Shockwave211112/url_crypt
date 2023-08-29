<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\RolePermissionsRequest;
use App\Modules\Auth\Services\PermissionsService;

class PermissionsController extends Controller
{

    public function index(PermissionsService $service)
    {
        return $service->index();
    }

    public function show(int $id, PermissionsService $service)
    {
        return $service->show($id);
    }

    public function sync(RolePermissionsRequest $request, PermissionsService $service)
    {
        return $service->sync($request->validated());
    }

}
