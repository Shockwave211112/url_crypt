<?php

namespace App\Traits;

use App\Exceptions\DataBaseException;
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
     * @throws DataBaseException
     */
    public function store(User $user, array $data)
    {
        if ($this->modelName == 'Link') {
            do {
                $data['referral'] = Str::random(10);
                $referralInDb = Link::where('referral', $data['referral'])->first();
            } while (isset($referralInDb));
        }

        $record = $this->model::create($data);

        if (isset($record)) {
            if ($this->modelName == 'User') $record->assignRole(User::BASIC_USER);
            if ($this->modelName == 'Link') $record->users()->attach($user->id);
            return response()->json([
                'message' => $this->modelName . ' added.'
            ]);
        }

        throw new DataBaseException(message: 'Something went wrong while adding a ' . $this->modelName . '.');
    }

    /**
     * @param $id
     * @return Object
     * @throws DataBaseException
     */
    public function show($id)
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
    public function update($id, $data)
    {
        $record = $this->model::find($id);

        if (isset($record)) {
            $record->update($data);
            if ($this->modelName == 'User') $record->syncRoles($data['role_name']);

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
    public function delete(int $id)
    {
        $record = $this->model::find($id);

        if (isset($record)) {
            $record->delete();

            return response()->json([
                'message' => $this->modelName . ' deleted.'
            ]);
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }
}
