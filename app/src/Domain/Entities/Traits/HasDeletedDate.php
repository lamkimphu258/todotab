<?php

namespace App\Domain\Entities\Traits;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @codeCoverageIgnore
 */
trait HasDeletedDate
{
    /**
     * @ORM\Column(name="deletedAt", type="datetime_immutable", nullable=true)
     */
    protected DateTimeImmutable $deletedAt;

    /**
     * @return DateTimeImmutable
     */
    public function getDeletedAt(): DateTimeImmutable
    {
        return $this->deletedAt;
    }
}
