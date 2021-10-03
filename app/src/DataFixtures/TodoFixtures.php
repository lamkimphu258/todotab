<?php

namespace App\DataFixtures;

use App\Domain\Entities\Todos\Todo;
use App\Domain\Entities\Users\User;
use App\Factory\TodoFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * @codeCoverageIgnore
 */
class TodoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository(User::class)->findAll();
        /** @var User $user */
        foreach ($users as $user) {
            $todos = TodoFactory::createMany(10, fn() => ['name' => Factory::create()->userName]);
            foreach ($todos as $todo) {
                $todo->withoutAutoRefresh(function (Todo $todo) use ($user) {
                    $todo->assignOwner($user);
                    $user->addTodo($todo);
                });
                $todo->save();
            }
        }
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
