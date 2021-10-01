<?php

namespace App\Tests\Integration\Domain\Repositories\Todos;

use App\Tests\Integration\Domain\Repositories\RepositoryTestCase;

abstract class TodoRepositoryTestCase extends RepositoryTestCase
{
    protected const NUMBER_OF_TODOS = 10;
}
