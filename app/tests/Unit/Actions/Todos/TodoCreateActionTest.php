<?php

namespace App\Tests\Unit\Actions\Todos;

use App\Actions\DtoMappers\Todos\TodoObjectDtoMapper;
use App\Actions\Dtos\Todos\TodoObjectDto;
use App\Actions\Todos\TodoCreateAction;
use App\Domain\Commands\Todos\TodoCreateCommand;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Domain\Services\Todos\TodoCreateService;
use App\Factory\TodoFactory;
use App\Factory\UserFactory;
use App\Filters\Todos\TodoCreateFilter;
use App\Responders\Todos\TodoCreateResponder;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class TodoCreateActionTest extends TodoActionTestCase
{
    public function testAuthenticatedException()
    {
        $request = $this->createMock(Request::class);
        $filter = $this->createMock(TodoCreateFilter::class);
        $todoRepository = $this->createMock(TodoRepository::class);
        $service = $this->createMock(TodoCreateService::class);
        $dtoMapper = $this->createMock(TodoObjectDtoMapper::class);
        $responder = $this->createMock(TodoCreateResponder::class);

        $todoCreateAction = new TodoCreateAction(
            $filter,
            $todoRepository,
            $dtoMapper,
            $responder,
            $service
        );
        $todoCreateAction->setContainer($this->getUnauthenticatedUserContainer());

        $this->expectException(AuthenticationException::class);

        $todoCreateAction->__invoke($request);
    }

    public function testThrowBadRequestHttpException()
    {
        $request = $this->createMock(Request::class);

        $filter = $this->createMock(TodoCreateFilter::class);
        $filter->expects($this->once())
            ->method('filter')
            ->with($request)
            ->willThrowException(new BadRequestHttpException());

        $todoRepository = $this->createMock(TodoRepository::class);
        $service = $this->createMock(TodoCreateService::class);
        $dtoMapper = $this->createMock(TodoObjectDtoMapper::class);
        $responder = $this->createMock(TodoCreateResponder::class);

        $action = new TodoCreateAction(
            $filter,
            $todoRepository,
            $dtoMapper,
            $responder,
            $service
        );
        $action->setContainer($this->getAuthenticatedUserContainer(UserFactory::createOne()->object()));

        $this->expectException(BadRequestHttpException::class);

        $action->__invoke($request);
    }

    public function testCreateNewTodoSuccessfully()
    {
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getContent')
            ->with()
            ->willReturn(json_encode(self::VALID_REQUEST_BODY));

        $filter = $this->createMock(TodoCreateFilter::class);
        $filter->expects($this->once())
            ->method('filter')
            ->with($request);

        $todoFactory = TodoFactory::createOne();
        $todoFactoryObject = $todoFactory->object();

        $userFactory = UserFactory::createOne();
        $todoCreateCommand = new TodoCreateCommand($todoFactory->getName(), $userFactory->object());

        $service = $this->createMock(TodoCreateService::class);
        $service->expects($this->once())
            ->method('handle')
            ->with($todoCreateCommand);

        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();
        $todoObjectDto = $this->createMock(TodoObjectDto::class);
        $todoObjectDto->name = $todoFactoryObject->getName();
        $todoObjectDto->slug = self::SLUG;
        $todoObjectDto->createdAt = $createdAt;
        $todoObjectDto->updatedAt = $updatedAt;

        $todoRepository = $this->createMock(TodoRepository::class);
        $todoRepository->expects($this->once())
            ->method('findLatestTodo')
            ->with()
            ->willReturn($todoFactory->object());

        $dtoMapper = $this->createMock(TodoObjectDtoMapper::class);
        $dtoMapper->expects($this->once())
            ->method('toDto')
            ->with($todoFactoryObject)
            ->willReturn($todoObjectDto);

        $responder = $this->createMock(TodoCreateResponder::class);
        $responder->expects($this->once())
            ->method('respond')
            ->with($todoObjectDto)
            ->willReturn(new JsonResponse($todoObjectDto, 201));

        $action = new TodoCreateAction(
            $filter,
            $todoRepository,
            $dtoMapper,
            $responder,
            $service,
        );
        $action->setContainer($this->getAuthenticatedUserContainer($userFactory->object()));

        $response = $action->__invoke($request);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
