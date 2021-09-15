<?php

namespace App\Tests\Integration\Domain\Repositories\Users;

use App\Domain\Entities\Users\User;
use App\Domain\Repositories\Users\UserRepository;
use DateTimeImmutable;

class UserRepositoryTest extends UserRepositoryTestCase
{
    public function testSaveUser()
    {
        $userRepository = new UserRepository($this->managerRegistry);

        $user = new User(self::EMAIL, self::PASSWORD, self::USERNAME);
        $userRepository->save($user);

        /** @var User $newUser */
        $newUser = $userRepository->findOneByEmail(self::EMAIL);

        $this->assertNotNull($newUser);

        $this->assertIsString($newUser->getId());
        $this->assertIsString($newUser->getEmail());
        $this->assertIsString($newUser->getPassword());
        $this->assertIsString($newUser->getUsername());
        $this->assertInstanceOf(DateTimeImmutable::class, $newUser->getCreatedAt());
        $this->assertInstanceOf(DateTimeImmutable::class, $newUser->getUpdatedAt());

        $this->assertEquals(self::EMAIL, $newUser->getEmail());
        $this->assertNotEquals(self::PASSWORD, $newUser->getPassword());
        $this->assertEquals(self::USERNAME, $newUser->getUsername());
    }
}
