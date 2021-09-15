<?php

namespace App\Domain\Entities;

use DateTimeImmutable;

interface HasUpdatedDateInterface
{
    public function getUpdatedAt(): DateTimeImmutable;
}
