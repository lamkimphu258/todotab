<?php

namespace App\Actions\DtoMappers\Todos;

use App\Actions\DtoMappers\RestApiObjectDtoMapperInterface;
use App\Actions\Dtos\Todos\TodoObjectDto;
use App\Domain\Entities\Todos\Todo;
use JetBrains\PhpStorm\Pure;

class TodoObjectDtoMapper implements RestApiObjectDtoMapperInterface
{
    /**
     * @param  Todo  $todo
     * @return TodoObjectDto
     */
    #[Pure] public function toDto(object $todo): TodoObjectDto
    {
        return new TodoObjectDto(
            $todo->getName(),
            $todo->getSlug(),
            $todo->getCreatedAt(),
            $todo->getUpdatedAt()
        );
    }

    /**
     * @param  TodoObjectDto  $dto
     * @return Todo
     * @codeCoverageIgnore
     */
    public function fromDto($dto): Todo
    {
    }
}
