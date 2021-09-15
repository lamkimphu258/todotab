<?php

namespace App\Domain\Services;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;

abstract class AbstractService implements ServiceInterface
{
    public function __construct(
        protected ServiceEntityRepositoryInterface $repository,
    ) {
    }
}
