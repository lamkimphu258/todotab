<?php

namespace App\Responders\Todos;

use App\Actions\Dtos\ListDtoInterface;
use App\Responders\RestApiListResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class TodoIndexResponder implements RestApiListResponderInterface
{
    /**
     * @param  ListDtoInterface[]  $todoListDtos
     * @return JsonResponse
     */
    public function respond(array $todoListDtos): JsonResponse
    {
        return new JsonResponse($todoListDtos);
    }
}
