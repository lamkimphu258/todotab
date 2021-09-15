<?php

use App\Actions\DtoMappers\Users\UserObjectDtoMapper;
use App\Actions\Dtos\Users\UserObjectDto;
use App\Actions\Users\UserRegisterAction;
use App\Domain\Commands\Users\UserRegisterCommand;
use App\Domain\Entities\Users\User;
use App\Domain\Entities\Users\UserPropertyName;
use App\Domain\Repositories\Users\UserRepository;
use App\Domain\Services\Users\UserRegisterService;
use App\Factory\UserFactory;
use App\Filters\Users\UserRegisterFilter;
use App\Responders\Users\UserRegisterResponder;
use App\Tests\Unit\Actions\ActionTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserRegisterActionTest extends ActionTestCase
{
    public function testThrowBadRequestHttpException()
    {
        $request = $this->createMock(Request::class);

        $filter = $this->createMock(UserRegisterFilter::class);
        $filter->expects($this->once())
            ->method('filter')
            ->with($request)
            ->willThrowException(new BadRequestHttpException(self::INVALID_REQUEST_BODY_MESSAGE));

        $service = $this->createMock(UserRegisterService::class);
        $repository = $this->createMock(UserRepository::class);
        $dtoMapper = $this->createMock(UserObjectDtoMapper::class);
        $responder = $this->createMock(UserRegisterResponder::class);

        $userRegisterAction = new UserRegisterAction(
            $filter,
            $repository,
            $service,
            $dtoMapper,
            $responder
        );

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage(self::INVALID_REQUEST_BODY_MESSAGE);

        $userRegisterAction->__invoke($request);
    }

    public function testCreateNewUserSuccessfully()
    {
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getContent')
            ->with()
            ->willReturn(json_encode(self::VALID_REQUEST_BODY));

        $filter = $this->createMock(UserRegisterFilter::class);
        $filter->expects($this->once())
            ->method('filter')
            ->with($request);

        $userFactory = UserFactory::createOne();
        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();

        $user = new User(
            $userFactory->getEmail(),
            $userFactory->getPassword(),
            $userFactory->getUsername()
        );

        $repository = $this->createMock(UserRepository::class);
        $repository->expects($this->once())
            ->method('findOneByEmail')
            ->with($userFactory->getEmail())
            ->willReturn($user);

        $service = $this->createMock(UserRegisterService::class);
        $service->expects($this->once())
            ->method('handle');

        $userDto = $this->createMock(UserObjectDto::class);
        $userDto->id = self::ID;
        $userDto->email = $userFactory->getEmail();
        $userDto->username = $userFactory->getUsername();
        $userDto->createdAt = $createdAt;
        $userDto->updatedAt = $updatedAt;

        $dtoMapper = $this->createMock(UserObjectDtoMapper::class);
        $dtoMapper->expects($this->once())
            ->method('toDto')
            ->with($user)
            ->willReturn($userDto);

        $responder = $this->createMock(UserRegisterResponder::class);
        $responder->expects($this->once())
            ->method('respond')
            ->with($userDto)
            ->willReturn(
                new JsonResponse(
                    $userDto,
                    status: Response::HTTP_CREATED
                )
            );

        $userRegisterAction = new UserRegisterAction(
            $filter,
            $repository,
            $service,
            $dtoMapper,
            $responder
        );

        $response = $userRegisterAction->__invoke($request);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());

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
