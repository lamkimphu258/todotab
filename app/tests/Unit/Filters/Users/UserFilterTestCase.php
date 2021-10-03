<?php

namespace App\Tests\Unit\Filters\Users;

use App\Tests\Unit\Filters\FilterTestCase;

abstract class UserFilterTestCase extends FilterTestCase
{
    protected const INVALID_REQUEST_BODY = [
        'email' => '',
    ];

    protected const VALID_REQUEST_BODY = [
        'email' => 'email@example.com',
        'password' => '$2y$13$ZKGX0LJ.YOh8FmsLCJrYoeYtqukwVw/xe3dBAOxvE8k5lu3VicJBW',
        'username' => 'username',
    ];
}
