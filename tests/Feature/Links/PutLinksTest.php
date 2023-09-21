<?php

namespace Tests\Feature\Links;

use App\Modules\Links\Models\Link;
use App\Modules\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class PutLinksTest extends TestCase
{
    protected $method = Request::METHOD_PUT;
    protected string $uri = '/links/';

    public function testShouldResponseWithHttpOk()
    {
        $user = User::factory()->create(['email' => 'test@test.com']);
        $user->givePermissionTo('link--put');

        $link = Link::factory()->user($user->id)->group($user->groups->first()->id)->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $link->id,
            data: [
                'name' => 'Test Link New',
                'description' => 'New Desc',
                'origin' => 'http://localhost:8000',
                'referral' => '7777aaa7777'
            ],
            user: $user
        );

        $this->assertDatabaseHas('links', ['name' => 'Test Link New']);
    }

    public function testShouldResponseWithHttpUnprocessableIfNoParams()
    {
        $user = User::factory()->create(['email' => 'test@test.com']);
        $user->givePermissionTo('link--put');

        $link = Link::factory()->user($user->id)->group($user->groups->first()->id)->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $link->id,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            user: $user
        );
    }

    public function testShouldResponseWithHttpUnprocessableIfInvalidParams()
    {
        $user = User::factory()->create(['email' => 'test@test.com']);
        $user->givePermissionTo('link--put');

        $link = Link::factory()->user($user->id)->group($user->groups->first()->id)->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $link->id,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            data: [
                'name' => ['aaa'],
                'description' => 1,
                'referral' => [3],
                'origin' => 2,
            ],
            user: $user
        );
    }

    public function testShouldResponseWithHttpUnathIfWithoutToken()
    {
        $link = Link::factory()->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $link->id,
            Response::HTTP_UNAUTHORIZED,
            needAuth: false
        );
    }

    public function testShouldResponseWithHttpForbiddenIfNotOwner()
    {
        $user = User::factory()->create(['email' => 'test@test.com']);
        $user->givePermissionTo('link--put');

        $link = Link::factory()->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $link->id,
            Response::HTTP_FORBIDDEN,
            data: [
                'name' => 'Test Link New',
                'description' => 'New Desc',
                'origin' => 'http://localhost:8000',
                'referral' => '7777aaa7777'
            ],
            user: $user,
        );
    }
}
