<?php

namespace App\Modules\Users\Services;

use App\Modules\Core\CRUDRepository;
use App\Modules\Core\Traits\CRUDTrait;
use App\Modules\Users\Models\User;

class UserService
{
    use CRUDTrait;

    public function __construct()
    {
        $this->repository = new CRUDRepository(new User());
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
