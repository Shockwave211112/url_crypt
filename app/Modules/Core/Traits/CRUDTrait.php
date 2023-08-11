<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Exceptions\AuthException;
use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Links\Models\Group;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Cache;

trait CRUDTrait
{
    protected $repository;

    public function index()
    {
        return $this->repository->index();
    }

    public function store($data)
    {
        return $this->repository->store($data);
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
                $defaultGroup = $user->groups->first();

                if ($record->id === $defaultGroup->id) {
                    throw new DataBaseException('You cant delete default group.', 403);
                }
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
