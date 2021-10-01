<?php

namespace App\DataFixtures;

use App\Factory\TodoFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @codeCoverageIgnore
 */
class TodoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        TodoFactory::createMany(10);
    }
}
