<?php

namespace App\Domain\Services\Todos;

use App\Domain\Commands\CommandInterface;
use App\Domain\Entities\Todos\Todo;
use App\Domain\Repositories\Todos\TodoRepository;
use App\Domain\Repositories\Users\UserRepository;
use App\Domain\Services\AbstractService;

class TodoCreateService extends AbstractService
{
    private UserRepository $userRepository;

    public function __construct(
        TodoRepository $todoRepository,
        UserRepository $userRepository
    ) {
        parent::__construct($todoRepository);
        $this->userRepository = $userRepository;
    }

    public function handle(CommandInterface $command)
    {
        $todo = new Todo($command->getName());
        $todo->assignOwner($command->getUser());
        $this->repository->save($todo);
    }
}
