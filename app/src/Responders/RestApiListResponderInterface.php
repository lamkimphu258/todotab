<?php

namespace App\Responders;

use App\Actions\Dtos\ListDtoInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

interface RestApiListResponderInterface extends RestApiResponderInterface
{
    /**
     * @param  ListDtoInterface[]  $listDtos
     * @return JsonResponse
     */
    public function respond(array $listDtos): JsonResponse;
}
