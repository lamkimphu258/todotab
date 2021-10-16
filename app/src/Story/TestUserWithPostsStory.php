<?php

namespace App\Story;

use App\Domain\Entities\Todos\Todo;
use App\Factory\TodoFactory;
use App\Factory\UserFactory;
use Zenstruck\Foundry\Story;

final class TestUserWithPostsStory extends Story
{
    private const NUMBER_OF_TODOS = 10;

    public function build(): void
    {
        $userFactory = UserFactory::createOne([
            'email' => 'test@email.com',
            'password' => 'password123ST@',
            'username' => 'test',
        ]);
        $user = $userFactory->object();
        $todoFactories = TodoFactory::createMany(self::NUMBER_OF_TODOS);
        foreach ($todoFactories as $todoFactory) {
            $todoFactory->withoutAutoRefresh(function (Todo $todo) use ($user) {
                $todo->assignOwner($user);
                $user->addTodo($todo);
            });
            $todoFactory->save();
        }
    }
}
