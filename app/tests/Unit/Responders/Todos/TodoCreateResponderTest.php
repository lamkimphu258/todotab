<?php

namespace App\Tests\Unit\Responders\Todos;

use App\Actions\Dtos\Todos\TodoObjectDto;
use App\Domain\Entities\Todos\TodoPropertyName;
use App\Factory\TodoFactory;
use App\Responders\Todos\TodoCreateResponder;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Response;

class TodoCreateResponderTest extends TodoResponderTestCase
{
    public function testRespondTodoObjectDto()
    {
        $todo = TodoFactory::createOne()->object();

        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();
        $todoObjectDto = $this->createMock(TodoObjectDto::class);
        $todoObjectDto->name = $todo->getName();
        $todoObjectDto->slug = self::SLUG;
        $todoObjectDto->createdAt = $createdAt;
        $todoObjectDto->updatedAt = $updatedAt;

        $responder = new TodoCreateResponder();
        $response = $responder->respond($todoObjectDto);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
