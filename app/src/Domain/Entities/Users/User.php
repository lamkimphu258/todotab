<?php

namespace App\Domain\Entities\Users;

use App\Domain\Entities\Entity;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Repositories\Users\UserRepository")
 * @codeCoverageIgnore
 */
class User extends Entity implements UserInterface
{
    /**
     * @ORM\Column(type="string", unique=true, nullable=false, length=255)
     */
    private string $email;

    /**
     * @ORM\Column(type="string", nullable=false, length=255)
     */
    private string $password;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false, length=255)
     */
    private string $username;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private DateTimeImmutable $verifiedAt;

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
        $this->password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );
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

    public function verify() {
        $this->verifiedAt = new DateTimeImmutable();
    }
}
