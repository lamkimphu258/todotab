<?php

namespace App\Actions\DtoMappers;

use App\Actions\Dtos\ObjectDtoInterface;

interface RestApiObjectDtoMapperInterface extends RestApiDtoMapperInterface
{
    public function fromDto(ObjectDtoInterface $dto): object;

    public function toDto(object $entity): ObjectDtoInterface;
}
