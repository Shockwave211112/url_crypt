<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Links\Models\Group;
use App\Modules\Links\Models\Link;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

trait CrudTrait
{

    protected $model;
    protected $modelName;

    public function index()
    {
        $modelIndex = Cache::tags([$this->modelName, 'pagination'])
            ->remember($this->modelName . '-page-' . request('page', default: 1), now()->addMinutes(180),
                function () {
                    return $this->model::paginate(10);
                });

        return $modelIndex;
    }

    /**
     * @param User $user
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthException
     * @throws DataBaseException
     */
    public function store(User $user, array $data)
    {
        if ($this->modelName == 'Link') {
            do {
                $data['referral'] = Str::random(10);
                $referralInDb = Link::where('referral', $data['referral'])->first();
            } while (isset($referralInDb));

            if (!isset($data['group_id'])) {
                $group = Group::where('name', $user->name . ' Default')->first();
            } else {
                $group = Group::where('id', $data['group_id'])->first();
            }

            if (!$group->hasAccess($user)) {
                throw new AuthException('No rights to the specified group.', 403);
            }
        }

        $record = $this->model::create($data);

        if (isset($record)) {

            //USER
            if ($this->modelName == 'User') {
                $record->assignRole(User::BASIC_USER);

                $linkGroup = Group::create([
                    'name' => $record->name . ' Default',
                    'description' => 'Default group for user - ' . $record->name,
                ]);
                $linkGroup->users()->attach($record->id);
            }

            //LINK
            if ($this->modelName == 'Link') {
                $record->users()->attach($user->id);
                $record->groups()->attach($group->id);

                $group->count++;
                $group->update();
            }

            //GROUP
            if ($this->modelName == 'Group') {
                $record->users()->attach($user->id);
            }

            return response()->json([
                'message' => $this->modelName . ' added.'
            ]);
        }

        throw new DataBaseException(message: 'Something went wrong while adding a ' . $this->modelName . '.');
    }

    /**
     * @param User $user
     * @param $id
     * @return mixed
     * @throws DataBaseException
     */
    public function show(User $user, $id)
    {
        $record = Cache::tags($this->modelName)
            ->remember($this->modelName . ':' . $id, now()->addMinutes(180),
                function () use ($id) {
                    return $this->model::find($id);
                });

        if (isset($record)) {
            return $record;
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }

    /**
     * @param $id
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws DataBaseException
     */
    public function update(User $user, $id, $data)
    {
        $record = $this->model::find($id);

        if (isset($record)) {

            //LINK
            if ($this->modelName == 'Link' && isset($data['group_id'])) {
                $group = Group::where('id', $data['group_id'])->first();

                if (!$group->hasAccess($user)) {
                    throw new AuthException('You dont have permissions to this group.', 403);
                }

                $record->groups()->detach();

                $record->groups()->attach($data['group_id']);
            }

            //USER
            if ($this->modelName == 'User') $record->syncRoles($data['role_name']);

            $record->update($data);

            return response()->json([
                'message' => $this->modelName . ' updated.'
            ]);
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws DataBaseException
     */
    public function delete(User $user, int $id)
    {
        $record = $this->model::find($id);

        if (isset($record)) {
            if ($this->modelName == 'Link' || 'Group') {
                if (!$record->hasAccess($user)) {
                    throw new AuthException('You dont have permissions for this ' . $this->modelName);
                }
            }

            //GROUP
            if ($this->modelName == 'Group') {
                $defaultGroup = Group::where('name', $user->name . ' Default')->first();
                foreach ($record->links->all() as $link) {
                    $link->groups()->attach($defaultGroup->id);
                    $defaultGroup->count++;
                }
                $defaultGroup->update();
            }

            //LINK
            if ($this->modelName == 'Link') {
                foreach ($record->groups->all() as $group) {
                    $group->count--;
                    $group->update();
                }
            }

            $record->delete();

            return response()->json([
                'message' => $this->modelName . ' deleted.'
            ]);
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }
}
