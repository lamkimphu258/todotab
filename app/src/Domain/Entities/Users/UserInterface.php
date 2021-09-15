<?php

namespace App\Domain\Entities\Users;

interface UserInterface
{
    public function getEmail(): string;

    public function getPassword(): string;

    public function getUsername(): string;
}
