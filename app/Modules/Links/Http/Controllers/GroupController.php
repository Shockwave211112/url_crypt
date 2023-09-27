<?php

namespace App\Modules\Links\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Exceptions\DataBaseException;
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
     * @OA\Get(
     *     path="/groups",
     *     summary="Get paginated list of groups.",
     *     description="If admin, shows all existing ones. If a user, then only his groups.",
     *     tags={"Groups"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *          response=200, description="Paginated list.",
     *          @OA\JsonContent(ref="#/components/schemas/GroupsListPaginated")
     *      ),
     *     @OA\Response(response=401, description="Unauthenticated."),
     *     @OA\Response(response=403, description="Permissions error.")
     * )
     * @PermissionGuard group--list
     * @param GroupService $service
     * @return mixed
     */
    public function index(GroupService $service)
    {
        return $service->index();
    }

    /**
     * @OA\Post(
     *     path="/groups",
     *     summary="Create new group.",
     *     tags={"Groups"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/StoreGroupRequest")
     *             )
     *      ),
     *     @OA\Response(
     *          response=200, description="Paginated list.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Info message."),
     *              @OA\Property(property="entity", ref="#/components/schemas/Group"))
     *      ),
     *     @OA\Response(response=401, description="Unauthenticated."),
     *     @OA\Response(response=403, description="Permissions error."),
     *     @OA\Response(response=422, description="Validation error."),
     * )
     * @PermissionGuard group--create
     * @param GroupStoreRequest $request
     * @param GroupService $service
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function store(GroupStoreRequest $request, GroupService $service)
    {
        $user = auth()->user();
        $service->canStore($user);

        $data = $request->validated();
        $data['user_id'] = $user->id;

        return $service->store($data);
    }

    /**
     * @OA\Get(
     *     path="/groups/{id}",
     *     summary="Show group by id.",
     *     tags={"Groups"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *          description="ID of group.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1"
     *      ),
     *     @OA\Response(
     *          response=200, description="Group object.",
     *          @OA\JsonContent(
     *              @OA\Property(property="entity", ref="#/components/schemas/Group"))
     *      ),
     *     @OA\Response(response=401, description="Unauthenticated."),
     *     @OA\Response(response=403, description="Permissions error."),
     *     @OA\Response(response=404, description="User not found."),
     * )
     * @PermissionGuard group--show
     * @param int $id
     * @param GroupService $service
     * @return JsonResponse
     * @throws AuthException
     * @throws DataBaseException
     */
    public function show(int $id, GroupService $service)
    {
        $service->exists($id);
        $service->hasAccess(auth()->user(), $id);

        return $service->show($id);
    }

    /**
     * @OA\Put(
     *     path="/groups/{id}",
     *     summary="Update all group data.",
     *     tags={"Groups"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *          description="ID of group.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1"
     *      ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/PutGroupRequest")
     *             )
     *      ),
     *     @OA\Response(
     *          response=200, description="Group updated.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Info message."),
     *              @OA\Property(property="entity", ref="#/components/schemas/Group"),
     *              @OA\Property(property="old_entity", ref="#/components/schemas/Group"))
     *      ),
     *     @OA\Response(response=401, description="Unauthenticated."),
     *     @OA\Response(response=403, description="Permissions error."),
     *     @OA\Response(response=404, description="Group not found."),
     *     @OA\Response(response=422, description="Validation error."),
     * )
     * @PermissionGuard group--put
     * @param int $id
     * @param GroupPutRequest $request
     * @param GroupService $service
     * @return JsonResponse
     * @throws AuthException
     * @throws DataBaseException
     */
    public function put(int $id, GroupPutRequest $request, GroupService $service)
    {
        $service->exists($id);
        $service->hasAccess(auth()->user(), $id);

        return $service->put($id, $request->validated());
    }

    /**
     *  @OA\Patch(
     *     path="/groups/{id}",
     *     summary="Partly update group data.",
     *     tags={"Groups"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *          description="ID of group.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1"
     *      ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/PatchGroupRequest")
     *             )
     *      ),
     *     @OA\Response(
     *          response=200, description="Group updated.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Info message."),
     *              @OA\Property(property="entity", ref="#/components/schemas/Group"),
     *              @OA\Property(property="old_entity", ref="#/components/schemas/Group"))
     *      ),
     *     @OA\Response(response=401, description="Unauthenticated."),
     *     @OA\Response(response=403, description="Permissions error."),
     *     @OA\Response(response=404, description="Group not found."),
     *     @OA\Response(response=422, description="Validation error."),
     * )
     * @PermissionGuard group--patch
     * @param int $id
     * @param GroupPatchRequest $request
     * @param GroupService $service
     * @return JsonResponse
     * @throws AuthException
     * @throws DataBaseException
     */
    public function patch(int $id, GroupPatchRequest $request, GroupService $service)
    {
        $service->exists($id);
        $service->hasAccess(auth()->user(), $id);

        return $service->patch($id, $request->validated());
    }

    /**
     * @OA\Delete(
     *     path="/groups/{id}",
     *     summary="Delete group.",
     *     tags={"Groups"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *          description="ID of group.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1"
     *      ),
     *     @OA\Response(
     *          response=200, description="Group deleted.",
     *          @OA\JsonContent(ref="#/components/schemas/MessageResponse")
     *      ),
     *     @OA\Response(response=401, description="Unauthenticated."),
     *     @OA\Response(response=403, description="Permissions error."),
     *     @OA\Response(response=404, description="Group not found."),
     * )
     * @PermissionGuard group--delete
     * @param int $id
     * @param GroupService $service
     * @return JsonResponse
     * @throws AuthException
     * @throws DataBaseException
     */
    public function delete(int $id, GroupService $service)
    {
        $service->exists($id);
        $service->hasAccess(auth()->user(), $id);

        return $service->delete($id);
    }
}
