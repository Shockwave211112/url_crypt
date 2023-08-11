<?php

namespace App\Modules\Core;

use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Core\Observers\RelationObserver;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CRUDRepository
{
    protected $model;
    protected $modelName;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->modelName = class_basename($model);
    }

    public function index()
    {
        $modelIndex = Cache::tags([$this->modelName, 'pagination'])
            ->remember($this->modelName . '-page-' . request('page', default: 1), now()->addMinutes(180),
                function () {
                    return $this->model::paginate(10);
                });

        return $modelIndex;
    }

    public function store($data)
    {
        $relations = $this->model->defaultRelations;

        $record = $this->model::create($data);

        if (count($relations)) {
            foreach ($data as $requestKey => $value) {
                if(array_key_exists($requestKey, $relations)) {
                    $record->{$relations[$requestKey]}()->attach($value);
                }
            }
        }

        return response()->json([
            'message' => $this->modelName . ' added.',
            'entity' => $record
        ]);
    }

    /**
     * @param User $user
     * @param $id
     * @return mixed
     * @throws DataBaseException
     */
    public function show(User $user, $id)
    {

    }

    /**
     * @param $id
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws DataBaseException
     */
    public function update(User $user, $id, $data)
    {

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws DataBaseException
     */
    public function delete(User $user, int $id)
    {

    }
}
