<?php

namespace App\Domain\Repositories\Users;

use App\Domain\Entities\Users\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param User $user
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function findOneByEmail(string $email): mixed
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param string $username
     * @return mixed
     */
    public function findOneByUsername(string $username): mixed
    {
        return $this->findOneBy(['username' => $username]);
    }
}
