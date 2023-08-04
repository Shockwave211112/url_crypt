<?php

namespace App\Traits;

use App\Exceptions\DataBaseException;
use App\Modules\Users\Models\User;

trait CrudTrait
{
    protected $model;

    protected $modelName;

    public function index()
    {
        return $this->model::paginate(10);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws DataBaseException
     */
    public function store($data)
    {
        $dbrow = $this->model::create($data);

        if (isset($dbrow)) {
            if ($this->modelName == 'User') $dbrow->assignRole(User::BASIC_USER);

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
        $dbrow = $this->model::find($id);

        if (isset($dbrow)) {
            return $dbrow;
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
        $dbrow = $this->model::find($id);

        if (isset($dbrow)) {
            $dbrow->update($data);
            if ($this->modelName == 'User') $dbrow->syncRoles($data['role_name']);

            return response()->json([
                'message' =>  $this->modelName . ' updated.'
            ]);
        }

        throw new DataBaseException(message:  $this->modelName . ' not found.', status: 404);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws DataBaseException
     */
    public function delete(int $id)
    {
        $dbrow = $this->model::find($id);

        if (isset($dbrow)) {
            $dbrow->delete();

            return response()->json([
                'message' => $this->modelName . ' deleted.'
            ]);
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }
}
