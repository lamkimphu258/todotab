<?php

namespace App\Domain\Commands\Todos;

use App\Domain\Commands\CommandInterface;

/**
 * @codeCoverageIgnore
 */
class TodoCreateCommand implements CommandInterface
{
    private string $name;

    private $user;

    public function __construct(
        string $name,
        $user
    ) {
        $this->name = $name;
        $this->user = $user;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUser()
    {
        return $this->user;
    }
}
