<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    public const LOGIN = 'login';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const EMAIL = 'email';
    public const ROLE_ID = 'role_id';

    protected function getCallbacks(): array
    {
        return [
            self::LOGIN => [$this, 'login'],
            self::FIRST_NAME => [$this, 'first_name'],
            self::LAST_NAME => [$this, 'last_name'],
            self::EMAIL => [$this, 'email'],
            self::ROLE_ID => [$this, 'role_id']
        ];
    }
    public function login(Builder $builder, $value)
    {
        $builder->where('login', 'like', "%{$value}%");
    }
    public function first_name(Builder $builder, $value)
    {
        $builder->where('first_name', 'like', "%{$value}%");
    }
    public function last_name(Builder $builder, $value)
    {
        $builder->where('last_name', 'like', "%{$value}%");
    }
    public function email(Builder $builder, $value)
    {
        $builder->where('email', 'like', "%{$value}%");
    }
    public function role_id(Builder $builder, $value)
    {
        $builder->where('role_id', '=', $value);
    }

}
