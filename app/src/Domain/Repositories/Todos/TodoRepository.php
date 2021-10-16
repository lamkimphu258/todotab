<?php

namespace App\Domain\Repositories\Todos;

use App\Domain\Entities\Todos\Todo;
use App\Domain\Entities\Users\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function findLatestTodo()
    {
        return $this->findOneBy([], ['createdAt' => 'desc']);
    }

    public function save(Todo $todo)
    {
        $this->getEntityManager()->persist($todo);
        $this->getEntityManager()->flush();
    }

    public function findByOwner(User $owner): array
    {
        return $owner->getTodos()->toArray();
    }
}
