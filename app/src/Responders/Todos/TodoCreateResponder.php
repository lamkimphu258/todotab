<?php

namespace App\Responders\Todos;

use App\Actions\Dtos\ObjectDtoInterface;
use App\Responders\RestApiObjectResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TodoCreateResponder implements RestApiObjectResponderInterface
{

    public function respond(ObjectDtoInterface $objectDto): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
