<?php

namespace App\Services;

use App\Exceptions\DataBaseException;
use App\Models\User;

class UserService
{
    /**
     * @param $data
     * @return array
     */
    public function getInfo($data): array
    {
        return $data;
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws DataBaseException
     */
    public function store($data)
    {
        $user = User::create($data);

        if (isset($user)) {
            return response()->json([
                'message' => 'User added.'
            ]);
        }
        throw new DataBaseException(message: 'Something went wrong while adding a user.');
    }

    /**
     * @param int $id
     * @return User
     * @throws DataBaseException
     */
    public function show(int $id): User
    {
        $user = User::find($id);

        if (isset($user)) {
            return $user;
        }

        throw new DataBaseException(message: 'User not found.', status: 404);
    }

    /**
     * @param $id
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws DataBaseException
     */
    public function update($id, $data)
    {
        $user = User::find($id);

        if (isset($user)) {
            $user->update($data);

            return response()->json([
                'message' => 'User updated.'
            ]);
        }

        throw new DataBaseException(message: 'User not found.', status: 404);
    }


    public function delete(int $id)
    {
        $user = User::find($id);

        if (isset($user)) {
            $user->delete();

            return response()->json([
                'message' => 'User deleted.'
            ]);
        }

        throw new DataBaseException(message: 'User not found.', status: 404);
    }

}
