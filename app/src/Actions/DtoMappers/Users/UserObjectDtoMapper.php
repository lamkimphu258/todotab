<?php

namespace App\Actions\DtoMappers\Users;

use App\Actions\DtoMappers\RestApiObjectDtoMapperInterface;
use App\Actions\Dtos\DtoInterface;
use App\Actions\Dtos\Users\UserObjectDto;
use App\Domain\Entities\Users\User;
use JetBrains\PhpStorm\Pure;

class UserObjectDtoMapper implements RestApiObjectDtoMapperInterface
{
    /**
     * @param DtoInterface $dto
     * @return object
     * @codeCoverageIgnore
     */
    public function fromDto(DtoInterface $dto): object
    {
        // TODO: Implement fromDto() method.
    }

    /**
     * @param object $entity
     * @return DtoInterface
     */
    #[Pure] public function toDto(object $entity): DtoInterface
    {
        /** @var User $entity */
        return new UserObjectDto(
            $entity->getId(),
            $entity->getEmail(),
            $entity->getUsername(),
            $entity->getCreatedAt(),
            $entity->getUpdatedAt()
        );
    }
}
