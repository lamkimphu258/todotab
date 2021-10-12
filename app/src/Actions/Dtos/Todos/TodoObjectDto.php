<?php

namespace App\Actions\Dtos\Todos;

use App\Actions\Dtos\ObjectDtoInterface;
use DateTimeImmutable;

class TodoObjectDto implements ObjectDtoInterface
{
    public function __construct(
        public string $name,
        public string $slug,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt
    ) {
    }
}
