<?php

namespace App\Modules\Links\Services;

use App\Modules\Core\CRUDRepository;
use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Traits\CRUDTrait;
use App\Modules\Links\Models\Group;
use App\Modules\Users\Models\User;

class GroupService
{
    use CRUDTrait;

    public function __construct()
    {
        $this->repository = new CRUDRepository(new Group());
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
        if (!in_array($id, $user->groups->pluck('id')->toArray())) {
            throw new AuthException('You dont have permissions to interact with this group.', 403);
        }
    }
}
