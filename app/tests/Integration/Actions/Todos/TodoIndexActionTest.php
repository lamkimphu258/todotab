<?php

namespace App\Tests\Integration\Actions\Todos;

use App\Domain\Entities\Todos\TodoPropertyName;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Story\TestUserWithPostsStory;
use App\Tests\Integration\Actions\RestApiTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoIndexActionTest extends RestApiTestCase
{
    private const URI = 'api/rest/v1/todos';

    private const HTTP_METHOD = Request::METHOD_GET;

    private const NUMBER_OF_TODOS = 10;

    public function testReturnAllTodos()
    {
        TestUserWithPostsStory::load();

        $todoRepository = $this->getContainer()->get(TodoRepository::class);
        $todos = $todoRepository->findAll();

        $this->createAuthenticatedUser();
        $this->client->request(
            self::HTTP_METHOD,
            self::URI
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        $responseInAssociativeArray = json_decode($this->client->getResponse()->getContent(), true);

        for ($i = 0; $i < self::NUMBER_OF_TODOS; $i++) {
            $responseElement = $responseInAssociativeArray[$i];
            $todo = $todos[$i];

            $this->assertArrayHasKey(TodoPropertyName::NAME, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::SLUG, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::CREATED_AT, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::UPDATED_AT, $responseElement);

            $this->assertIsString($responseElement[TodoPropertyName::NAME]);
            $this->assertIsString($responseElement[TodoPropertyName::SLUG]);
            $this->assertIsArray($responseElement[TodoPropertyName::CREATED_AT]);
            $this->assertIsArray($responseElement[TodoPropertyName::UPDATED_AT]);

            $this->assertSame($todo->getName(), $responseElement[TodoPropertyName::NAME]);
            $this->assertStringContainsString($todo->getSlug(), $responseElement[TodoPropertyName::SLUG]);
            $this->assertSame(
                $todo->getCreatedAt()->format(self::RESPONSE_DATE_FORMAT),
                $responseElement[TodoPropertyName::CREATED_AT]['date']
            );
            $this->assertSame(
                $todo->getUpdatedAt()->format(self::RESPONSE_DATE_FORMAT),
                $responseElement[TodoPropertyName::UPDATED_AT]['date']
            );
        }
    }
}
