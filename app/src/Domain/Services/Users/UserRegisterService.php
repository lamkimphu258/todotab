<?php

namespace App\Domain\Services\Users;

use App\Domain\Commands\CommandInterface;
use App\Domain\Commands\Users\UserRegisterCommand;
use App\Domain\Entities\Users\User;
use App\Domain\Repositories\Users\UserRepository;
use App\Domain\Services\AbstractService;
use App\Domain\Services\Helper\Mailer;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserRegisterService extends AbstractService
{
    private Mailer $mailer;

    public function __construct(
        UserRepository $repository,
        Mailer $mailer
    ) {
        parent::__construct($repository);
        $this->mailer = $mailer;
    }

    /**
     * @param  UserRegisterCommand  $command
     * @return void
     */
    public function handle(CommandInterface $command)
    {
        $result = $this->repository->findOneByEmail($command->getEmail());
        if (!is_null($result)) {
            throw new BadRequestHttpException('Email is already existed');
        }

        $user = new User(
            $command->getEmail(),
            $command->getPassword(),
            $command->getUsername()
        );
        $this->repository->save($user);

        $this->mailer->sendVerificationEmail(
            $command->getEmail(),
            $command->getUsername()
        );
    }
}
