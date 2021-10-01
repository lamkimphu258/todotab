<?php

namespace App\Responders\Todos;

use App\Actions\Dtos\Todos\TodoListDto;
use App\Domain\Entities\Todos\TodoPropertyName;
use App\Factory\TodoFactory;
use App\Tests\Unit\Responders\Todos\TodoResponderTestCase;
use DateTimeImmutable;

class TodoIndexResponderTest extends TodoResponderTestCase
{
    public function testRespondTodoListDtos()
    {
        $todoFactory = TodoFactory::createMany(self::NUMBER_OF_TODO_IN_INDEX_RESPONSE);

        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();

        $todoListDtos = [];
        for ($i = 0; $i < count($todoFactory); $i++) {
            $todoFactoryProxy = $todoFactory[$i];
            $todoListDto = $this->createMock(TodoListDto::class);
            $todoListDto->name = $todoFactoryProxy->getName();
            $todoListDto->slug = self::SLUG;
            $todoListDto->createdAt = $createdAt;
            $todoListDto->updatedAt = $updatedAt;

            $todoListDtos[] = $todoListDto;
        }

        $responder = new TodoIndexResponder();
        $response = $responder->respond($todoListDtos);

        $this->assertTrue($response->isOk());
        $this->assertJson($response->getContent());

        $responseInAssociativeArray = json_decode($response->getContent(), true);
        $this->assertCount(self::NUMBER_OF_TODO_IN_INDEX_RESPONSE, $responseInAssociativeArray);

        for ($i = 0; $i < self::NUMBER_OF_TODO_IN_INDEX_RESPONSE; $i++) {
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
