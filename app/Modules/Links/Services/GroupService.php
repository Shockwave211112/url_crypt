<?php

namespace App\Modules\Links\Services;

use App\Modules\Core\Traits\CrudTrait;
use App\Modules\Links\Models\Group;

class GroupService
{
    use CrudTrait;

    /**
     * @param Group $model
     */
    public function __construct(Group $model)
    {
        $this->model = $model;
        $this->modelName = class_basename($model);
    }
}
