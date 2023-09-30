<?php

namespace App\Modules\Links\Services;

use App\Modules\Core\CRUDRepository;
use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Core\Traits\CRUDTrait;
use App\Modules\Links\Jobs\LinkHit;
use App\Modules\Links\Models\Group;
use App\Modules\Links\Models\Link;
use App\Modules\Links\Models\LinkStatistic;
use App\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LinkService
{
    use CRUDTrait;

    public function __construct()
    {
        $this->repository = new CRUDRepository(new Link());
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasExactRoles(User::ADMIN)) return $this->repository->index();
        else {
            return Cache::tags(['User:' . $user->id, 'Link', 'pagination'])
                ->remember($user->id . '-Link-page-' . request('page', default: 1), now()->addMinutes(180),
                    fn() => $user->links->forPage(request('page', default: 1), 10));
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function show(int $id, Request $request)
    {
        $link = Cache::tags('Link')
            ->remember('Link:' . $id, now()->addMinutes(180),
                fn() => Link::find($id));

        if ($link) {
            Cache::tags('Referral')->put("Link:" . $link->referral, now()->addMinutes(180));
            $linkStat = $link->stats();

            if (isset($request['sort'])) $sortType = $request['sort'];
            else $sortType = "asc";

            if (isset($request['by'])) {
                if (in_array($request['by'], ['day', 'month', 'year']))
                    $linkStat->orderByRaw("EXTRACT (" . $request['by'] . " FROM date) " . $sortType);
                elseif ($request['by'] == 'hits')
                    $linkStat->orderBy('hits', $sortType);
            }
            else    $linkStat->orderBy('date', $sortType);

            return response()->json([
                'entity' => $link,
                'stats' => $linkStat->get()
            ]);
        }
        throw new DataBaseException(message: 'Link not found.', status: 404);
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
        $link = Cache::tags('Referral')
            ->remember('Link:' . $referral, now()->addMinutes(180),
                fn() => Link::where('referral', $referral)->first());

        if (!$link) throw new DataBaseException('Link not found.', 404);

        dispatch(new LinkHit($link));

        return redirect($link->origin);
    }

    /**
     * Проверяет возможность добавления ссылки в указанную группу пользователем
     *
     * @param User $user
     * @param array $data
     * @return void
     * @throws AuthException
     * @throws DataBaseException
     */
    public function checkStorePermissions(User $user, array $data)
    {
        if (!$user->hasExactRoles(User::ADMIN)) {
            foreach ($data['group_id'] as $data_group) {
                if (!in_array($data_group, $user->groups->pluck('id')->toArray()))
                    throw new AuthException('You dont have permissions to add link in this group.', 403);

                if ($user->groups->where('id', $data_group)->first()->count >= config('constants.env.links_per_group'))
                    throw new DataBaseException('Please select other group. Max count of links reached.', 403);
            }

            if ($user->links->sum('count') >= config('constants.env.links_per_user'))
                throw new DataBaseException('Maximum of links count reached.', 403);
        }
    }

    /**
     * Проверка существования ссылки
     *
     * @param int $id
     * @return void
     * @throws DataBaseException
     */
    public function exists(int $id)
    {
        $link = Link::find($id);

        if (!$link) {
            throw new DataBaseException('Link not found.', 404);
        }
    }

    /**
     * Проверяет наличие связи между ссылкой и пользователем
     *
     * @param User $user
     * @param int $id
     * @return void
     * @throws AuthException
     */
    public function hasAccess(User $user, int $id)
    {
        if (!in_array($id, $user->links->pluck('id')->toArray()))
            throw new AuthException('You dont have permissions to interact with this link.', 403);
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
        } while ($referralInDb);

        return $referral;
    }

    /**
     * Увеличить счётчик у групп с указанным ID
     *
     * @param int $group_id
     * @return void
     */
    public function groupCountIncrement(int $group_id)
    {
        $group = Group::where('id', $group_id)->first();
        $group->count++;
        $group->update();
    }

    /**
     * Уменьшить счётчик у группы с указанным ID
     *
     * @param int $group_id
     * @return void
     */
    public function groupCountDecrement(int $group_id)
    {
        $group = Group::where('id', $group_id)->first();
        $group->count--;
        $group->update();
    }

    /**
     * Уменьшить счётчик у групп с указанной ссылкой
     *
     * @param int $linkId
     * @return void
     */
    public function groupsDecrement(int $linkId)
    {
        $groups = Group::whereHas('links', function ($query) use ($linkId) {
            $query->where('link_id', $linkId);
        })->get();

        foreach ($groups as $group) {
            $group->count--;
            $group->update();
        }
    }

    /**
     * Изменение счётчика у групп в связи с обновлением данных у ссылки
     *
     * @param int $linkId
     * @param array $groups
     * @return void
     */
    public function groupsUpdate(int $linkId, array $groups)
    {
        if (count($groups)) {
            $original = Link::where('id', $linkId)->first()->groups;

            foreach ($original as $group) {
                if (!in_array($group->id, $groups)) {
                    $this->groupCountDecrement($group->id);
                };
            }

            foreach ($groups as $newGroup) {
                if (!in_array($newGroup, $original->pluck('id')->toArray())) {
                    $this->groupCountIncrement($newGroup);
                };
            }
        }
    }
}
