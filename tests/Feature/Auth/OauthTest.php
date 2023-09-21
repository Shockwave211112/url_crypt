<?php

namespace Tests\Feature\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

class OauthTest extends TestCase
{
    protected $method = Request::METHOD_POST;
    protected string $uri = '/auth/registration';

    public function testShouldResponseWithHttpOk()
    {
        $socialiteUser = Mockery::mock('Laravel\Socialite\Two\User');
        $socialiteUser
            ->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getName')
            ->andReturn(Str::random(10))
            ->shouldReceive('getEmail')
            ->andReturn(Str::random(10) . '@example.com')
            ->shouldReceive('getAvatar')
            ->andReturn('https://google.com')
            ->shouldReceive('getToken')
            ->andReturn(Str::random(30));

        Socialite::shouldReceive('driver->stateless->user')->andReturn($socialiteUser);

        $this->get('/auth/google/callback')->assertJsonStructure(['token']);

    }
}
