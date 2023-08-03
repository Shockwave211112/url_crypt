<?php

namespace App\Modules\Users\Models;

use App\Traits\Filterable;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'login',
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hasRole(string $role) {
        $role_id = Role::where('name', $role)->first()->id;
        return $this->role_id === $role_id;
    }

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }
}
