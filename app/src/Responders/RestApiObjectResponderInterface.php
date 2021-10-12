<?php

namespace App\Responders;

use App\Actions\Dtos\ObjectDtoInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

interface RestApiObjectResponderInterface extends RestApiResponderInterface
{
    /**
     * @param  ObjectDtoInterface  $objectDto
     * @return JsonResponse
     */
    public function respond(ObjectDtoInterface $objectDto): JsonResponse;
}
