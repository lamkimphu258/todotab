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
        $response = $this->httpClient->request(
            self::HTTP_METHOD,
            self::URI,
            [
                'json' => self::VALID_REQUEST_BODY
            ]
        );

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $responseInAssociativeArray = json_decode($response->getContent(), true);

        $this->assertArrayHasKey(UserPropertyName::ID, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::EMAIL, $responseInAssociativeArray);
        $this->assertArrayNotHasKey(UserPropertyName::PASSWORD, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::USERNAME, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::CREATED_AT, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::UPDATED_AT, $responseInAssociativeArray);

        $this->assertSame(self::VALID_REQUEST_BODY[UserPropertyName::EMAIL], $responseInAssociativeArray[UserPropertyName::EMAIL]);
        $this->assertSame(self::VALID_REQUEST_BODY[UserPropertyName::USERNAME], $responseInAssociativeArray[UserPropertyName::USERNAME]);
    }
}
