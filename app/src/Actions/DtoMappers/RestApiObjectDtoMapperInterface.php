<?php

namespace App\Actions\DtoMappers;

use App\Actions\Dtos\DtoInterface;

interface RestApiObjectDtoMapperInterface extends RestApiDtoMapperInterface
{
    public function fromDto(DtoInterface $dto): object;

    public function toDto(object $entity): DtoInterface;
}
