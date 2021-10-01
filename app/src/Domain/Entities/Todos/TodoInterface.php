<?php

namespace App\Domain\Entities\Todos;

interface TodoInterface
{
    public function getName(): string;

    public function getSlug(): string;
}
