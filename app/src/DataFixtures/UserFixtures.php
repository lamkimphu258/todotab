<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Factory;

/**
 * @codeCoverageIgnore
 */
class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        UserFactory::createMany(
            10,
            fn() => [
                'email' => $faker->unique->email,
                'username' => $faker->unique->userName
            ]
        );
    }
}
