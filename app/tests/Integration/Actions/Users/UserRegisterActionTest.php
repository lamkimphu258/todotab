<?php

namespace App\Tests\Integration\Actions\Users;

use App\Domain\Entities\Users\UserPropertyName;
use App\Tests\Integration\Actions\Traits\HasTestBadRequestBody;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterActionTest extends UserActionTestCase
{
    use HasTestBadRequestBody;

    private const URI = 'api/rest/v1/auth/register';

    private const HTTP_METHOD = Request::METHOD_POST;

    public function testCreateUserSuccessfullyReturnUserDto()
    {
        $this->client->jsonRequest(
            self::HTTP_METHOD,
            self::URI,
            self::VALID_REQUEST_BODY
        );

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        $responseInAssociativeArray = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertArrayHasKey(UserPropertyName::ID, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::EMAIL, $responseInAssociativeArray);
        $this->assertArrayNotHasKey(UserPropertyName::PASSWORD, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::USERNAME, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::CREATED_AT, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::UPDATED_AT, $responseInAssociativeArray);

        $this->assertSame(
            self::VALID_REQUEST_BODY[UserPropertyName::EMAIL],
            $responseInAssociativeArray[UserPropertyName::EMAIL]
        );
        $this->assertSame(
            self::VALID_REQUEST_BODY[UserPropertyName::USERNAME],
            $responseInAssociativeArray[UserPropertyName::USERNAME]
        );
    }
}
