<?php

namespace App\Modules\Auth\Services;

use App\Exceptions\AuthException;
use App\Exceptions\EmailException;
use App\Modules\Auth\Events\PasswordResetting;
use App\Modules\Auth\Events\UserRegistered;
use App\Modules\Auth\Models\ConfirmLinks;
use App\Modules\Auth\Models\RestoreLinks;
use App\Modules\Users\Models\User;
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
            $user = User::where('name', $data['name'])->first();

        if (!isset($user)) {
            throw new AuthException(message: 'User not found.', status: '404');
        }
        if (!Hash::check($data['password'], $user->password)) {
            throw new AuthException(message: 'Email/login and password mismatch', status: '403');
        }

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(array $data)
    {
        $user = User::create($data);
        $user->assignRole(User::BASIC_USER);

        event(new UserRegistered($user, $this->generateUrl($user, 'verify')));

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     * @throws EmailException
     */
    public function sendVerifyLink($user)
    {
        if ($user->hasVerifiedEmail()) {
            throw new EmailException(message: 'Email already verified!', status: '403');
        }

        event(new UserRegistered($user, $this->generateUrl($user, 'verify')));

        return response()->json([
            'message' => 'Email sent!',
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws EmailException
     */
    public function emailVerify($data)
    {
        $confirmLink = ConfirmLinks::where('token', $data['token'])->first();
        if (!isset($confirmLink)) {
            throw new EmailException(message: 'Link expired.', status: '404');
        }

        $decryptedToken = decrypt(base64_decode($data['token']));
        $splittedToken = explode('_', $decryptedToken);

        $expiryDate = $splittedToken[0];
        if ($expiryDate < now()) {
            throw new EmailException(message: 'Link expired.', status: '404');
        }

        $userId = $splittedToken[1];
        $user = User::where('id', $userId)->first();
        if (!isset($user)) {
            throw new EmailException(message: 'Verifying user not found.', status: '404');
        }

        $user->markEmailAsVerified();
        ConfirmLinks::where('user_id', $userId)->delete();

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword($data)
    {
        $user = User::where('email', $data['email'])->first();

        event(new PasswordResetting($user, $this->generateUrl($user, 'password')));

        return response()->json([
            'message' => 'Email sent!',
        ]);
    }

    public function getResetPassword()
    {
        return response()->json([
            'message' => 'ok',
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @throws EmailException
     */
    public function resetPassword($data)
    {
        $restoreLink = RestoreLinks::where('token', $data['token'])->first();
        if (!isset($confirmLink)) {
            throw new EmailException(message: 'Link expired.', status: '404');
        }

        $decryptedToken = decrypt(base64_decode($data['token']));
        $splittedToken = explode('_', $decryptedToken);

        $expiryDate = $splittedToken[0];
        if ($expiryDate < now()) {
            throw new EmailException(message: 'Link expired.', status: '404');
        }

        $userId = $splittedToken[1];
        $user = User::where('id', $userId)->first();
        if (!isset($user)) {
            throw new EmailException(message: 'Verifying user not found.', status: '404');
        }

        $user->password = $data['password'];
        $user->update();
        RestoreLinks::where('user_id', $userId)->delete();

        return response()->json([
            'message' => 'Password changed.',
        ]);
    }

    /**
     * @param User $user
     * @param string $type
     * @return string
     */
    private function generateUrl(User $user, string $type): string
    {
        switch ($type) {
            case 'verify':
                $minutes = config('auth.email_verify_timeout');
                $linkClass = ConfirmLinks::class;
                $route = 'email.verify';
                break;
            case 'password':
                $minutes = config('auth.password_timeout');
                $linkClass = RestoreLinks::class;
                $route = 'password.reset';
                break;
        }

        $expiryDate = now()->addMinutes($minutes);
        $token = base64_encode(encrypt($expiryDate . '_' . $user->id));

        $linkClass::create(['user_id' => $user->id, 'token' => $token, 'expiry_date' => $expiryDate]);

        return route($route, ['token' => $token]);
    }
}
