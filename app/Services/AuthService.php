<?php

namespace App\Services;

use App\Exceptions\AuthException;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthException
     */
    public function login(array $data)
    {
        if (isset($data['email']))
            $user = User::where('email', $data['email'])->first();
        else
            $user = User::where('login', $data['login'])->first();

        if (!isset($user)) {
            throw new AuthException(message: 'User not found', status: '404');
        }
        if (!Hash::check($data['password'], $user->password)) {
            throw new AuthException(message: 'Email/login and password missmatch', status: '403');
        }

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }

    public function registration(array $data)
    {
        $role_id = Role::where('name', Role::UNVERIFIED_USER)->first()->id;
        $data['role_id'] = $role_id;

        $user = User::create($data);

        event(new Registered($user));

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }

    public function emailVerify(array $data)
    {
        dd($data);

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }
}
