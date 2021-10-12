<?php

namespace App\Tests\Unit\Actions\DtoMappers\Todos;

use App\Actions\DtoMappers\Todos\TodoObjectDtoMapper;
use App\Actions\Dtos\Todos\TodoObjectDto;
use App\Domain\Entities\Todos\Todo;
use App\Factory\TodoFactory;
use DateTimeImmutable;

class TodoObjectDtoMapperTest extends TodoDtoMapperTestCase
{
    public function testToDto()
    {
        $todoFactory = TodoFactory::createOne();
        $todoFactoryObject = $todoFactory->object();

        $now = new DateTimeImmutable();
        $todo = $this->createMock(Todo::class);
        $todo->expects($this->once())
            ->method('getName')
            ->with()
            ->willReturn($todoFactoryObject->getName());
        $todo->expects($this->once())
            ->method('getSlug')
            ->with()
            ->willReturn(self::SLUG);
        $todo->expects($this->once())
            ->method('getCreatedAt')
            ->with()
            ->willReturn($now);
        $todo->expects($this->once())
            ->method('getUpdatedAt')
            ->with()
            ->willReturn($now);

        $dtoMapper = new TodoObjectDtoMapper();
        $todoObjectDto = $dtoMapper->toDto($todo);

        $this->assertInstanceOf(TodoObjectDto::class, $todoObjectDto);
        $this->assertIsString($todoObjectDto->name);
        $this->assertIsString($todoObjectDto->slug);
        $this->assertInstanceOf(DateTimeImmutable::class, $todoObjectDto->createdAt);
        $this->assertInstanceOf(DateTimeImmutable::class, $todoObjectDto->updatedAt);

        $this->assertEquals($todoFactory->getName(), $todoObjectDto->name);
        $this->assertEquals(self::SLUG, $todoObjectDto->slug);
        $this->assertEquals($now, $todoObjectDto->createdAt);
        $this->assertEquals($now, $todoObjectDto->updatedAt);
    }
}
