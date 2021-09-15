<?php

namespace App\Responders\Users;

use App\Actions\Dtos\ObjectDtoInterface;
use App\Responders\RestApiObjectResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterResponder implements RestApiObjectResponderInterface
{
    /**
     * @param ObjectDtoInterface $objectDto
     * @return JsonResponse
     */
    public function respond(ObjectDtoInterface $objectDto): JsonResponse
    {
        return new JsonResponse($objectDto, Response::HTTP_CREATED);
    }
}
