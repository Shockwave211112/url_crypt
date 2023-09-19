<?php

namespace Tests\Feature\Groups;

use App\Modules\Links\Models\Group;
use App\Modules\Links\Models\GroupUser;
use App\Modules\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetByIdGroupsTest extends TestCase
{
    protected $method = Request::METHOD_GET;
    protected string $uri = '/groups/';

    public function testShouldResponseWithHttpOk()
    {
        $user = User::factory()->create(['email' => 'test@test.com']);
        $user->givePermissionTo('group--create');
        $user->givePermissionTo('group--show');

        $this->defaultTest(
            Request::METHOD_POST,
            '/groups',
            data: [
                'name' => 'Test Group',
                'description' => '???text???'
            ],
            user: $user
        );

        $group = Group::orderBy('id', 'desc')->first();

        $this->defaultTest(
            $this->method,
            $this->uri . $group->id,
            user: $user
        );
    }

    public function testShouldResponseWithHttpNotFound()
    {
        $this->defaultTest(
            $this->method,
            $this->uri . 9999999,
            Response::HTTP_NOT_FOUND,
        );
    }

    public function testShouldResponseWithHttpUnathIfWithoutToken()
    {
        $group = Group::first();

        $this->defaultTest(
            $this->method,
            $this->uri . $group->id,
            Response::HTTP_UNAUTHORIZED,
            needAuth: false
        );
    }

    public function testShouldResponseWithHttpForbiddenIfNotOwner()
    {
        $group = Group::first();

        $this->defaultTest(
            $this->method,
            $this->uri . $group->id,
            Response::HTTP_FORBIDDEN,
            role: User::BASIC_USER,
        );
    }
}
