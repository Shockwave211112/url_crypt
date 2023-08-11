<?php

namespace App\Modules\Links\Services;

use App\Modules\Core\CRUDRepository;
use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Core\Traits\CRUDTrait;
use App\Modules\Links\Jobs\LinkHit;
use App\Modules\Links\Models\Group;
use App\Modules\Links\Models\Link;
use App\Modules\Users\Models\User;
use Illuminate\Support\Str;

class LinkService
{
    use CRUDTrait;

    public function __construct()
    {
        $this->repository = new CRUDRepository(new Link());
    }

    /**
     * Учёт перехода по ссылке
     *
     * @param string $referral
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws DataBaseException
     */
    public function referral(string $referral)
    {
        $link = Link::where('referral', $referral)->first();

        if (!isset($link)) {
            throw new DataBaseException('Link not found.', 404);
        }

        dispatch(new LinkHit($link));

        return redirect($link->origin);
    }

    /**
     * Проверяет возможность добавления ссылки в указанную группу пользователем
     *
     * @param User $user
     * @param $data
     * @return void
     * @throws AuthException
     * @throws DataBaseException
     */
    public function checkStorePermissions(User $user, $data)
    {
        if (!in_array($data['group_id'], $user->groups->pluck('id')->toArray())) {
            throw new AuthException('You dont have permissions to add link in this group.', 403);
        }

        if ($user->groups->sum('count') >= 500) {
            throw new DataBaseException('Maximum of links count reached.', 403);
        }

        if ($user->groups->where('id', $data['group_id'])->first()->count >= 100) {
            throw new DataBaseException('Please select other group. Max count of links reached.', 403);
        }
    }

    /**
     * Генерирует уникальную строку для ссылки
     *
     * @return string
     */
    public function generateReferral()
    {
        do {
            $referral = Str::random(10);
            $referralInDb = Link::where('referral', $referral)->first();
        } while (isset($referralInDb));

        return $referral;
    }

    /**
     * @param int $group_id
     * @return void
     */
    public function storeToGroup(int $group_id)
    {
        $group = Group::where('id', $group_id)->first();
        $group->count++;
        $group->update();
    }
}
