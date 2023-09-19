<?php

namespace Tests\Feature\Groups;

use App\Modules\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetGroupsTest extends TestCase
{
    protected $method = Request::METHOD_GET;
    protected string $uri = '/groups';

    public function testShouldResponseWithHttpOk()
    {
        $this->defaultTest(
            $this->method,
            $this->uri
        );
    }

    public function testShouldResponseWithHttpUnathIfWithoutToken()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNAUTHORIZED,
            needAuth: false
        );
    }

    public function testShouldResponseWithHttpForbiddenIfNotAdmin()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_FORBIDDEN,
            role: User::BASIC_USER,
        );
    }
}
