<?php

namespace App\Tests\Integration\Actions\Todos;

use App\Domain\Entities\Todos\TodoPropertyName;
use App\Factory\TodoFactory;
use App\Tests\Integration\Actions\RestApiTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoIndexActionTest extends RestApiTestCase
{
    private const URI = 'api/rest/v1/todos';

    private const HTTP_METHOD = Request::METHOD_GET;

    private const NUMBER_OF_TODOS = 10;

    public function testReturnAllTodos()
    {
        $todoFactories = TodoFactory::createMany(self::NUMBER_OF_TODOS);

        /** @var JsonResponse $response */
        $response = $this->httpClient->request(
            self::HTTP_METHOD,
            self::URI
        );

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $responseInAssociativeArray = json_decode($response->getContent(), true);

        for ($i = 0; $i < self::NUMBER_OF_TODOS; $i++) {
            $responseElement = $responseInAssociativeArray[$i];
            $todoFactory = $todoFactories[$i]->object();

            $this->assertArrayHasKey(TodoPropertyName::NAME, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::SLUG, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::CREATED_AT, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::UPDATED_AT, $responseElement);

            $this->assertIsString($responseElement[TodoPropertyName::NAME]);
            $this->assertIsString($responseElement[TodoPropertyName::SLUG]);
            $this->assertIsArray($responseElement[TodoPropertyName::CREATED_AT]);
            $this->assertIsArray($responseElement[TodoPropertyName::UPDATED_AT]);

            $this->assertEquals($todoFactory->getName(), $responseElement[TodoPropertyName::NAME]);
            $this->assertStringContainsString('todo', $responseElement[TodoPropertyName::SLUG]);
            $this->assertEquals(
                $todoFactory->getCreatedAt()->format(self::RESPONSE_DATE_FORMAT),
                $responseElement[TodoPropertyName::CREATED_AT]['date']
            );
            $this->assertEquals(
                $todoFactory->getUpdatedAt()->format(self::RESPONSE_DATE_FORMAT),
                $responseElement[TodoPropertyName::UPDATED_AT]['date']
            );
        }
    }
}
