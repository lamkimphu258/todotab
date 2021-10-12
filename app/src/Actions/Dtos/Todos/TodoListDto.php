<?php

namespace App\Actions\Dtos\Todos;

use App\Actions\Dtos\ListDtoInterface;
use DateTimeImmutable;

/**
 * @codeCoverageIgnore
 */
class TodoListDto implements ListDtoInterface
{
    /**
     * @param  string  $name
     * @param  string  $slug
     * @param  DateTimeImmutable  $createdAt
     * @param  DateTimeImmutable  $updatedAt
     */
    public function __construct(
        public string $name,
        public string $slug,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt
    ) {
    }
}
