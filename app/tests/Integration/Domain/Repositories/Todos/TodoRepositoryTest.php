<?php

namespace App\Tests\Integration\Domain\Repositories\Todos;

use App\Domain\Entities\Todos\Todo;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Factory\TodoFactory;
use DateTimeImmutable;

class TodoRepositoryTest extends TodoRepositoryTestCase
{
    public function testReturnAllTodos()
    {
        $todoFactories = TodoFactory::createMany(self::NUMBER_OF_TODOS);

        $repository = new TodoRepository($this->managerRegistry);
        /** @var Todo[] $todos */
        $todos = $repository->findAll();

        $this->assertCount(self::NUMBER_OF_TODOS, $todos);

        for ($i = 0; $i < self::NUMBER_OF_TODOS; $i++) {
            $todo = $todos[$i];
            $todoFactory = $todoFactories[$i]->object();

            $this->assertInstanceOf(Todo::class, $todo);
            $this->assertIsString($todo->getName());
            $this->assertIsString($todo->getSlug());
            $this->assertInstanceOf(DateTimeImmutable::class, $todo->getCreatedAt());
            $this->assertInstanceOf(DateTimeImmutable::class, $todo->getUpdatedAt());

            $this->assertEquals($todoFactory->getName(), $todo->getName());
            $this->assertStringContainsString('todo', $todo->getSlug());
            $this->assertEquals($todoFactory->getCreatedAt(), $todo->getCreatedAt());
            $this->assertEquals($todoFactory->getUpdatedAt(), $todo->getUpdatedAt());
        }
    }
}
