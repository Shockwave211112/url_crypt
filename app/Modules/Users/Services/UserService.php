<?php

namespace App\Modules\Users\Services;

use App\Modules\Core\Traits\CrudTrait;
use App\Modules\Users\Models\User;

class UserService
{
    use CrudTrait;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
        $this->modelName = class_basename($model);
    }

    /**
     * @param $data
     * @return User
     */
    public function getInfo($data)
    {
        return $data;
    }
}
