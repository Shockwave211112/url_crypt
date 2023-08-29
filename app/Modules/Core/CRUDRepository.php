<?php

namespace App\Modules\Core;

use App\Modules\Core\Exceptions\DataBaseException;
use App\Modules\Links\Events\RelationUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
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
        return Cache::tags([$this->modelName, 'pagination'])
            ->remember($this->modelName . '-page-' . request('page', default: 1), now()->addMinutes(180),
                function () {
                    return $this->model::paginate(10);
                });
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data)
    {
        $relations = $this->model->defaultRelations;

        $record = $this->model::create($data);

        if (count($relations)) {
            foreach ($data as $requestKey => $value) {
                if (array_key_exists($requestKey, $relations)) {
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
     * @param int $id
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function show(int $id)
    {
        $record = Cache::tags($this->modelName)
            ->remember($this->modelName . ':' . $id, now()->addMinutes(180),
                function () use ($id) {
                    return $this->model::find($id);
                });

        if ($record) {
            return response()->json([
                'entity' => $record
            ]);
        }
        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }


    /**
     * @param string $method
     * @param int $id
     * @param array $data
     * @param array $relations
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function update(string $method, int $id, array $data, array $relations)
    {
        if ($method === 'patch') $fields = array_keys($data);
        else $fields = $this->model->getFillable();

        $data = $this->onlyFields($data, $fields);
        $record = $this->model::find($id);

        if ($record) {
            $oldRecord = clone $record;

            if ($relations) {
                foreach ($relations as $relation => $value) {
                    event(new RelationUpdate($this->modelName, $record, $relations));

                    $record->{$relation}()->sync($value);
                }
            }

            $record->update($data);

            return response()->json([
                'message' => $this->modelName . ' updated.',
                'entity' => $record,
                'old_entity' => $oldRecord,
            ]);
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }

    /**
     * @param int $id
     * @param array $data
     * @param array $relations
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function put(int $id, array $data, array $relations)
    {
        return $this->update('put', $id, $data, $relations);
    }

    /**
     * @param int $id
     * @param array $data
     * @param array $relations
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function patch(int $id, array $data, array $relations)
    {
        return $this->update('patch', $id, $data, $relations);
    }


    /**
     * @param int $id
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function delete(int $id)
    {
        $record = $this->model::find($id);

        if ($record) {
            $record->delete();

            return response()->json([
                'message' => $this->modelName . ' deleted.'
            ]);
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }

    /**
     * Возвращает преобразованный массив из полей $data в формате списка полей $fields
     *
     * @param array $data
     * @param array $fields
     * @return array
     */
    private static function onlyFields(array $data = [], array $fields = []): array
    {
        if (!count($data) || !count($fields)) return [];

        $returnData = [];

        foreach ($fields as $field) {
            if (!isset($data[$field])) $data[$field] = null;

            $returnData[$field] = $data[$field];
        }

        return $returnData;
    }
}
