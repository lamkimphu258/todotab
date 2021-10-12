<?php

namespace App\Tests\Unit\Actions\Todos;

use App\Tests\Unit\Actions\ActionTestCase;

class TodoActionTestCase extends ActionTestCase
{
    protected const NUMBER_OF_TODOS = 2;

    protected const USERNAME = 'username';

    protected const SLUG = 'slug';

    protected const INVALID_REQUEST_BODY = [
        'name' => '',
    ];

    protected const VALID_REQUEST_BODY = [
        'name' => 'todo',
    ];
}
