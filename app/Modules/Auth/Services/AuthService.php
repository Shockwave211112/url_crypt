<?php

namespace App\Modules\Auth\Services;

use App\Exceptions\AuthException;
use App\Modules\Users\Models\User;
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
        $user = User::create($data);
        $user->assignRole(User::BASIC_USER);

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
