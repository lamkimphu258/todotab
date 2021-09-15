<?php

namespace App\Tests\Integration\Domain\Repositories;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

abstract class RepositoryTestCase extends KernelTestCase
{
    use Factories;

    use ResetDatabase;

    protected ManagerRegistry $managerRegistry;

    public function setUp(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $this->managerRegistry = $container->get(ManagerRegistry::class);
    }
}
