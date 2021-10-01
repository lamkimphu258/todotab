<?php

namespace App\Domain\Entities\Todos;

use App\Domain\Entities\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Repositories\Todos\TodoRepository")]
 * @codeCoverageIgnore
 */
class Todo extends Entity implements TodoInterface
{
    /**
     * @var string
     * @ORM\Column (type="string", length=255)
     */
    private string $name;

    /**
     * @var string
     * @Gedmo\Slug (fields={"name"})
     * @ORM\Column (type="string", length=255)
     */
    private string $slug;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
