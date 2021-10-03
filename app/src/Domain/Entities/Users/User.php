<?php

namespace App\Domain\Entities\Users;

use App\Domain\Entities\Entity;
use App\Domain\Entities\Todos\Todo;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Repositories\Users\UserRepository")
 * @codeCoverageIgnore
 * @method string getUserIdentifier()
 */
class User extends Entity implements PasswordAuthenticatedUserInterface, UserInterface
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
     * @ORM\OneToMany(targetEntity="App\Domain\Entities\Todos\Todo", mappedBy="owner", cascade={"remove"}, orphanRemoval=true)
     */
    private Collection $todos;

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
        $this->todos = new ArrayCollection();
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

    public function verify()
    {
        $this->verifiedAt = new DateTimeImmutable();
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    /**
     * @return Collection
     */
    public function getTodos(): Collection
    {
        return $this->todos;
    }

    public function addTodo(Todo $todo)
    {
        $this->todos->add($todo);
    }
}
