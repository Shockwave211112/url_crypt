<?php

namespace App\Modules\Links\Services;

use App\Modules\Core\CRUDRepository;
use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Core\Traits\CRUDTrait;
use App\Modules\Links\Models\Group;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class GroupService
{
    use CRUDTrait;

    public function __construct()
    {
        $this->repository = new CRUDRepository(new Group());
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasExactRoles(User::ADMIN)) return $this->repository->index();
        else return Cache::tags(['User:' . $user->id, 'Link', 'pagination'])
                ->remember($user->id . '-Link-page-' . request('page', default: 1), now()->addMinutes(180),
                    fn () => $user->groups->forPage(request('page', default: 1), 10));
    }
    /**
     * Проверка существования группы
     *
     * @param int $id
     * @return void
     * @throws DataBaseException
     */
    public function exists(int $id)
    {
        $group = Group::find($id);

        if (!$group) throw new DataBaseException('Group not found.', 404);
    }

    /**
     * Проверяет наличие связи между группой и пользователем
     *
     * @param User $user
     * @param int $id
     * @return void
     * @throws AuthException
     */
    public function hasAccess(User $user, int $id)
    {
        if (!in_array($id, $user->groups->pluck('id')->toArray()))
            throw new AuthException('You dont have permissions to interact with this group.', 403);
    }

    public function canStore(User $user)
    {
        if ($user->groups->sum('count') >= config('constants.env.groups_per_user'))
            throw new DataBaseException('Maximum of groups count reached.', 403);
    }
}
