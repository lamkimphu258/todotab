<?php

namespace App\Responders\Todos;

use App\Actions\Dtos\ObjectDtoInterface;
use App\Responders\RestApiObjectResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class TodoDeleteResponder implements RestApiObjectResponderInterface
{

    public function respond(ObjectDtoInterface $objectDto): JsonResponse
    {
        return new JsonResponse();
    }
}
