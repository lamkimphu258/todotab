<?php

namespace App\Tests\Unit\Actions\Todos;

use App\Actions\DtoMappers\Todos\TodoListDtoMapper;
use App\Actions\Dtos\Todos\TodoListDto;
use App\Actions\Todos\TodoIndexAction;
use App\Domain\Entities\Todos\TodoPropertyName;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Domain\Repositories\Users\UserRepository;
use App\Factory\TodoFactory;
use App\Factory\UserFactory;
use App\Filters\Todos\TodoIndexFilter;
use App\Responders\Todos\TodoIndexResponder;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TodoIndexActionTest extends TodoActionTestCase
{
    public function testReturnAllTodos()
    {
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('get')
            ->with('username')
            ->willReturn(self::USERNAME);

        $filter = $this->createMock(TodoIndexFilter::class);

        $todoFactories = TodoFactory::createMany(self::NUMBER_OF_TODOS);
        $userFactory = UserFactory::createOne();

        foreach ($todoFactories as $todoFactory) {
            $todos[] = $todoFactory->object();
        }

        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();

        $todoListDtos = [];
        for ($i = 0; $i < self::NUMBER_OF_TODOS; $i++) {
            $todoListDto = $this->createMock(TodoListDto::class);

            $todoListDto->name = $todoFactories[$i]->getName();
            $todoListDto->slug = self::SLUG;
            $todoListDto->createdAt = $createdAt;
            $todoListDto->updatedAt = $updatedAt;

            $todoListDtos[] = $todoListDto;
        }

        $todoRepository = $this->createMock(TodoRepository::class);
        $todoRepository->expects($this->once())
            ->method('findByOwner')
            ->with($userFactory->object())
            ->willReturn($todos);

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->expects($this->once())
            ->method('findOneByUsername')
            ->with('username')
            ->willReturn($userFactory->object());

        $dtoMapper = $this->createMock(TodoListDtoMapper::class);
        $dtoMapper->expects($this->once())
            ->method('toDtos')
            ->with($todos)
            ->willReturn($todoListDtos);

        $responder = $this->createMock(TodoIndexResponder::class);
        $responder->expects($this->once())
            ->method('respond')
            ->with($todoListDtos)
            ->willReturn(new JsonResponse($todoListDtos));

        $action = new TodoIndexAction(
            $filter,
            $todoRepository,
            $dtoMapper,
            $responder,
            $userRepository
        );
        $response = $action->__invoke($request);

        $this->assertTrue($response->isOk());
        $this->assertJson($response->getContent());

        $responseInAssociativeArray = json_decode($response->getContent(), true);
        $this->assertCount(self::NUMBER_OF_TODOS, $responseInAssociativeArray);

        for ($i = 0; $i < self::NUMBER_OF_TODOS; $i++) {
            $todoListDtoResponse = $responseInAssociativeArray[$i];
            $todoListDto = $todoListDtos[$i];

            $this->assertArrayHasKey(TodoPropertyName::NAME, $todoListDtoResponse);
            $this->assertArrayHasKey(TodoPropertyName::SLUG, $todoListDtoResponse);
            $this->assertArrayHasKey(TodoPropertyName::CREATED_AT, $todoListDtoResponse);
            $this->assertArrayHasKey(TodoPropertyName::UPDATED_AT, $todoListDtoResponse);

            $this->assertIsString($todoListDtoResponse[TodoPropertyName::NAME]);
            $this->assertIsString($todoListDtoResponse[TodoPropertyName::SLUG]);
            $this->assertIsArray($todoListDtoResponse[TodoPropertyName::CREATED_AT]);
            $this->assertIsArray($todoListDtoResponse[TodoPropertyName::UPDATED_AT]);

            $this->assertEquals($todoListDto->name, $todoListDtoResponse[TodoPropertyName::NAME]);
            $this->assertEquals($todoListDto->slug, $todoListDtoResponse[TodoPropertyName::SLUG]);
            $this->assertEquals(
                $todoListDto->createdAt->format(self::RESPONSE_DATE_FORMAT),
                $todoListDtoResponse[TodoPropertyName::CREATED_AT]['date']
            );
            $this->assertEquals(
                $todoListDto->updatedAt->format(self::RESPONSE_DATE_FORMAT),
                $todoListDtoResponse[TodoPropertyName::UPDATED_AT]['date']
            );
        }
    }
}
