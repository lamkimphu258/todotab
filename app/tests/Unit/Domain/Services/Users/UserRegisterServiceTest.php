<?php

namespace App\Unit\Domain\Services\Users;

use App\Domain\Commands\Users\UserRegisterCommand;
use App\Domain\Entities\Users\User;
use App\Domain\Repositories\Users\UserRepository;
use App\Domain\Services\Helper\Mailer;
use App\Domain\Services\Users\UserRegisterService;
use App\Factory\UserFactory;
use App\Tests\Unit\Domain\Services\Users\UserRegisterServiceTestCase;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserRegisterServiceTest extends UserRegisterServiceTestCase
{
    public function testEmailIsAlreadyExisted()
    {
        $userFactory = UserFactory::createOne();

        $command = $this->createMock(UserRegisterCommand::class);
        $command->expects($this->once())
            ->method('getEmail')
            ->with()
            ->willReturn($userFactory->getEmail());
        $command->expects($this->never())
            ->method('getPassword')
            ->with()
            ->willReturn($userFactory->getPassword());
        $command->expects($this->never())
            ->method('getUsername')
            ->with()
            ->willReturn($userFactory->getUsername());

        $user = new User(
            $userFactory->getEmail(),
            $userFactory->getPassword(),
            $userFactory->getUsername()
        );

        $repository = $this->createMock(UserRepository::class);
        $repository->expects($this->once())
            ->method('findOneByEmail')
            ->with($user->getEmail())
            ->willReturn($user);

        $mailer = $this->createMock(Mailer::class);

        $service = new UserRegisterService(
            $repository,
            $mailer
        );

        $this->expectException(BadRequestHttpException::class);

        $service->handle($command);
    }

    public function testSaveUserSuccessfully()
    {
        $userFactory = UserFactory::createOne();

        $command = $this->createMock(UserRegisterCommand::class);
        $command->expects($this->any())
            ->method('getEmail')
            ->with()
            ->willReturn($userFactory->getEmail());
        $command->expects($this->any())
            ->method('getPassword')
            ->with()
            ->willReturn($userFactory->getPassword());
        $command->expects($this->any())
            ->method('getUsername')
            ->with()
            ->willReturn($userFactory->getUsername());

        $repository = $this->createMock(UserRepository::class);
        $repository->expects($this->once())
            ->method('findOneByEmail')
            ->with($userFactory->getEmail())
            ->willReturn(null);
        $repository->expects($this->once())
            ->method('save');

        $mailer = $this->createMock(Mailer::class);

        $service = new UserRegisterService($repository, $mailer);

        $service->handle($command);
    }
}
