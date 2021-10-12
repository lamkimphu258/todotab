<?php

namespace App\Tests\Unit\Filters\Todos;

use App\Tests\Unit\Filters\FilterTestCase;

abstract class TodoFilterTestCase extends FilterTestCase
{
    const VALID_REQUEST_BODY = [
        'name' => 'todo'
    ];
}
