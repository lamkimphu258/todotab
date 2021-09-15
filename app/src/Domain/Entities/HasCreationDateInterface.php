<?php

namespace App\Domain\Entities;

use DateTimeImmutable;

interface HasCreationDateInterface
{
    public function getCreatedAt(): DateTimeImmutable;
}
