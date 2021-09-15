<?php

namespace App\Domain\Commands\Users;

use App\Domain\Commands\CommandInterface;

/**
 * @codeCoverageIgnore
 */
class UserRegisterCommand implements CommandInterface
{
    private string $email;

    private string $password;

    private string $username;

    /**
     * @param string $email
     * @param string $password
     * @param string $username
     */
    public function __construct(
        string $email,
        string $password,
        string $username
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}
