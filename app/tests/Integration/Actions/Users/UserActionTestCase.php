<?php

namespace App\Tests\Integration\Actions\Users;

use App\Tests\Integration\Actions\RestApiTestCase;

abstract class UserActionTestCase extends RestApiTestCase
{
    protected const INVALID_REQUEST_BODY = [
        'email' => '',
    ];

    protected const VALID_REQUEST_BODY = [
        'email' => 'email@example.com',
        'password' => 'password123ST@',
        'username' => 'username',
    ];
}
