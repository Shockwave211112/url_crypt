<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\EmailVerifyRequest;
use App\Modules\Auth\Http\Requests\ForgotRequest;
use App\Modules\Auth\Http\Requests\LoginRequest;
use App\Modules\Auth\Http\Requests\NewPasswordRequest;
use App\Modules\Auth\Http\Requests\OauthRequest;
use App\Modules\Auth\Http\Requests\RegistrationRequest;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthService $service
     * @return string
     * @throws \App\Modules\Core\Exceptions\AuthException
     */
    public function login(LoginRequest $request, AuthService $service)
    {
        return $service->login($request->validated());
    }

    /**
     * @param RegistrationRequest $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(RegistrationRequest $request, AuthService $service)
    {
        return $service->registration($request->validated());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Successful logout.',
        ]);
    }

    /**
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Core\Exceptions\EmailException
     */
    public function resend(AuthService $service)
    {
        return $service->resend(auth()->user());
    }

    /**
     * @param Request $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Core\Exceptions\EmailException
     */
    public function emailVerify(EmailVerifyRequest $request, AuthService $service)
    {
        return $service->emailVerify($request->validated());
    }

    /**
     * @param ForgotRequest $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(ForgotRequest $request, AuthService $service)
    {
        return $service->forgotPassword($request->validated());
    }

    public function getResetPassword(AuthService $service)
    {
        return $service->getResetPassword();
    }

    /**
     * @param NewPasswordRequest $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Modules\Core\Exceptions\EmailException
     */
    public function resetPassword(NewPasswordRequest $request, AuthService $service)
    {
        return $service->resetPassword($request->validated());
    }

    public function oauth(OauthRequest $request, AuthService $service)
    {
        return $service->oauth($request->validated());
    }

    public function callback(OauthRequest $request, AuthService $service)
    {
        return $service->callback($request->validated());
    }
}