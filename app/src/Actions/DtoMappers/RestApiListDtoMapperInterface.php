<?php

namespace App\Actions\DtoMappers;

use App\Actions\Dtos\ListDtoInterface;

interface RestApiListDtoMapperInterface extends RestApiDtoMapperInterface
{
    /**
     * @param ListDtoInterface[]
     * @return array
     */
    public function fromDtos(array $listDto): array;

    /**
     * @param array $entities
     * @return ListDtoInterface[]
     */
    public function toDtos(array $entities): array;
}
