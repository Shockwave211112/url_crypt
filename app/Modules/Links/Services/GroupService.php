<?php

namespace App\Modules\Links\Services;

use App\Modules\Core\Traits\CRUDTrait;
use App\Modules\Links\Models\Group;

class GroupService
{
    use CRUDTrait;

    /**
     * @param Group $model
     */
    public function __construct(Group $model)
    {
        $this->model = $model;
        $this->modelName = class_basename($model);
    }
}
