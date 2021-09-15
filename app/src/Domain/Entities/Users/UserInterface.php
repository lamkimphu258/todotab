<?php

namespace App\Domain\Entities\Users;

interface UserInterface extends \Symfony\Component\Security\Core\User\UserInterface
{
    public function getEmail(): string;
}
