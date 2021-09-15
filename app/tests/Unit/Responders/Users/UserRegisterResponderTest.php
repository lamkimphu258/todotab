<?php

namespace App\Tests\Unit\Responders\Users;

use App\Actions\Dtos\Users\UserObjectDto;
use App\Domain\Entities\Users\UserInterface;
use App\Domain\Entities\Users\UserPropertyName;
use App\Factory\UserFactory;
use App\Responders\RestApiObjectResponderInterface;
use App\Responders\RestApiResponderInterface;
use App\Responders\Users\UserRegisterResponder;
use App\Tests\Unit\Responders\RestApiResponderTestCase;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterResponderTest extends RestApiResponderTestCase
{
    public function testRespondSuccess()
    {
        /** @var UserInterface $userFactory */
        $userFactory = UserFactory::createOne();
        $userDto = $this->createMock(UserObjectDto::class);

        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();
        $userDto->id = self::EXISTING_ID;
        $userDto->email = $userFactory->getEmail();
        $userDto->username = $userFactory->getUsername();
        $userDto->createdAt = $createdAt;
        $userDto->updatedAt = $updatedAt;

        $userRegisterResponder = new UserRegisterResponder();
        $this->assertInstanceOf(RestApiResponderInterface::class, $userRegisterResponder);
        $this->assertInstanceOf(RestApiObjectResponderInterface::class, $userRegisterResponder);

        $response = $userRegisterResponder->respond($userDto);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertInstanceOf(JsonResponse::class, $response);

        $responseInAssociativeArray = json_decode($response->getContent(), true);

        $this->assertArrayHasKey(UserPropertyName::ID, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::EMAIL, $responseInAssociativeArray);
        $this->assertArrayNotHasKey(UserPropertyName::PASSWORD, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::USERNAME, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::CREATED_AT, $responseInAssociativeArray);
        $this->assertArrayHasKey(UserPropertyName::UPDATED_AT, $responseInAssociativeArray);

        $this->assertEquals($userDto->id, $responseInAssociativeArray[UserPropertyName::ID]);
        $this->assertEquals($userDto->email, $responseInAssociativeArray[UserPropertyName::EMAIL]);
        $this->assertEquals($userDto->username, $responseInAssociativeArray[UserPropertyName::USERNAME]);
        $this->assertIsArray($responseInAssociativeArray['createdAt']);
        $this->assertEquals(
            $userDto->createdAt->format(self::RESPONSE_DATE_FORMAT),
            $responseInAssociativeArray['createdAt']['date']
        );
        $this->assertIsArray($responseInAssociativeArray['updatedAt']);
        $this->assertEquals(
            $userDto->updatedAt->format(self::RESPONSE_DATE_FORMAT),
            $responseInAssociativeArray['updatedAt']['date']
        );
    }
}
