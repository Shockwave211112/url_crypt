<?php

namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Http\Requests\StoreRequest;
use App\Modules\Users\Http\Requests\UpdateRequest;
use App\Modules\Users\Models\User;
use App\Modules\Users\Services\UserService;

class UserController extends Controller
{
//    /**
//     * @param FilterRequest $request
//     * @return mixed
//     * @throws \Illuminate\Contracts\Container\BindingResolutionException
//     */
//    public function index(FilterRequest $request)
//    {
//        $data = $request->validated();
//        $filter = app()->make(UserFilter::class, ['queryParams' => array_filter($data)]);
//        $query = User::filter($filter);
//
//        if ($request->sort == null) {
//            $sort = 'asc';
//        } else {
//            $sort = $request->sort;
//        }
//
//        switch ($request->orderBy) {
//            case 'login':
//                $query->orderBy('login', $sort);
//                break;
//            case 'first_name':
//                $query->orderBy('first_name', $sort);
//                break;
//            case 'last_name':
//                $query->orderBy('last_name', $sort);
//                break;
//            case 'email':
//                $query->orderBy('email', $sort);
//                break;
//            case 'role_id':
//                $query->orderBy('role_id', $sort);
//                break;
//        }
//        return $query->paginate(10);
//    }
    public function index(UserService $service)
    {
        return $service->index();
    }

    /**
     * @param StoreRequest $request
     * @param UserService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function store(StoreRequest $request, UserService $service)
    {
        return $service->store($request->validated());
    }

    /**
     * @param $id
     * @param UserService $service
     * @return User
     * @throws \App\Exceptions\DataBaseException
     */
    public function show($id, UserService $service)
    {
        return $service->show($id);
    }

    /**
     * @param UserService $service
     * @return User
     */
    public function getInfo(UserService $service)
    {
        return $service->getInfo(auth()->user());
    }

    /**
     * @param $id
     * @param UpdateRequest $request
     * @param UserService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function update($id, UpdateRequest $request, UserService $service)
    {
        return $service->update($id, $request->validated());
    }

    public function delete($id, UserService $service)
    {
        return $service->delete($id);
    }
}
