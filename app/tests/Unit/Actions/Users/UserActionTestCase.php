<?php

namespace App\Tests\Unit\Actions\Users;

use App\Tests\Unit\Actions\ActionTestCase;

class UserActionTestCase extends ActionTestCase
{
    protected const INVALID_REQUEST_BODY = [
        'email' => '',
    ];

    protected const VALID_REQUEST_BODY = [
        'email' => 'example@email.com',
        'password' => 'password123ST@',
        'username' => 'username',
    ];
}
