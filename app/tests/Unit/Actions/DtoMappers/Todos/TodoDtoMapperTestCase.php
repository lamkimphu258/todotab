<?php

namespace App\Tests\Unit\Actions\DtoMappers\Todos;

use App\Tests\Unit\Actions\DtoMappers\DtoMapperTestCase;

abstract class TodoDtoMapperTestCase extends DtoMapperTestCase
{
    protected const NUMBER_OF_TODOS = 10;

    protected const SLUG = 'todo';
}
