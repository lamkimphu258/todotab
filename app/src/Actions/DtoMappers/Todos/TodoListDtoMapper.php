<?php

namespace App\Actions\DtoMappers\Todos;

use App\Actions\DtoMappers\RestApiListDtoMapperInterface;
use App\Actions\Dtos\Todos\TodoListDto;
use App\Domain\Entities\Todos\Todo;
use JetBrains\PhpStorm\Pure;

class TodoListDtoMapper implements RestApiListDtoMapperInterface
{
    /**
     * @param  TodoListDto[]  $listDto
     * @return Todo[]
     * @codeCoverageIgnore
     */
    public function fromDtos(array $listDto): array
    {
        // TODO: Implement fromDto() method.
    }

    /**
     * @param  Todo[]  $entities
     * @return TodoListDto[]
     */
    #[Pure] public function toDtos(array $entities): array
    {
        $todoListDto = [];

        /** @var Todo $entity */
        foreach ($entities as $entity) {
            $todoListDto[] = new TodoListDto(
                $entity->getName(),
                $entity->getSlug(),
                $entity->getCreatedAt(),
                $entity->getUpdatedAt()
            );
        }

        return $todoListDto;
    }
}
