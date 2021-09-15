<?php

namespace App\Tests\Unit\Filters;

use PHPUnit\Framework\TestCase;

abstract class UserFilterTestCase extends TestCase
{
    protected const INVALID_REQUEST_BODY_MESSAGE = 'invalid-request-body-message';

    protected const INVALID_REQUEST_BODY = [
        'email' => '',
    ];

    protected const VALID_REQUEST_BODY = [
        'email' => 'email@example.com',
        'password' => '$2y$13$ZKGX0LJ.YOh8FmsLCJrYoeYtqukwVw/xe3dBAOxvE8k5lu3VicJBW',
        'username' => 'username',
    ];

    protected const HAVE_ERRORS = 1;

    protected const HAVE_NO_ERROR = 0;
}
