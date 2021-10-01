<?php

namespace App\Tests\Unit\Actions\DtoMappers\Todos;

use App\Actions\DtoMappers\Todos\TodoListDtoMapper;
use App\Actions\Dtos\Todos\TodoListDto;
use App\Domain\Entities\Todos\Todo;
use App\Factory\TodoFactory;
use DateTimeImmutable;

class TodoListDtoMapperTest extends TodoDtoMapperTestCase
{
    public function testToDtos()
    {
        $todoFactories = TodoFactory::createMany(self::NUMBER_OF_TODOS);
        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();

        $todos = [];
        foreach ($todoFactories as $todoFactory) {
            $todo = $this->createMock(Todo::class);
            $todo->expects($this->once())
                ->method('getName')
                ->with()
                ->willReturn($todoFactory->getName());
            $todo->expects($this->once())
                ->method('getSlug')
                ->with()
                ->willReturn(self::SLUG);
            $todo->expects($this->once())
                ->method('getCreatedAt')
                ->with()
                ->willReturn($createdAt);
            $todo->expects($this->once())
                ->method('getUpdatedAt')
                ->with()
                ->willReturn($updatedAt);
            $todos[] = $todo;
        }

        $dtoMapper = new TodoListDtoMapper();
        $todoListDtos = $dtoMapper->toDtos($todos);

        $this->assertCount(self::NUMBER_OF_TODOS, $todoListDtos);

        for ($i = 0; $i < self::NUMBER_OF_TODOS; $i++) {
            $todoListDto = $todoListDtos[$i];
            $todoFactory = $todoFactories[$i];

            $this->assertInstanceOf(TodoListDto::class, $todoListDto);
            $this->assertIsString($todoListDto->name);
            $this->assertIsString($todoListDto->slug);
            $this->assertInstanceOf(DateTimeImmutable::class, $todoListDto->createdAt);
            $this->assertInstanceOf(DateTimeImmutable::class, $todoListDto->updatedAt);

            $this->assertEquals($todoFactory->getName(), $todoListDto->name);
            $this->assertEquals(self::SLUG, $todoListDto->slug);
            $this->assertEquals($createdAt, $todoListDto->createdAt);
            $this->assertEquals($updatedAt, $todoListDto->updatedAt);
        }
    }
}
