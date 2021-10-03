<?php

namespace App\Tests\Integration\Actions\Todos;

use App\Domain\Entities\Todos\Todo;
use App\Domain\Entities\Todos\TodoPropertyName;
use App\Factory\TodoFactory;
use App\Factory\UserFactory;
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
        $userFactory = UserFactory::createOne();
        $user = $userFactory->object();
        $todoFactories = TodoFactory::createMany(self::NUMBER_OF_TODOS);
        foreach ($todoFactories as $todoFactory) {
            $todoFactory->withoutAutoRefresh(function (Todo $todo) use ($user) {
                $todo->assignOwner($user);
                $user->addTodo($todo);
            });
            $todoFactory->save();
        }

        /** @var JsonResponse $response */
        $response = $this->httpClient->request(
            self::HTTP_METHOD,
            '/api/rest/v1/' . $user->getUsername() . '/todos', [
                'json' => [
                    'email' => $userFactory->getEmail()
                ]
            ]
        );

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $responseInAssociativeArray = json_decode($response->getContent(), true);

        for ($i = 0; $i < self::NUMBER_OF_TODOS; $i++) {
            $responseElement = $responseInAssociativeArray[$i];
            $todoFactoryObject = $todoFactories[$i]->object();

            $this->assertArrayHasKey(TodoPropertyName::NAME, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::SLUG, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::CREATED_AT, $responseElement);
            $this->assertArrayHasKey(TodoPropertyName::UPDATED_AT, $responseElement);

            $this->assertIsString($responseElement[TodoPropertyName::NAME]);
            $this->assertIsString($responseElement[TodoPropertyName::SLUG]);
            $this->assertIsArray($responseElement[TodoPropertyName::CREATED_AT]);
            $this->assertIsArray($responseElement[TodoPropertyName::UPDATED_AT]);

            $this->assertSame($todoFactoryObject->getName(), $responseElement[TodoPropertyName::NAME]);
            $this->assertStringContainsString('todo', $responseElement[TodoPropertyName::SLUG]);
            $this->assertSame(
                $todoFactoryObject->getCreatedAt()->format(self::RESPONSE_DATE_FORMAT),
                $responseElement[TodoPropertyName::CREATED_AT]['date']
            );
            $this->assertSame(
                $todoFactoryObject->getUpdatedAt()->format(self::RESPONSE_DATE_FORMAT),
                $responseElement[TodoPropertyName::UPDATED_AT]['date']
            );
        }
    }
}
