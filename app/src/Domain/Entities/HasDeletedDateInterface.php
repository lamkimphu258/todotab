<?php

namespace App\Domain\Entities;

use DateTimeImmutable;

interface HasDeletedDateInterface
{
    public function getDeletedAt(): DateTimeImmutable;
}
